@extends('layouts.be.be')

@push('css')
	
@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        Slider
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.product_size_chart') }}">
                                Product Size Chart
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
                            <h3 class="page-title">Product Size Chart List</h3>
                        </div>
                        <div class="mn-rght">
                            <button class="addbsnt --pluses">
                                <a href="{{ route('be.product_size_chart.add') }}">
                                    <i class="ti-plus"></i>
                                </a>
                            </button>
                        </div>
                    </div>
					<table id="ChartDataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>Gambar</th>
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
        var datatableChart;

        (function($) {
            'use strict';
            $(document).ready(function() {
                datatableChart = $('#ChartDataTable').DataTable({
                    responsive: true,
                    scrollX: true,
                    DisplayLength: 50,
                    processing: true,
                    serverSide: true,
                    deferRender : true,
                    stateSave: true,
                    language: {
                        search: '<i class="fas fa-search" aria-hidden="true"></i>',
                        searchPlaceholder: 'Search Chart'
                    },
                    ajax: {
                        url: "{{ $api_url.'product/chart/table' }}",
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
                        { data: "image",
                            render : function(data, type, row) {
                                if (data != '') {
                                    return '<center> <img src="{{ env('APP_DOWNLOAD') }}'+data+'" class="img-responsive" style="width: 120px;"> </center>';
                                    } else {
                                    return '<center> <img src="{{ asset("images/default.jpeg") }}"  class="img-responsive" style="width: 120px;"> </center>';
                                }
                            },
                            "width": "20%",
                            orderable: false,
                        },
                        {
                            orderable: false,
                            className: 'text-center',
                            render: function (data, type, row) {
                                return '<button class="btn cur-p btn-primary editForm"> <a title="Ubah" href="{{ route("be.product_size_chart.edit",["id"=>"/"]) }}/'+row.id+'" aria-pressed="false" autocomplete="off">Edit</a></button>'+
                                    '<button class="btn cur-p btn-danger"><a class="btn-pln --delete" href="javascript:void(0)" onclick="deleteRow('+row.id+');">delete</a></button>';
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
                        url : '{{ $api_url."product/chart/delete" }}',
                        method : 'post',
                        data : {
                            id : id,
                            api_token: "{{ auth()->user()->api_token }}"
                        },
                        success : function (response) {
                            datatableChart.ajax.reload();
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

        $(document).on('click', '.product_size_chart-detail', function(){
            var id = $(this).data('id');
            $('#modalSlider').modal();
            $.ajax({
                url : '{{ $api_url."product/chart/detail/" }}'+id,
                method : 'post',
                beforeSend: function (xhr) {
                },
                success : function (response) {
                    $('#modalSlider .modal-body').empty();
                    if (response.modal) {
                        $('#modalSlider .modal-body').append(response.modal);
                        $('#modalSlider .modal-body').removeClass('lazy'); 
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

        function datatable_reload() {
            // Reload datatable
            datatableChart.ajax.reload();
        }
    </script>
@endpush