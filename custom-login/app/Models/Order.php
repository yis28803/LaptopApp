<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['user_id','fullname','tax','phone_number','note','order_date','status','total_money','shipping_method','shipping_address','payment_method','paid','email'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
    public $timestamps = false;

    
}
