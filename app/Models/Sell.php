<?php

namespace App\Models;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sell extends Model
{
    use HasFactory;
    use CrudTrait;
    protected $fillable = [
        'customer_id',
        'invoice_no',
        'invoice_date',
        'note',
        'paid_amount',
        'total_amount',
        'sell_on_date',
        'due_paid_date',
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

    public function scopeInvoice_number(){
        $sell = Sell::latest()->first();
        $inv = $sell->id + 1;
        $inv_code = "SL 00".$inv;
        return $inv_code;
    }
}
