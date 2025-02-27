<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendance = Attendance::all();
        return response()->json($attendance);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'student_id' => 'required|exists:students,id',
            'status' => 'required|boolean',
            'remark' => 'nullable|string|max:255',
        ]);

        $attendance = Attendance::create($request->all());

        return response()->json([
            'message' => 'Attendance record created successfully',
            'attendance' => $attendance
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        return response()->json($attendance);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        $request->validate([
            'date' => 'sometimes|date',
            'student_id' => 'sometimes|exists:students,id',
            'status' => 'sometimes|boolean',
            'remark' => 'nullable|string|max:255',
        ]);

        $attendance->update($request->all());

        return response()->json([
            'message' => 'Attendance record updated successfully',
            'attendance' => $attendance
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        $attendance->delete();

        return response()->json(['message' => 'Attendance record deleted successfully']);
    }
}
