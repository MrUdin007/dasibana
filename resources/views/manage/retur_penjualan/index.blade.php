@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        Retur Penjualan
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.retur_penjualan') }}">
                                Retur Penjualan
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
							<h3 class="page-title">Retur Penjualan</h3>
						</div>
						<div class="mn-rght">
							<button class="addbsnt --pluses">
								<a href="{{ route('be.retur_penjualan.create') }}">
									<i class="ti-plus"></i>
								</a>
							</button>
						</div>
					</div>
					<table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Nota</th>
                            <th>Retur Code</th>
                            <th>Date Retur</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
<script type="text/javascript">
    let dataTable;
    let trans_state = JSON.parse('{!! $trans_status !!}');

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
                    searchPlaceholder: 'Search Retur'
                },
                ajax: {
                    url: "{{ $api_url.'retur_penjualan/table' }}",
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
                order:[[2,'asc']],
                columns: [
                    { data: "DT_RowIndex", "width": "3%" },
                    { data: "customer" },
                    { data: "nota" },
                    { data: "transaction_code" },
                    { data: "created_at"},
                    { data: "grandtotal",
                        className:'text-right',
                        render : function(data, type, row) {
                           
                                return 'Rp '+row.grandtotal;
                            }
                    },
                    { data: "status",
                        className:'text-center',
                        render : function(data, type, row) {
                            if(row.status == 2){
                                return "Void";
                            }else{

                                var select = $("<select class='select form-control' onchange='stateChange(this,"+row.id+")'></select>", {
                                    "id": row.id,
                                    "value": data
                                });

                                $.each(trans_state, function(key, value){
                                    var option = $("<option></option>", {
                                        "text": value,
                                        "value": key
                                    });
                                    
                                    if(parseInt(row.status) === parseInt(key)){
                                        option.attr("selected", "selected")
                                    }

                                    select.append(option);
                                });

                                return select.prop("outerHTML");
                                }
                            }
                    },
                    {
                        orderable: false,
                        className: 'text-center',
                        render: function (data, type, row) {
                            return '<button class="btn cur-p btn-secondary"> <a title="Lihat" class="product-detail" href="{{route("be.retur_penjualan.view",["id"=>""])}}'+row.id+'" aria-pressed="false">View</a></button>'
                                  +'<button class="btn cur-p btn-primary"><a title="Edit" class="product-detail" href="{{route("be.retur_penjualan.edit",["id"=>""])}}'+row.id+'" aria-pressed="false">Edit</a></button>';
                        }
                    },
                ],
            });
        });
    })(jQuery);

    function datatable_reload() {
            dataTable.ajax.reload();
        }

    function stateChange(e,id){
        let status = $(e).val();

        $.ajax({
            type: 'POST',
            data: {
                id : id,
                status : status,
                token: "{{ csrf_token() }}",
                api_token: "{{ auth()->user()->api_token }}"
            },
            dataType: "json",
            url: '{{ $api_url."retur_penjualan/status" }}',
            success: function(data){
                if (data.success) {
                    swal({
                        title: "Sukses",
                        text: "Sukses Mengganti Status",
                        type: "success",
                    });
                    datatable_reload();
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    }
</script>
@endpush
