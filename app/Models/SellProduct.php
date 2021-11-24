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
        //tin unit
        'tin_unit',
        'total_price',
        'status',
    ];

    public function scopeSellProduct($q,$id)
    {
        return self::where('sell_id', $id)->get();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

