<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class CourseLessonsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $courseID = $request->course_id;
            $lessons = Lesson::where('course_id', $courseID)->get();
            return response()->json(['lessons' => $lessons], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Output failed!'], 409);
        }
    }
}



