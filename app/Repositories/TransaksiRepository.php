<?php

namespace App\Repositories;

use App\Interfaces\TransaksiInterface;
use App\Models\Commission;
use App\Models\Menu;
use App\Models\Platfrom;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class TransaksiRepository implements TransaksiInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function month(){
        $months = Transaksi::selectRaw('MONTH(tanggal_transaksi) as bulan')
    ->selectRaw('MIN(tanggal_transaksi) as tanggal')
    ->groupBy('bulan')
    ->orderBy('bulan', 'desc')
    ->get();

    $months = $months->reverse()->values();

// Format nama bulan untuk tampilan dropdown
    $formattedMonths = $months->map(function ($item) {
        return [
            'value' => $item->bulan,
            'label' => Carbon::parse($item->tanggal)->translatedFormat('F')
        ];
    });
    return $formattedMonths;
    }

    public function getallTransaksi($request)
    {
    // Inisialisasi query builder
    $query = Transaksi::selectRaw('tanggal_transaksi, SUM(jumlah_pesanan) as sum_jumlah_pesanan, SUM(laba_kotor) as sum_laba_kotor')
        ->groupBy('tanggal_transaksi')
        ->orderBy('tanggal_transaksi', 'desc');

    // Terapkan filter hanya jika ada input 'filter_bulan'
    $query->when($request->filled('filter_bulan'), function ($q) use ($request) {
        $q->whereMonth('tanggal_transaksi', $request->filter_bulan);
    });

    // Jalankan query dan ambil hasilnya
    $transaksi = $query->get();

    // Lakukan pemformatan setelah query dijalankan
    $transaksi = $transaksi->map(function ($item) {
        $item->tanggal_transaksi_formatted = Carbon::parse($item->tanggal_transaksi)->translatedFormat('j F Y');
        return $item;
    });

    return $transaksi;
    }

    public function getallmenu()
    {
        $menu = Menu::all();

        return $menu;
    }
    public function getallplatfrom()
    {
        $platfrom = Platfrom::all();

        return $platfrom;
    }

    public function store($request)
    {
        try {
            $menu = Menu::findOrFail($request->menu_id);
            $findKomisi = Commission::where('platfrom_id', $request->platfrom_id)
                ->orderBy('created_at', 'desc')
                ->first();
            $getKomisi = $findKomisi->komisi;
            $komisi = $getKomisi * $request->harga / 100;
            $hpp = $menu->hpp;
            // $bleble = ($request->harga * $request->jumlah_pesanan) - $komisi - $hpp;
            // dd($bleble);
            Transaksi::create([
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'platfrom_id' => $request->platfrom_id,
                'menu_id' => $request->menu_id,
                'komisi_id' => $findKomisi->id,
                'harga' => $request->harga,
                'jumlah_pesanan' => $request->jumlah_pesanan,
                'omset' => $request->jumlah_pesanan * $request->jumlah_pesanan,
                'laba_kotor' => ($request->harga * $request->jumlah_pesanan) - $komisi - $hpp*$request->jumlah_pesanan,
            ]);
            return ['success' => true, 'message' => 'Platfrom has been added'];
        } catch (\Exception $e) {
            // dd($getKomisi);
            return ['success' => false, 'message' => 'Failed to add platfrom : ' . $e->getMessage()];
        }
    }

    public function detailTransaction($tanggal_transaksi)
    {
        $transaksi = Transaksi::whereDate('tanggal_transaksi', $tanggal_transaksi)->get();
        return $transaksi;
    }

    public function Pdf($request)
    {

    }
}
