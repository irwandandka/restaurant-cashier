@extends('layouts.app')
@section('title', 'Order Makanan')
@section('header')
<div class="section-header">
    <h1>Order Makanan</h1>
    <div class="section-header-breadcrumb">
      @if(Auth::user()->role === 'owner') 
      <div class="breadcrumb-item active"><a href="{{ route('owner.dashboard') }}">Dashboard</a></div>
      @else
      <div class="breadcrumb-item active"><a href="{{ route('cashier.dashboard') }}">Dashboard</a></div>
      @endif
      <div class="breadcrumb-item"><a href="{{ route('order.index') }}">Order Makanan</a></div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-6 overflow-auto">
        <div class="row">
            @foreach ($foods as $food)
                <div class="col-md-6">
                    <div class="card">
                        <img src="{{ asset('storage/foods/' . $food->image) }}" class="card-img-top" style="width: 100%; height: 180px">
                        <div class="card-body">
                        <h5 class="card-title">{{ $food->name }}</h5>
                        <p class="card-text" id="price">Rp {{ number_format($food->price) }}</p>
                        <input type="hidden" id="price-{{ $food->id }}" value="{{ $food->price }}">
                        <input type="hidden" id="name-{{ $food->id }}" value="{{ $food->name }}">
                        <button type="button" id="tambah" onclick="tambah({{ $food->id }})" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header font-weight-bold">Tambah Pesanan</div>
                <div class="card-body">
                    <form action="{{ route('table.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="customer_name" class="form-label font-weight-bold">Nama Pelanggan</label>
                            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" class="form-control @error('customer_name') is-invalid @enderror">
                            @error('customer_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="form-label font-weight-bold">Deskripsi Pesanan</label>
                            <input type="text" name="description" id="description" value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="table_id" class="form-label font-weight-bold">Meja</label>
                            <select name="table_id" class="form-control" id="table_id">
                                <option value="" selected>Pilih Meja</option>
                                @foreach ($tables as $table)
                                    <option value="{{ $table->id }}">{{ $table->table_number }}</option>
                                @endforeach
                            </select>
                            @error('table_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="total_price" class="form-label font-weight-bold">Total Harga</label>
                            <input type="number" name="total_price" id="total_price" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        const btnTambah = document.querySelector("#tambah");
        let totalPrice = 0;
        let quantity = 0;

        function tambah(id) {
            let priceId = "#price-" + id;
            let nameId = "#name-" + id;
            let price = document.querySelector(priceId);
            let name = document.querySelector(nameId);
            totalPrice += parseInt(price.value);
            document.querySelector("#total_price").value = totalPrice;
        }
    </script>
@endpush