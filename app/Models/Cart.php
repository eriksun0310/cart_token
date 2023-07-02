<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [''];//所有欄位都可以加資料
    private $rate = 1;

    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    //hasOne:一個cart 只會擁有一個order
    public function order(){
        return $this->hasOne(Order::class);
    }

    //結帳流程
    public function checkout(){
        
        //先檢查商品數量
        foreach($this->cartItems as $cartItem){
            $product = $cartItem->product;
            if(!$product->checkQuantity($cartItem->quantity)){
                return $product->title.'數量不足';
            }
        }




        $order = $this->order()->create([
            'user_id' =>$this->user_id
        ]);
        if($this->user->level == 2){
            $this->rate = 0.8;
        }

        foreach($this->cartItems as $cartItem){
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                'price' => $cartItem->product->price * $this->rate
            ]);
            $cartItem->product->update([
                'quantity'=>$cartItem->product->quantity - $cartItem->quantity
            ]);
        }
        $this->update(['checkouted' => true]);
        $order->orderItems;
        return $order;
    }
}
