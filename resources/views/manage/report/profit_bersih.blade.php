@extends('layouts.be.be')

@section('content')
<div id='mainContent'>
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    Report Profit Bersih Penjualan
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ route('be.report.profit_bersih') }}">
                            Report Profit Bersih Penjualan
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row gap-20 pos-r">
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <div class="row form-vegan">
                    <div class="col-md-4">
                        <label>Start Date</label>
                        <input type="text" data-provide="datepicker" class="form-control" name="first_date" id="first_date" placeholder="Date Start" id="first_date">
                    </div>
                    <div class="col-md-4">
                        <label>End Date</label>
                        <input type="text" data-provide="datepicker" class="form-control" name="last_date" id="last_date" placeholder="Date End" id="last_date">
                    </div>
                    <div class="col-md-4">
                        <button type="button" style="margin-top: 30px !important;" id="filter" onclick="location.reload();" class="btn btn-success">Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gap-20 pos-r">
        <div class="masonry-item col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <div class="grid_layouts --two-auto">
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection