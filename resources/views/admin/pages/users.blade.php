@extends('admin.layouts.main')

@section('contentAdmin')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    {{-- <h1>Profile {{Auth::user()->username}}</h1> --}}
    <div class="row mx-3">
        <div class="card">
            <div class="card-header">
                <h5 class="text-capitalize">data users</h5>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-outline-primary rounded-pill mb-2 text-capitalize" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                tambah
              </button>
                <table class="table table-bordered mb-3">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                      @foreach($data as $item)
                        <tr>
                          <td>{{($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                          <td>{{$item->username}}</td>
                          <td>{{$item->email}}</td>
                          <td>{{ optional($item->role)->name ?? 'No Role' }}</td> 
                        </tr>
                      @endforeach
                      
                    </tbody>
                </table>
              </div>
              <div class="card-footer bg-white">
                <div class="float-right">
                    {{ $data->links('vendor.pagination.paginations') }}
                </div>
              </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection