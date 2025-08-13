<?php

namespace App\Repositories;

use App\Interfaces\AnalisisInterface;
use App\Models\Transaksi;

class AnalisisRepository implements AnalisisInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getpenjualandata(){

        $transaksi = Transaksi::selectRaw('DATE_FORMAT(tanggal_transaksi, "%Y-%M") as bulan_tahun,
                                         SUM(jumlah_pesanan) as total_pesanan,
                                         SUM(laba_kotor) as total_laba')
        ->groupBy('bulan_tahun')
        ->orderBy('bulan_tahun')
        ->get();



        return $transaksi;
    }

    public function getPlatfromschart()
    {
        $platfrom = Transaksi::with('platfrom')
            ->selectRaw('platfrom_id as platfrom_name, SUM(laba_kotor) as total_laba')
            ->groupBy('platfrom_name')
            ->orderBy('total_laba','desc')
            ->get();

        return $platfrom;



    }

    public function getMenuschart()
    {
        // Implement logic to retrieve menu chart data
    }

    public function getSaleschart()
    {
        // Implement logic to retrieve sales chart data
    }
}
