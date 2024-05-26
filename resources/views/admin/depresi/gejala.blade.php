@extends('layouts.admin.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm" aria-current="page">Data Gangguan</li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tambah Gejala</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Data Gangguan</h6>
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
              <h6 class="text-white text-capitalize ps-3">Tambah Data Gejala</h6>
            </div>
        </div>
        <div class="card-body px-5 pb-2">
            <form method="POST" action="{{ route('admin.depresi.gejala-store') }}">
                @csrf
                <input type="hidden" name="depresi_id" id="depresi_id" value="{{ $depresi->id }}">
                <div class="input-group input-group-outline my-3 is-filled">
                    <label class="form-label">Tingkat Depresi</label>
                    <input type="text" class="form-control" required name="tingkat_depresi" id="tingkat_depresi" readonly value="{{ $depresi->tingkat_depresi }}">
                </div>
                @foreach ($gejala as $g)
                    <div class="form-check">
                        @php
                            // Periksa apakah gejala ini sudah terkait dengan tingkat depresi yang sedang diedit
                            $checked = in_array($g->id, $gejalaDepresi) ? 'checked' : '';
                        @endphp
                        <input class="form-check-input" type="checkbox" id="fcustomCheck_{{ $g->id }}" name="gejala_id[]" value="{{ $g->id }}" {{ $checked }}>
                        <label class="custom-control-label" for="customCheck_{{ $g->id }}">{{ $g->nama_gejala }}</label>
                    </div>
                @endforeach
                <button type="submit" class="btn bg-gradient-primary mt-3">Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
