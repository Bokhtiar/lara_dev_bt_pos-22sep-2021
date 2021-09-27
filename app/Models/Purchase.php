<?php

namespace App\Models;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $fillable = [
        'supplier_id',
        'reference_no',
        'purchase_date',
        'attech_file',
        'note',
        'product_id',
        'purchase_quantity',
        'unit_cost_before_discount',
        'discount_percent',
        'unit_cost_before_tax',
        'tax',
        'line_total',
        'profit_margin',
        'unit_selling_price',
        'amount',
        'paid_on_date',
        'payment_method',
        'bkash',
        'rocket',
        'nagud',
        'bank',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Contact::class);
    }

}