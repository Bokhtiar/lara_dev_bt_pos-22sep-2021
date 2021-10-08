<?php

namespace App\Models;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $fillable = [
        'customer_id',
        'invoice_no',
        'invoice_date',
        'note',
        'pay_amount',
        'total_amount',
        'sell_on_date',
        'payment_method',
        'user_id',
        'bkash',
        'nagud',
        'rocket',
        'bank',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Contact::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
