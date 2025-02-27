<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::all();
        return response()->json($classrooms);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Normally returns a view for a form, not needed for API-based CRUD
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
            'grade_id' => 'required|exists:grades,id',
            'section' => 'required|string|max:2',
            'status' => 'boolean',
            'remarks' => 'nullable|string|max:45',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $classroom = Classroom::create($request->all());

        return response()->json($classroom, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $classroom = Classroom::findOrFail($id);
        return response()->json($classroom);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Normally returns a view for a form, not needed for API-based CRUD
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'year' => 'integer',
            'grade_id' => 'exists:grades,id',
            'section' => 'string|max:2',
            'status' => 'boolean',
            'remarks' => 'nullable|string|max:45',
            'teacher_id' => 'exists:teachers,id',
        ]);

        $classroom = Classroom::findOrFail($id);
        $classroom->update($request->all());

        return response()->json($classroom);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();

        return response()->json(['message' => 'Classroom deleted successfully']);
    }
}
