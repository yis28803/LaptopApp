<?php
    $index = 1;
?>

@if ($orders->count() > 0)
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-cyan-400 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Num.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Order
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Receiver
                    </th>  
                  
                  
                    <th scope="col" class="px-6 py-3">
                        Total money
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ORDER DATE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="col" class="px-6 py-3 flex-1">
                           {{ $index++ }}
                        </td>
                        <td scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                <img src={{ $order->orderDetails->first()->laptop->avatar_url }} class="w-10 md:w-16 max-h-full cursor-pointer hover:border-cyan-600 border-3 rounded-md" alt={{ "order $order->id" }}>
                                <div class="flex flex-col px-3 text-gray-900 font-bold">
                                    @foreach ($order->orderDetails as $detail)
                                       <span > 
                             -   {{ $detail->number_of_products }}  {{ $detail->laptop->name }} 
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                        <td class="p-4 hover:border-cyan-600 border-cyan-400">
                            {{ $order->fullname }}
                        </td>
                     
                        <td class="px-6 py-4">
                            {{ $order->total_money }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->status }}
                        </td>
                        <td class="px-6 py-4 font-semibold  ">
                            {{ $order->order_date }}
                          </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            @if ($order->status === 'pending' || $order->status == 'processing')
                            <div class="flex items-center" >
                                @if ($order->payment_method == 'VNPAY' && $order->paid == false)
                                    <form action ={{route('vnpay_payment',['id'=>$order->id])}} method="GET">
                                        @csrf
                                        <button type="submit" class="border-gray-300 uppercase shadow-sm rounded-md px-2 py-1 bg-green-300 hover:bg-green-600 text-white">
                                            Pay
                                        </button>
                                    </form>
                                @endif
                                <form action={{ route('order.getById',['id'=>$order->id]) }} method="GET">
                                    <button type="submit" class="border-gray-300 uppercase shadow-sm rounded-md px-2 py-1 bg-yellow-300 hover:bg-yellow-600 text-white">
                                        View
                                    </button>
                                </form>
                                <form action={{ route('orders.delete',['id'=>$order->id]) }} method="POST" class="ml-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-gray-300 uppercase shadow-sm rounded-md px-2 py-1 bg-red-400 hover:bg-red-800 text-white">
                                        Delete
                                    </button>
                                </form>
                            </div>
                            @else
                            <div class="flex ">
                                <form action={{ route('order.getById',['id'=>$order->id]) }} method="GET">
                                    <button type="submit" class="border-gray-300 uppercase shadow-sm rounded-md px-2 py-1 bg-yellow-300 hover:bg-yellow-600 text-white">
                                        View
                                    </button>
                                </form>

                                @if ($order->status == 'cancelled')
                                <button type="button" disabled class="border-gray-300 uppercase shadow-sm rounded-md px-2 py-1 bg-green-300 hover:bg-green-600 text-white mx-2">
                                   again
                                    </button>
                                @endif
                                @if ($order->status == 'delivered')
                                <form action={{ route('order.receive',['id'=>$order->id]) }} method="POST">
                                    @csrf
                                <button type="submit" class="border-gray-300 uppercase shadow-sm rounded-md px-2 py-1 bg-cyan-400 hover:bg-cyan-600 text-white mx-2">
                                    Received
                                 </button>
                                </form>
                                @endif
                            </div>
                        
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="font-bold text-1xl">There are not any orders.</p>
@endif
