<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Laptop;
use App\Models\Order;
use App\Models\PaymentModel;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $favorite_laptops = Laptop::join('order_details', 'laptops.id', '=', 'order_details.product_id')
        ->select('laptops.*', DB::raw('COUNT(order_details.product_id) as order_amount'))
        ->groupBy('laptops.id')  
        ->orderBy('order_amount', 'DESC')
        ->take(8)
        ->get();
        

        $brands = Brand::join('laptops', 'brands.id', '=', 'laptops.brand_id')
        ->select('brands.id', 'brands.name', DB::raw('COUNT(laptops.brand_id) as laptops_per_brand'))
        ->groupBy('brands.id', 'brands.name')
        ->having('laptops_per_brand', '>', 0)
        ->get();

        $asus_laptops = Laptop::where('brand_id',5)
        ->orWhere('name','like',"%asus%")
        ->take(4)->get();
        $acer_laptops = Laptop::where('brand_id',6)->take(4)->get();
        
        if (Auth::id()) {
            $userType = Auth()->user()->user_type;
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
    
            $vnpayIncome = Order::select(
                    DB::raw('YEAR(order_date) as year'),
                    DB::raw('MONTH(order_date) as month'),
                    DB::raw('SUM(total_money) as vnpay_total_income')
                )
                ->where('paid', 1)
                ->where('payment_method', 'vnpay')
                ->groupBy('year', 'month')
                ->orderBy('month')
                ->get();
    
            $codIncome = Order::select(
                    DB::raw('YEAR(order_date) as year'),
                    DB::raw('MONTH(order_date) as month'),
                    DB::raw('SUM(total_money) as cod_total_income')
                )
                ->where('paid', 1)
                ->where('payment_method', 'cod')
                ->groupBy('year', 'month')
                ->orderBy('month')
                ->get();
    
            $unViewedOrders = Order::where('status', 'pending')->take(10)->get();
            $vip_customers = User::join("orders", 'users.id', '=', 'orders.user_id')
                ->select('users.id', 'users.name', 'users.email', DB::raw('COUNT(orders.id) as total_orders'), DB::raw('SUM(orders.total_money) as total_spent'))
                ->groupBy('users.id', 'users.name')
                ->orderBy('total_spent', 'DESC')
                ->take(10)
                ->get();
    
            if ($userType == 'user') {
              
                return view('home',
            [
                'favorite_laptops' => $favorite_laptops,
                'brands' => $brands,
                'asus_laptops' => $asus_laptops,
                'acer_laptops' => $acer_laptops
            ]
            );

            } else if ($userType == 'admin') {
                return view('admin.admin_home', [
                    'cod_income' => $codIncome,
                    'vnpay_income' => $vnpayIncome,
                    'un_viewed_orders' => $unViewedOrders,
                    'vip_customers' => $vip_customers,
                ]);
            } else {
                return redirect()->back();
            }
        }

       
        
        return view('home',
        [
            'favorite_laptops' => $favorite_laptops,
            'brands' => $brands,
            'asus_laptops' => $asus_laptops,
            'acer_laptops' => $acer_laptops
        ]
        );
    }
  
}
