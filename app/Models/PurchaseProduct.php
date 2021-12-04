<?php

namespace App\Models;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseProduct extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $fillable = [
        'product_id', 'purchase_id', 'unit_price', 'total_price', 'purchase_quantity', 'tin_purchase', 'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }


    public function scopeProduct_name($query, $id){
       return Self::where('purchase_id', $id)->get('product_id');
    }

    public function scopePurchaseProduct($q,$id)
    {
        return self::where('purchase_id', $id)->get();
    }
}
