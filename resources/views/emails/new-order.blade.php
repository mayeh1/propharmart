<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: sans-serif; color: #0f172a;">
    <h2>New order received: {{ $order->order_number }}</h2>

    <p><strong>Customer:</strong> {{ $order->customer_name }} ({{ $order->customer_email }})</p>
    @if($order->customer_phone)
        <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
    @endif
    <p><strong>Shipping address:</strong> {{ $order->shipping_address }}</p>

    <table cellpadding="6" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-top: 16px;">
        <thead>
            <tr style="text-align: left; border-bottom: 1px solid #e2e8f0;">
                <th>Item</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>£{{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 16px;">
        <strong>Subtotal:</strong> £{{ number_format($order->subtotal, 2) }}<br>
        <strong>Shipping:</strong> £{{ number_format($order->shipping, 2) }}<br>
        <strong>Total:</strong> £{{ number_format($order->total, 2) }}
    </p>

    <p>Thanks,<br>{{ config('app.name') }}</p>
</body>
</html>
