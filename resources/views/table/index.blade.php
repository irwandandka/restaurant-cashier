@extends('layouts.app')
@section('title', 'Meja')
@section('header')
<div class="section-header">
    <h1>Meja</h1>
    <div class="section-header-breadcrumb">
      @if(Auth::user()->role === 'owner') 
      <div class="breadcrumb-item active"><a href="{{ route('owner.dashboard') }}">Dashboard</a></div>
      @else
      <div class="breadcrumb-item active"><a href="{{ route('cashier.dashboard') }}">Dashboard</a></div>
      @endif
      <div class="breadcrumb-item"><a href="{{ route('table.index') }}">Meja</a></div>
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
                    <div class="card-header font-weight-bold">Meja</div>
                    <div class="card-body">
                        <a href="{{ route('table.create') }}" class="btn btn-primary mb-3">Tambah Meja</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nomor Meja</th>
                                        <th>Jumlah Kursi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tables as $no => $table)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $table->table_number }}</td>
                                            <td>{{ $table->total_chair }}</td>
                                            <td>{{ $table->status === false ? 'Kosong' : 'Penuh' }}</td>
                                            <td>
                                                <a href="{{ route('table.edit', $table->id) }}" class="btn btn-outline-success"><i class="fas fa-pen"></i></a>
                                                {{-- <a href="" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a> --}}
                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteTable-{{ $table->id }}">
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
@foreach ($tables as $t)
<div class="modal fade" id="deleteTable-{{ $t->id }}" tabindex="-1" aria-labelledby="deleteTableLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteTableModal">Hapus Meja</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('table.destroy', $t->id) }}" method="post">
                @csrf
                @method('DELETE')
                <p class="text-center">Anda yakin ingin menghapus Meja Nomor {{ $t->table_number }}?</p>
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