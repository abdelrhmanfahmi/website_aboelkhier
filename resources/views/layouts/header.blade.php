<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <?php $settings = \App\Models\Setting::all(); ?>
      <a class="navbar-brand" href="#">
        @if($settings[7]->image != null)
            <img src="{{ asset('uploads/' . $settings[7]->image) }}" width="80px" height="80px" alt="">
        @else
            <img src="{{ asset('assets/images/firstLogo.JPG') }}" width="80px" height="80px" alt="">
        @endif
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">الرئيسية</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">عن الموقع</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              خدماتنا
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php $services = \App\Models\Service::all(); ?>
                @foreach ($services as $service)
                    <li><a class="dropdown-item" href="/show/service/{{ $service->id }}">{{ $service->title }}</a></li>
                @endforeach
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contact">تواصل معنا</a>
          </li>
        </ul>
        <div class="d-flex justify-content-between">
            <div class="mx-3">
                <i class="fas fa-envelope text-dark"></i>
                <span class="text-dark">{!! $settings[0]->value !!}</span>
            </div>
            <div>
                <i class="fas fa-phone text-dark"></i>
                <span class="text-dark">{!! $settings[1]->value !!}</span>
            </div>
        </div>
      </div>
    </div>
  </nav>
