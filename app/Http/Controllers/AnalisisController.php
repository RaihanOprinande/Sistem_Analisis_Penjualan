<?php

namespace App\Http\Controllers;

use App\Repositories\AnalisisRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalisisController extends Controller
{
    protected $analisisRepository;

    public function __construct(AnalisisRepository $analisisRepository)
    {
        $this->analisisRepository = $analisisRepository;
    }

    public function SalesChart()
    {
        $tahun_ini = now()->year;
        $data = $this->analisisRepository->getpenjualandata();
        $omset_bulanan = $this->analisisRepository->getomsetbulanan();

            $namaBulan = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            $labels = $data->pluck('bulan')->map(function($b) use ($namaBulan) {
            return $namaBulan[$b];
         });

         $omset_grafik = $data->pluck('omset');
         $laba_kotor_grafik = $data->pluck('laba_kotor');

         $omset = $omset_bulanan->sortByDesc('omset')->first();
         $get_omset_bulan = $omset->bulan;
         $omset_bulan = $namaBulan[$get_omset_bulan];

         $laba_kotor = $data->sortByDesc('laba_kotor')->first();
         $get_laba_kotor_bulan = $laba_kotor->bulan;
         $laba_kotor_bulan = $namaBulan[$get_laba_kotor_bulan];

        // $Hlaba = $this->analisisRepository->getSaleshighestlaba();
        // $Hquantity = $this->analisisRepository->getSaleshighestquantity();
        // $tableorder = $this->analisisRepository->gettableorder();
        $tablesale = $this->analisisRepository->gettablesales();

        // $Bulan = [
        //     '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
        //     '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
        //     '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        // ];

        // $data_month_qty = $this->analisisRepository->getSaleshighestquantity();
        // $data_month_qty = explode('-', $data_month_qty->bulan_tahun);
        // $HquantityFormatted = $Bulan[$data_month_qty[1]] . ' ' . $data_month_qty[0];

        // $data_month_sales = $this->analisisRepository->getSaleshighestlaba();
        // $data_month_sales = explode('-', $data_month_sales->bulan_tahun);
        // $HlabaFormatted = $Bulan[$data_month_sales[1]] . ' ' . $data_month_sales[0];
        // dd($table);
        // return view('analisis.sales', compact('total_pesanan', 'labels', 'laba_kotor', 'Hlaba', 'HquantityFormatted','Hquantity','HlabaFormatted', 'tableorder','tablesale'));
        // dd($omset_bulan);
        return view('analisis.sales', compact('labels','omset_grafik','laba_kotor_grafik','tahun_ini','omset','omset_bulan','tablesale','laba_kotor_bulan','laba_kotor'));
    }

    public function PlatfromChart()
    {
        $data = $this->analisisRepository->getplatfromchart();
        $platfrom = $this->analisisRepository->getPlatfromhighestgross();
        $labels = $data->pluck('platfrom')->toArray();
        $laba_kotor = $data->pluck('total_laba_kotor')->toArray();

        $pfuntung = $data->sortByDesc('total_laba_kotor')->first();

        // dd($platfrom);
        return view('analisis.platfrom', compact('labels',  'laba_kotor','pfuntung','platfrom'));
    }

    public function MenuChart(){
        $data = $this->analisisRepository->getmenuchart();
        $labels = $data->pluck('menu_name')->toArray();
        $jumlah_pesanan = $data->pluck('total_pesanan')->toArray();
        $menu = $this->analisisRepository->getmenu();
        $menu_terlaris = $data->sortByDesc('total_pesanan')->first();

        return view('analisis.menu',compact('labels','jumlah_pesanan','menu_terlaris','menu'));
    }
}
