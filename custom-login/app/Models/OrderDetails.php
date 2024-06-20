<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable=['order_id','product_id','price','number_of_products','total_money','color'];
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function laptop()
    {
        return $this->belongsTo(Laptop::class , 'product_id');
    }
    public $timestamps = false;
}
