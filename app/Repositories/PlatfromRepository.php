<?php

namespace App\repositories;

use App\Interfaces\PlatfromInterface;
use App\Models\Platfrom;

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
            $validated = $request->validate([
                'platfrom' => 'required',
            ]);
            Platfrom::create($validated);

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
}
