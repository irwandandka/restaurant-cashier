@extends('layouts.app')
@section('title', 'Edit Kategori Makanan')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header font-weight-bold">Edit Kategori Makanan</div>
            <div class="card-body">
                <form action="{{ route('category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name" class="form-label font-weight-bold">Nama Kategori</label>
                        <input type="text" name="name" id="name" value="{{ $category->name ?? old('name') }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
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