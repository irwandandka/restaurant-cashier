@extends('layouts.app')
@section('title', 'Tambah Meja')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header font-weight-bold">Tambah Data Meja</div>
            <div class="card-body">
                <form action="{{ route('table.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="table_number" class="form-label font-weight-bold">Nomor Meja</label>
                        <input type="text" name="table_number" id="table_number" value="{{ old('table_number') }}" class="form-control @error('table_number') is-invalid @enderror">
                        @error('table_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="total_chair" class="form-label font-weight-bold">Jumlah Kursi</label>
                        <input type="number" name="total_chair" id="total_chair" value="{{ old('total_chair') }}" class="form-control @error('total_chair') is-invalid @enderror">
                        @error('total_chair')
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