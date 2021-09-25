<?php

namespace App\Models;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use CrudTrait;
    
    protected $fillable = [
        'product_name', 'product_sku', 'alert_quantity', 'category_id', 'subcategory_id','brand_id','unit_id','warranty_id','product_image','product_description','status'
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
}