@extends('layouts.app')
@section('content')
<section class="pb-11 pt-7 bg-600">

  <div class="container">
    <div class="row">
      <div class="col-12">
        <h6 class="font-sans-serif text-primary fw-bold">Course lists</h6>
        <h1 class="mb-6">All Courses</h1>
        <form class="row g-3" action="{{ route('courses') }}" method="GET" role="filter">
          <div class="col-sm-6 col-md-3">
            <label class="form-label" for="inputCategories">Categories</label>
            <select class="form-select" id="inputCategories">
              <option selected="selected">All Categories</option>
              <option value="1">UX designer</option>
            </select>
          </div>
          <div class="col-sm-6 col-md-3">
            <label class="form-label" for="inputLevel">Level</label>
            <select class="form-select" id="inputLevel">
              <option selected="selected">All Level</option>
              <option value="1">Level 1 </option>
              <option value="2">Level 2 </option>
              <option value="3">Level 3</option>
            </select>
          </div>
          <div class="col-sm-6 col-md-3">
            <label class="form-label" for="inputLanguage">Language</label>
            <select class="form-select" id="inputLanguage">
              <option selected="selected">English</option>
              <option value="1">Bangla</option>
              <option value="2">Hindi</option>
            </select>
          </div>
          <div class="col-sm-6 col-md-3">
            <label class="form-label" for="inputInstructor">{{ trans('app.filter.teacher') }}</label>
            <select class="form-select" id="inputInstructor" name="teacher">
              <option value="0">{{ trans('app.filter.all_teacher') }}</option>
              @foreach ($teachers as $id => $teacher)
                <option value="{{ $id }}" {{ $id == $filters['teacher'] ? 'selected' : '' }}>{{ $teacher }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-auto z-index-2">
            <button class="btn btn-primary" type="submit">{{ trans('global.submit') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end of .container-->

</section>

<section class="pb-0" style="margin-top:-17rem">

  <div class="container">
    <div class="row">
      @if (!$courses->isEmpty())
        @foreach ($courses as $course)
          <div class="col-md-6 col-lg-4 mb-4">
            <a class="card h-100" href="{{ route('courses.show', $course->slug) }}">
              <div class="card-cover">
                <div class="cover-img-container">
                  <img class="card-img-top w-100" src="img/gallery/ux-designer.png" alt="courses" />
                </div>
                <div class="img-teacher-container">
                  <img class="card-img-teacher" src="img/gallery/teacher.jpg" />
                </div>
              </div>
              <div class="card-body">
                <h5 class="font-sans-serif fw-bold fs-md-0 fs-lg-1">
                  {{ $course->title }}
                </h5>
                <p class="text-muted fs--1 stretched-link text-decoration-none">
                  {{ $course->description }}
                </p>
              </div>
            </a>
          </div>
        @endforeach
      @else
        <h2 class="text-center">No courses found</h2>
      @endif

    </div>
  </div>
  <!-- end of .container-->

</section>
@endsection
@section('scripts')
@parent
@endsection
