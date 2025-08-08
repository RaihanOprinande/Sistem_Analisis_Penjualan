<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable
     = [
        'platfrom_id',
        'menu_id',
        'komisi_id',
        'harga'
     ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

        public function platfrom()
    {
        return $this->belongsTo(Menu::class, 'platfrom_id');
    }
}
