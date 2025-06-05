<?php

namespace App\Repositories;

use App\Interfaces\CommissionInterface;
use App\Models\Commission;
use App\Models\Platfrom;

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
            // $platfrom = Commission::where('platfrom_id', $id)->first();
            // $platfrom = Platfrom::find($id);
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

            $validated = $request->validate([
                'komisi' => 'required|numeric',
                'platfrom_id' => 'required|exists:platfrom_komisis,platfrom_id',
                'tanggal_berlaku' => 'required',
            ]);
            Commission::create($validated);
            return ['success' => true, 'message' => 'Commission has been added'];
        } catch (\Exception $e) {
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
