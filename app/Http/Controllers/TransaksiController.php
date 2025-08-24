<?php

namespace App\Http\Controllers;

use App\Imports\TransaksiImport;
use App\Interfaces\TransaksiInterface;
use App\Models\Menu;
use App\Models\Platfrom;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
        public $transaksiInterface;

    public function __construct(TransaksiInterface $transaksiInterface)
    {
        $this->transaksiInterface = $transaksiInterface;

    }
    public function index(Request $request)
    {
        $transaksi = $this->transaksiInterface->getallTransaksi($request);
        $month = $this->transaksiInterface->month();

        return view('transaksi.index', compact('transaksi','month'));
    }

    public function create()
    {
        $menus = $this->transaksiInterface->getallmenu();
        $platfroms = $this->transaksiInterface->getallplatfrom();
        // dd($menus, $platfroms);
        return view('transaksi.create',compact('menus', 'platfroms'));
    }

    public function store(Request $request)
    {
        $result = $this->transaksiInterface->store($request);
        // dd($result);
        if ($result['success']) {
            return redirect('/transaction')->with('success', $result['message']);
        } else {
            return redirect('/transaction')->with('error', $result['message']);
        }
    }

    public function show($tanggal_transaksi){
        $tanggal_transaksi = $this->transaksiInterface->detailTransaction($tanggal_transaksi);

        return view('transaksi.detail',compact('tanggal_transaksi'));
    }


    public function Pdf(Request $request){
        $tanggal_mulai = $request->start_date;


        $tanggal_akhir = $request->end_date;

        $tanggal_mulai_formatted = Carbon::parse($tanggal_mulai)->translatedFormat('j F Y');
        $tanggal_akhir_formatted = Carbon::parse($tanggal_akhir)->translatedFormat('j F Y');

        $transaksis = $this->transaksiInterface->cetakpdf($request);
        $ringkasanPerPlatform = $this->transaksiInterface->ringkasanplatfrom($request);
        $ringkasanBulanIni = $this->transaksiInterface->ringkasanbulan($request);

        $pdf = Pdf::loadView('transaksi.pdf', compact('transaksis', 'tanggal_mulai_formatted', 'tanggal_akhir_formatted','ringkasanPerPlatform','ringkasanBulanIni'));
        return $pdf->stream('laporan-transaksi-' . date('Y-m-d') . '.pdf');
    }

    public function updatestatus(Request $request , string $id){
        $result = $this->transaksiInterface->update($request,$id);

        if ($result['success']) {
            return response()->json(['message' => $result['message']], 200);
        } else {
            return response()->json(['message' => $result['message']], 500);
        }

    }

        public function import(Request $request)
    {
        try {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

            Excel::import(new TransaksiImport, $request->file('file'));
            return redirect('/transaction')->with('success', 'Data transaksi berhasil diimpor!');
        } catch (\Exception $e) {
            return redirect('/transaction')->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }
}
