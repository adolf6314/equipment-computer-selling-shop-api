<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'id',
        'name_en',
        'name_th',
        'prov_id'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public $timestamps = false;

    public function province()
    {
        return $this->belongsTo(Province::class, 'id');
    }

    public function sub_districts()
    {
        return $this->hasMany(Sub_District::class, 'dist_id');
    }
}
