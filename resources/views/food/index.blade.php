@extends('layouts.app')
@section('title', 'Makanan')
@section('header')
<div class="section-header">
    <h1>Makanan</h1>
    <div class="section-header-breadcrumb">
      @if(Auth::user()->role === 'owner') 
      <div class="breadcrumb-item active"><a href="{{ route('owner.dashboard') }}">Dashboard</a></div>
      @else
      <div class="breadcrumb-item active"><a href="{{ route('cashier.dashboard') }}">Dashboard</a></div>
      @endif
      <div class="breadcrumb-item"><a href="{{ route('food.index') }}">Makanan</a></div>
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
                    <div class="card-header font-weight-bold">Makanan</div>
                    <div class="card-body">
                        <a href="{{ route('food.create') }}" class="btn btn-primary mb-3">Tambah Makanan</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($foods as $no => $food)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $food->name }}</td>
                                            <td>{{ $food->price }}</td>
                                            <td>{{ $food->category->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#showImage-{{ $food->id }}">
                                                    <i class="fas fa-image"></i>
                                                </button>
                                                <a href="{{ route('food.edit', $food->id) }}" class="btn btn-outline-success"><i class="fas fa-pen"></i></a>
                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteFood-{{ $food->id }}">
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
@foreach ($foods as $f)
<div class="modal fade" id="deleteFood-{{ $f->id }}" tabindex="-1" aria-labelledby="deleteFoodLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Makanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('food.destroy', $f->id) }}" method="post">
                @csrf
                @method('DELETE')
                <p class="text-center">Anda yakin ingin menghapus makanan {{ $f->name }}?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Ya, hapus</button>
            </form>
        </div>
      </div>
    </div>
</div>
{{-- Image Modal --}}
<div class="modal fade" id="showImage-{{ $f->id }}" tabindex="-1" aria-labelledby="showImageLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Gambar {{ $f->name }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
            <img src="{{ asset('storage/foods/' . $f->image) }}" alt="{{ $f->image }}" class="img-fluid" width="400">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endforeach
@endsection