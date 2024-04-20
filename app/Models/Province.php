<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'id',
        'name_en',
        'name_th',
        'reg_id'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public $timestamps = false;

    public function region()
    {
        return $this->belongsTo(Region::class, 'id');
    }

    public function districts()
    {
        return $this->hasMany(District::class, 'prov_id');
    }
}
