<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sell extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'invoice_no',
        'invoice_date',
        'note',
        'paid_amount',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->belongsTo(Contact::class);
    }
}
