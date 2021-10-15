<?php

namespace App\Models;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $fillable = [
        'product_id', 'purchase_id', 'unit_price', 'total_price', 'purchase_quantity', 'status',
    ];
}
