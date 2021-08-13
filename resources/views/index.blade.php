@extends('layouts.app')
@section('content')
<section class="pt-6 bg-600" id="home">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end"><img class="pt-7 pt-md-0 w-100" src="img/gallery/hero-header.png" width="470" alt="hero-header" /></div>
      <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
        <h4 class="fw-bold font-sans-serif">Become Master</h4>
        <h1 class="fs-6 fs-xl-7 mb-5">Learn New Skills Online Find Best Courses</h1>
        <a class="btn btn-primary me-2" href="#!" role="button">Get A Quote</a>
        <a class="btn btn-outline-secondary" href="{{ route('about') }}" role="button">Read more</a>
      </div>
    </div>
  </div>
</section>

<section class="py-0" style="margin-top:-5.8rem">
  <div class="container">
    <div class="row">
      <div class="card card-span bg-secondary">
        <div class="card-body">
          <div class="row flex-center gx-0">
            <div class="col-lg-4 col-xl-2 text-center text-xl-start"><img src="img/gallery/funfacts.png" width="170" alt="..." /></div>
            <div class="col-lg-8 col-xl-4">
              <h1 class="text-light fs-lg-4 fs-xl-5">Upcoming Our <span class="text-primary">Basic in Python </span>Course!</h1>
            </div>
            <div class="col-lg-12 col-xl-6">
              <h1 class="display-1 text-light text-center text-xl-end">11 : 02 : 45 : 21</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <h1 class="text-center mb-5"> Top Featured Courses</h1>

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

    </div>
  </div>
</section>

<section class="pt-0">
  <div class="container">
    <div class="row h-100 align-items-center">
      <div class="col-md-12 col-lg-6 h-100">
        <div class="card card-span text-white h-100"><img class="w-100" src="img/gallery/student-feedback.png" alt="..." />
          <div class="card-body px-xl-5 px-md-3 pt-0">
            <div class="d-flex flex-column align-items-center bg-200" style="margin-top:-2.4rem;">
              <h5 class="mt-3 mb-0">Kimmie Vo</h5>
              <p class="text-muted">Junior Designer</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-6 h-100">
        <h1 class="my-4">Successful Student<br /><span class="text-primary">Feedback</span></h1>
        <p>Take courses from the world’s best instructors and universities. Courses include recorded auto-graded and peer-reviewed assignments, video lectures, and community discussion forums. When you complete a course, you’ll be eligible to receive a shareable electronic Course Certificate for a small fee.</p>
        <div class="mt-6">
          <h5 class="font-sans-serif fw-bold mb-3">The courses that Kimmie has taken</h5>
          <div class="card card-span bg-600">
            <div class="card-body">
              <div class="row flex-center gx-0">
                <div class="col-lg-4 col-xl-3 text-center text-xl-start"><img src="img/gallery/art-design.png" width="120" alt="courses" /></div>
                <div class="col-lg-8 col-xl-9">
                  <h5 class="font-sans-serif fw-bold">Modern and Contemporary Art and Design</h5>
                  <p class="text-muted fs--1">The Museum of Modern Art</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section>
  <div class="bg-holder" style="background-image:url(img/gallery/funfacts-2-bg.png);background-position:center;background-size:cover;">
  </div>
  <!--/.bg-holder-->

  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-lg-3 text-center mb-5"><img src="img/gallery/published.png" height="100" alt="..." />
        <h1 class="my-2">768</h1>
        <p class="text-info fw-bold">COURSES PUBLISHED</p>
      </div>
      <div class="col-sm-6 col-lg-3 text-center mb-5"><img src="img/gallery/instructors.png" height="100" alt="..." />
        <h1 class="my-2">120</h1>
        <p class="text-info fw-bold">EXPERT INSTRUCTORS</p>
      </div>
      <div class="col-sm-6 col-lg-3 text-center mb-5"><img src="img/gallery/learners.png" height="100" alt="..." />
        <h1 class="my-2">8300</h1>
        <p class="text-info fw-bold">HAPPY LEARNERS</p>
      </div>
      <div class="col-sm-6 col-lg-3 text-center mb-5"><img src="img/gallery/awards.png" height="100" alt="..." />
        <h1 class="my-2">32</h1>
        <p class="text-info fw-bold">AWARDS ACHIEVED</p>
      </div>
    </div>
  </div>
</section>
@endsection
@section('scripts')
@parent

@endsection
