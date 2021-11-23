<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fit extends Model
{
    use HasFactory;
    protected $fillable = [
        'fit_size','fit_piches','tin_ban','fit_long'
    ];
}
