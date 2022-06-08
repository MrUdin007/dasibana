@extends('layouts.be.app')

@push('title')
    <title>Dasibana - Produk</title>
@endpush

@section('content')
<div class="row gap-20 pos-r">
    <div class="masonry-item col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h3 class="page-title text-uppercase">data Produk</h3>
                </div>
                <div class="mn-rght">
                    <button class="addbsnt --pluses">
                        <a href="http://127.0.0.2/vim-fe/public/manage/supplier/tambah">
                            <i class="ti-plus"></i>
                        </a>
                    </button>
                </div>
            </div>


            @foreach ($products as $product_item)
            <div>{{$product_item}}</div>
            @endforeach


            <table id="dasibanaTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                <thead>
                    <tr>
                        <th>foto</th>
                        <th>nama</th>
                        <th>status</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>dasi</td>
                        <td>tersedia</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>dasi kupu-kupu</td>
                        <td>Tersedia</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
