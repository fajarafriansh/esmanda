<section class="bg-primary py-2 d-none d-sm-block">

  <div class="container">
    <div class="row align-items-center">
      <div class="col-auto d-none d-lg-block">
        <p class="mb-0 fs--1"><i class="fas fa-map-marker-alt me-3"></i><span>1600 Amphitheatre Parkway, CA 94043 </span></p>
      </div>
      <div class="col-auto ms-md-auto order-md-2 d-none d-sm-block">
        <ul class="list-unstyled list-inline mb-0">
          <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i class="fab fa-facebook-f text-900"></i></a></li>
          <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i class="fab fa-pinterest text-900"></i></a></li>
          <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i class="fab fa-twitter text-900"></i></a></li>
          <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i class="fab fa-instagram text-900"> </i></a></li>
        </ul>
      </div>
      <div class="col-auto">
        <p class="mb-0 fs--1"><i class="fas fa-envelope me-3"></i><a class="text-900" href="mailto:vctung@outlook.com">vctung@outlook.com </a></p>
      </div>
    </div>
  </div>
  <!-- end of .container-->

</section>

<nav class="navbar navbar-expand-lg navbar-light sticky-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ asset('img/gallery/logo-n.png') }}" height="45" alt="logo" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
        <li class="nav-item px-2">
          <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{ route('home') }}">
            {{ trans('app.menu.home') }}
          </a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link {{ (request()->is('about')) ? 'active' : '' }}" href="{{ route('about') }}">
            {{ trans('app.menu.about') }}
          </a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link {{ (request()->is('courses')) ? 'active' : '' }}" href="{{ route('courses') }}">
            {{ trans('app.menu.courses') }}
          </a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link {{ (request()->is('contact')) ? 'active' : '' }}" href="{{ route('contact') }}">
            {{ trans('app.menu.contact') }}
          </a>
        </li>
      </ul>
      @guest
        <button class="ms-3 btn btn-primary order-1 order-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
          {{ trans('global.login') }}
        </button>
      @endguest
      @auth
        <a class="ms-3 btn btn-primary order-1 order-lg-0" href="{{ route('admin.home') }}">
          Dashboard
        </a>
      @endauth
      <form class="d-flex my-3 d-block d-lg-none">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
      <div class="dropdown d-none d-lg-block">
        <button class="btn btn-outline-light ms-2" id="dropdownMenuButton1" type="submit" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-search text-800"></i></button>
        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuButton1" style="top:55px">
          <form>
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" />
          </form>
        </ul>
      </div>
    </div>
  </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
          </div>
          <div class="mb-0 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">{{ trans('global.remember_me') }}</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          {{ trans('global.register') }}
        </button>
        <button type="button" class="btn btn-primary">
          {{ trans('global.login') }}
        </button>
      </div>
    </div>
  </div>
</div>
