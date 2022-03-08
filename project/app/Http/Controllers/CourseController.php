<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('lessons')->get();
        return response()->json(['courses' => $courses], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:256',
            'student_capacity' => 'required|integer',
            'start_date' => 'required|date_format:Y-m-d|after:yesterday',
            'end_date' => 'required|date_format:Y-m-d|after:start_date',
            'has_certificate' => 'required|boolean',
        ]);

        try {
            $course = Course::create($request->all());

            return response()->json(['course' => $course, 'message' => 'Success create course'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Create failed!'], 409);
        }
    }
}



