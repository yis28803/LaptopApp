<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $table= "cart_items";
    protected $fillable = ['user_id','laptop_id','quantity','total_money'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function laptop()
    {
        return $this->belongsTo(Laptop::class,'laptop_id');
    }
}
