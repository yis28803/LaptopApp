@extends('dashboard')
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
                <p><strong>Email:</strong> {{ $order->email }}</p>
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
    @if ($order->status == 'pending')
    <div class="flex justify-start mt-4">
        <x-danger-button class="mr-4">
            {{ __('DELETE') }}
        </x-danger-button>
        @if (Auth()->user()->user_type == 'admin')
            <x-primary-button>
                {{ __('ACCEPTED') }}
            </x-primary-button>
        @endif
    
    </div>
    @else
    <div class="mt-4">
        <x-input-error :messages="['NO ACTION']" />
    </div>
    @endif
</div>
@endsection
