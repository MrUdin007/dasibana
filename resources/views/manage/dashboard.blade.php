@extends('layouts.be.app')

@push('title')
    <title>Dasibana - Dashboard</title>
@endpush

@push('css')
    <style>
        .box-dsh{
            background-color: #0b303c;
            padding: 10px;
            text-align: center;
            border: 2px solid #f9fafb;
            color: #ffffff;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <a class="col-6 col-md-4 box-dsh" href="{{ route('admin.index')}}">
                ADMIN
            </a>
            <a class="col-6 col-md-4 box-dsh" href="{{ route('sosmed.index')}}">
                SOSMED
            </a>
            <a class="col-6 col-md-4 box-dsh" href="{{ route('kontak.index')}}">
                PERUSAHAAN
            </a>
            <a class="col-6 box-dsh" href="{{ route('produkkategori.index')}}">
                PRODUK KATEGORI
            </a>
            <a class="col-6 box-dsh" href="{{ route('produk.index')}}">
                PRODUK
            </a>
        </div>
    </div>
@endsection
