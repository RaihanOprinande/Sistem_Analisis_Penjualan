<?php

namespace App\Repositories;

use App\Interfaces\AnalisisInterface;
use App\Models\Menu;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalisisRepository implements AnalisisInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getomsetbulanan(){
        $tahun_ini = Carbon::now()->year;
            $data = Transaksi::selectRaw('MONTH(tanggal_transaksi) as bulan, SUM(harga * jumlah_pesanan) as omset')
        ->whereYear('tanggal_transaksi', $tahun_ini)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

        return $data;
    }

    public function getpenjualandata(){

            $bulan_ini = Carbon::now()->month;
    $tahun_ini = Carbon::now()->year;
    $data = Transaksi::selectRaw('MONTH(tanggal_transaksi) as bulan, SUM(jumlah_pesanan) as penjualan, SUM(laba_kotor) as laba_kotor, SUM(harga * jumlah_pesanan) as omset')
        ->whereYear('tanggal_transaksi', $tahun_ini)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

        return $data;
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
        // $platfrom = Transaksi::with('platfrom')
        //     ->selectRaw('platfrom_id as platfrom_name, SUM(laba_kotor) as total_laba')

        //     ->groupBy('platfrom_name')
        //     ->orderBy('total_laba','desc')
        //     ->get();

        // return $platfrom;

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

    public function getplatfromchart()
    {
        // $tahun_ini = Carbon::now()->year;
        $bulan_ini = Carbon::now()->month;

        $platfrom = DB::table('transaksis')
            ->select('platfroms.platfrom', DB::raw('SUM(transaksis.laba_kotor) as total_laba_kotor, SUM(transaksis.harga * transaksis.jumlah_pesanan) as omset'))
            ->join('platfroms', 'transaksis.platfrom_id', '=', 'platfroms.id')
            ->whereMonth('transaksis.tanggal_transaksi', $bulan_ini)
            ->groupBy('platfroms.platfrom')
            ->orderBy('total_laba_kotor', 'desc')
            ->get();



            // dd($platfrom);
        return $platfrom;
    }

    public function getPlatfromhighestgross(){
        $filter = Transaksi::with('platfrom')->selectRaw('platfrom_id, SUM(laba_kotor) as laba_kotor')
                    ->groupBy('platfrom_id')
                    ->orderBy('laba_kotor','desc')
                    ->first();
        $platfrom_id = $filter->platfrom_id;
        $platfrom = Transaksi::with('platfrom')->where('platfrom_id',$platfrom_id)->get();

            return $platfrom;
    }

    public function getmenuchart(){

        $bulan_ini = Carbon::now()->month;

        $menu = DB::table('transaksis')
            ->select('menus.menu_name', DB::raw('SUM(transaksis.jumlah_pesanan) as total_pesanan'))
            ->join('menus', 'transaksis.menu_id', '=', 'menus.id')
            ->whereMonth('transaksis.tanggal_transaksi', $bulan_ini)
            ->groupBy('menus.menu_name')
            ->orderBy('total_pesanan', 'desc')
            ->get();

            return $menu;
    }

    public function getmenu(){
        $menu = Menu::all();

        return $menu;
    }
}
