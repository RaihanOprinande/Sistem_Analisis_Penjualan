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
        $data = $this->analisisRepository->getpenjualandata();

        $labels = $data->pluck('bulan_tahun');
        $total_pesanan = $data->pluck('total_pesanan');
        $laba_kotor = $data->pluck('total_laba');

        $Hlaba = $this->analisisRepository->getSaleshighestlaba();
        $Hquantity = $this->analisisRepository->getSaleshighestquantity();
        $tableorder = $this->analisisRepository->gettableorder();
        $tablesale = $this->analisisRepository->gettablesales();

        $Bulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        $data_month_qty = $this->analisisRepository->getSaleshighestquantity();
        $data_month_qty = explode('-', $data_month_qty->bulan_tahun);
        $HquantityFormatted = $Bulan[$data_month_qty[1]] . ' ' . $data_month_qty[0];

        $data_month_sales = $this->analisisRepository->getSaleshighestlaba();
        $data_month_sales = explode('-', $data_month_sales->bulan_tahun);
        $HlabaFormatted = $Bulan[$data_month_sales[1]] . ' ' . $data_month_sales[0];
        // dd($table);
        return view('analisis.index', compact('total_pesanan', 'labels', 'laba_kotor', 'Hlaba', 'HquantityFormatted','Hquantity','HlabaFormatted', 'tableorder','tablesale'));
    }
}
