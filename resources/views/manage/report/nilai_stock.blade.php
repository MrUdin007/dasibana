@extends('layouts.be.be')

@section('content')
<div id='mainContent'>
	<div class="container-fluid">
		<div class="grid_layouts --two-auto">
			<div class="head-lst">
				<h5 class="page-title">
					Report Nilai Stock
				</h5>
			</div>
			<div class="mn-rght">
				<ol class="breadcrumb">
					<li><a href="javascript:void(0)">Home</a></li>
					<li class="active">
						<a href="{{ route('be.report.nilai_stock') }}">
							Report Nilai Stock
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
							<th>Product Code</th>
							<th>Product Name</th>
							<th class="text-center">Stok</th>
							<th class="text-right">Harga Rata-rata</th>
							<th class="text-center">Nilai Stock</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
                 <table class="table table-striped table-bordered">
                    <tr>
                        <th colspan="4" class="text-right">Total Nilai Stock</th>
                        <th colspan="2" id="total_nilai" class="text-right"></th>
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
    var total_nsa = 0;
    (function($) {
        $('#total_nilai').text(total_nsa);
        'use strict';
        $(document).ready(function() {
            dataTable = $('#DataTable').DataTable({
                responsive: true,
                scrollX: true,
                DisplayLength: 50,
                processing: true,
                serverSide: true,
                deferRender : true,
                stateSave: true,
                language: {
                    search: '<i class="fas fa-search" aria-hidden="true"></i>',
                    searchPlaceholder: 'Search Product'
                },
                ajax: {
                    url: "{{ $api_url.'report/nilai_stock' }}",
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
                    targets: 0
                }],
                order:[[2,'asc']],
                columns: [
                    { data: "DT_RowIndex", "width": "3%",className:"text-center" },
                    { data: "product_code" },
                    { data: "product_name" },
                    { data: "stock",className:"text-center" },
                    { data: "harga_rata_rata",className:"text-right"},
                    { data: "nilai_stock",className:"text-right"},
                ],
                drawCallback:function(setting){
                    var api   = this.api();
                    var datah = api.rows().data();
                    var ind   = api.rows( {page:'current'} ).data().length;
                    var total_ns = 0;

                    jQuery.each(datah, function(index, item) {
                      
                        var harga_rata_rata     = item.harga_rata_rata.replace("Rp", " ");
                        var int_harga_rata_rata = parseInt(harga_rata_rata.replace(",", ""));
                        
                        total_ns += (item.stock * int_harga_rata_rata);
                    });
                    total_nsa = total_ns;
                    $('#total_nilai').text('Rp '+format_number(total_ns));
                }
            });
        });
    })(jQuery);

    function datatable_reload() {
        dataTable.ajax.reload();
    }

    function format_number(val) {
        return val.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    }
</script>
@endpush