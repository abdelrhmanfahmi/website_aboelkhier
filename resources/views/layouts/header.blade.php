<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('assets/images/firstLogo.JPG') }}" width="80px" height="80px" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">About Us</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Services
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php $services = \App\Models\Service::all(); ?>
                @foreach ($services as $service)
                    <li><a class="dropdown-item" href="/show/service/{{ $service->id }}">{{ $service->title }}</a></li>
                @endforeach
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contact">Contact Us</a>
          </li>
        </ul>
        <div class="d-flex justify-content-between">
            <div class="mx-3">
                <i class="fas fa-envelope text-dark"></i>
                <span class="text-dark">asmaa@gmail.com</span>
            </div>
            <div>
                <i class="fas fa-phone text-dark"></i>
                <span class="text-dark">+201123635566</span>
            </div>
        </div>
      </div>
    </div>
  </nav>
