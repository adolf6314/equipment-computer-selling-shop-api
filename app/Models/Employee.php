<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Employee extends Authenticatable
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
        'role',
        'sex',
        'work_status',
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

    public function sub_district(){
        return $this->belongsTo(Sub_District::class, 'id');
    }
}
