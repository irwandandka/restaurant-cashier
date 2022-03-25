<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title') | CashierIO</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> --}}
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h5>Cashier.IO</h1>
                                <div>{{ $setting->restaurant_name }}</div>
                                <div>{{ $setting->address }}</div>
                            </div>
        
                            <div class="">
                                <div>Nama Pelanggan : {{ $order->customer_name }}</div>
                                <div>Waktu Pemesanan : {{ $order->created_at->diffForHumans() }}</div>
                                <div>Deskripsi Pemesanan : {{ $order->description }}</div>
                                <div>Nomor Meja : {{ $order->table->table_number }}</div>
                            </div>
                            
                            <div>
                                <h5 class="mt-3">Detail Pesanan</h5>
                                @foreach ($order->order_details as $no => $detail)
                                    <div>{{ $no + 1 }}. {{ $detail->food->name }} - Rp {{ number_format($detail->total) }}</div>
                                @endforeach
                                <p>Total Harga : Rp {{ number_format($order->total_price) }}</p>
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-success" id="print"><i class="fas fa-print"></i> Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </section>
      </div>
      <footer class="main-footer d-print-none">
        <div class="footer-left">
          Copyright &copy; 2022 <div class="bullet"></div> Made By ❤ <a href="#">Irwanda Andika Putra</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>



  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>
  <script>
    btnPrint = document.querySelector("#print");
    btnPrint.addEventListener('click', function() {
        window.print();
    })
</script>

  <!-- JS Libraies -->
  {{-- <script src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script> --}}

  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <!-- Page Specific JS File -->
</body>
</html>



{{-- @extends('layouts.app')
@section('title', 'Transaksi')
@section('header')
<div class="section-header">
    <h1>Order Makanan</h1>
    <div class="section-header-breadcrumb">
      @if(Auth::user()->role === 'owner') 
      <div class="breadcrumb-item active"><a href="{{ route('owner.dashboard') }}">Dashboard</a></div>
      @else
      <div class="breadcrumb-item active"><a href="{{ route('cashier.dashboard') }}">Dashboard</a></div>
      @endif
      <div class="breadcrumb-item"><a href="{{ route('transaction.print', $order->id) }}">Print Transaksi</a></div>
    </div>
</div>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h5>Cashier.IO</h1>
                        <p>{{ $setting->restaurant_name }}</p>
                        <p>{{ $setting->address }}</p>
                    </div>

                    <div class="row ml-1 mb-2">
                        <div>Nama Pelanggan <span class="badge badge-success mr-2">{{ $order->customer_name }}</span></div>
                        <div>Waktu Pemesanan <span class="badge badge-secondary mr-2">{{ $order->created_at->diffForHumans() }}</span></div>
                        <div>Deskripsi Pemesanan <span class="badge badge-info">{{ $order->description }}</span></div>
                    </div>
                    
                    <div>
                        @foreach ($order->order_details as $detail)
                            <p>{{ $detail->food->name }} <span class="badge badge-primary">Rp {{ number_format($detail->total) }}</span></p>
                        @endforeach
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-success" id="print"><i class="fas fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        btnPrint = document.querySelector("#print");
        btnPrint.addEventListener('click', function() {
            window.print();
        })
    </script>
@endpush --}}