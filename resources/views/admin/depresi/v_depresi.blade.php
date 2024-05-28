@extends('layouts.admin.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data Gangguan</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Data Gangguan</h6>
    </nav>
@endsection
@section('content')
@if(session('success'))
  <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
    <span class="alert-icon align-middle">
      <span class="material-icons text-md">
      thumb_up_off_alt
      </span>
    </span>
    <span class="alert-text">{{ session('success') }}</span>
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
              <div class="d-flex justify-content-between align-items-center ps-3 pe-3">
                  <h6 class="text-white text-capitalize">Tabel Gangguan</h6>
                  <a href="{{ route('admin.depresi.create') }}" class="btn btn-light">Tambah</a>
              </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 yajra-datatable">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Depresi</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tingkat Depresi</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script type="text/javascript">
    $(function () {
      
      var table = $('.yajra-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ url('gangguan/list') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'kode_depresi', name: 'kode_depresi'},
              {data: 'tingkat_depresi', name: 'tingkat_depresi'},
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true,
                  className: 'align-middle text-center'
              },
          ]
      });
      
    });
  </script>
@endsection
