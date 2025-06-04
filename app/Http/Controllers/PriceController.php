<?php

namespace App\Http\Controllers;

use App\Interfaces\PriceInterface;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $priceinterface;

     public function __construct(PriceInterface $priceinterface)
     {
         $this->priceinterface = $priceinterface;
     }

    public function index()
    {   $price = $this->priceinterface->getallprice();
        $menu = $this->priceinterface->getallmenu();
        $platfrom = $this->priceinterface->getallplatfrom();
        return view('price.index',compact('platfrom', 'menu','price'));

    }

        public function byplatfrom(string $id)
    {
    $prices = Price::with('menu','platfrom')->where('platfrom_id', $id)->get();
    return response()->json($prices);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $price = $this->priceinterface->getallprice();
        $menu = $this->priceinterface->getallmenu();
        $platfrom = $this->priceinterface->getallplatfrom();
        return view('price.create',compact('platfrom', 'menu','price'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $price = $this->priceinterface->storedata($request);

        if ($price['success']) {
            return redirect('/price')->with('success', $price['message']);
        } else {
            return redirect('/price')->with('error', $price['message']);
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
        $price = $this->priceinterface->getdata($id);
        $menu = $this->priceinterface->getallmenu();
        $platfrom = $this->priceinterface->getallplatfrom();
        return view('price.update', compact('platfrom', 'menu', 'price'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $price = $this->priceinterface->updatedata($request, $id);

        if ($price['success']) {
            return redirect('/price')->with('success', $price['message']);
        } else {
            return redirect('/price')->with('error', $price['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
