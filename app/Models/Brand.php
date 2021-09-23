<?php

namespace App\Models;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    use CrudTrait;
    
    protected $fillable = [
        'brand_name', 'brand_description', 'status',
    ];
}
