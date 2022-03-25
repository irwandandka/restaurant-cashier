<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = ['total','quantity','food_id','order_id'];

    public function order() 
    {
        return $this->belongsTo(Order::class);
    }

    public function food() 
    {
        return $this->belongsTo(Food::class);
    }
}
