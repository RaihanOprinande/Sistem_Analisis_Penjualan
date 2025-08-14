<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
    $data = Transaksi::selectRaw('MONTH(tanggal_transaksi) as bulan, SUM(jumlah_pesanan) as penjualan, SUM(laba_kotor) as laba_kotor')
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    $data_harga = Transaksi::all();

    // Mapping angka bulan ke nama bulan
    $namaBulan = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $labels = $data->pluck('bulan')->map(function($b) use ($namaBulan) {
        return $namaBulan[$b];
    });

    $penjualans = $data->pluck('penjualan');
    $laba_kotor = $data->pluck('laba_kotor');
    $harga = $data->pluck('harga');

    $getjumlah_pesanan = $data->sum('penjualan');
    $jumlah_pesanan = $getjumlah_pesanan;

    $getlaba_kotor = $data->sum('laba_kotor');
    $Alaba_kotor = $getlaba_kotor;

    $hitung_transaksi = Transaksi::count();
    $get_harga = $data_harga->pluck('harga');
    $aov = $get_harga->sum() / $hitung_transaksi;
    // dd($aov);

            $getplatfrom = DB::table('transaksis')
            ->select('platfroms.platfrom', DB::raw('SUM(transaksis.laba_kotor) as total_laba_kotor'))
            ->join('platfroms', 'transaksis.platfrom_id', '=', 'platfroms.id')
            ->groupBy('platfroms.platfrom')
            ->orderBy('total_laba_kotor', 'desc')
            ->get();

            $platfrom = $getplatfrom->first();

    return view('dashboard', compact('labels', 'penjualans','laba_kotor','jumlah_pesanan', 'Alaba_kotor','aov','platfrom'));
    }


}
