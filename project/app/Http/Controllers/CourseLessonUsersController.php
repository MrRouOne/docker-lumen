<?php

namespace App\Http\Controllers;

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
            $lessonUser = LessonUser::where(['user_id' => Auth::user()->id, 'lesson_id' => $request->route('id')])->first();
            $isPassed = $request->input('is_passed');

            if (!isset($lessonUser->id)) {
                return response()->json(['message' => 'You are not enrolled in this lesson'], 400);
            }

            if (!$isPassed) {
                return response()->json(['message' => 'Field is_passed cant be false'], 400);
            }

            if ($lessonUser->is_passed and $isPassed) {
                return response()->json(['message' => 'You have already completed this lesson'], 400);
            }

            $lessonUser->update(['is_passed' => $isPassed]);
            return response()->json(['LessonUser' => $lessonUser, 'message' => 'You have successfully completed this lesson'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Output failed!'], 409);
        }
    }
}



