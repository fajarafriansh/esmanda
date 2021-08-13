@extends('layouts.admin')
@section('content')

<div class="card">
  <div class="card-header">
    {{ trans('global.show') }} {{ trans('cruds.course.title') }}
  </div>

  <div class="card-body">
    <div class="form-group">
      <div class="form-group">
        <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
          {{ trans('global.back_to_list') }}
        </a>
      </div>
      <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <th>{{ trans('cruds.course.fields.id') }}</th>
            <td>{{ $course->id }}</td>
          </tr>
          <tr>
            <th>{{ trans('cruds.course.fields.teachers') }}</th>
            <td>
              @foreach($course->teachers as $key => $teachers)
                <span class="label label-info">{{ $teachers->name }}</span>
              @endforeach
            </td>
          </tr>
          <tr>
            <th>{{ trans('cruds.course.fields.title') }}</th>
            <td>{{ $course->title }}</td>
          </tr>
          <tr>
            <th>{{ trans('cruds.course.fields.description') }}</th>
            <td>{{ $course->description }}</td>
          </tr>
          <tr>
            <th>{{ trans('cruds.course.fields.course_image') }}</th>
            <td>
              @if($course->course_image)
                <a href="{{ $course->course_image->getUrl() }}" target="_blank" style="display: inline-block">
                  <img src="{{ $course->course_image->getUrl('thumb') }}">
                </a>
              @endif
            </td>
          </tr>
          <tr>
            <th>{{ trans('cruds.course.fields.start_date') }}</th>
            <td>{{ $course->start_date }}</td>
          </tr>
          <tr>
            <th>{{ trans('cruds.course.fields.published') }}</th>
            <td>
              <input type="checkbox" disabled="disabled" {{ $course->published ? 'checked' : '' }}>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="form-group">
        <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
          {{ trans('global.back_to_list') }}
        </a>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    {{ trans('global.relatedData') }}
  </div>
  <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
    <li class="nav-item">
      <a class="nav-link" href="#course_lessons" role="tab" data-toggle="tab">
        {{ trans('cruds.lesson.title') }}
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#course_tests" role="tab" data-toggle="tab">
        {{ trans('cruds.test.title') }}
      </a>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane" role="tabpanel" id="course_lessons">
      @includeIf('admin.courses.relationships.courseLessons', ['lessons' => $course->courseLessons])
    </div>
    <div class="tab-pane" role="tabpanel" id="course_tests">
      @includeIf('admin.courses.relationships.courseTests', ['tests' => $course->courseTests])
    </div>
  </div>
</div>

@endsection
