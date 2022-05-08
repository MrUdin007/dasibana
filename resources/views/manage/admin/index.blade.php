@extends('layouts.be.app')

@section('content')
<div class="row gap-20 pos-r">
    <div class="masonry-item col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h3 class="page-title text-uppercase">data admin</h3>
                </div>
                <div class="mn-rght">
                    <button class="addbsnt --pluses">
                        <a href="http://127.0.0.2/vim-fe/public/manage/supplier/tambah">
                            <i class="ti-plus"></i>
                        </a>
                    </button>
                </div>
            </div>
            <table id="dasibanaTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>username</th>
                        <th>email</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Garrett Winters</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
