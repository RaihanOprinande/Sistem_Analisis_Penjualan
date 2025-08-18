<?php

namespace App\Repositories;

use App\Interfaces\DashboardInterface;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardInterface
{
    /**
     * Create a new class instance.
     */

        public function __construct()
    {

    }

    public function getdatachart()
    {
    $bulan_ini = Carbon::now()->month;
    $tahun_ini = Carbon::now()->year;
    $data = Transaksi::selectRaw('MONTH(tanggal_transaksi) as bulan, SUM(jumlah_pesanan) as penjualan, SUM(laba_kotor) as laba_kotor')
        ->whereYear('tanggal_transaksi', $tahun_ini)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

        return $data;
    }

    public function getdata(){
        $bulan_ini = Carbon::now()->month;
        $tahun_ini = Carbon::now()->year;
        $data = Transaksi::with('platfrom', 'menu','komisi')
        ->whereMonth('tanggal_transaksi', $bulan_ini)
        ->whereYear('tanggal_transaksi',$tahun_ini)
        ->get();
        return $data;
    }

    public function getomzet()
    {
        $bulan_ini = Carbon::now()->month;
        $tahun_ini = Carbon::now()->year;

        $omzet = Transaksi::selectRaw('SUM(harga * jumlah_pesanan) as total_omset')
        ->whereMonth('tanggal_transaksi', $bulan_ini)
        ->whereYear('tanggal_transaksi', $tahun_ini)
        ->first()
        ->total_omset;

        return $omzet;
    }

    public function getvaluableplatfrom()
    {

        $bulan_ini = Carbon::now()->month;
        $tahun_ini = Carbon::now()->year;

            $data = DB::table('transaksis')
            ->select('platfroms.platfrom', DB::raw('SUM(transaksis.laba_kotor) as total_laba_kotor'))
            ->join('platfroms', 'transaksis.platfrom_id', '=', 'platfroms.id')
            ->whereMonth('transaksis.tanggal_transaksi', $bulan_ini)
            ->whereYear('transaksis.tanggal_transaksi', $tahun_ini)
            ->groupBy('platfroms.platfrom')
            ->orderBy('total_laba_kotor', 'desc')
            ->get();

        return $data;
    }
}
