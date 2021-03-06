@extends('layouts.app')
@section('content')
<section class="pb-11 pt-7 bg-600">

  <div class="container">
    <div class="row">
      <div class="col-12">
        <h6 class="font-sans-serif text-primary fw-bold">Course detail</h6>
        <h1 class="mb-6">{{ $course->title }}</h1>
      </div>
    </div>
  </div>
  <!-- end of .container-->

</section>

<section class="pb-0" style="margin-top:-21.5rem">

  <div class="container">
    <div class="row">
      <div class="col-md-8 mb-3">
        <img class="w-100" src="{{ asset('img/gallery/ux-designer.png') }}" alt="..." />
      </div>
      <div class="col-md-4">
        <div class="card">
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Teacher </strong>: @foreach ($course->teachers as $teacher) {{ $teacher->name }} @endforeach</li>
            <li class="list-group-item"><strong>Categories </strong>: Technology</li>
            <li class="list-group-item"><strong>Lectures </strong>: {{ $course->courseLessons->count()}}</li>
            <li class="list-group-item"><strong>Level </strong>: Intermediate Level</li>
            @guest
              <button class="list-group-item button" data-bs-toggle="modal" data-bs-target="#loginModal">
                {{ trans('global.login') }}
              </button>
            @endguest
            @auth
            <button type="submit" class="list-group-item button" data-bs-toggle="modal" data-bs-target="#enrolModal">Enrol The Course</button>
            @endauth
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <h2 class="mt-4 mb-3">Description</h2>
        <p>{{ $course->description }}</p>

        <h2 class="mt-4 mb-3">Course Outline</h2>
        <div class="accordion" id="lessonsList">
          @foreach ($course->courseLessons as $lesson)
            <div class="accordion-item">
              <h2 class="accordion-header" id="panelsStayOpen-heading-{{ $lesson->id }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse-{{ $lesson->id }}" aria-expanded="true" aria-controls="panelsStayOpen-collapse-{{ $lesson->id }}">
                  <strong>{{ $lesson->title }}</strong>
                </button>
              </h2>
              <div id="panelsStayOpen-collapse-{{ $lesson->id }}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading-{{ $lesson->id }}">
                <div class="accordion-body d-flex flex-column align-items-start justify-content-between">
                  <p>{{ $lesson->excerpt }}</p>
                  <a class="btn btn-outline-secondary order-1 order-lg-0 flex-shrink-0" href="{{ route('lessons.show', $lesson->slug) }}">
                    View Details
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- end of .container-->

</section>

<!-- Modal -->
<div class="modal fade" id="enrolModal" tabindex="-1" aria-labelledby="enrolModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-4">
          <h4>Enter course access code</h4>
          <div>Ask your teacher if you don't have access code</div>
        </div>
        <form class="d-flex flex-column align-items-center" action="{{ route('courses.enrol') }}" method="POST">
          @csrf
          <input type="hidden" name="course_id" value="{{ $course->id }}">
          <div class="mb-4">
            <input type="text" name="access_code" class="form-control" placeholder="Course access code" required>
          </div>
          <button type="submit" class="btn btn-primary btn-lg">Enrol The Course</button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
@endsection
