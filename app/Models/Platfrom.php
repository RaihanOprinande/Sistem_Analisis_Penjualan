<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platfrom extends Model
{
    protected $fillable = [
        'platfrom'
    ];

    public function price()
    {
        return $this->hasMany(Price::class, 'platfrom_id');
    }
}
