@extends('dashboard')
@section('title','Payment')

@section('content')
<div class="p-1">
    <form action ={{ route('order.create') }} method="POST">
        @csrf
        
        <div class="flex flex-col ">
            <div class="flex items-center text-cyan-400 font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22s8-9.155 8-13a8 8 0 0 0-16 0c0 3.845 8 13 8 13zm0 0V10"/>
                  </svg>
                  <span class="mx-2 text-2xl"> Receive Address </span>
            </div>
            <div class="my-2 grid sm:grid-cols-2 gap-3">
                <input type="text" name="receiver" placeholder="receiver's fullname" class=" border-gray-400 shadow-sm  rounded-md hover:border-gray-600 sm:col-span-1" required/>       
                <input type="text" name="phone" placeholder="receriver's phone number" class="border-gray-400 shadow-sm rounded-md hover:border-gray-600 sm:col-span-1" required/>       
                 <input type="text" name="address" class=" border-gray-400 shadow-sm rounded-md hover:border-gray-600 sm:col-span-2" placeholder="received address" required/>
                 <input type="text" name="email" class=" border-gray-400 shadow-sm rounded-md hover:border-gray-600 sm:col-span-2" placeholder="email" required/>
            </div>
            <hr class="border-gray-100 my-1 border-4 rounded"/>
            <div class="flex items-center mt-1 text-cyan-400 font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h12a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/>
                    <rect x="2" y="10" width="20" height="8" rx="2" ry="2"/>
                  </svg>
                  <span class="mx-2 text-2xl"> Products </span>
            </div>
            <div class="relative overflow-x-auto shadow-sm sm:rounded-lg ">
                <table class="w-full text-sm text-left rtl:text-right border-gray-200">
                    <thead class="text-xl  uppercase ">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-gray-600">
                                Laptop
                            </th>
                            <th scope="col" class="px-6 py-3 text-gray-400">
                                Qty
                            </th>
                            <th scope="col" class="px-6 py-3 text-gray-400">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3 text-gray-400">
                                Total money
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                      @if (isset($cart_items))
                      @foreach ($cart_items as $item)
                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                         
                          <td class="px-6 py-4 font-semibold text-gray-600  ">
                            <a href="/laptops/{{ $item->laptop->id }}" class="mr-3 flex items-center" >
                                <img src={{ $item->laptop->avatar_url }} class="w-16 md:w-32 max-w-full max-h-full cursor-pointer hover:border-cyan-600 border-3 rounded-md" alt={{ $item->laptop->name }}>
                                {{ $item->laptop->name }}
                            </a>
                          

                          </td>
                          <td class="px-6 py-4 text-gray-400">
                           {{ $item->quantity }}
                          </td>
                          <td class="px-6 py-4 font-semibold text-gray-400  price">
                              {{ $item->laptop->price }}
                          </td>
                          <td class="px-6 py-4 font-semibold text-gray-400 ">
                             {{ $item->total_money }}
                          </td>
                      </tr>
                      @endforeach
                      @endif
                    
                    </tbody>
                </table>
            </div>
           <div class="flex items-center px-3 py-5 w-full bg-cyan-50 my-1 ">
            <span class="mr-3 text-gray-500">
               Message:
            </span>
            <input type="text" name="note" placeholder="note for seller" class="flex-1 border-gray-400 shadow-sm  rounded-md"/>       
           </div>
         
           <hr class="border-gray-100 my-1 border-4 rounded"/>
           <div class="grid grid-cols-2 gap-3">
                <div class="sm:col-span-1 col-span-2">
                    <div class="flex sm:items-center text-cyan-400 font-bold py-4">
                        <img src="{{ asset('images/payment_method.png') }}" alt="" class="block h-9 w-auto fill-current text-gray-800"/>
                        <span class="text-2xl mx-2 text-cyan-400"> Payment method </span>
                
                        <select id="payment_method" name="payment_method" class="w-52 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mx-2  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                          <option value="COD">COD</option>
                          <option value="VNPAY" >VNPay</option>
                          <option value="MOMO" disabled>MOMO</option>
                          <option value="CREDIT-CARD" disabled>Credit card</option>
                          <option value="GG_Pay" disabled>Google Payment</option>
                          
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-1 col-span-2 flex flex-col ">
                   
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">
                                total product price:
                            </span>
                            <input  value="$ {{ $total_money }}" class="border-none text-end" disabled  required/>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">
                                tax:
                            </span>
                            <input  value="$ {{ $total_money/10 }}" class="border-none text-end" disabled required />
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">
                                Total bill:
                            </span>
                            <?php
                            function getCartItemIDsAsString($cart_items) {
                            $id_list = array(); 

                            foreach ($cart_items as $cart_item) {
                                if (isset($cart_item->id)) {
                                    // Nếu có, thêm id vào danh sách
                                    $id_list[] = $cart_item->id;
                                }
                            }

                            $json_string = json_encode($id_list);

                            return $json_string;
                            }
                            $id_string = getCartItemIDsAsString($cart_items);
                            ?>
                            <input  value="$ {{ $total_money + $total_money/10 }}" class="border-none text-cyan-400 font-bold text-end text-2xl" disabled />
                            <input value="{{ $total_money/10 }}" name="tax" class="hidden" required/>
                            <input type="text" name="total_money" id="" class="hidden" value="{{ $total_money +$total_money/10 }}"/>
                            <input type="text" name="cart_ids" id="selected_ids" class="hidden" value="{{ $id_string }}"/>
                        </div>
                   <button type="submit" class="px-3 py-2 bg-cyan-400 hover:bg-cyan-600 text-white uppercase rounded-md border-gray-300 shadow-sm">
                    Order
                   </button>
                </div>

           </div>
        </div>
    </form>
</div>
@endsection