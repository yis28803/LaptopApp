<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laptop;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use App\Services\EmailService;

class OrderController extends Controller
{
    public function index()
    {   
        if (Auth::id()) {
            $userType = Auth()->user()->user_type;
            if ($userType == 'admin') {
                $orders = Order::orderBy("created_at",'desc')
                ->paginate(6);
                return view('admin.orders.order', compact('orders'));
            } else if ($userType == 'user') {
                $existing_user_id = Auth::id();
                $orders = Order::where('user_id',$existing_user_id)
                ->orderBy("order_date",'DESC')
                ->get();
                return view('order',compact('orders'));
            }
        }
    }
    public function create_or_update(Request $request)
    {
        $user_id = Auth::id();
        $cart_ids = json_decode($request->input('cart_ids'), true);
        $cart_items = CartItem::whereIn('id', $cart_ids)->get();

        $newOrder = Order::create([
            'user_id' => $user_id,
            'tax' => $request->input('total_money')/10,
            'fullname' => $request->input('receiver'),
            'phone_number' => $request->input('phone'),
            'note' => $request->input('note'),
            'payment_method' => $request->input('payment_method'),
            'status' => 'pending',
            'shipping_address' => $request->input('address'),
            'total_money' => $request->input('total_money'),
            'paid'=>false,
            'email'=>$request->input('email')
        ]);

        foreach ($cart_items as $item) {
           OrderDetails::create([
            'order_id'=>$newOrder->id,
            'product_id'=>$item->laptop_id,
            'price'=>$item->laptop->price,
            'number_of_products'=>$item->quantity,
            'total_money'=>$item->total_money,
            'color'=>$item->laptop->color,
           
           ]);
           $item->delete();
        }
        if($request->input('payment_method') == 'COD'){
            $mailService = new EmailService();
            if( $mailService->sendBillMail($newOrder)){
                return redirect()->route('orders.index')->with("message","Đặt hàng thành công");
            }
            return redirect()->route('orders.index');
        }
        return redirect()->route('vnpay_payment',['id'=>$newOrder->id]);
    }

    public function delete($id)
    {
        
        if (Auth::id()) {
            $userType = Auth()->user()->user_type;
            if ($userType == 'admin') {
                $order = Order::findOrFail($id);
                $order_details = OrderDetails::where('order_id', $order->id)->get();
                // $order_details->each->delete();
                // $order->delete();
                
                $order->status = 'cancelled';
                $order->save();
                return redirect()->route('admin_order.index')->with('success', 'Order has been deleted successfully.');
            } else if ($userType == 'user') {
                $order = Order::findOrFail($id);
                if ($order->user_id != Auth()->user()->id) {
                    abort(401);
                } else {
                    $order_details = OrderDetails::where('order_id', $order->id)->get();
                    // $order_details->each->delete();
                    // $order->delete();
                    $order->status = 'cancelled';
                    $order->save();
                    return redirect()->back()->with('success', 'Order has been deleted successfully');
                }
            }
        }
    }


    public function getById($id)
    {
        if (Auth::id()) {
            $userType = Auth()->user()->user_type;
            $order = Order::findOrFail($id);
            $order_details = OrderDetails::where('order_id', "$order->id")->get();
            if ($userType == 'admin') {
                return view('admin.orders.order_details', compact('order', 'order_details'));
            } else if ($userType == 'user') {
                if (Auth::id() != $order->user_id) {
                    abort(401);
                } else {
                    return view('order_details', compact('order', 'order_details'));
                }
            }
        }
    }

    public function searchByUserId($id)
    {
        if (Auth::id()) {
            $userType = Auth()->user()->user_type;
            if ($userType == 'admin') {
                $orders = Order::where('user_id', '=', "$id")
                    ->paginate(10);
                return view('admin.orders.order', compact('orders'));
            }
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $status = $request->input("status");
        
        $query = Order::query();
        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('fullname', 'like', "%$keyword%")
                  ->orWhere('email', $keyword)
                  ->orWhere('phone_number', $keyword)
                  ->orWhere('address', 'like', "%$keyword%");
            });
        }
        
        if (!empty($status)) {
            $query->where('status', $status);
        }
        $orders = $query->paginate(10);
        
        return view('admin.orders.order', compact('orders'));
    }
    

    public function showFormOrder(Request $request){
        $total_money = $request->input('total_money');
        $cart_ids = json_decode($request->input('cart_ids'), true);
        $cart_items = CartItem::whereIn('id',$cart_ids)->get();
        return view('checkout',compact('cart_items','total_money'));
    }

    public function adminOrder(){
       
    }
    public function accepted($id){
        if (Auth::id()) {
            $userType = Auth()->user()->user_type;
            if ($userType == 'admin') {
                $order = Order::findOrFail($id);
                $order->status = 'processing';
                $order->save();
                return redirect()->route('admin_order.index')->with('success', 'Order has been accepted successfully.');
            } else if ($userType == 'user') {
               abort(401);
            }
        }
    }

    public function deliver($id){
        if (Auth::id()) {
            $userType = Auth()->user()->user_type;
            if ($userType == 'admin') {
                $order = Order::findOrFail($id);
                $order->status = 'delivered';
                $order->save();
                return redirect()->route('admin_order.index')->with('success', 'Order has been delivered successfully.');
            } else if ($userType == 'user') {
               abort(401);
            }
        }
    }
    
    public function received($id){
       
        if (Auth::id()) {
            $userType = Auth()->user()->user_type;
            if ($userType == 'user') {
            
                $order = Order::findOrFail($id);
            
                if(Auth::id() !== $order->user_id){
                    abort(401);
                }
                $order->status = 'received';
                $order->save();
                return redirect()->route('orders.index')->with('success', 'Order has been received successfully.');
            } else if ($userType == 'admin') {
               abort(401);
            }
        }
    }


}
