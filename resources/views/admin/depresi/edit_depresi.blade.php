@extends('layouts.admin.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm" aria-current="page">Data Depresi</li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Data</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Data Depresi</h6>
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
              <h6 class="text-white text-capitalize ps-3">Edit Data</h6>
            </div>
        </div>
        <div class="card-body px-5 pb-2">
            <form method="POST" action="{{ route('admin.depresi.update') }}">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $depresi->id }}">
                <div class="input-group input-group-static my-3 is-filled">
                  <label>Kode Depresi</label>
                  <input type="text" class="form-control" required name="kode_depresi" id="kode_depresi" readonly value="{{ $depresi->kode_depresi }}">
                </div>
                <div class="input-group input-group-static my-3">
                  <label>Tingkat Depresi</label>
                  <input type="text" class="form-control" required name="tingkat_depresi" id="tingkat_depresi" value="{{ $depresi->tingkat_depresi }}">
                </div>
                <button type="submit" class="btn bg-gradient-primary mt-3">Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
