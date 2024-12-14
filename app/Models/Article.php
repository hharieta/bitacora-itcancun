<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'partition',
        'department',
        'department_head',
    ];

    public function requisitions()
    {
        return $this->hasMany(Requisition::class);
    }
}
