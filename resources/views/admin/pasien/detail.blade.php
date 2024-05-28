@extends('layouts.admin.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm" aria-current="page">Data Pasien</li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Detail Data</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Data Pasien</h6>
    </nav>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible text-white fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Detail Pasien</h6>
                    </div>
                </div>
                <div class="card-body px-5 pb-2">
                    <form>
                        @csrf
                        <div class="input-group input-group-static my-3 is-filled">
                            <label>Nama</label>
                            <input type="text" class="form-control" disabled value="{{ $pasien->nama_pasien }}">
                        </div>
                        <div class="input-group input-group-static my-3 is-filled">
                            <label>Alamat</label>
                            <input type="text" class="form-control" disabled value="{{ $pasien->alamat }}">
                        </div>
                        <div class="input-group input-group-static my-3 is-filled">
                            <label>No. Telp</label>
                            <input type="text" class="form-control" disabled value="{{ $pasien->no_telp }}">
                        </div>
                        <div class="input-group input-group-static my-3 is-filled">
                            <label>Email</label>
                            <input type="text" class="form-control" disabled value="{{ $hasil_diagnosa->user->email }}">
                        </div>
                        <div class="input-group input-group-static my-3 is-filled">
                            <label>Hasil Diagnosa</label>
                            <input type="text" class="form-control" disabled value="{{ $hasil_diagnosa->depresi->tingkat_depresi }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
