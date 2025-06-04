<?php

namespace App\Http\Controllers;

use App\Interfaces\PlatfromInterface;
use Illuminate\Http\Request;

class PlatfromController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $platfromInterface;

     public function __construct(PlatfromInterface $platfromInterface)
     {
         $this->platfromInterface = $platfromInterface;
     }

    public function index(Request $request)
    {
        $platfrom = $this->platfromInterface->getdata($request);
        return view('platfrom.index', compact('platfrom'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $platfrom = $this->platfromInterface->storedata($request);

        if ($platfrom['success']) {
            return redirect('/platfrom')->with('success', $platfrom['message']);
        } else {
            return redirect('/platfrom')->with('error', $platfrom['message']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $platfrom = $this->platfromInterface->updatedata($request, $id);

        if ($platfrom['success']) {
            return redirect('/platfrom')->with('success', $platfrom['message']);
        } else {
            return redirect('/platfrom')->with('error', $platfrom['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $platfrom = $this->platfromInterface->deletedata($id);

        if ($platfrom['success']) {
            return redirect('/platfrom')->with('success', $platfrom['message']);
        } else {
            return redirect('/platfrom')->with('error', $platfrom['message']);
        }
    }
}
