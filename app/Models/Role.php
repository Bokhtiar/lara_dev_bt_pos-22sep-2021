<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function permission()
    {
       return $this->hasOne(Permission::class);
    }

    // public function user_permission() //this is user_permission method
    // {
    //     return $this->hasOne(User::class);
    // }

    public function user()
    {
        return $this->hasMnay(User::class);
    }
}
