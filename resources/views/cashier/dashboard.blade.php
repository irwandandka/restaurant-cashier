@extends('layouts.app')
@section('title', 'Cashier Dashboard')
@section('header')
<div class="section-header">
    <h1>Dashboard</h1>
    <div class="section-header-breadcrumb">
      @if(Auth::user()->role === 'owner') 
      <div class="breadcrumb-item active"><a href="{{ route('owner.dashboard') }}">Dashboard</a></div>
      @else
      <div class="breadcrumb-item active"><a href="{{ route('cashier.dashboard') }}">Dashboard</a></div>
      @endif
    </div>
</div>
@endsection
@section('content')
@if (session('message'))
<div class="row">
    <div class="col-md-12 text-center font-weight-bold">
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Selamat Datang {{ Auth::user()->name }}, anda login sebagai {{ Auth::user()->role == 'owner' ? 'Owner' : 'Kasir' }}</h5>
            </div>
        </div>
    </div>
</div>
@endsection