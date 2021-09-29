<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'product_id',
        'admin_id',
        'quantity',
        'order_id',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Contact::class);
    }
    public function product()
    {
        return $this->belongsTo(Contact::class);
    }
    public function admin()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}