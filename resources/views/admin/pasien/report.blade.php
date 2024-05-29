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
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/admin') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets/admin') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/admin') }}/assets/css/material-dashboard.css?v=3.1.0"
        rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>

<body class="g-sidenav-show  bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Data Pasien</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <h6 class="nav-link nav-link-icon text-body font-weight-bold px-0"
                                style="
                        margin-bottom: 0px;">
                                <span class="d-sm-inline d-none">Deteksi Depresi</span>
                            </h6>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @php
                use Carbon\Carbon;
            @endphp

            <p class="text-sm">Tanggal Awal: {{ Carbon::parse($tgl_awal)->format('d/m/Y') }}</p>
            <p class="text-sm">Tanggal Akhir: {{ Carbon::parse($tgl_akhir)->format('d/m/Y') }}</p>
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="border border-radius-lg pt-4 pb-3">
                                <h6 class="text-capitalize ps-3">Hasil Diagnosa Pasien</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No.</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama Pasien</th>
                                            <th
                                                class="text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tingkat Depresi</th>
                                            <th
                                                class="text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tgl Diagnosa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hasil_diagnosa as $index => $d)
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-xs font-weight-bold"> {{ (int)$index + 1 }}. </span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-xs font-weight-bold"> {{ $d->user->name }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-xs font-weight-bold"> {{ $d->depresi->tingkat_depresi }} </span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-xs font-weight-bold"> {{ Carbon::parse($d->updated_at)->format('d/m/Y') }} </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--   Core JS Files   -->
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/admin') }}/assets/js/core/popper.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/plugins/chartjs.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/material-dashboard.min.js?v=3.1.0"></script>
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/admin') }}/assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>
<script>
    window.onload = function() {
        window.print();
    }
</script>
</html>
