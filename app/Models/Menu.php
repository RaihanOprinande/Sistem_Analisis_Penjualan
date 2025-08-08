<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
    'menu_name',
    'hpp',
    'target_laba'
    ];

    public function prices()
    {
        return $this->hasMany(Price::class, 'menu_id');
    }
}
