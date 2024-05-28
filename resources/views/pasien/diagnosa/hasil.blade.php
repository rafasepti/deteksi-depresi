@extends('layouts.pasien.app')
@section('header')
    <header class="bg-gradient-dark">
        <div class="page-header min-vh-75" style="background-image: url('{{ asset('assets/pasien/assets') }}/img/bg9.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center mx-auto my-auto">
                        <h1 class="text-white">Hasil Diagnosa</h1>
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
                <div class="row justify-content-center text-center my-sm-5">
                    <div class="col-lg-6">
                        <span class="badge bg-primary mb-3">Hasil Diagnosa Anda</span>
                        <h2 class="text-dark mb-0">{{ $hasil_diagnosa->depresi->tingkat_depresi }}</h2>
                        @if ($hasil_diagnosa->depresi->tingkat_depresi == 'Tidak Depresi')
                            <p class="lead mt-2 text-justify">Kamu sedang berada di jalur yang baik. Tetap pertahankan semangatmu dan terus
                                berjuang meraih impianmu. Setiap langkah kecil yang kamu ambil adalah bagian dari perjalanan
                                besar menuju kebahagiaan.</p>
                        @elseif($hasil_diagnosa->depresi->tingkat_depresi == 'Depresi Ringan')
                            <p class="lead mt-2 text-justify">Terkadang hidup memang tidak selalu mudah, tapi ingatlah bahwa kamu lebih kuat
                                daripada yang kamu kira. Setiap hari adalah kesempatan baru untuk memperbaiki dan menemukan
                                kembali kebahagiaan. Jangan ragu untuk berbagi perasaanmu dengan orang-orang yang peduli
                                padamu </p>
                        @elseif($hasil_diagnosa->depresi->tingkat_depresi == 'Depresi Sedang')
                            <p class="lead mt-2 text-justify">Setiap hari mungkin terasa seperti tantangan besar, tapi ingatlah bahwa kamu
                                memiliki kekuatan untuk melewati masa-masa sulit ini. Tidak apa-apa untuk merasa tidak
                                baik-baik saja, dan tidak apa-apa untuk meminta bantuan. Berbicara dengan seseorang yang
                                kamu percayai atau seorang profesional dapat membuat perbedaan besar. Kamu tidak sendirian
                                dalam perjalanan ini, dan ada harapan di depan sana. Setiap langkah kecil yang kamu ambil
                                menuju pemulihan adalah sebuah kemenangan.</p>
                        @elseif($hasil_diagnosa->depresi->tingkat_depresi == 'Depresi Berat')
                            <p class="lead mt-2 text-justify">Kami tahu kamu sedang mengalami masa-masa yang sulit, tapi kamu tidak
                                sendirian. Ada banyak orang yang peduli dan siap membantu. Jangan ragu untuk mencari bantuan
                                profesional. Ingatlah, bertahan melalui hari-hari sulit ini adalah tanda kekuatan yang luar
                                biasa.</p>
                        @elseif($hasil_diagnosa->depresi->tingkat_depresi == 'Depresi Sangat Berat')
                            <p class="lead mt-2 text-justify">Ketika segalanya terasa gelap dan tak ada jalan keluar, ingatlah bahwa ada
                                harapan dan bantuan di luar sana. Jangan pernah merasa bahwa kamu harus melalui ini
                                sendirian. Mencari bantuan profesional dan berbicara dengan orang yang kamu percaya adalah
                                langkah pertama menuju pemulihan. Hidupmu sangat berharga, dan ada banyak orang yang peduli
                                tentangmu.</p>
                        @endif

                        <div class="buttons">
                            <a href="{{ route('pasien.diagnosa') }}" class="btn btn-danger">Diagnosa Kembali</a>
                            <a href="{{ route('index') }}" class="btn btn-secondary">Kembali Ke Beranda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
