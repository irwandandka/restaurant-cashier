@extends('layouts.app')
@section('title', 'Transaksi')
@section('header')
<div class="section-header">
    <h1>Transaksi</h1>
    <div class="section-header-breadcrumb">
      @if(Auth::user()->role === 'owner') 
      <div class="breadcrumb-item active"><a href="{{ route('owner.dashboard') }}">Dashboard</a></div>
      @else
      <div class="breadcrumb-item active"><a href="{{ route('cashier.dashboard') }}">Dashboard</a></div>
      @endif
      <div class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Transaksi</a></div>
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
                    <div class="card-header font-weight-bold">Transaksi</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Total Harga</th>
                                        <th>Nomor Meja</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $no => $transaction)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $transaction->customer_name }}</td>
                                            <td>{{ $transaction->total_price }}</td>
                                            <td>{{ $transaction->table->table_number }}</td>
                                            <td>{{ $transaction->created_at->diffForHumans() }}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteTransaction-{{ $transaction->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                {{-- <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#deleteTransaction-{{ $transaction->id }}">
                                                    <i class="fas fa-print"></i>
                                                </button> --}}
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
@foreach ($transactions as $t)
<div class="modal fade" id="deleteTransaction-{{ $t->id }}" tabindex="-1" aria-labelledby="deleteTransactionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteTransactionModal">Hapus Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('transaction.destroy', $t->id) }}" method="post">
                @csrf
                @method('DELETE')
                <p class="text-center">Anda yakin ingin menghapus Transaksi ini?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Ya, hapus</button>
            </form>
        </div>
      </div>
    </div>
</div>
@endforeach
@endsection