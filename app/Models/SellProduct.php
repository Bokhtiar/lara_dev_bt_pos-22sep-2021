<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'sell_id',
        'sell_quantity',
        'unit_selling_price',
        'total_price',
        'status',
    ];
}

