<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'invoice_no',
        'invoice_date',
        'note',
        'pay_amount',
        'total_amount',
        'sell_on_date',
        'payment_method',
        'bkash',
        'nagud',
        'rocket',
        'bank',
        'status',
    ];
}