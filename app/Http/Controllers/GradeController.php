<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        return response()->json($grades);
    }

    public function create()
    {
        // Return view for creating a grade
    }

    public function store(Request $request)
    {
        $grade = Grade::create($request->all());
        return response()->json($grade);
    }

    public function show(Grade $grade)
    {
        return response()->json($grade);
    }

    public function edit(Grade $grade)
    {
        // Return view for editing a grade
    }

    public function update(Request $request, Grade $grade)
    {
        $grade->update($request->all());
        return response()->json($grade);
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return response()->json(['message' => 'Grade deleted successfully']);
    }
}
