<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_name','description','table_id','total_price'];

    public function order_details() 
    {
        return $this->hasMany(OrderDetail::class);
    } 

    public function table()
    {
        return $this->belongsTo(Table::class);    
    }
}
