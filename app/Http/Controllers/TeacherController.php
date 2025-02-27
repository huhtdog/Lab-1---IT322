<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return response()->json($teachers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return view for creating a teacher (if using Blade templates)
        // return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required|min:6',
            'fname' => 'required|string|max:45',
            'lname' => 'required|string|max:45',
            'dob' => 'required|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'status' => 'boolean'
        ]);

        $teacher = Teacher::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'status' => $request->status ?? 1,
        ]);

        return response()->json($teacher, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return response()->json($teacher);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        // Return view for editing a teacher (if using Blade templates)
        // return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'email' => 'sometimes|email|unique:teachers,email,' . $teacher->id,
            'password' => 'sometimes|min:6',
            'fname' => 'sometimes|string|max:45',
            'lname' => 'sometimes|string|max:45',
            'dob' => 'sometimes|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'status' => 'boolean'
        ]);

        $teacher->update([
            'email' => $request->email ?? $teacher->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $teacher->password,
            'fname' => $request->fname ?? $teacher->fname,
            'lname' => $request->lname ?? $teacher->lname,
            'dob' => $request->dob ?? $teacher->dob,
            'phone' => $request->phone ?? $teacher->phone,
            'mobile' => $request->mobile ?? $teacher->mobile,
            'status' => $request->status ?? $teacher->status,
        ]);

        return response()->json($teacher);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json(['message' => 'Teacher deleted successfully']);
    }
}
