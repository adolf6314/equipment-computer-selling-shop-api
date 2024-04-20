<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'id',
        'name_en',
        'name_th'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public $timestamps = false;

    public function provinces()
    {
        return $this->hasMany(Province::class, 'reg_id');
    }
}
