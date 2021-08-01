<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTestRequest;
use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Test;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('test_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tests = Test::with(['course', 'lesson', 'questions'])->get();

        return view('admin.tests.index', compact('tests'));
    }

    public function create()
    {
        abort_if(Gate::denies('test_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessons = Lesson::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $questions = Question::pluck('question', 'id');

        return view('admin.tests.create', compact('courses', 'lessons', 'questions'));
    }

    public function store(StoreTestRequest $request)
    {
        $test = Test::create($request->all());
        $test->questions()->sync($request->input('questions', []));

        return redirect()->route('admin.tests.index');
    }

    public function edit(Test $test)
    {
        abort_if(Gate::denies('test_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessons = Lesson::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $questions = Question::pluck('question', 'id');

        $test->load('course', 'lesson', 'questions');

        return view('admin.tests.edit', compact('courses', 'lessons', 'questions', 'test'));
    }

    public function update(UpdateTestRequest $request, Test $test)
    {
        $test->update($request->all());
        $test->questions()->sync($request->input('questions', []));

        return redirect()->route('admin.tests.index');
    }

    public function show(Test $test)
    {
        abort_if(Gate::denies('test_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $test->load('course', 'lesson', 'questions');

        return view('admin.tests.show', compact('test'));
    }

    public function destroy(Test $test)
    {
        abort_if(Gate::denies('test_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $test->delete();

        return back();
    }

    public function massDestroy(MassDestroyTestRequest $request)
    {
        Test::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}