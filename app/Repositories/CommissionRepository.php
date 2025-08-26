<?php

namespace App\Repositories;

use App\Interfaces\CommissionInterface;
use App\Models\Commission;
use App\Models\Platfrom;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CommissionRepository implements CommissionInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getdata()
    {
        $komisi = Commission::with('platfrom')->get();
        return $komisi;
    }
    public function getdetail($id)
    {

            $komisi = Commission::where('platfrom_id', $id)->get();

            return $komisi;

    }
    public function getdetailplatfrom($id)
    {
        $platfrom = Platfrom::find($id);
        return $platfrom;
    }
    public function storedata($request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'komisi' => 'required|numeric|max:100',
                'platfrom_id' => 'required|exists:platfrom_komisis,platfrom_id',
                'tanggal_berlaku' => Carbon::now(),
            ]);
            $commission = Commission::create($validated);

            $price = Price::where('platfrom_id',$commission->platfrom_id)->with('menu','platfrom')->get();

            foreach ($price as $price) {
            $hpp = $price->menu->hpp;
            $target_laba = $price->menu->target_laba;
            $komisi = $commission->komisi;

        $harga_mentah = ($hpp + ($hpp * ($target_laba / 100))) / (1 - ($komisi / 100));
        $harga_final = ceil($harga_mentah / 100) * 100;


        $laba_bersih = ($harga_final * (1 - ($komisi / 100))) - $hpp;
        $laba_final = round($laba_bersih);


            $price->update([
                'komisi_id' => $commission->id,
                'harga' => $harga_final,
                'laba' => $laba_final
            ]);
        }
        // dd($commission);
        DB::commit();
            return ['success' => true, 'message' => 'Commission has been added'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => 'Failed to add commission: ' . $e->getMessage()];
        }
    }
    public function updatedata($request, $id)
    {
        try {
            $validated = $request->validate([
                'komisi' => 'required|numeric',
                'platfrom_id' => 'required|exists:platfrom,id',
            ]);
            $komisi = Commission::find($id);
            $komisi->update($validated);
            return ['success' => true, 'message' => 'Commission has been updated'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Failed to update commission: ' . $e->getMessage()];
        }
    }
    public function deletedata($id)
    {
        try {
            $komisi = Commission::find($id);
            $komisi->delete();

            return ['success' => true, 'message' => 'Menu has been deleted'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Failed to delete menu : '. $e->getMessage()];
        }
    }
}
