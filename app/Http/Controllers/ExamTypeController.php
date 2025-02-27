<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamType;

class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $examTypes = ExamType::all();
        return response()->json($examTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'desc' => 'nullable|string|max:255',
        ]);

        $examType = ExamType::create($request->all());
        return response()->json(['message' => 'Exam Type created successfully', 'data' => $examType], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $examType = ExamType::findOrFail($id);
        return response()->json($examType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $examType = ExamType::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:45',
            'desc' => 'nullable|string|max:255',
        ]);

        $examType->update($request->all());
        return response()->json(['message' => 'Exam Type updated successfully', 'data' => $examType]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $examType = ExamType::findOrFail($id);
        $examType->delete();
        return response()->json(['message' => 'Exam Type deleted successfully']);
    }
}
