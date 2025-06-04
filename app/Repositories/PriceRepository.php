<?php

namespace App\Repositories;

use App\Interfaces\PriceInterface;
use App\Models\Menu;
use App\Models\Platfrom;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceRepository implements PriceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getallprice()
    {

        $price = Price::all();

        return $price;
    }

    public function getmenubyplatfrom($id)
    {
    $prices = Price::where('platfrom_id', $id)->get();
    return response()->json($prices);
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
    public function getdata($id)
    {
        // Logic to retrieve data by ID
    }
    public function storedata($request)
    {
        // $menu = Menu::find($id);
        try {
        $validated = $request->validate([
            'menu_id' => 'required',
            'platfrom_id' => 'required',
            'komisi' => 'required|numeric',
            'target_laba' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);
        Price::create($validated);
        return ['success' => true, 'message' => 'Price has been added'];
        } catch (\Exception $e) {
        return ['success' => false, 'message' => 'Failed to add price: ' . $e->getMessage()];
        }
    }
    public function updatedata($request ,$id)
    {
        // Logic to update data
    }
    public function deletedata($id)
    {
        // Logic to delete data
    }
}
