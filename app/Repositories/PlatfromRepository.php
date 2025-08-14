<?php

namespace App\repositories;

use App\Interfaces\PlatfromInterface;
use App\Models\Commission;
use App\Models\Platfrom;
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
            ]);
            Platfrom::create($validated);
            Commission::create([
                'platfrom_id' => Platfrom::latest()->first()->id,
                'komisi' => $request->komisi,
                'tanggal_berlaku' =>$request->tanggal_berlaku,
            ]);
            DB::commit();

            return ['success' => true, 'message' => 'Platfrom has been added'];
        } catch (\Exception $e) {
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
