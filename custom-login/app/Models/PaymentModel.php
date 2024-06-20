<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory;
    protected $table = "payments";
    protected $fillable = ['id','user_id','order_id','method','amount','created_at','updated_at','status'];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
