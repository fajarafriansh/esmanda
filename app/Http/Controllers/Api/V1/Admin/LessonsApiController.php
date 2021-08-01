<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Http\Resources\Admin\LessonResource;
use App\Models\Lesson;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('lesson_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonResource(Lesson::with(['course'])->get());
    }

    public function store(StoreLessonRequest $request)
    {
        $lesson = Lesson::create($request->all());

        if ($request->input('lesson_image', false)) {
            $lesson->addMedia(storage_path('tmp/uploads/' . basename($request->input('lesson_image'))))->toMediaCollection('lesson_image');
        }

        if ($request->input('files', false)) {
            $lesson->addMedia(storage_path('tmp/uploads/' . basename($request->input('files'))))->toMediaCollection('files');
        }

        return (new LessonResource($lesson))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonResource($lesson->load(['course']));
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->all());

        if ($request->input('lesson_image', false)) {
            if (!$lesson->lesson_image || $request->input('lesson_image') !== $lesson->lesson_image->file_name) {
                if ($lesson->lesson_image) {
                    $lesson->lesson_image->delete();
                }
                $lesson->addMedia(storage_path('tmp/uploads/' . basename($request->input('lesson_image'))))->toMediaCollection('lesson_image');
            }
        } elseif ($lesson->lesson_image) {
            $lesson->lesson_image->delete();
        }

        if ($request->input('files', false)) {
            if (!$lesson->files || $request->input('files') !== $lesson->files->file_name) {
                if ($lesson->files) {
                    $lesson->files->delete();
                }
                $lesson->addMedia(storage_path('tmp/uploads/' . basename($request->input('files'))))->toMediaCollection('files');
            }
        } elseif ($lesson->files) {
            $lesson->files->delete();
        }

        return (new LessonResource($lesson))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}