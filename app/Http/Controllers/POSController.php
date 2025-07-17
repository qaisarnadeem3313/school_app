<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    public function index()
    {
        $categories = Category::active()->with('products')->get();
        $products = Product::active()->with('category')->get();
        $customers = Customer::active()->get();
        
        return view('pos.index', compact('categories', 'products', 'customers'));
    }

    public function processSale(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,card,account',
            'paid_amount' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Calculate totals
            $subtotal = 0;
            $saleItems = [];

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                // Check stock
                if ($product->track_quantity && $product->stock_quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                $totalPrice = $product->price * $item['quantity'];
                $subtotal += $totalPrice;

                $saleItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'unit_price' => $product->price,
                    'quantity' => $item['quantity'],
                    'total_price' => $totalPrice,
                ];

                // Update stock
                if ($product->track_quantity) {
                    $product->decrement('stock_quantity', $item['quantity']);
                }
            }

            $taxRate = 0.10; // 10% tax
            $taxAmount = $subtotal * $taxRate;
            $totalAmount = $subtotal + $taxAmount;
            $paidAmount = $request->paid_amount;
            $changeAmount = $paidAmount - $totalAmount;

            if ($changeAmount < 0) {
                throw new \Exception("Insufficient payment amount");
            }

            // Create sale
            $sale = Sale::create([
                'sale_number' => Sale::generateSaleNumber(),
                'customer_id' => $request->customer_id,
                'user_id' => 1, // Default user for now
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'discount_amount' => 0,
                'total_amount' => $totalAmount,
                'paid_amount' => $paidAmount,
                'change_amount' => $changeAmount,
                'payment_method' => $request->payment_method,
                'status' => 'completed',
                'notes' => $request->notes,
            ]);

            // Create sale items
            foreach ($saleItems as $saleItem) {
                $saleItem['sale_id'] = $sale->id;
                SaleItem::create($saleItem);
            }

            // Update customer balance if paying with account
            if ($request->payment_method === 'account' && $request->customer_id) {
                $customer = Customer::find($request->customer_id);
                if ($customer->balance < $totalAmount) {
                    throw new \Exception("Insufficient account balance");
                }
                $customer->decrement('balance', $totalAmount);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Sale processed successfully',
                'sale_id' => $sale->id,
                'receipt_url' => route('pos.receipt', $sale->id)
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function receipt(Sale $sale)
    {
        $sale->load(['customer', 'saleItems', 'user']);
        return view('pos.receipt', compact('sale'));
    }
}
