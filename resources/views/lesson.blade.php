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
      <div class="col-md-8"><img class="w-100" src="assets/img/gallery/ux-designer.png" alt="..." />
        <h1 class="my-4">Description</h1>
        <p>The online Master of Computer and Information Technology degree (MCIT Online) is an online masters degree in Computer Science tailored for non-Computer Science majors. Offered by the University of Pennsylvania, this new program brings the long-running, established on-campus MCIT degree online. The MCIT Online program empowers students without computer science backgrounds to succeed in computing and technology fields. MCIT Online students come from diverse academic backgrounds ranging from business and history to chemistry and medicine.</p>
        <p>Computer science might not be in your past, but it will be in your future. Technology has an immense impact on our lives, and is creating fields and positions that didn’t exist five years ago. Equipped with a competitive computer science degree, MCIT Online graduates will be uniquely positioned to fill roles in finance, healthcare, education, and government, as well as in the core software development industry. Exposure to real-world projects throughout the program will prepare students to utilize skills that positively impact society.</p>
        <h1>What You’ll Learn?</h1>
        <ul class="list-unstyled">
          <li class="mb-3"> <i class="fas fa-check text-info me-2"></i><strong>Ivy League Quality</strong>&nbsp;A first-of-its-kind program that offers an Ivy League master’s degree in Computer Science designed for non-CS majors.</li>
          <li class="mb-3"> <i class="fas fa-check text-info me-2"></i><strong>Built Around Your Schedule The coursework</strong>&nbsp;is 100 percent online. You’ll benefit from the same high-quality instruction as on-campus students and graduate with the same degree. The diploma does not indicate whether the degree was earned online or on-campus.</li>
          <li class="mb-3"> <i class="fas fa-check text-info me-2"></i><strong>Accessible Pricing The cost of the MCIT Online degree</strong>&nbsp; is significantly less than on-campus alternatives and most online master’s degrees in Computer Science. Students pay $2,640 per course unit for a total of 10 courses units. Tuition and fees are posted as a guide and may be subject to change.</li>
          <li class="mb-3"> <i class="fas fa-check text-info me-2"></i><strong>Try before you apply Penn Engineering</strong>&nbsp; offers an online Specialization, Introduction to Programming with Python and Java, on Coursera to help you decide whether the MCIT Online program is the right fit before you apply. </li>
        </ul>
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
