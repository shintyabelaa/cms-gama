<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DataAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::all();
        return view("admin.data-admin.index", compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.data-admin.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate(User::$rules);

        // Create a new agen
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'created_at' => now(),
        ]);

        // Redirect with a success message
        return redirect()->route('data-admin.index')->with('create_success', 'Data Agen Berhasil Ditambahkan');
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
    public function edit(string $id)
    {
        $admin = User::findOrFail($id);
        return view('admin.data-admin.edit', ['admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|max:12',
        ]);

        // If password is not provided, don't update it
        $data = $request->only(['name', 'email', 'role']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // Update the admin data
        $admin->update($data);

        return redirect()->route('data-admin.index')->with('edit_success', 'Admin updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::findOrFail($id);

        $admin->delete();
        return redirect()->route('data-admin.index')->with('delete_success', 'Admin deleted successfully.');
    }
}
