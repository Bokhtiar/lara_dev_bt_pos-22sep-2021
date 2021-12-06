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
        'due_paid_date',
        'note',
        'user_id',
        'paid_on_date',
        'payment_method',
        'bkash',
        'total_amount',
        'paid_amount',
        'rocket',
        'nagud',
        'bank',
        'status',
    ];



    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Contact::class);
    }

    public function purchase_product()
    {
        return $this->belongsTo(PurchaseProduct::class);
    }

    public function scopeReference_number()
    {

        $pur = Purchase::latest()->first();
        if($pur==null){
            $pur=1;
            $ref_code = "Rf 00".$pur;
            return $ref_code;
        }else{
            $ref = $pur->id + 1;
            $ref_code = "Rf 00".$ref;
            return $ref_code;
        }


    }

}
