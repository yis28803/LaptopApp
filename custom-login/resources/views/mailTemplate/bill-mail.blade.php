<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-200">
    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-semibold mb-4">Invoice</h1>
            <div class="flex justify-between mb-4">
                <div>
                    <p class="font-semibold">Customer: {{ $order->fullname }}</p>
                    <p>Email: {{ $order->email }}</p>
                </div>
                <div>
                    <p>Order Date: {{ $order->order_date }}</p>
                    <p>Status: {{ $order->status }}</p>
                </div>
            </div>
            <table class="w-full border-collapse border border-gray-400 mt-4">
                <thead>
                    <tr>
                        <th class="p-2 border border-gray-400">Product</th>
                        <th class="p-2 border border-gray-400">Price</th>
                        <th class="p-2 border border-gray-400">Quantity</th>
                        <th class="p-2 border border-gray-400">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderDetails as $detail)
                    <tr>
                        <td class="p-2 border border-gray-400">{{ $detail->laptop->name }}</td>
                        <td class="p-2 border border-gray-400">{{ $detail->price }}</td>
                        <td class="p-2 border border-gray-400">{{ $detail->number_of_products }}</td>
                        <td class="p-2 border border-gray-400">{{ $detail->total_money }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-end mt-4">
                <p class="font-semibold">Total: {{ $order->total_money }}</p>
            </div>
            <div class="mt-8">
                <p class="text-gray-600">Thank you for your purchase!</p>
                <p class="text-gray-600">Laptop Shop</p>
                <p class="text-gray-600">123 Fake Street, Faketown</p>
                <p class="text-gray-600">Fakecountry</p>
            </div>
        </div>
    </div>
</body>
</html>
