<?php

namespace App\Models;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use CrudTrait;
    
    protected $fillable = [
        'category_name', 'category_description', 'status',
    ];
}
