@extends('layouts.app')
@section('title', 'Edit Meja')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header font-weight-bold">Edit Meja</div>
            <div class="card-body">
                <form action="{{ route('table.update', $table->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="table_number" class="form-label font-weight-bold">Nomor Meja</label>
                        <input type="text" name="table_number" id="table_number" value="{{ $table->table_number ?? old('table_number') }}" class="form-control @error('table_number') is-invalid @enderror">
                        @error('table_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="total_chair" class="form-label font-weight-bold">Jumlah Kursi</label>
                        <input type="number" name="total_chair" id="total_chair" value="{{ $table->total_chair ?? old('total_chair') }}" class="form-control @error('total_chair') is-invalid @enderror">
                        @error('total_chair')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="status" class="form-label font-weight-bold">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="" selected>Pilih Status</option>
                            <option value="1" {{ $table->status == 1 ? 'selected' : '' }}>Kosong</option>
                            <option value="0" {{ $table->status == 0 ? 'selected' : '' }}>Penuh</option>
                        </select>
                        @error('total_chair')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary float-right">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection