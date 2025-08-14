<?php

namespace App\Http\Controllers;

use App\Interfaces\TransaksiInterface;
use App\Models\Menu;
use App\Models\Platfrom;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
        public $transaksiInterface;

    public function __construct(TransaksiInterface $transaksiInterface)
    {
        $this->transaksiInterface = $transaksiInterface;

    }
    public function index()
    {
        $transaksi = $this->transaksiInterface->getallTransaksi();

        return view('transaksi.index', compact('transaksi'));
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

        public function Pdf(Request $request)
    {
                // Ambil data transaksi dari database
    $tanggal_mulai = null;
    $tanggal_akhir = null;
    $transaksis = collect(); // Inisialisasi collection kosong

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $transaksis = Transaksi::whereBetween('tanggal_transaksi', [$request->start_date, $request->end_date])
            ->with('platfrom', 'menu')
            ->orderBy('tanggal_transaksi', 'asc') // Pindahkan orderBy() sebelum get()
            ->get(); // Tambahkan ->get() di sini

        $tanggal_mulai = $request->start_date;
        $tanggal_akhir = $request->end_date;
    } else {
        $transaksis = Transaksi::with('platfrom', 'menu')
            ->orderBy('tanggal_transaksi', 'desc') // Pastikan ada orderBy() juga di sini
            ->get();

        $tanggal_mulai = Transaksi::min('tanggal_transaksi');
        $tanggal_akhir = Transaksi::max('tanggal_transaksi');
    }

    $pdf = Pdf::loadView('transaksi.pdf', compact('transaksis', 'tanggal_mulai', 'tanggal_akhir'));

    return $pdf->stream('laporan-transaksi-' . date('Y-m-d') . '.pdf');
    }
}
