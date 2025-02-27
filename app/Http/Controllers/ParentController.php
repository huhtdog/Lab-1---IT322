<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentModel; // Ensure your model is correctly named
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parents = ParentModel::all();
        return response()->json($parents);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not required for API-based applications
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:parents,email',
            'password' => 'required|min:6',
            'fname' => 'required|string|max:45',
            'lname' => 'required|string|max:45',
            'dob' => 'required|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'status' => 'boolean',
        ]);

        $parent = ParentModel::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'status' => $request->status ?? 1, // Default to active
            'last_login_date' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'Parent created successfully', 'parent' => $parent], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $parent = ParentModel::findOrFail($id);
        return response()->json($parent);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Not required for API-based applications
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $parent = ParentModel::findOrFail($id);

        $request->validate([
            'email' => 'email|unique:parents,email,' . $id,
            'password' => 'nullable|min:6',
            'fname' => 'string|max:45',
            'lname' => 'string|max:45',
            'dob' => 'date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'status' => 'boolean',
        ]);

        $parent->update([
            'email' => $request->email ?? $parent->email,
            'password' => $request->password ? Hash::make($request->password) : $parent->password,
            'fname' => $request->fname ?? $parent->fname,
            'lname' => $request->lname ?? $parent->lname,
            'dob' => $request->dob ?? $parent->dob,
            'phone' => $request->phone ?? $parent->phone,
            'mobile' => $request->mobile ?? $parent->mobile,
            'status' => $request->status ?? $parent->status,
            'last_login_date' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'Parent updated successfully', 'parent' => $parent]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parent = ParentModel::findOrFail($id);
        $parent->delete();
        return response()->json(['message' => 'Parent deleted successfully']);
    }
}
