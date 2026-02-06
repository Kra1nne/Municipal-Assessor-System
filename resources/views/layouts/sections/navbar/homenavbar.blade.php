<nav class="position-sticky top-0 navbar navbar-expand-lg d-flex align-items-center h-100 shadow-sm bg-white">
  <div class="container-fluid">

    <!-- Logo -->
    <span class="app-brand-logo demo me-1 ">
      @include('_partials.macros', ['height' => 60])
    </span>

    <!-- Mobile toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse gap-2 my-4 my-lg-0" id="navbarNav">

      <!-- Center navigation -->
      <div class="navbar-nav nav-pills mx-auto gap-2">

        <a class="nav-link rounded-pill w-px-100 px-5 text-dark
          {{ request()->routeIs('landing-page') ? 'active text-white' : '' }}"
          href="{{ route('landing-page') }}">
          Home
        </a>

        <a class="nav-link rounded-pill w-px-100 px-5 text-dark
          {{ request()->routeIs('services-page') ? 'active text-white' : '' }}"
          href="{{ route('services-page') }}">
          Services
        </a>

        <a class="nav-link rounded-pill w-px-100 px-5 text-dark
          {{ request()->routeIs('about-page') ? 'active text-white' : '' }}"
          href="{{ route('about-page') }}">
          About
        </a>

        <a class="nav-link rounded-pill w-px-100 px-5 text-dark
          {{ request()->routeIs('contact-page') ? 'active text-white' : '' }}"
          href="{{ route('contact-page') }}">
          Contact
        </a>

      </div>

      <!-- Right side -->
      <div class="d-flex align-items-center my-2 my-lg-0">
        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-5">
          Login
        </a>
      </div>

    </div>
  </div>
</nav>
