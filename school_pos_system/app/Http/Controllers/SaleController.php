<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Sale::with(['customer', 'user', 'saleItems'])
            ->orderBy('created_at', 'desc');

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter by customer
        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        // Filter by payment method
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        $sales = $query->paginate(20);
        
        // Calculate totals
        $totalSales = $query->sum('total_amount');
        $totalCount = $query->count();

        return view('sales.index', compact('sales', 'totalSales', 'totalCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This would typically redirect to POS
        return redirect()->route('pos.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Sales are created through POS
        return redirect()->route('pos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sale->load(['customer', 'user', 'saleItems.product']);
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        // Sales should not be editable after creation
        return redirect()->route('sales.show', $sale)->with('error', 'Sales cannot be edited.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        // Sales should not be editable after creation
        return redirect()->route('sales.show', $sale)->with('error', 'Sales cannot be edited.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        // Only allow deletion if sale is pending
        if ($sale->status !== 'pending') {
            return redirect()->route('sales.index')->with('error', 'Only pending sales can be deleted.');
        }

        // Restore stock quantities
        foreach ($sale->saleItems as $item) {
            if ($item->product && $item->product->track_quantity) {
                $item->product->increment('stock_quantity', $item->quantity);
            }
        }

        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }

    public function receipt(Sale $sale)
    {
        return redirect()->route('pos.receipt', $sale);
    }
}
