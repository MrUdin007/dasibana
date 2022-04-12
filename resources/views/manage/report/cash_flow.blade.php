@extends('layouts.be.be')

@section('content')
<div id='mainContent'>
	<div class="container-fluid">
		<div class="grid_layouts --two-auto">
			<div class="head-lst">
				<h5 class="page-title">
					Report Cash Flow
				</h5>
			</div>
			<div class="mn-rght">
				<ol class="breadcrumb">
					<li><a href="javascript:void(0)">Home</a></li>
					<li class="active">
						<a href="{{ route('be.report.cash_flow') }}">
							Report Cash Flow
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
				<table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
					<thead>
						<tr>
							<th style="width:10px;">No</th>
							<th>Tgl Transaksi</th>
							<th>Kode Transaksi</th>
							<th class="text-right">Total Transaksi</th>
							<th class="text-right">Masuk</th>
							<th class="text-right">Keluar</th>
							<th class="text-right">Saldo</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
                  
				</table>
                <table class="table table-striped table-bordered">
                    <tr>
                        <td class="text-right">Biaya</td>
                        <td id="biaya" class="text-right"></td>
                    </tr>
                    <tr>
                        <td class="text-right">Saldo Awal (sebelum tanggal awal)</td>
                        <td id="saldo_awal" class="text-right"></td>
                    </tr>
                    <tr>
                        <td class="text-right">Saldo Akhir </td>
                        <td id="saldo_akhir" class="text-right"></td>
                    </tr>
                    <tr>
                        <td class="text-right">Total Saldo</td>
                        <td id="total_saldo" class="text-right"></td>
                    </tr>
                </table>
			</div>
		</div>
	</div>
</div>
@endsection 
@push('scripts')
<script type="text/javascript">
	let dataTable;

    getSaldoAwal();
    (function($) {
        'use strict';
        $(document).ready(function() {
            dataTable = $('#DataTable').DataTable({
                responsive: true,
                scrollX: true,
                DisplayLength: 50,
                processing: true,
                serverSide: true,
                deferRender : true,
                ordering:false,
                stateSave: true,
                language: {
                    search: '<i class="fas fa-search" aria-hidden="true"></i>',
                    searchPlaceholder: 'Search Transaction'
                },
                ajax: {
                    url: "{{ $api_url.'report/cash_flow' }}",
                    type: "post",
                    dataType: "json",
                    data: {
                        _token: "{{csrf_token()}}",
                        api_token: "{{ auth()->user()->api_token }}",
                        first_date:$('#first_date').val(),
                        last_date:$('#last_date').val(),
                    }
                },
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0,
                }],
                order:[[2,'asc']],
                columns: [
                    { data: "DT_RowIndex", "width": "3%",className:"text-center" },
                    { data: "dateorder",className:"text-center" },
                    { data: "no_trx",className:"text-center" },
                    { data: "total_belanja",className:"text-right" },
                    { data: "masuk",className:"text-right"},
                    { data: "keluar",className:"text-right"},
                    { data: "saldo",className:"text-right"},
                ],
                drawCallback:function(setting){
                    var api = this.api();
                    var ind = api.rows( {page:'current'} ).data().length;
                    // Output the data for the visible rows to the browser's console
                    var saldo_akhir_raw = dataTable.row(ind-1).data().saldo;
                    var saldo_akhir     = parseInt(saldo_akhir_raw.replace("Rp", " "));

                    var saldo_awal_raw = $('#saldo_awal').text();
                    var saldo_awal     = parseInt(saldo_awal_raw.replace("Rp", " "));

                    var biaya_raw = $('#biaya').text();
                    var biaya     = parseInt(biaya_raw.replace("Rp", " "));
                   
                    $('#saldo_akhir').text(dataTable.row(ind-1).data().saldo);
                    var total_saldo    = biaya + saldo_akhir + saldo_awal;
                    $('#total_saldo').text('Rp '+total_saldo);
                }
            });

        });
    })(jQuery);

    function getSaldoAwal(){

        $.ajax({
                type: 'POST',
                data: {
                    token: "{{ csrf_token() }}",
                    api_token: "{{ auth()->user()->api_token }}",
                    first_date:$('#first_date').val(),
                    last_date:$('#last_date').val()
                },
                dataType: "json",
                url: '{{ $api_url."report/saldo_awal_cash_flow" }}',
                success: function(data){
                  $('#saldo_awal').text(data.data.saldo_awal);
                  $('#biaya').text(data.data.biaya);
                },
                error: function(data){
                    console.log(data);
                }
            });
    }

    function datatable_reload() {
        dataTable.ajax.reload();
    }
</script>
@endpush