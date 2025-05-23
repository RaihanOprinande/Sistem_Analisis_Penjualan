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
        return view('register');
    }

    public function store(Request $request){

        $register = $this->registerInterface->store($request);

        if ($register['success']) {
            return redirect('/login')->with('success', $register['message']);
        } else {
            return redirect('/register')->with('error', $register['message']);
        };
    }


}
