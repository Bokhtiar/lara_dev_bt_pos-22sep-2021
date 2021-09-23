<?php

namespace App\Models;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    use CrudTrait;
    
    protected $fillable = [
        'category_id', 'subcategory_name', 'subcategory_description', 'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}