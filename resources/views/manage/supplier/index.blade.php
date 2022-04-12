@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        Supplier
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.supplier') }}">
                                Supplier
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
							<h3 class="page-title">Supplier</h3>
						</div>
						<div class="mn-rght">
							<button class="addbsnt --pluses">
								<a href="{{ route('be.supplier.create') }}">
									<i class="ti-plus"></i>
								</a>
							</button>
						</div>
					</div>
					<table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Note</th>
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
        var dataTable;
        var state = JSON.parse('{!! $status !!}');

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
                        searchPlaceholder: 'Search Supplier'
                    },
                    ajax: {
                        url: "{{ $api_url.'supplier/table' }}",
                        type: "post",
                        dataType: "json",
                		data: {
		                    _token: "{{ csrf_token() }}",
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
                        { data: "DT_RowIndex", "width": "3%" ,className:"text-center"},
                        { data: "name" },
                        { data: "phone" },
                        { data: "email" },
                        { data: "address" },
                        { data: "note" },
                        { data: "is_active",
                            render : function(data, type, row) {
                                var i = data ? 1 : 0;
                                var select = $("<select class='select form-control' onchange='stateChange(this,"+row.id+")'></select>", {
                                    "id": row.id,
                                    "value": data
                                });

                                $.each(state, function(key, value){
                                    var option = $("<option></option>", {
                                        "text": value,
                                        "value": key
                                    });

                                    if(parseInt(i) == parseInt(key)){
                                        option.attr("selected", "selected")
                                    }

                                    select.append(option);
                                });

                                return select.prop("outerHTML");
                            },
                            "width": "10%"
                        },
                        {
                            orderable: false,
                            className: 'text-center',
                            "width": "15%",
                            render: function (data, type, row) {
                                return '<a class="btn cur-p btn-primary editForm" title="Ubah" href="{{ route("be.supplier.edit",["id"=>"/"]) }}/' + row.id +'" aria-pressed="false" autocomplete="off">Edit</a>'+
                                '<a type="button" class="btn cur-p btn-danger" href="javascript:void(0)" onclick=deleteRow('+ row.id +')>Delete</a>';
                            }
                        },
                    ],
                });
            });
        })(jQuery);

        function datatable_reload() {
            dataTable.ajax.reload();
        }

        function stateChange(e, id) {
            var status = $(e).val();

            $.ajax({
                type: 'POST',
                data: {
                    id : id,
                    status : status,
                    token: "{{ csrf_token() }}",
                    api_token: "{{ auth()->user()->api_token }}"
                },
                dataType: "json",
                url: '{{ $api_url."supplier/status" }}',
                success: function(data){
                    if (data.success) {
                        swal({
                            title: "Sukses",
                            text: "Sukses Mengganti Status",
                            type: "success",
                        });
                    }
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

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
                        url : '{{ $api_url."supplier/delete" }}',
                        method : 'post',
                        data : {
                            token: "{{ csrf_token() }}",
                            id,
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

    </script>
@endpush
