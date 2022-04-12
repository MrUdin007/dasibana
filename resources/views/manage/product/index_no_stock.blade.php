@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        Stock Produk Habis
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.product.stock') }}">
                                Stock Produk Habis
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
							<h3 class="page-title">Stock Produk Habis</h3>
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
                        searchPlaceholder: 'Search Product'
                    },
                    ajax: {
                        url: "{{ $api_url.'product/table' }}",
                        type: "post",
                        dataType: "json",
                		data: {
		                    _token: "{{csrf_token()}}",
                            api_token: "{{ auth()->user()->api_token }}",
                            no_stock: true,
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
                                if (data == 0) {
                                    return "Inactive";
                                } else if (data == 1) {
                                    return "Active";
                                }
                            },
                            "width": "8%"
                        },
                        {
                            orderable: false,
                            className: 'text-center',
                            render: function (data, type, row) {
                                return '<a title="Lihat" class="btn cur-p btn-secondary product-detail" data-id="' + row.id + '" stype="button" aria-pressed="false">View</a>';
                            }
                        },
                    ],
                });
            });
        })(jQuery);

        function datatable_reload() {
            dataTable.ajax.reload();
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


    </script>
@endpush
