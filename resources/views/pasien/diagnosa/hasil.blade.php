@extends('layouts.pasien.app')
@section('style')
    <style>
        .pagination .page-item.active .page-link {
            color: white;
        }
    </style>
@endsection
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
            <h1>Hasil Diagnosa</h1>
            <h2>{{ $depresiLevelNaiveBayes }}</h2>
            <h2>{{ $depresiLevelKNN }}</h2>
        </div>
    </section>
@endsection

