<?php

namespace App\Repositories;

use App\Interfaces\TransaksiInterface;
use App\Models\Commission;
use App\Models\Menu;
use App\Models\Platfrom;
use App\Models\Transaksi;

class TransaksiRepository implements TransaksiInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getallTransaksi()
    {
    $transaksi = Transaksi::selectRaw('tanggal_transaksi, SUM(jumlah_pesanan) as jumlah_pesanan, SUM(laba_kotor) as laba_kotor')
        ->groupBy('tanggal_transaksi')
        ->orderBy('tanggal_transaksi', 'desc')
        ->get();

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
                'harga' => $request->harga,
                'jumlah_pesanan' => $request->jumlah_pesanan,
                'laba_kotor' => ($request->harga * $request->jumlah_pesanan) - $komisi- $hpp,
            ]);
            return ['success' => true, 'message' => 'Platfrom has been added'];
        } catch (\Exception $e) {
            // dd($getKomisi);
            return ['success' => false, 'message' => 'Failed to add platfrom : ' . $e->getMessage()];
        }
    }
}
