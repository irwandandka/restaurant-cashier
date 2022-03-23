@extends('layouts.app')
@section('title', 'Tambah Setting')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header font-weight-bold">Tambah Data Setting</div>
            <div class="card-body">
                <form action="{{ route('setting.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="restaurant_name" class="form-label font-weight-bold">Nama Restoran</label>
                        <input type="text" name="restaurant_name" id="restaurant_name" value="{{ old('restaurant_name') }}" class="form-control @error('restaurant_name') is-invalid @enderror">
                        @error('restaurant_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone_number" class="form-label font-weight-bold">No Telepon</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="form-control @error('phone_number') is-invalid @enderror">
                        @error('phone_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="address" class="form-label font-weight-bold">Alamat</label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror">
                        @error('address')
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