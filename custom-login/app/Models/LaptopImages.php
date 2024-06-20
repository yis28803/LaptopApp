<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaptopImages extends Model
{
    use HasFactory;
    protected $table = 'laptop_images';
    protected $fillable = ['laptop_id','url'];

    public function laptop()
    {
        return $this->belongsTo(Laptop::class,"laptop_id");
    }
    
    public $timestamps = false;

}
