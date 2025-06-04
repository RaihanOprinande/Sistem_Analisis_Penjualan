<?php

namespace App\Http\Controllers;

use App\Interfaces\MenuInterface;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public $menuInterface;

    public function __construct(MenuInterface $menuInterface)
    {
        $this->menuInterface = $menuInterface;
    }

    public function index()
    {
        $menu = $this->menuInterface->getdata();
        return view('menu.index', compact('menu'));
    }



    public function create()
    {
        return view('menu.create');
    }
    public function store(Request $request)
    {
        $menu = $this->menuInterface->storedata($request);

        if ($menu['success']) {
            return redirect('/menu')->with('success', $menu['message']);
        } else {
            return redirect('/menu')->with('error', $menu['message']);
        }
    }

    public function update(Request $request,string $id)
    {
        $menu = $this->menuInterface->updatedata($request, $id);

        if ($menu['success']) {
            return redirect('/menu')->with('success', $menu['message']);
        } else {
            return redirect('/menu')->with('error', $menu['message']);
        }
    }

    public function destroy(string $id)
    {
        $menu = $this->menuInterface->deletedata($id);

        if ($menu['success']) {
            return redirect('/menu')->with('success', $menu['message']);
        } else {
            return redirect('/menu')->with('error', $menu['message']);
        }
    }
}
