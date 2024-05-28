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
                    <form action="{{ route('pasien.diagnosa.session') }}" method="POST" id="diagnosisForm">
                        @csrf
                        <input type="hidden" name="page" id="page" value="{{ $pertanyaan->currentPage() }}">
                        <table>
                            @foreach ($pertanyaan as $index => $p)
                                <tr>
                                    <td>{{ $index + $pertanyaan->firstItem() }}.</td>
                                    <td>{{ $p->pertanyaan }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="pb-3">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                @php
                                                    $answer = session('gejala_' . $index + $pertanyaan->firstItem());
                                                @endphp
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gejala_{{ $index + $pertanyaan->firstItem() }}" id="customRadio1_{{ $p->id }}" value="0" {{ $answer == '0' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="customRadio1_{{ $p->id }}">Tidak</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gejala_{{ $index + $pertanyaan->firstItem() }}" id="customRadio2_{{ $p->id }}" value="1" {{ $answer == '1' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="customRadio2_{{ $p->id }}">Tidak Yakin</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gejala_{{ $index + $pertanyaan->firstItem() }}" id="customRadio3_{{ $p->id }}" value="2" {{ $answer == '2' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="customRadio3_{{ $p->id }}">Mungkin</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gejala_{{ $index + $pertanyaan->firstItem() }}" id="customRadio4_{{ $p->id }}" value="3" {{ $answer == '3' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="customRadio4_{{ $p->id }}">Kemungkinan Besar</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gejala_{{ $index + $pertanyaan->firstItem() }}" id="customRadio5_{{ $p->id }}" value="4" {{ $answer == '4' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="customRadio5_{{ $p->id }}">Hampir Pasti</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gejala_{{ $index + $pertanyaan->firstItem() }}" id="customRadio6_{{ $p->id }}" value="5" {{ $answer == '5' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="customRadio6_{{ $p->id }}">Pasti</label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @if ($pertanyaan->currentPage() == $pertanyaan->lastPage())
                            <button type="submit" name="btn_submit" class="btn bg-gradient-primary mt-3">Submit</button>
                        @endif
                    </form>
                    <div class="mt-4">
                        {{ $pertanyaan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        function validateForm() {
            const form = document.getElementById('diagnosisForm');
            const questions = form.querySelectorAll('.form-check-input');
            const questionGroups = {};

            questions.forEach((input) => {
                const name = input.name;
                if (!questionGroups[name]) {
                    questionGroups[name] = [];
                }
                questionGroups[name].push(input);
            });

            let isValid = true;

            for (const name in questionGroups) {
                const isAnswered = questionGroups[name].some((input) => input.checked);
                if (!isAnswered) {
                    isValid = false;
                    alert('Silakan jawab semua pertanyaan!');
                    break;
                }
            }

            return isValid;
        }

        window.onload = function() {
            const form = document.getElementById('diagnosisForm');
            form.onsubmit = function(event) {
                if (!validateForm()) {
                    event.preventDefault();
                }
            };
        };

        document.addEventListener('DOMContentLoaded', function() {
            const paginationLinks = document.querySelectorAll('.pagination a');

            paginationLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Selalu prevent default untuk kontrol secara manual

                    if (validateForm()) {
                        const form = document.getElementById('diagnosisForm');
                        const action = link.getAttribute('href');
                        const pageInput = document.getElementById('page');
                        const urlParams = new URLSearchParams(new URL(action).search);
                        const page = urlParams.get('page');
                        pageInput.value = page;
                        form.submit();
                    }
                });
            });
        });   
    </script>
@endsection
