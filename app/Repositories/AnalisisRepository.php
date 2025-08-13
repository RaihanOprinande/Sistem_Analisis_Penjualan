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

        $transaksi = Transaksi::selectRaw('DATE_FORMAT(tanggal_transaksi, "%Y-%m") as bulan_tahun,
                                         SUM(jumlah_pesanan) as total_pesanan,
                                         SUM(laba_kotor) as total_laba')
        ->groupBy('bulan_tahun')
        ->orderBy('bulan_tahun','asc')
        ->get();

        return $transaksi;
    }

    public function getSaleshighestlaba()
    {
        $sales = Transaksi::selectRaw('DATE_FORMAT(tanggal_transaksi, "%Y-%m") as bulan_tahun, SUM(laba_kotor) as total_laba')
            ->groupBy('bulan_tahun')
            ->orderBy('total_laba', 'desc')
            ->first();

        return $sales;
    }

    public function getSaleshighestquantity()
    {
        $quantity = Transaksi::selectRaw('DATE_FORMAT(tanggal_transaksi, "%Y-%m") as bulan_tahun, SUM(jumlah_pesanan) as total_quantity')
            ->groupBy('bulan_tahun')
            ->orderBy('total_quantity', 'desc')
            ->first();

        return $quantity;
    }

    public function getSaleshighestmonth()
    {
        $sales = Transaksi::selectRaw('DATE_FORMAT(tanggal_transaksi, "%Y-%M") as bulan_tahun, SUM(laba_kotor) as total_laba')
            ->groupBy('bulan_tahun')
            ->orderBy('total_laba', 'desc')
            ->limit(5)
            ->get();

        return $sales;
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

    public function gettableorder()
    {
            $quantity = Transaksi::selectRaw('DATE_FORMAT(tanggal_transaksi, "%Y-%m") as bulan_tahun, SUM(jumlah_pesanan) as total_quantity')
            ->groupBy('bulan_tahun')
            ->orderBy('total_quantity', 'desc')
            ->first();

            $quantity = explode('-', $quantity->bulan_tahun);

            $year = $quantity[0];
            $month = $quantity[1];


            $data = Transaksi::whereMonth('tanggal_transaksi', $month)->whereYear('tanggal_transaksi',$year)->with('platfrom','menu')->get();
        // $data = dd($month);
            return $data;
    }

    public function gettablesales()
    {
        $sales = Transaksi::selectRaw('DATE_FORMAT(tanggal_transaksi, "%Y-%m") as bulan_tahun, SUM(laba_kotor) as total_laba')
            ->groupBy('bulan_tahun')
            ->orderBy('total_laba', 'desc')
            ->first();

        $sales = explode('-', $sales->bulan_tahun);

        $year = $sales[0];
        $month = $sales[1];

        $data = Transaksi::whereMonth('tanggal_transaksi', $month)->whereYear('tanggal_transaksi',$year)->with('platfrom','menu')->get();

        return $data;
    }
}
