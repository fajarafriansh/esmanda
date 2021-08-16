<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;

class CoursesTableSeeder extends Seeder
{
    public function run()
    {
        Course::factory()->count(5)->create()->each(function ($course) {
            $course->teachers()->sync([2]);
            $course->categories()->sync([1]);
            $course->courseLessons()->saveMany(Lesson::factory()->count(10)->create());
        });
    }
}
