<?php

namespace App\Models;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    use CrudTrait;
    
    protected $fillable = [
        'unit_name', 'unit_short_name', 'unit_description'
    ];
}
