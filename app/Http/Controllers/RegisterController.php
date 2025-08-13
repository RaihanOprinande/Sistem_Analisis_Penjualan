<?php

namespace App\Http\Controllers;

use App\Interfaces\RegisterInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public $registerInterface;

    public function __construct(RegisterInterface $registerInterface)
    {
        $this->registerInterface = $registerInterface;
    }

    public function index(){
        $admin = $this->registerInterface->getalldata();
        return view('admin.index',compact('admin'));
    }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){

        $register = $this->registerInterface->store($request);

        if ($register['success']) {
            return redirect('/admin')->with('success', $register['message']);
        } else {
            return redirect('/admin')->with('error', $register['message']);
        };
    }

        public function update(Request $request,string $id)
    {
        $admin = $this->registerInterface->updatedata($request, $id);

        if ($admin['success']) {
            return redirect('/admin')->with('success', $admin['message']);
        } else {
            return redirect('/admin')->with('error', $admin['message']);
        }
    }

    public function destroy(string $id)
    {
        $register = $this->registerInterface->deletedata($id);

        if ($register['success']) {
            return redirect('/admin')->with('success', $register['message']);
        } else {
            return redirect('/admin')->with('error', $register['message']);
        }
    }


}
