<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_District extends Model
{
    protected $table = 'sub_districts';

    protected $fillable = [
        'id',
        'name_en',
        'name_th',
        'post_code',
        'dist_id'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public $timestamps = false;

    public function post_code()
    {
        return $this->belongsTo(Post_Code::class, 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'sub_dist_id');
    }
}
