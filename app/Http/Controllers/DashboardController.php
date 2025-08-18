<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

    $bulan_ini = Carbon::now()->month;
    $tahun_ini = Carbon::now()->year;
    $data = Transaksi::selectRaw('MONTH(tanggal_transaksi) as bulan, SUM(jumlah_pesanan) as penjualan, SUM(laba_kotor) as laba_kotor')
        // ->whereMonth('tanggal_transaksi', $bulan_ini)
        ->whereYear('tanggal_transaksi', $tahun_ini)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    $bulan = $data->pluck('bulan');

    // mengubah angka bulan ke nama bulan
    $namaBulan = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $labels = $data->pluck('bulan')->map(function($b) use ($namaBulan) {
        return $namaBulan[$b];
    });

    $data_harga = Transaksi::whereMonth('tanggal_transaksi',$bulan_ini)
                ->whereYear('tanggal_transaksi', $tahun_ini)
                ->select('harga')
                ->get();


    $penjualans = $data->pluck('penjualan');
    $laba_kotor = $data->pluck('laba_kotor');
    $harga = $data->pluck('harga');

    $getjumlah_pesanan = $data->sum('penjualan');
    $jumlah_pesanan = $getjumlah_pesanan;

    $getlaba_kotor = Transaksi::whereMonth('tanggal_transaksi', $bulan_ini)
                    ->whereYear('tanggal_transaksi', $tahun_ini)
                    ->sum('laba_kotor');
    $Alaba_kotor = $getlaba_kotor;

    $hitung_transaksi = Transaksi::whereMonth('tanggal_transaksi',$bulan_ini)
    ->whereyear('tanggal_transaksi', $tahun_ini)
    ->count();

    $get_harga = $data_harga->pluck('harga');
    $aov = $get_harga->sum() / $hitung_transaksi;
    // dd($aov);

            $getplatfrom = DB::table('transaksis')
            ->select('platfroms.platfrom', DB::raw('SUM(transaksis.laba_kotor) as total_laba_kotor'))
            ->join('platfroms', 'transaksis.platfrom_id', '=', 'platfroms.id')
            ->whereMonth('transaksis.tanggal_transaksi', $bulan_ini)
            ->whereYear('transaksis.tanggal_transaksi', $tahun_ini)
            ->groupBy('platfroms.platfrom')
            ->orderBy('total_laba_kotor', 'desc')
            ->get();

            $platfrom = $getplatfrom->first();

            // dd($aov);

    return view('dashboard', compact('labels', 'penjualans','laba_kotor','jumlah_pesanan', 'Alaba_kotor','aov','platfrom'));
    }


}
