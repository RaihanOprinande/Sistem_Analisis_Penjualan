<?php

namespace App\Repositories;

use App\Interfaces\RegisterInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterRepository implements RegisterInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function store(Request $request){
        try {

        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|confirmed'
        ]);

        // dd($validated);
        User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]
        );
        return ['success' => true, 'message' => 'your account has been created'];
        } catch (\Exception $e) {
        return ['success' => false, 'message' => 'Failed to add an account : '. $e->getMessage()];
    }
    }
}
