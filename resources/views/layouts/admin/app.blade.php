<!--
=========================================================
* Material Dashboard 2 - v3.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/admin') }}/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('assets/admin') }}/assets/img/favicon.png">
  <title>
    Deteksi Depresi
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/admin') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="{{ asset('assets/admin') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/admin') }}/assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  
  <link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" rel="stylesheet">
  @vite(['resources/js/app.js'])
  @yield('style');
</head>

<body class="g-sidenav-show  bg-gray-200">
  @include('layouts.admin.sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
          @yield('breadcrumb')
          @include('layouts.admin.navbar')
        </div>
      </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      @yield('content')
      @include('layouts.admin.footer')
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/admin') }}/assets/js/core/popper.min.js"></script>
  <script src="{{ asset('assets/admin') }}/assets/js/core/bootstrap.min.js"></script>
  <script src="{{ asset('assets/admin') }}/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="{{ asset('assets/admin') }}/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="{{ asset('assets/admin') }}/assets/js/plugins/chartjs.min.js"></script>

    <!-- Github buttons -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
    <script async defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script async defer src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/admin') }}/assets/js/material-dashboard.min.js?v=3.1.0"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  @yield('script')
</body>

</html>