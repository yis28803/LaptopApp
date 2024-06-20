@extends('dashboard')
@section('title','Cart')

@section('content')
   

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-cyan-400 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <input id="check-all" type="checkbox" class="rounded-md border-gray-500"/>
                </th>
                <th scope="col" class="px-16 py-3">
                    <span class="sr-only">Image</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    Laptop
                </th>
                <th scope="col" class="px-6 py-3">
                    Qty
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Total money
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
          @if (isset($carts))
          @foreach ($carts as $item)
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td scope="col" class="px-6 py-3">
                  <input id="check-item" type="checkbox"  class="check-item rounded-md border-gray-500"/>
                  <input class="id" class="hidden" type="hidden" value={{ $item->id }}/>
              </td>
              
              <td class="p-4 hover:border-cyan-600 border-cyan-400">
                <div class="hover:border-cyan-600 border-cyan-400">
                    <a href="/laptops/{{ $item->laptop->id }}" >
                        <img src={{ $item->laptop->avatar_url }} class="w-16 md:w-32 max-w-full max-h-full cursor-pointer hover:border-cyan-600 border-3 rounded-md" alt={{ $item->laptop->name }}>
                    </a>
                </div>
               
              </td>
              <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                 {{ $item->laptop->name }}
              </td>
              <td class="px-6 py-4">
                  <form id="change_quantity_form-{{ $item->id }}" action={{ route('cart.update_quantity',['id'=>$item->id]) }} method="POST">
                      @csrf
                      <input type="number" name="quantity" class="rounded-md border-gray-400 px-2.5 py-1 w-24 text-sm quantity" value={{ $item->quantity }} onchange="submitForm({{ $item->id }})">
                  </form>
              </td>
              <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white price">
                  {{ $item->laptop->price }}
              </td>
              <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                 {{ $item->total_money }}
              </td>
              <td class="px-6 py-4">
                  <form action="{{ route('cart.delete',$item->id) }}" method="POST" >
                      @csrf
                      @method('DELETE')
                      <x-icon-button class="">
                          {{ __('X') }}
                       </x-icon-button>
                  
                     </form>
                  
              </td>
          </tr>
         
          @endforeach
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td scope="col" class="px-6 py-3">
              </td>
              <td class="p-4">
                
              </td>
              <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
              <span class="font-bold text-lg text-red-600">
              Total bill
             </span>
              </td>
              <td class="px-6 py-4">
                 
              </td>
              <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                
              </td>
              <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                <span id="total-value">
                </span>
              </td>
              <td class="px-6 py-4">
                  <form id="order-form" action={{ route('order.show_create') }} method="POST" >
                      @csrf
                      <input type='text' name="total_money" id="total_money" class="hidden"/>
                      <input type="text" name="cart_ids" id="selected_ids" class="hidden"/>
                      <button type="submit" id="orderButton" class="rounded-md px-2 py-1 text-white bg-cyan-400 hover:bg-cyan-600 shawdow-sm hover:shadow-md">
                          Order
                      </button>
                  </form>
              </td>
          </tr>
          @endif
          
            
        </tbody>
    </table>
    

</div>
<script>
    
    document.addEventListener("DOMContentLoaded", function() {
    const checkboxes = document.querySelectorAll('.check-item');
    const checkAll = document.getElementById('check-all');
    const totalValue = document.getElementById('total-value');
    const selected_ids = document.getElementById('selected_ids');
    const totalMoney = document.getElementById('total_money');
    
    
    function calculateTotal() {
        let total = 0;
        const list_id=[];

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const row = checkbox.closest('tr');
                const price = parseFloat(row.querySelector('.price').innerText);
                const quantity = parseFloat(row.querySelector('.quantity').value);
                const id = parseInt(row.querySelector('.id').value);
                list_id.push(id);
                total += price * quantity;  
            }
        });
      
        selected_ids.value=JSON.stringify(list_id);
        totalMoney.value=total.toFixed(2);
        totalValue.textContent = total.toFixed(2);
    }
    
    checkAll.addEventListener('change', () => {
        checkboxes.forEach(checkbox => {
            checkbox.checked = checkAll.checked;
        });
        calculateTotal();
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            calculateTotal();
        });
    });

    const quantityInputs = document.querySelectorAll('.quantity');
    quantityInputs.forEach(input => {
        input.addEventListener('input', () => {
            calculateTotal();
        });
    });
   
   
});
    function submitForm(id){
        document.getElementById('change_quantity_form-'+id).submit();
   }

   
</script>


@endsection