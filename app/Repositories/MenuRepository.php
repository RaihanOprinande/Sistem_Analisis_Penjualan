<?php

namespace App\Repositories;

use App\Interfaces\MenuInterface;
use App\Models\Menu;

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
            $validated = $request->validate([
            'menu_name' => 'required',
            'hpp' => 'required|numeric',
        ]);
        Menu::create($validated);

        return ['success' => true, 'message' => 'Menu has been added'];
        } catch (\Exception $e) {
        return ['success' => false, 'message' => 'Failed to add menu : '. $e->getMessage()];
        }
    }

    public function updatedata($request, $id)
    {
        try {
            $validated = $request->validate([
            'menu_name' => 'required',
            'hpp' => 'required|numeric',
        ]);
        $menu = Menu::find($id);
        $menu->update($validated);

        return ['success' => true, 'message' => 'Menu has been updated'];
        } catch (\Exception $e) {
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
