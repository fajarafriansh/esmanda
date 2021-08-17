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
    <div>
      <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('img/gallery/logo-n.png') }}" alt="logo" />
      </a>
    </div>
    <div class="order-2 order-lg-3 d-flex align-items-center">
      @guest
        <button class="ms-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
          {{ trans('global.login') }}
        </button>
      @endguest
      @auth
        <a class="ms-3 btn btn-primary" href="{{ route('admin.home') }}" target="_blank" title="Goto Dashboard">
          Dashboard
        </a>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="d-none d-md-block btn btn-outline-light ms-2" title="Logout"><i class="fas fa-sign-out-alt text-800"></i></button>
        </form>
      @endauth
    </div>
    <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0 order-3 order-lg-2" id="navbarSupportedContent">
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
        @auth
          <li class="nav-item px-2 d-md-none">
            <form id="logoutform" action="{{ route('logout') }}" method="POST">
              @csrf
              <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                {{ trans('global.logout') }}
              </a>
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h2 class="mb-3">Login</h2>
        <a class="mb-4 btn btn-lg social-button d-flex align-items-center justify-content-center" href="{{ route('google.login') }}">
          <img src="{{ asset('img/svg/logo_google.svg') }}" alt="">
          <span class="ms-2">Login with Google</span>
        </a>

        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="mb-3">
            <div class="mb-2">or use your email to login</div>
            <div class="mb-3">
              <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" required autocomplete="email">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="new-password">
            </div>
            <div class="d-flex justify-content-between">
              <div class="mb-0 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">{{ trans('global.remember_me') }}</label>
              </div>
              @if(Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                  {{ trans('global.forgot_password') }}
                </a>
              @endif
            </div>
          </div>
          <div class="d-grid gap-4">
            <button type="submit" class="btn btn-primary btn-lg">
              {{ trans('global.login') }}
            </button>
            <div class="text-center">
              <span>Need an account?</span>
              <a href="{{ route('register') }}?redirect={{ request()->path() }}">Register</a>
            </div>
          </div>
        </form>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
