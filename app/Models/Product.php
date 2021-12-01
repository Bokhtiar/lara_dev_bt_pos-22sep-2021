<?php

namespace App\Models;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Product extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $fillable = [
        'product_name',
        'unit_price',
        'purchase_id',
        'unit_selling_price',
        'product_sku',
        'alert_quantity',
        'category_id',
        'subcategory_id',
        'brand_id',
        'user_id',
        'unit_id',
        'warranty_id',
        'product_image',
        'product_description',

        //tin colums
        'tin_unit',
        'mm',
        'fit',
        'piches',
        'unit_total_price',
        'unit_ban_price',
        'unit_per_pc_price',
        'unit_sell_total_price',
        'unit_sell_ban_price',
        'unit_sell_per_pc_price',
        'status'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function warranty()
    {
        return $this->belongsTo(Warranty::class);
    }


    public function scopeAlert()
    {
        return "";
    }

    public function scopeSku()
    {
        $product = Product::latest()->first();
        $sku = $product->id + 1;
        $sku_code = "PSKU 00".$sku;
        return $sku_code;
    }

}
