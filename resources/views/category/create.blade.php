@extends('layouts.app')
@section('title', 'Tambah Kategori Makanan')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header font-weight-bold">Tambah Data Kategori Makanan</div>
            <div class="card-body">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="form-label font-weight-bold">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection