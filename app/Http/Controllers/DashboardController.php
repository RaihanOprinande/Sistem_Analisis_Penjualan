<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
    $data = Transaksi::selectRaw('MONTH(tanggal_transaksi) as bulan, SUM(jumlah_pesanan) as penjualan, SUM(laba_kotor) as laba_kotor')
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    // Mapping angka bulan ke nama bulan
    $namaBulan = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $labels = $data->pluck('bulan')->map(function($b) use ($namaBulan) {
        return $namaBulan[$b];
    });

    $penjualans = $data->pluck('penjualan');
    $laba_kotor = $data->pluck('laba_kotor');
    return view('dashboard', compact('labels', 'penjualans','laba_kotor'));
    }


}
