<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'platfrom_komisis';
    protected $fillable = [
        'komisi',
        'platfrom_id',
        'tanggal_berlaku'
    ];

    public function platfrom()
    {
        return $this->belongsTo(Platfrom::class, 'platfrom_id');
    }
}
