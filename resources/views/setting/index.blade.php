@extends('layouts.app')
@section('title', 'Setting')
@section('header')
<div class="section-header">
    <h1>Setting</h1>
    <div class="section-header-breadcrumb">
      @if(Auth::user()->role === 'owner') 
      <div class="breadcrumb-item active"><a href="{{ route('owner.dashboard') }}">Dashboard</a></div>
      @else
      <div class="breadcrumb-item active"><a href="{{ route('cashier.dashboard') }}">Dashboard</a></div>
      @endif
      <div class="breadcrumb-item"><a href="{{ route('setting.index') }}">Setting</a></div>
    </div>
</div>
@endsection
@section('content')
    @if (session('message'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    @endif
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold">Setting</div>
                    <div class="card-body">
                        @if ($settings->count() === 0)
                        <a href="{{ route('setting.create') }}" class="btn btn-primary mb-3">Tambah Setting</a>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Restoran</th>
                                        <th>No Telepon</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($settings as $no => $setting)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $setting->restaurant_name }}</td>
                                            <td>{{ $setting->phone_number }}</td>
                                            <td>{{ $setting->address }}</td>
                                            <td>
                                                <a href="{{ route('setting.edit', $setting->id) }}" class="btn btn-outline-success"><i class="fas fa-pen"></i></a>
                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteSetting-{{ $setting->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
{{-- Delete Modal --}}
@foreach ($settings as $s)
<div class="modal fade" id="deleteSetting-{{ $s->id }}" tabindex="-1" aria-labelledby="deleteSettingLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Settingan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('setting.destroy', $s->id) }}" method="post">
                @csrf
                @method('DELETE')
                <p class="text-center">Anda yakin ingin menghapus settingan ini?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Ya, hapus</button>
            </form>
        </div>
      </div>
    </div>
</div>
@endforeach
@endsection