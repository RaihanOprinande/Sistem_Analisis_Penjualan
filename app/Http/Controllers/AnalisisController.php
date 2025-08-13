<?php

namespace App\Http\Controllers;

use App\Repositories\AnalisisRepository;
use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    protected $analisisRepository;

    public function __construct(AnalisisRepository $analisisRepository)
    {
        $this->analisisRepository = $analisisRepository;
    }

    public function index()
    {
        $data = $this->analisisRepository->getpenjualandata();

        $labels = $data->pluck('bulan_tahun');
        $total_pesanan = $data->pluck('total_pesanan');
        $laba_kotor = $data->pluck('total_laba');

        return view('analisis.index', compact('total_pesanan', 'labels', 'laba_kotor'));
    }

    public function getChartData(Request $request)
    {
        $chartType = $request->input('chartType');

        switch ($chartType) {
            case 'sales':

                break;
            case 'platfroms':
                $data = $this->analisisRepository->getPlatfromschart();
                $labels = $data->pluck('platfrom_name');
                $chartData = $data->pluck('total_laba');
                $chartLabel = 'Total Laba per Platform';

                return response()->json([
                    'labels' => $labels,
                    'datasets' => [[
                        'label' => $chartLabel,
                        'data' => $chartData,
                        'backgroundColor' => ['#91A0AF', '#FFC107', '#DC3545', '#17A2B8'] // Contoh warna
                    ]]
                ]);
                break;
            case 'menus':

                break;
            default:
                return response()->json(['error' => 'Invalid chart type'], 400);
        }
    }
}
