<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;

class ExamController extends Controller
{
    /**
     * Display a listing of the exams.
     */
    public function index()
    {
        $exams = Exam::all();
        return response()->json($exams);
    }

    /**
     * Show the form for creating a new exam.
     */
    public function create()
    {
        // Return a view if using Blade templates (for web-based UI)
    }

    /**
     * Store a newly created exam in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'exam_type_id' => 'required|exists:exam_types,id',
            'name' => 'required|string|max:45',
            'start_date' => 'required|date',
        ]);

        $exam = Exam::create($validated);
        return response()->json(['message' => 'Exam created successfully', 'exam' => $exam], 201);
    }

    /**
     * Display the specified exam.
     */
    public function show($id)
    {
        $exam = Exam::findOrFail($id);
        return response()->json($exam);
    }

    /**
     * Show the form for editing the specified exam.
     */
    public function edit($id)
    {
        // Return a view for editing (for web-based UI)
    }

    /**
     * Update the specified exam in storage.
     */
    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        $validated = $request->validate([
            'exam_type_id' => 'required|exists:exam_types,id',
            'name' => 'required|string|max:45',
            'start_date' => 'required|date',
        ]);

        $exam->update($validated);
        return response()->json(['message' => 'Exam updated successfully', 'exam' => $exam]);
    }

    /**
     * Remove the specified exam from storage.
     */
    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return response()->json(['message' => 'Exam deleted successfully']);
    }
}
