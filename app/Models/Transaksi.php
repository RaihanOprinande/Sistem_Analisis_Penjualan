<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal_transaksi',
        'platfrom_id',
        'komisi_id',
        'menu_id',
        'harga',
        'jumlah_pesanan',
        'omset',
        'laba_kotor',
        'status'
    ];

    public function platfrom()
    {
        return $this->belongsTo(Platfrom::class, 'platfrom_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function komisi()
    {
        return $this->belongsTo(Commission::class, 'komisi_id');
    }


}
