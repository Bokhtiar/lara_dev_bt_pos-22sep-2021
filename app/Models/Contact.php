<?php

namespace App\Models;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $fillable = [
        'contact_info',
        'prefix_name',
        'f_name',
        'l_name',
        'email',
        'phone',
        'city',
        'state',
        'country',
        'zip',
        'company_name',
        'company_phone',
        'compnay_email',
    ];

    public function scopegetCode($type='customer'){
    if( $type = 'customer' ){
            return 'customer';
        }else{
            return 'supplier';
        }
    }
}
