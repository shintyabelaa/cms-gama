<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('name', 'email', 'id')->get();
        return view('users.index', [
            'users' => $users,
             'title'=> 'Admin'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create',['title'=> 'Admin']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6',
            'email' => ['required', 'email', Rule::unique('users')->whereNull('deleted_at')]
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Admin created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('users.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->select('name', 'email', 'id')->first();
        return view('users.edit', ['user' => $user,'title'=> 'Admin']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6',
            'email' => Rule::unique('users')->whereNull('deleted_at')->ignore($id)
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
