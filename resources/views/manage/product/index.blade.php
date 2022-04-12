@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        Product List
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.product') }}">
                                Product List
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
							<h3 class="page-title">Product List</h3>
						</div>
						<div class="mn-rght">
							<button class="addbsnt --pluses">
								<a href="{{ route('be.product.create') }}">
									<i class="ti-plus"></i>
								</a>
							</button>
						</div>
					</div>
					<table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Weight</th>
                            <th>Price</th>
                            <th>Discount</th>
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

        <!-- Modal View -->
        <div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Product Stock</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="updateStockForm" action="{{ $api_url.'product/update/stock' }}" method="POST">
                        <div class="modal-body">
                            <input type="hidden" class="stock-id">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label">Product</label>
                                        <p class="form-control-static stock-name"></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Stock</label>
                                        <input class="form-control product-stock" type="number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" id="updateStock">Update</button>
                        </div>
                    </form>
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
                        searchPlaceholder: 'Search Product'
                    },
                    ajax: {
                        url: "{{ $api_url.'product/table' }}",
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
                    order:[[1,'asc']],
                    columns: [
                        { data: "DT_RowIndex", "width": "3%" },
                        { data: "code" },
                        { data: "name" },
                        { data: "description", "width": "30%" },
                        { data: "weight" },
                        { data: "price" },
                        { data: "discount",
                            render : function(data, type, row) {
                                if (row["discount_type"] == 0) {
                                    return "-";
                                } else if (row["discount_type"] == 1) {
                                    return "Rp. " + data;
                                } else if (row["discount_type"] == 2) {
                                    return data + "%"
                                }
                            },
                            "width": "7%"
                        },
                        { data: "stock" },
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
                            "width": "8%"
                        },
                        {
                            orderable: false,
                            className: 'text-center',
                            render: function (data, type, row) {
                                return '<a title="Lihat" class="btn cur-p btn-secondary product-detail" data-id="' + row.id + '" href="#" aria-pressed="false">View</a>'+
                                '<a class="btn cur-p btn-primary editForm" title="Ubah" href="{{ route("be.product.edit",["id"=>"/"]) }}/' + row.id +'" aria-pressed="false" autocomplete="off">Edit</a>'+
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
                url: '{{ $api_url."product/status" }}',
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

        $(document).on('click', '.product-detail', function(){
            let id = $(this).data('id');

            $('#modalProduct').modal();

            $.ajax({
                url : '{{ $api_url."product/detail/" }}'+id,
                method : 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    api_token: "{{ auth()->user()->api_token }}"
                },
                beforeSend: function (xhr) {
                },
                success : function (response) {
                    $('#modalProduct .modal-body').empty();
                    if (response.modal) {
                        $('#modalProduct .modal-body').html(response.modal);
                    }
                },
                error : function (xhr) {
                    if (xhr.status == 401) {
                        swal({
                            type: "error",
                            title: "Your login status in invalid!",
                            text: "Please do login again.",
                        }, function (isConfirm) {
                            $('#formLogout').submit();
                        });
                    }
                }
            });
        });

        $(document).ready(function () {

            $('#updateStock').click(function (e) {
                e.preventDefault();
                let url = $('#updateStockForm').attr('action');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        id : $('#updateStockForm').find('.stock-id').val(),
                        stock : $('#updateStockForm').find('.product-stock').val(),
                        token: "{{ csrf_token() }}",
                        api_token: "{{ auth()->user()->api_token }}"
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            swal({
                                title: "Sukses",
                                text: "Sukses Update Stock",
                                type: "success",
                            });
                        }
                    },
                    error: function(response){
                        console.log(response);
                        swal({
                            title: "Gagal",
                            text: "Update Stock Gagal!",
                            type: "error",
                        });
                    }
                });

                $('#modalStock').modal('hide');
                datatable_reload();
            });

        });

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
                        url : '{{ $api_url."product/delete" }}',
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
