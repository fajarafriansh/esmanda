@extends('layouts.app')
@section('content')
<section class="pb-11 pt-7 bg-600">

  <div class="container">
    <div class="row">
      <div class="col-12">
        <h6 class="font-sans-serif text-primary fw-bold">Lesson detail</h6>
        <h1 class="mb-6">{{ $lesson->title }}</h1>
      </div>
    </div>
  </div>
  <!-- end of .container-->

</section>

<section style="margin-top:-21.5rem">

  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <img class="w-100 mb-5" src="{{ asset('img/gallery/ux-designer.png') }}" alt="..." />
        <div class="lesson-content">
          {!! $lesson->content !!}
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Enrolled </strong>: 1200 students</li>
            <li class="list-group-item"><strong>Duration </strong>: 2 hours</li>
            <li class="list-group-item"><strong>Lectures </strong>: 8</li>
            <li class="list-group-item"><strong>Categories </strong>: Technology</li>
            <li class="list-group-item"><strong>Level </strong>: Intermediate Level</li>
            <li class="list-group-item text-center"><img src="assets/img/gallery/searching.png" width="78" alt="..." />
              <p class="text-muted mb-0 mt-4">Contact a customer support at</p><a class="text-info" href="mailto:vctung@outlook.com">vctung@outlook.com</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- end of .container-->

</section>
@endsection
