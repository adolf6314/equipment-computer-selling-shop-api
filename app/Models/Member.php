<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Member extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'phone',
        'sex',
        'theme',
        'status',
        'address',
        'sub_dist_id'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public $timestamps = false;
}
