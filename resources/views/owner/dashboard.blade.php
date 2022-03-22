@extends('layouts.app')
@section('title', 'Owner Dashboard')
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