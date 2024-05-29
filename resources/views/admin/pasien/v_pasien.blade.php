@extends('layouts.admin.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data Pasien</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Data Pasien</h6>
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
                  <h6 class="text-white text-capitalize">Tabel Pasien</h6>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-block btn-light mb-3" data-bs-toggle="modal" data-bs-target="#modal-default">Print</button>
              </div>
          </div>
        </div>
        <div class="card-body px-4 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 yajra-datatable">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pasien</th>
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

  <div class="modal fade" id="modal-default" tabindex="-1" aria-labelledby="modal-default-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-default-label">Filter Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.pasien.filter') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group input-group-static my-3">
                        <label for="tgl_awal">Tanggal Awal</label>
                        <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" required>
                    </div>
                    <div class="input-group input-group-static my-3">
                        <label for="tgl_akhir">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-primary">Print</button>
                    <button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
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
          ajax: "{{ url('pasien/list') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'user.name', name: 'user.name'},
              {data: 'depresi.tingkat_depresi', name: 'depresi.tingkat_depresi'},
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
