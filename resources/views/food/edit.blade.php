@extends('layouts.app')
@section('title', 'Edit Makanan')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header font-weight-bold">Edit Makanan</div>
            <div class="card-body">
                <form action="{{ route('food.update', $food->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name" class="form-label font-weight-bold">Nama Makanan</label>
                        <input type="text" name="name" id="name" value="{{ $food->name ?? old('name') }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="price" class="form-label font-weight-bold">Harga</label>
                        <input type="number" name="price" id="price" value="{{ $food->price ?? old('price') }}" class="form-control @error('price') is-invalid @enderror">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="category_id" class="form-label font-weight-bold">Nama Kategori</label>
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $food->category_id == $food->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="image" class="form-label font-weight-bold">Gambar</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
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