<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamResult;
use App\Models\Student;
use App\Models\Course;

class ExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all exam results with student and course details
        $examResults = ExamResult::with(['student', 'course'])->get();
        return response()->json($examResults);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not needed for API-based CRUD
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'exam_id' => 'required|exists:exams,id',
            'marks' => 'required|string|max:45'
        ]);

        // Create exam result record
        $examResult = ExamResult::create($request->all());

        return response()->json([
            'message' => 'Exam result created successfully',
            'exam_result' => $examResult
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find exam result by ID and include related student & course data
        $examResult = ExamResult::with(['student', 'course'])->findOrFail($id);

        return response()->json($examResult);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Not needed for API-based CRUD
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate request data
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'exam_id' => 'required|exists:exams,id',
            'marks' => 'required|string|max:45'
        ]);

        // Find the exam result and update it
        $examResult = ExamResult::findOrFail($id);
        $examResult->update($request->all());

        return response()->json([
            'message' => 'Exam result updated successfully',
            'exam_result' => $examResult
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find and delete the exam result
        $examResult = ExamResult::findOrFail($id);
        $examResult->delete();

        return response()->json(['message' => 'Exam result deleted successfully']);
    }
}
