<?php

namespace App\Http\Controllers;

use App\Interfaces\TransaksiInterface;
use App\Models\Menu;
use App\Models\Platfrom;
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
}
