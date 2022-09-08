<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $dates = ['delivery_date', 'delivered_at'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(){
        return $this->belongsToMany(Product::class);
    }

    public function products(){
        return $this->hasMany(OrderProduct::class);
    }
}
