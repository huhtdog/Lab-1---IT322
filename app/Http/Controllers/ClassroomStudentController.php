<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassroomStudent;

class ClassroomStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classroomStudents = ClassroomStudent::all();
        return response()->json($classroomStudents);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'student_id' => 'required|exists:students,id',
        ]);

        $classroomStudent = ClassroomStudent::create($validated);
        return response()->json($classroomStudent, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $classroomStudent = ClassroomStudent::findOrFail($id);
        return response()->json($classroomStudent);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $classroomStudent = ClassroomStudent::findOrFail($id);

        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'student_id' => 'required|exists:students,id',
        ]);

        $classroomStudent->update($validated);
        return response()->json($classroomStudent);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $classroomStudent = ClassroomStudent::findOrFail($id);
        $classroomStudent->delete();

        return response()->json(['message' => 'Record deleted successfully']);
    }
}
