<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sell extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'author',
        'quantity',
        'order_id',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Contact::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public static function item_cart(){

        $sell=Self::where('author',Auth::id())
                ->where('order_id',NULL)
                ->get();

        return $sell;
        }
}
