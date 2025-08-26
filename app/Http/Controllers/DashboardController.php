<?php

namespace App\Http\Controllers;

use App\Interfaces\DashboardInterface;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public $dashboardInterface;

    public function __construct(DashboardInterface $dashboardInterface)
    {
        $this->dashboardInterface = $dashboardInterface;
    }
    public function index()
    {

    $data = $this->dashboardInterface->getdatachart();
    $data2 = $this->dashboardInterface->getdata();
    $omzet = $this->dashboardInterface->getomzet();
    $get_platfrom = $this->dashboardInterface->getvaluableplatfrom();

    // mengubah angka bulan ke nama bulan
    $namaBulan = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $labels = $data->pluck('bulan')->map(function($b) use ($namaBulan) {
        return $namaBulan[$b];
    });

    $jumlah_pesanan = $data2->sum('jumlah_pesanan');
    $harga = $data2->sum('harga');
    $total_transaksi = $data2->count();
    $platfrom = $get_platfrom->pluck('platfrom')->first();
    $laba_kotor = $data2->pluck('laba_kotor');
    $bulan = $data->pluck('bulan');
    $sum_laba_kotor = $laba_kotor->sum();
    $aov = $harga / $total_transaksi;
    $total_omset = $data2->pluck('omset');
    $get_menu = $data2->pluck('menu')->first();

    $jumlah_pesanan_grafik = $data->pluck('penjualan');
    $laba_kotor_grafik = $data->pluck('laba_kotor');
    $omset_grafik = $data->pluck('omset');

    // dd($get_menu);
    return view('dashboard', compact('omzet','labels','jumlah_pesanan_grafik','laba_kotor_grafik','sum_laba_kotor', 'jumlah_pesanan','aov','platfrom','omset_grafik','total_omset'));
    }


}
