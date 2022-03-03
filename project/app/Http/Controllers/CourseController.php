<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return Course::all();
    }

    public function create(Request $request)
    {
        $course = Course::create($request->all());

        return response()->json(   [
            'data'=>[
                'id'=>$course->id,
                'status'=>'created'
            ]
        ],201);
    }
}



