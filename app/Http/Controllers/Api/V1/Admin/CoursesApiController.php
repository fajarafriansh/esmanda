<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\Admin\CourseResource;
use App\Models\Course;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CoursesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseResource(Course::with(['teachers'])->get());
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->all());
        $course->teachers()->sync($request->input('teachers', []));
        if ($request->input('course_image', false)) {
            $course->addMedia(storage_path('tmp/uploads/' . basename($request->input('course_image'))))->toMediaCollection('course_image');
        }

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseResource($course->load(['teachers']));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());
        $course->teachers()->sync($request->input('teachers', []));
        if ($request->input('course_image', false)) {
            if (!$course->course_image || $request->input('course_image') !== $course->course_image->file_name) {
                if ($course->course_image) {
                    $course->course_image->delete();
                }
                $course->addMedia(storage_path('tmp/uploads/' . basename($request->input('course_image'))))->toMediaCollection('course_image');
            }
        } elseif ($course->course_image) {
            $course->course_image->delete();
        }

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}