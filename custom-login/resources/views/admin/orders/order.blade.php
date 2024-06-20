@extends('admin.admin')
@section('title', 'Manage Orders')

@section('content')
<div class="container mx-auto p-4">
    <div class="p-2 mb-4">
        <form method="GET" action="{{ route('admin_order.search') }}">
            <div class="flex items-center space-x-2">
                <x-text-input id="keyword" class="block w-50 mr-2"
                type="text"
                name="keyword"
                placeholder="name or email or phone" />
                <select id="status" name="status" class=" mr-2 rounded border-gray-300 w-50 text-gray-500 focus:ring-indigo-500 shadow-sm">
                    <option value="">-- Select Status --</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <x-primary-button class="mr-2">Search</x-primary-button>
            </div>
        </form>
    </div>

    <x-table :headers="['ID', 'Fullname',  'Phone Number', 'Order Date', 'Status', 'Total Money', 'Actions']" :data="$orders" class="border-collapse border border-gray-200">
        @foreach ($orders as $order)
        <tr>
            <td class="px-6 py-4">{{ $order->id }}</td>
         
            <td class="px-6 py-4">{{ $order->fullname }}</td>
           
            <td class="px-6 py-4">{{ $order->phone_number }}</td>
            <td class="px-6 py-4">{{ $order->order_date }}</td>
            <td class="px-6 py-4">{{ $order->status }}</td>
            <td class="px-6 py-4">{{ $order->total_money }}</td>
            <td class="px-6 py-4 space-x-2 flex items-center">
                <x-nav-link :href="route('admin_order.getById', ['id' => $order->id])" class="text-yellow-400 hover:text-yellow-900">
                    {{ __('Details') }}
                </x-nav-link>
                
                @if ($order->status == 'pending' || $order->status == 'processing')
                    <form method="POST" action="{{ route('admin_order.delete', ['id' => $order->id]) }}" class="inline cursor-pointer">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-lg font-bold bg-red-400 hover:bg-red-600 rounded-md shadow-sm text-white px-3 py-1">
                            X
                        </button>
                    </form>
                @endif
            
                @if ($order->paid == 1) 
                    <div class="bg-green-500 flex items-center justify-center text-white w-8 h-8 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check text-lg" viewBox="0 0 16 16">
                            <path d="M13.293 4.293a1 1 0 0 1 0 1.414l-7 7a1 1 0 0 1-1.414 0l-3-3a1 1 0 1 1 1.414-1.414L6 10.586l6.293-6.293a1 1 0 0 1 1.414 0z"/>
                        </svg>
                    </div>
                @endif
            </td>
            
        </tr>

        @endforeach
    </x-table>

    {{ $orders->links() }}
</div>
@endsection
