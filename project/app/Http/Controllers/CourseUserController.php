<?php

namespace App\Http\Controllers;

use App\Events\DoubleCourseEvent;
use App\Events\FreePlaceCourseEvent;
use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseUserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required|integer'
        ]);

        try {
            $course_id = $request->input('course_id');
            $course = Course::find($course_id);

            if (!isset($course->id)) {
                return response()->json(['message' => 'Incorrect field: course_id'], 400);
            }

            if (!event(new DoubleCourseEvent(Auth::user()->id, $course_id))) {
                return response()->json(['message' => 'You already registered to this course.'], 403);
            }

            if (!event(new FreePlaceCourseEvent($course_id))) {
                return response()->json(['message' => 'Place are over.'], 403);
            }

            CourseUser::create([
                'user_id' => Auth::user()->id,
                'course_id' => $course_id,
                'percentage_passing' => 0,
            ]);

            return response()->json(['message' => 'Success registration.'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed!'], 409);
        }
    }
}



