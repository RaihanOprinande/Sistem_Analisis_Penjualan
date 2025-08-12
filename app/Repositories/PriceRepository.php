<?php

namespace App\Repositories;

use App\Interfaces\PriceInterface;
use App\Models\Commission;
use App\Models\Menu;
use App\Models\Platfrom;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $price = Price::orderby('created_at', 'desc')->get();

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
        $platfrom = Platfrom::with('komisi')->get();

        return $platfrom;
    }
    public function getdata($id)
    {
        $price = Price::find($id);
        return $price;
    }
    public function storedata($request)
    {
        // $menu = Menu::find($id);
        try {
            // DB::beginTransaction();

        $validated = $request->validate([
            'menu_id' => 'required',
            'platfrom_id' => 'required',
            'komisi_id' => 'required|numeric',
            'target_laba' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);
        $existing = Price::where('platfrom_id', $request->platfrom_id)
            ->where('menu_id', $request->menu_id)
            ->first();

        if ($existing) {
        Price::where('platfrom_id', $request->platfrom_id)
            ->where('menu_id', $request->menu_id)
            ->delete();
        }

        Price::create($validated);
        // DB::commit();
        // dd($validated);
        return ['success' => true, 'message' => 'Price has been added'];
    } catch (\Exception $e) {
        // dd($validated);
        return ['success' => false, 'message' => 'Failed to add price: ' . $e->getMessage()];
        }
    }
    public function updatedata($request ,$id)
    {
        try {
            $validated = $request->validate([
            'menu_id' => 'required',
            'platfrom_id' => 'required',
            'komisi_id' => 'required|numeric',
            'target_laba' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);
        Price::where('id',$id)->update($validated);
        return ['success' => true, 'message' => 'Price has been added'];
        } catch (\Exception $e) {
        return ['success' => false, 'message' => 'Failed to add price: ' . $e->getMessage()];
        }
    }
    public function deletedata($id)
    {
        // Logic to delete data
    }

    public function getallkomisi()
    {
        $komisi = Commission::all();
        return $komisi;
    }
}
