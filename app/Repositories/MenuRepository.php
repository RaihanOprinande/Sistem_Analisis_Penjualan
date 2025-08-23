<?php

namespace App\Repositories;

use App\Interfaces\MenuInterface;
use App\Models\Commission;
use App\Models\Menu;
use App\Models\Platfrom;
use App\Models\Price;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class MenuRepository implements MenuInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

    public function getdata()
    {
        $menu = Menu::all();
        return $menu;
    }

    public function storedata($request)
    {
    try {
    DB::beginTransaction();
    $validated = $request->validate([
        'menu_name' => 'required',
        'hpp' => 'required|numeric',
        'target_laba' => 'required|numeric',
    ]);

    $menu = Menu::create($validated);

    $platfroms = Platfrom::all();

    foreach($platfroms as $pf) {
        $commission = Commission::where('platfrom_id', $pf->id)->orderBy('created_at', 'desc')->first();

        $hpp = $menu->hpp;
        $laba = $menu->target_laba;
        $komisi = $commission ? $commission->komisi : 0;


        $harga_mentah = ($hpp + ($hpp * ($laba / 100))) / (1 - ($komisi / 100));

        $harga_final = ceil($harga_mentah / 500) * 500;

        $laba = $harga_final - (1 - $komisi / 100) - $hpp;

        $laba_final = ceil($laba);


        Price::create([
            'platfrom_id' => $pf->id,
            'menu_id' => $menu->id,
            'komisi_id' => $commission ? $commission->id : null,
            'harga' => $harga_final,
            'laba' => $laba_final,
        ]);
    }

    DB::commit();

    // dd($harga_mentah, $harga_final);
    return ['success' => true, 'message' => 'Menu has been added'];
} catch (\Exception $e) {
            DB::rollBack();
        return ['success' => false, 'message' => 'Failed to add menu : '. $e->getMessage()];
        }
    }

    public function updatedata($request, $id)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'menu_name' => 'required',
                'hpp' => 'required|numeric',
                'target_laba' => 'required|numeric',
            ]);
        $menu = Menu::find($id);
        $menu->update($validated);

        $platfroms = Platfrom::all();

            foreach($platfroms as $pf){
                $commission = Commission::where('platfrom_id', $pf->id)->orderBy('tanggal_berlaku', 'desc')->first();

                $hpp = $menu->hpp;
                $laba = $menu->target_laba;
                $komisi = $commission ? $commission->komisi : 0;

                $harga = ($hpp + ($hpp * ($laba / 100))) / (1 - ($komisi / 100));

                $harga_final = round($harga / 500) * 500;

                $laba = $harga_final - (1 - $komisi / 100) - $hpp;

                $laba_final = ceil($laba);

                Price::create([
                        'platfrom_id' => $pf->id,
                        'menu_id' => $menu->id,
                        'komisi_id' => $commission ? $commission->id : null,
                        'harga' => $harga_final,
                        'laba' => $laba_final,
                    ]);
            }
            DB::commit();
            // dd($laba_final, $harga,$harga_final);
        return ['success' => true, 'message' => 'Menu has been updated'];
        } catch (\Exception $e) {
            DB::rollBack();
        return ['success' => false, 'message' => 'Failed to update menu : '. $e->getMessage()];
        }
    }

    public function deletedata($id)
    {
        try {
            $menu = Menu::find($id);
            $menu->delete();

            return ['success' => true, 'message' => 'Menu has been deleted'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Failed to delete menu : '. $e->getMessage()];
        }
    }

}
