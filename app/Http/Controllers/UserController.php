<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users =  User::latest()->get();

            return response()->json($users);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        try {

            $payload = $request->validate([
                'name' => 'sometimes',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $request['password'] = bcrypt($request['password']);

            $user->update($payload);


            return response()->json([
                'status' => true,
                'message' => 'Updated Successfully',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {

            $this->authorize('delete', User::class);
            $user->delete();

            return response()->json([
                'message' => 'User Deleted Successfully',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'error' => $e->errors(),
            ], 422);
        }
    }
}
