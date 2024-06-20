@extends('admin.admin')
@section('title', 'Admin Home')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-cyan-400 text-2xl font-bold">Monthly Income</h1>

    <canvas id="incomeChart" width="400" height="200"></canvas>

    <hr class="border-gray-100 my-3 border-4 rounded"/>
    <h1 class="text-yellow-400 text-2xl font-bold">VIP Customers</h1>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-yellow-400 dark:bg-gray-700 dark:text-gray-400">
            <tr >
                <th scope="col" class="px-6 py-3">
                   ID
                </th>
                <th scope="col" class="px-6 py-3">
                   Fullname
                </th>
                <th scope="col" class="px-6 py-3">
                   
                    Email
                 </th>
                 <th scope="col" class="px-6 py-3">
                    Orders
                </th>
                <th scope="col" class="px-6 py-3">
                    Spent money
                </th>

            </tr>
        </thead>
        <tbody>
            @if (isset($vip_customers))
                @foreach ($vip_customers as $item)
                <tr class="odd:bg-white even:bg-gray-100">
                  
                        <td scope="col" class="px-6 py-3">
                            {{ $item->id }}
                        </td>
                        <td scope="col" class="px-6 py-3">
                            {{ $item->name }}
                        </td>
                        <td scope="col" class="px-6 py-3">
                            {{ $item->email }}
                        </td>
                        <td scope="col" class="px-6 py-3">
                            {{ $item->total_orders }}
                        </td>
                        <td scope="col" class="px-6 py-3">
                            {{ $item->total_spent }}
                        </td>
                     

                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <hr class="border-gray-100 my-3 border-4 rounded"/>

    <a href="/admin/orders/search?keyword=&status=pending">
        <h1 class="text-cyan-400 text-2xl font-bold hover:underline ">Unapproved Orders</h1>
    </a>
    


    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-cyan-400 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                   ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Fullname
                </th>
                <th scope="col" class="px-6 py-3">
                   Address
                </th>
                <th scope="col" class="px-6 py-3">
                   Product QTY
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
           
            @if (isset($un_viewed_orders))
                @foreach ($un_viewed_orders as $item)
                <tr class="odd:bg-white even:bg-gray-100">
                    <td scope="col" class="px-6 py-3">
                        {{ $item->id }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $item->fullname }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ $item->shipping_address }}
                    </td>
                    <td scope="col" class="px-6 py-3">
                        {{ count($item->orderDetails) }}
                    </td>
                  
                    <td scope="col" class="px-6 py-3">
                        {{ $item->total_money }}
                    </td>
                    <td class="items-center">
                        <a href={{ route('admin_order.getById',['id'=>$item->id]) }}>
                            <div class="text-yellow-500  hover:underline hover:text-yellow-700">
                            details
                            </div>
                        </a>
                    </td>
                </tr>
                  <hr>
                @endforeach
            @endif
        </tbody>
    </table>
    <hr>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const vnpayIncome = @json($vnpay_income);
            const codIncome = @json($cod_income);

            // Chuẩn bị dữ liệu cho biểu đồ
            const labels = vnpayIncome.map(item => `${item.month}/${item.year}`);
            const vnpayData = vnpayIncome.map(item => item.vnpay_total_income);
            const codData = codIncome.map(item => item.cod_total_income);

            const data = {
                labels: labels,
                datasets: [
                    {
                        label: 'VNPay',
                        data: vnpayData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'COD',
                        data: codData,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }
                ]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            // Vẽ biểu đồ
            const incomeChart = new Chart(
                document.getElementById('incomeChart'),
                config
            );
        });

        </script>
</div>

@endsection