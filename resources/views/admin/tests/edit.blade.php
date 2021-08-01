@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.test.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tests.update", [$test->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="course_id">{{ trans('cruds.test.fields.course') }}</label>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id" id="course_id">
                    @foreach($courses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('course_id') ? old('course_id') : $test->course->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.test.fields.course_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lesson_id">{{ trans('cruds.test.fields.lesson') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson') ? 'is-invalid' : '' }}" name="lesson_id" id="lesson_id">
                    @foreach($lessons as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lesson_id') ? old('lesson_id') : $test->lesson->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.test.fields.lesson_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.test.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $test->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.test.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.test.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $test->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.test.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="questions">{{ trans('cruds.test.fields.questions') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('questions') ? 'is-invalid' : '' }}" name="questions[]" id="questions" multiple>
                    @foreach($questions as $id => $question)
                        <option value="{{ $id }}" {{ (in_array($id, old('questions', [])) || $test->questions->contains($id)) ? 'selected' : '' }}>{{ $question }}</option>
                    @endforeach
                </select>
                @if($errors->has('questions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('questions') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.test.fields.questions_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="published" value="0">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ $test->published || old('published', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">{{ trans('cruds.test.fields.published') }}</label>
                </div>
                @if($errors->has('published'))
                    <div class="invalid-feedback">
                        {{ $errors->first('published') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.test.fields.published_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection