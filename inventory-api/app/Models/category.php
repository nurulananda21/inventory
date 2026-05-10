<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\items;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function items()
    {
        return $this->hasMany(item::class);
    }
}