<?php

namespace App\Http\Controllers;

use App\Models\CourseUser;
use App\Models\Lesson;
use App\Models\LessonUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseLessonUsersController extends Controller
{
    public function registration(Request $request)
    {
        $this->validate($request, [
            'is_passed' => 'required|boolean',
        ]);

        try {
            $lessonUser = LessonUser::where(['user_id'=>Auth::user()->id,'lesson_id'=>$request->route('id')])->first();

            if (!isset($lessonUser->id)) {
                return response()->json(['message' => 'Incorrect lesson_id'], 201);
            }

            $lessonUser->update(['is_passed' => $request->input('is_passed')]);
            return response()->json(['LessonUser' => $lessonUser, 'message' => 'Updated'], 201);

        } catch (\Exception $e) {
            echo $e;
            return response()->json(['message' => 'Output failed!'], 409);
        }
    }
}



