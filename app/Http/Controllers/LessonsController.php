<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonsController extends Controller
{
    public function show($slug) {
        $lesson = Lesson::where('slug', $slug)->where('published', 1)->firstOrFail();
        return view('lesson', compact('lesson'));
    }
}
