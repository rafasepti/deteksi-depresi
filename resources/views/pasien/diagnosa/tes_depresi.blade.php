@extends('layouts.pasien.app')
@section('header')
    <header class="bg-gradient-dark">
        <div class="page-header min-vh-75" style="background-image: url('{{ asset('assets/pasien/assets') }}/img/bg9.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center mx-auto my-auto">
                        <h1 class="text-white">Kuisioner Diagnosa</h1>
                        <p class="lead mb-4 text-white opacity-8">Jawablah pertanyaan sesuai kondisi anda yang sebenarnya,
                            agar kami bisa mendiagnosa secara tepat</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <section class="my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <h3 class="mt-5 mt-lg-0">Data Pengguna</h3>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-s">Nama</h6>
                                        </td>
                                        <td>
                                            <p class="text-s mb-0">{{ $pasien->nama_pasien }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-s">Email</h6>
                                        </td>
                                        <td>
                                            <p class="text-s mb-0">{{ $pasien->user->email }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-s">Alamat</h6>
                                        </td>
                                        <td>
                                            <p class="text-s mb-0">{{ $pasien->alamat }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-s">No. Telp</h6>
                                        </td>
                                        <td>
                                            <p class="text-s mb-0">{{ $pasien->no_telp }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 mt-lg-0 mt-5 px-3">
                    <h3 class="mt-5 mt-lg-0">Pertanyaan</h3>
                    <div class="table-responsive">
                        <table>
                            @foreach ($pertanyaan as $item => $p)
                                <tr>
                                    <td>{{ $item+1 }}.</td>
                                    <td>{{ $p->pertanyaan }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="pb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio1">
                                                <label class="custom-control-label" for="customRadio1">Tidak Tahu</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio2">
                                                <label class="custom-control-label" for="customRadio2">Tidak Yakin</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio3">
                                                <label class="custom-control-label" for="customRadio3">Mungkin</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio4">
                                                <label class="custom-control-label" for="customRadio4">Kemungkinan Besar</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio5">
                                                <label class="custom-control-label" for="customRadio5">Hampir Pasti</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio5">
                                                <label class="custom-control-label" for="customRadio5">Pasti</label>
                                            </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
