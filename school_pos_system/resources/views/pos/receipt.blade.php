<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - {{ $sale->sale_number }}</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            max-width: 300px;
            margin: 0 auto;
            padding: 10px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .school-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .receipt-info {
            margin-bottom: 10px;
        }
        .receipt-info div {
            margin: 2px 0;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        .items-table th,
        .items-table td {
            text-align: left;
            padding: 2px;
            border-bottom: 1px solid #ccc;
        }
        .items-table th {
            border-bottom: 2px solid #000;
        }
        .text-right {
            text-align: right;
        }
        .total-section {
            border-top: 2px solid #000;
            padding-top: 5px;
            margin-top: 10px;
        }
        .total-line {
            display: flex;
            justify-content: space-between;
            margin: 2px 0;
        }
        .total-line.grand-total {
            font-weight: bold;
            font-size: 14px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #000;
            font-size: 10px;
        }
        @media print {
            body {
                margin: 0;
                padding: 5px;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="school-name">SCHOOL STORE</div>
        <div>Point of Sale System</div>
        <div>123 School Street</div>
        <div>Education City, EC 12345</div>
        <div>Phone: (555) 123-4567</div>
    </div>

    <div class="receipt-info">
        <div><strong>Receipt #:</strong> {{ $sale->sale_number }}</div>
        <div><strong>Date:</strong> {{ $sale->created_at->format('M d, Y H:i:s') }}</div>
        <div><strong>Cashier:</strong> {{ $sale->user->name }}</div>
        @if($sale->customer)
            <div><strong>Customer:</strong> {{ $sale->customer->name }}</div>
            @if($sale->customer->student_id)
                <div><strong>Student ID:</strong> {{ $sale->customer->student_id }}</div>
            @endif
        @else
            <div><strong>Customer:</strong> Walk-in</div>
        @endif
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>Item</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Price</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->saleItems as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">${{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-right">${{ number_format($item->total_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-line">
            <span>Subtotal:</span>
            <span>${{ number_format($sale->subtotal, 2) }}</span>
        </div>
        <div class="total-line">
            <span>Tax (10%):</span>
            <span>${{ number_format($sale->tax_amount, 2) }}</span>
        </div>
        @if($sale->discount_amount > 0)
            <div class="total-line">
                <span>Discount:</span>
                <span>-${{ number_format($sale->discount_amount, 2) }}</span>
            </div>
        @endif
        <div class="total-line grand-total">
            <span>TOTAL:</span>
            <span>${{ number_format($sale->total_amount, 2) }}</span>
        </div>
    </div>

    <div class="total-section">
        <div class="total-line">
            <span>Payment Method:</span>
            <span>{{ ucfirst($sale->payment_method) }}</span>
        </div>
        <div class="total-line">
            <span>Amount Paid:</span>
            <span>${{ number_format($sale->paid_amount, 2) }}</span>
        </div>
        @if($sale->change_amount > 0)
            <div class="total-line">
                <span>Change:</span>
                <span>${{ number_format($sale->change_amount, 2) }}</span>
            </div>
        @endif
    </div>

    @if($sale->notes)
        <div class="total-section">
            <div><strong>Notes:</strong></div>
            <div>{{ $sale->notes }}</div>
        </div>
    @endif

    <div class="footer">
        <div>Thank you for your purchase!</div>
        <div>Have a great day!</div>
        <div style="margin-top: 10px;">
            Items sold are not returnable.
        </div>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 14px;">
            Print Receipt
        </button>
        <button onclick="window.close()" style="padding: 10px 20px; font-size: 14px; margin-left: 10px;">
            Close
        </button>
    </div>

    <script>
        // Auto-print when page loads
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>