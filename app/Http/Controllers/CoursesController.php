<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        $teachers = User::whereHas('roles', function($q) { $q->where('role_id', 2); })->pluck('name', 'id');;
        $query = Course::query();

        if ($request->input('teacher')) {
            $query->whereHas('teachers', function ($query) use ($request) {
                $query->where('id', $request->input('teacher'));
            });
        }

        $courses = $query->paginate(10);
        $filters = [];
        $filters['teacher'] = $request->input('teacher');
        // dd($filters);
        return view('courses', compact('courses', 'teachers', 'filters'));
    }

    public function show($slug) {
        $course = Course::where('slug', $slug)->where('published', 1)->firstOrFail();
        $course->load('teachers', 'courseLessons', 'courseTests');
        return view('course', compact('course'));
    }
}
