<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonsController extends Controller
{
    public function show($slug) {
        $lesson = Lesson::where('slug', $slug)->where('published', 1)->firstOrFail();
        $prev_lesson = Lesson::where('course_id', $lesson->course_id)
            ->where('position', '<', $lesson->position)
            ->orderBy('position', 'desc')
            ->first();
        $next_lesson = Lesson::where('course_id', $lesson->course_id)
            ->where('position', '>', $lesson->position)
            ->orderBy('position', 'asc')
            ->first();

        return view('lesson', compact('lesson', 'prev_lesson', 'next_lesson'));
    }
}
