@extends('layouts.be.be')

@push('css')
	
@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        Product Size
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.product_size') }}">
                                Product Size
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
                            <h3 class="page-title">Product Size List</h3>
                        </div>
                        <div class="mn-rght">
                            <button class="addbsnt --pluses">
                                <a href="{{ route('be.product_size.add') }}">
                                    <i class="ti-plus"></i>
                                </a>
                            </button>
                        </div>
                    </div>
					<table id="SizeDataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>Size</th>
                            <th>Stock</th>
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
        var datatableSize;
        var state = JSON.parse('{!! $status !!}');

        (function($) {
            'use strict';
            $(document).ready(function() {
                datatableSize = $('#SizeDataTable').DataTable({
                    responsive: true,
                    scrollX: true,
                    DisplayLength: 50,
                    processing: true,
                    serverSide: true,
                    deferRender : true,
                    stateSave: true,
                    language: {
                        search: '<i class="fas fa-search" aria-hidden="true"></i>',
                        searchPlaceholder: 'Search Size'
                    },
                    ajax: {
                        url: "{{ $api_url.'product/size/table' }}",
                        type: "post",
                        dataType: "json",
                		data: {
		                    _token: "{{csrf_token()}}" ,
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
                        { data: "DT_RowIndex" },
                        { data: "product_id" },
                        { data: "name" },
                        { data: "stock" },
                        { data: "status",
                            render : function(data, type, row) {
                                console.log(data);
                                var select = $("<select class='select form-control' onchange='stateChange(this,"+row.id+")'></select>", {
                                    "id": row.id,
                                    "value": data
                                });

                                $.each(state, function(key, value){
                                    var option = $("<option></option>", {
                                        "text": value,
                                        "value": key
                                    });

                                    if(parseInt(data) === parseInt(key)){
                                        option.attr("selected", "selected")
                                    }

                                    select.append(option);
                                });

                                return select.prop("outerHTML");
                                }
                        },
                        {
                            orderable: false,
                            className: 'text-center',
                            render: function (data, type, row) {
                                return '<button class="btn cur-p btn-primary editForm"> <a title="Ubah" href="{{ route("be.product_size.edit",["id"=>"/"]) }}/'+row.id+'" aria-pressed="false" autocomplete="off">Edit</a></button>'
                                    +'<button class="btn cur-p btn-danger"><a class="btn-pln --delete" href="javascript:void(0)" onclick="deleteRow('+row.id+');">delete</a></button>';
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
                        url : '{{ $api_url."product/size/delete" }}',
                        method : 'post',
                        data : {
                            id : id,
                            api_token: "{{ auth()->user()->api_token }}"
                        },
                        success : function (response) {
                            datatableSize.ajax.reload();
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


        function stateChange(e, id) {
            var status = $(e).val();
            $.ajax({
                type: 'POST',
                data: {
                    id : id,
                    status : status,
                    _token: "{{ csrf_token() }}",
                    api_token: "{{ auth()->user()->api_token }}"
                },
                dataType: "json",
                url : '{{ $api_url."product/size/status" }}',
                success: function(data){
                    if (data.success) {
                        swal({
                            title: "Sukses",
                            text: "Sukses mengganti status",
                            type: "success",
                        });
                    }
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        function datatable_reload() {
            // Reload datatable
            datatableSize.ajax.reload();
        }
    </script>
@endpush