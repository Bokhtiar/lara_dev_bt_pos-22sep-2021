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
        'product_name', 'price', 'purchase_id', 'unit_selling_price', 'product_sku', 'alert_quantity', 'category_id', 'subcategory_id','brand_id','unit_id','warranty_id','product_image','product_description','status'
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
        foreach(Purchase::all() as $p){
                return Product::whereNotNull('purchase_id')->where('alert_quantity', '>=', $p->purchase_quantity)->get();
        }
    }

}
