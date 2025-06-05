<?php

namespace App\Http\Controllers;

use App\Interfaces\CommissionInterface;
use Illuminate\Http\Request;

class commissionController extends Controller
{
    public $komisiInterface;

    public function __construct(CommissionInterface $komisiInterface)
    {
        $this->komisiInterface = $komisiInterface;

    }

    public function index()
    {
        $komisi = $this->komisiInterface->getdata();
        return view('komisi.index', compact('komisi'));
    }

    public function create()
    {
        return view('komisi.create');
    }

    public function store(Request $request)
    {
        $komisi = $this->komisiInterface->storedata($request);

        if ($komisi['success']) {
            return redirect('/komisi')->with('success', $komisi['message']);
        } else {
            return redirect('/komisi')->with('error', $komisi['message']);
        }
    }

        public function edit(string $id)
    {
        $komisi = $this->komisiInterface->getdetail($id);
        return view('komisi.edit', compact('komisi'));
    }

    public function update(Request $request, string $id)
    {
        $komisi = $this->komisiInterface->updatedata($request, $id);

        if ($komisi['success']) {
            return redirect('/komisi')->with('success', $komisi['message']);
        } else {
            return redirect('/komisi')->with('error', $komisi['message']);
        }
    }

    public function destroy(string $id)
    {
        $komisi = $this->komisiInterface->deletedata($id);

        if ($komisi['success']) {
            return redirect('/komisi')->with('success', $komisi['message']);
        } else {
            return redirect('/komisi')->with('error', $komisi['message']);
        }
    }

    public function show(string $id)
    {
        $komisi = $this->komisiInterface->getdetail($id);
        $pelatfrom = $this->komisiInterface->getdetailplatfrom($id);
        // dd($komisi);
        return view('komisi.index', compact('komisi','pelatfrom'));
    }


}
