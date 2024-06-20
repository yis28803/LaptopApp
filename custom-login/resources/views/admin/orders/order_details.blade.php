@extends('admin.admin')
@section('title','Order Details')


@section('content')
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    <!-- Order information -->
    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Order Information</h3>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/2 px-3 mb-2">
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-2">
                <p><strong>Order Date:</strong> {{ $order->order_date }}</p>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-2">
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-2 flex ">
                <p><strong>Paid:</strong> </p>
                @if ($order->paid==1)
                     <div class="underline rounded-md text-green-800 border-white mx-3" >
                        payment success   
                     </div>
                @else
                <div class="underline text-yellow-700  rounded-md border-white mx-3"  >
                   not paid  
                 </div>
                @endif
               
            </div>
        </div>
    </div>

    <!-- Customer information -->
    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Customer Information</h3>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/2 px-3 mb-2">
                <p><strong>Name:</strong> {{ $order->fullname }}</p>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-2">
                <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-2">
                <p><strong>Phone Number:</strong> {{ $order->phone_number }}</p>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-2">
                <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
            </div>
        </div>
    </div>

    <!-- Order items -->
    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Order Items</h3>
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($order_details as $detail)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ optional($detail->laptop)->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ optional($detail->laptop)->price }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->number_of_products }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->total_money }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Total -->
    <div class="mt-4">
        <p class="text-lg font-semibold">Total: ${{ $order->total_money }}</p>
    </div>

    <!-- Action buttons -->
    @if ($order->status == 'pending' || $order->status == 'processing')
    <div class="flex justify-start mt-4">
      
        <form method="POST" action="{{ route('admin_order.delete', ['id' => $order->id]) }}" class="inline cursor-pointer">
            @csrf
            @method('DELETE')
           <button type="submit" class="text-3xl font-bold bg-red-400 hover:bg-red-600 rounded-md shadow-sm text-white px-2 py-0">
           Delete
           </button>
        </form>
        @if ($order->status == 'pending')
      
        <form method="POST" action="{{ route('admin_order.accept', ['id' => $order->id]) }}" class="inline cursor-pointer mx-2">
            @csrf
           <button type="submit" class="text-3xl font-bold bg-green-400 hover:bg-green-800 rounded-md shadow-sm text-white px-2 py-0">
           Accepted
           </button>
        </form>
        @else
        <form method="POST" action="{{ route('admin_order.deliver', ['id' => $order->id]) }}" class="inline cursor-pointer mx-2">
            @csrf
           <button type="submit" class="text-3xl font-bold bg-blue-400 hover:bg-blue-800 rounded-md shadow-sm text-white px-2 py-0">
           Delivering
           </button>
        </form>
        @endif
       
    </div>
    @else
            <div class="mt-4">
                <x-input-error :messages="['NO ACTION']" />
            </div>
    @endif
</div>
@endsection