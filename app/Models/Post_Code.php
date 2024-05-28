<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_Code extends Model
{
    protected $table = 'post_codes';

    protected $fillable = [
        'id',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public $timestamps = false;

    public function sub_districts()
    {
        return $this->hasMany(Sub_District::class, 'post_code');
    }
}
