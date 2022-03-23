@extends('layouts.app')
@section('title', 'Edit Setting')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header font-weight-bold">Edit Setting</div>
            <div class="card-body">
                <form action="{{ route('setting.update', $setting->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="restaurant_name" class="form-label font-weight-bold">Nama Restoran</label>
                        <input type="text" name="restaurant_name" id="restaurant_name" value="{{ $setting->restaurant_name ?? old('restaurant_name') }}" class="form-control @error('restaurant_name') is-invalid @enderror">
                        @error('restaurant_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone_number" class="form-label font-weight-bold">No Telepon</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ $setting->phone_number ?? old('phone_number') }}" class="form-control @error('phone_number') is-invalid @enderror">
                        @error('phone_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="address" class="form-label font-weight-bold">Alamat</label>
                        <input type="text" name="address" id="address" value="{{ $setting->address ?? old('address') }}" class="form-control @error('address') is-invalid @enderror">
                        @error('address')
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