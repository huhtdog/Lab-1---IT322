<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // If using views, return a form view
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'description' => 'nullable|string|max:45',
            'grade_id' => 'required|exists:grades,id'
        ]);

        $course = Course::create($request->all());

        return response()->json(['message' => 'Course created successfully', 'course' => $course], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return response()->json($course);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'description' => 'nullable|string|max:45',
            'grade_id' => 'required|exists:grades,id'
        ]);

        $course->update($request->all());

        return response()->json(['message' => 'Course updated successfully', 'course' => $course]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['message' => 'Course deleted successfully']);
    }
}
