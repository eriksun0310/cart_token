<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded =[''];
    
    public function cartItems(){
        //hasMany():出來的資料是複數
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    
    //檢查商品數量
    public function checkQuantity($quantity){
        //db的數量 < 前端傳來的數量
        if($this->quantity < $quantity){
            return false;
        }
        return true;
    }
}
