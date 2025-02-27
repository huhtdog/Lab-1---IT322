<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        // Return view for creating a student (if using Blade templates)
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6',
            'fname' => 'required|string|max:45',
            'lname' => 'required|string|max:45',
            'dob' => 'required|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'parent_id' => 'required|exists:parents,id',
            'date_of_join' => 'nullable|date',
            'status' => 'boolean',
        ]);

        $student = Student::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'parent_id' => $request->parent_id,
            'date_of_join' => $request->date_of_join,
            'status' => $request->status ?? 1, // Default active
            'last_login_date' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'Student created successfully', 'student' => $student]);
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        // Return view for editing a student (if using Blade templates)
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'email' => 'required|email|unique:students,email,' . $student->id,
            'fname' => 'required|string|max:45',
            'lname' => 'required|string|max:45',
            'dob' => 'required|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'parent_id' => 'required|exists:parents,id',
            'date_of_join' => 'nullable|date',
            'status' => 'boolean',
        ]);

        $student->update([
            'email' => $request->email,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'parent_id' => $request->parent_id,
            'date_of_join' => $request->date_of_join,
            'status' => $request->status ?? $student->status,
            'last_login_date' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'Student updated successfully', 'student' => $student]);
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
