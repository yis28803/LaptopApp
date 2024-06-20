<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Laptop;
use Google\Service\CloudAlloyDBAdmin\QuantityBasedExpiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $id = Auth::id();
        $carts = CartItem::where('user_id',$id)->get();
        return view('cart',compact('carts'));
    }
    public function add(Request $request)
    {
        $laptop_id = $request->input('laptop_id');
        $quantity = $request->input('quantity');
        
        if ($quantity > 0) {
            $user_id = Auth::id();
            $existing_laptop = Laptop::findOrFail($laptop_id);
            $existingCartItem = CartItem::where('user_id', $user_id)
                ->where('laptop_id', $laptop_id)
                ->first();
    
            if ($existingCartItem) {
                $existingCartItem->quantity = $quantity;
                $existingCartItem->total_money = $quantity * $existing_laptop->price;
                $existingCartItem->save();
            } else {
                
                $total_money = $quantity * $existing_laptop->price;
                
                CartItem::create([
                    'user_id' => $user_id,
                    'quantity' => $quantity,
                    'laptop_id' => $laptop_id,
                    'total_money' => $total_money,
                ]);
            }
    
            return redirect()->route('laptop_detail.index', ['id' => $laptop_id]);
        } else {
            return back()->with('error', 'Số lượng không hợp lệ');
        }
    }
    

    public function update_quantity(Request $request,$id){
        $user_id = Auth::id();
        $cart_item = CartItem::findOrFail($id);
        $existing_laptop = Laptop::findOrFail($cart_item->laptop_id);
        if($user_id == $cart_item->user_id){
            $quantity = $request->input('quantity');
            if($quantity>0){
                $total_money = $quantity * $existing_laptop->price;
                $cart_item->quantity = $quantity;
                $cart_item->total_money = $total_money;
                $cart_item->save();
             return redirect()->route('cart.index');
            }
            return redirect()->route('cart.index');
        }
        else {
            abort(401);
        }
    }

    public function delete($id){
        $cart_item = CartItem::findOrFail($id);
        $cart_item->delete();
        return redirect()->back();
    }
    public function search(Request $request ){
        
    }   
}
