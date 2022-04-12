@extends('layouts.be.be')

@section('content')
<div id='mainContent'>
	<div class="container-fluid">
		<div class="grid_layouts --two-auto">
			<div class="head-lst">
				<h5 class="page-title">
					Customer Voucher List
				</h5>
			</div>
			<div class="mn-rght">
				<ol class="breadcrumb">
					<li><a href="javascript:void(0)">Home</a></li>
					<li class="active">
						<a href="{{ route('be.customer.voucher') }}">
							Customer Voucher List
						</a>
					</li>
				</ol>
			</div>
		</div>
	</div>

	<!-- Datatables -->
	<!-- ============================================================== -->
	<div class="row gap-20 pos-r">
		<div class="masonry-item col-md-12">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
				<div class="grid_layouts --two-auto">
					<div class="head-lst">
						<h3 class="page-title">Customer Voucher List</h3>
					</div>
				</div>
				<table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
					<thead>
						<tr>
							<th width="10">No</th>
							<th>Kode</th>
							<th>Voucher Name</th>
							<th>Customer</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Type</th>
							<th>Value</th>
							<th width="250">Action</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalDetail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail Voucher</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<label for="product" class="col-sm-3 col-form-label">Kode Voucher</label><br>
					<div id="kode"></div>
				</div>
				<div class="input-group">
					<label for="qty" class="col-sm-3 col-form-label">Nama Voucher</label>
					<div id="nama_voucher"></div>	
				</div>
				<div class="input-group">
					<label for="harga_satuan" class="col-sm-3 col-form-label">Masa berlaku</label>
					<div id="masa_berlaku"></div>
				</div>
				<div class="input-group">
					<label for="diskon" class="col-sm-3 col-form-label">Type</label>
					<div id="type"></div>
				</div>
				<div class="input-group">
					<label for="subtotal" class="col-sm-3 col-form-label">Value</label>
					<div id="value"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-customize" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
	var dataTable;

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
				stateSave: true,
				language: {
					search: '<i class="fas fa-search" aria-hidden="true"></i>',
					searchPlaceholder: 'Search Customer Voucher'
				},
				ajax: {
					url: "{{ $api_url.'customer/voucher/table' }}",
					type: "post",
					dataType: "json",
					data: {
						_token: "{{csrf_token()}}",
						api_token: "{{ auth()->user()->api_token }}"
					}
				},
				columnDefs: [{
					searchable: false,
					orderable: false,
					targets: 0
				}],
				order:[[1,'asc']],
				columns: [
					{ data: "DT_RowIndex",className:"text-center" },
					{ data: "kode" ,className:"text-center"},
					{ data: "title" },
					{ data: "name" },
					{ data: "start_date",className:"text-center" },
					{ data: "end_date" ,className:"text-center"},
					{ data: "type" ,className:"text-center"},
					{ data: "value" ,className:"text-right"},
					{
						orderable: false,
						className: 'text-center',
						render: function (data, type, row) {
							return '<a title="Lihat" class="btn cur-p btn-secondary product-detail" data-id="' + row.id + '" href="javascript:void(0);" onclick=openDetail('+ row.id +') aria-pressed="false">View</a>';
						}
					},
				],
			});
		});
	})(jQuery);

	function deleteRow(id) {
        swal({
            title: "Apakah Anda yakin",
            text: "Anda tidak dapat memulihkan data ini",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, hapus data",
            cancelButtonText: "Batalkan",
            closeOnConfirm: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : '{{ $api_url."voucher/delete" }}',
                    method : 'post',
                    data : {
                        token: "{{ csrf_token() }}",
                        id:id,
                        api_token: "{{ auth()->user()->api_token }}"
                    },
                    success : function (response) {
                        dataTable.ajax.reload();
                        swal({
                            title: response.title,
                            text: response.desc,
                            type: response.type,
                        });
                    }
                });
            }
        });
    }

   function openDetail(id){
	     $.ajax({
	        type:'post',
	        url :'{{ $api_url."voucher/edit" }}' ,
	        data: {
	           _token: '{{ csrf_token() }}',
	           id:id,
	           api_token: "{{ auth()->user()->api_token }}"
	        },
	        dataType:"json",
	        beforeSend: function () {
	           swal({
	                title: "Please wait",
	                text: "Your request is being processed",
	                showConfirmButton: false,
	            });
	           
	        },
	        success: function (response) {
	            swal.close();
	            var type = '';
	            if(response.type == 1){
	            	type = "Voucher";	
	            }else if(response.type == 2){
	            	type = "Ongkir";
	            }else{
	            	type = "Gift";
	            }
	            var value='';
	            if(response.disc_idr != null && response.disc_idr !=0){
					value = 'Rp '+response.disc_idr;
				}else if(response.disc_percent != null && response.disc_percent !=0 ){
					value = response.disc_percent+' %';
				}else{
					value = 'Rp '+response.disc_idr;
				}

	            $('#modalDetail #kode').text(response.kode);
	            $('#modalDetail #nama_voucher').text(response.title);
	            $('#modalDetail #masa_berlaku').text(response.start_date+' sd '+response.end_date);
	            $('#modalDetail #diskon').text(response.start_date+' sd '+response.end_date);
	            $('#modalDetail #type').text(type);
	            $('#modalDetail #value').text(value);
				$('#modalDetail').modal('show');
	        }
	    });
   }
</script>
@endpush