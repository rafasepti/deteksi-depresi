@php
    $currentRoute = Route::currentRouteName();
@endphp
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="{{ asset('assets/admin') }}/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Deteksi Depresi</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white {{ $currentRoute == 'index.admin' ? 'active bg-gradient-primary' : '' }}" href="{{ route('index.admin') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Data Master</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ $currentRoute == 'admin.data-admin' ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.data-admin') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Admin</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ $currentRoute == 'admin.gejala' ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.gejala') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">medical_services</i>
            </div>
            <span class="nav-link-text ms-1">Gejala</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ $currentRoute == 'admin.depresi' ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.depresi') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">description</i>
            </div>
            <span class="nav-link-text ms-1">Gangguan</span>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link text-white {{ $currentRoute == 'admin.pertanyaan' ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.pertanyaan') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">question_mark</i>
            </div>
            <span class="nav-link-text ms-1">Pertanyaan Diagnosa</span>
          </a>
        </li> --}}
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Data Pasien</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ $currentRoute == 'admin.pasien' ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.pasien') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">people</i>
            </div>
            <span class="nav-link-text ms-1">Pasien</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>