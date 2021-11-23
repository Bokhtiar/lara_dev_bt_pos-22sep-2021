<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'fit_id', 'mm', 'ton', 'tinpc',
    ];

    public function fit()
    {
        return $this->belongsTo(Fit::class);
    }
}
