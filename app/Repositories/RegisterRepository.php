<?php

namespace App\Repositories;

use App\Interfaces\RegisterInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
                'role' => 0,
                'password' => Hash::make($validated['password'])
            ]
        );
        return ['success' => true, 'message' => 'Admin has been created'];
        } catch (\Exception $e) {
        return ['success' => false, 'message' => 'Failed to add an Admin : '. $e->getMessage()];
    }

    }
        public function getalldata()
    {
        $admin = User::where('role', '0')->get();

        return $admin;
    }

        public function deletedata($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            return ['success' => true, 'message' => 'Admin has been deleted'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Failed to delete admin : '. $e->getMessage()];
        }
    }

    public function updatedata($request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $validated = $request->validate([
            'name' => 'string',
                        'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);
        // $admin = User::find($id);
                $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

            return ['success' => true, 'message' => 'Admin has been updated'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Failed to update admin : '. $e->getMessage()];
        }
    }
}
