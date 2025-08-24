<?php

namespace App\Repositories;

use App\Interfaces\PlatfromInterface;
use App\Models\Commission;
use App\Models\Menu;
use App\Models\Platfrom;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PlatfromRepository implements PlatfromInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getdata($request)
    {

        return Platfrom::all();

    }
    public function storedata($request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'platfrom' => 'required',
                'komisi' => 'required|numeric|max:100'
            ]);
            Platfrom::create($validated);
            Commission::create([
                'platfrom_id' => Platfrom::latest()->first()->id,
                'komisi' => $validated->komisi,
                'tanggal_berlaku' => Carbon::now(),
            ]);

                $menus = Menu::all();

    foreach ($menus as $menu) {
        $hpp = $menu->hpp;
        $laba = $menu->target_laba;
        $komisi_persen = $request->komisi;

        $harga_mentah = ($hpp + ($hpp * ($laba / 100))) / (1 - ($komisi_persen / 100));
        $harga_final = ceil($harga_mentah / 100) * 100;

        $laba_bersih = ($harga_final * (1 - ($komisi_persen / 100))) - $hpp;
        $laba_final = round($laba_bersih);

        Price::create([
            'platfrom_id' => Platfrom::latest()->first()->id,
            'menu_id' => $menu->id,
            'komisi_id' => $request->komisi,
            'harga' => $harga_final,
            'laba' => $laba_final,
        ]);
    }
            DB::commit();

            return ['success' => true, 'message' => 'Platfrom has been added'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => 'Failed to add platfrom : ' . $e->getMessage()];
        }
    }
    public function updatedata($request, $id)
    {
        try {
            $validated = $request->validate([
                'platfrom' => 'required',
            ]);
            $platfrom = Platfrom::find($id);
            $platfrom->update($validated);

            return ['success' => true, 'message' => 'Platfrom has been updated'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Failed to update platfrom : ' . $e->getMessage()];
        }
    }
    public function deletedata($id)
    {
        try {
            $platfrom = Platfrom::find($id);
            $platfrom->delete();

            return ['success' => true, 'message' => 'Platfrom has been deleted'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Failed to delete platfrom : ' . $e->getMessage()];
        }
    }

    public function showdata($id)
    {
        $platfrom = Platfrom::find($id);
        return $platfrom;
    }
    public function showdatakomisi($id)
    {
                $platfrom = Platfrom::find($id);
                $komisi = Commission::where('platfrom_id', $platfrom->id)->get();
                return $komisi;

    }

}
