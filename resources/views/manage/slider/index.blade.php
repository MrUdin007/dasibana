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
                            <a href="{{ route('be.slider') }}">
                                Slider
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
                            <h3 class="page-title">Slider List</h3>
                        </div>
                        <div class="mn-rght">
                            <button class="addbsnt --pluses">
                                <a href="{{ route('be.slider.add') }}">
                                    <i class="ti-plus"></i>
                                </a>
                            </button>
                        </div>
                    </div>
					<table id="SliderDataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Url</th>
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

    <!-- Modal View -->
    <div id="modalSlider" data-backdrop="static" data-keyboard="false" class="modal fade modal-pln" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">
                        Slider
                    </h4> 
                </div>
                <div class="modal-body lazy pt-0 pb-0">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-pln --view" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- End of Modal View -->
@endsection

@push('scripts')
	<script type="text/javascript">
        var datatableSlider;
        var state = JSON.parse('{!! $status !!}');

        (function($) {
            'use strict';
            $(document).ready(function() {
                datatableSlider = $('#SliderDataTable').DataTable({
                    responsive: true,
                    scrollX: true,
                    DisplayLength: 50,
                    processing: true,
                    serverSide: true,
                    rowReorder: true,
                    deferRender : true,
                    stateSave: true,
                    scrollX: true,
                    language: {
                        search: '<i class="fas fa-search" aria-hidden="true"></i>',
                        searchPlaceholder: 'Search Slider'
                    },
                    ajax: {
                        url: "{{ $api_url.'slider/table' }}",
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
                        { data: "target_url",
                            render: function (data, type, row) {
                                if(data){
                                    return data.substr(0,50)+'...';
                                }else{
                                    return '-';
                                }
                            }
                        },
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
                                return '<button class="btn cur-p btn-info"><a href="#" title="view" class="btn-pln --view slider-detail" data-id="'+row.id+'" data-toggle="modal">View</a></button>'+'<button class="btn cur-p btn-primary editForm"> <a title="Ubah" href="{{ route("be.slider.edit",["id"=>"/"]) }}/'+row.id+'" aria-pressed="false" autocomplete="off">Edit</a></button>'+
                                    '<button class="btn cur-p btn-danger"><a class="btn-pln --delete" href="javascript:void(0)" onclick="deleteRow('+row.id+');">delete</a></button>';
                            }
                        },
                    ],
                    // rowCallback: function (row, data, index) {
                        /*
                         * function ini digunakan untuk memanipulasi data 1 row, sebelum menjadi row pada table di html
                         * contoh: mengubah nomor menjadi bold
                         */
                        // $('td:eq(0)', row).html('<b>'+data.DT_RowIndex+'</b>');
                    // }
                });

            // datatableSlider.on('row-reorder', function(e, diff, edit) {
            //     var urutan = [];
            //     for (var i = 0, ien = diff.length; i < ien; i++) {
            //         urutan[i] = {
            //             id: datatableSlider.row( diff[i].node).data().id,
            //             sort: diff[i].newPosition + 1,
            //         };
            //     }
            //     $.ajax({
            //         url: "{{ $api_url.'slider/sorting' }}",
            //         method: "GET",
            //         data: {
            //             "order": urutan
            //         },
            //         dataType: "json",
            //         success: function(data) {
            //             datatableSlider.ajax.reload(null, false);
            //         },
            //         error: function(data) {
            //         }
            //     });
            // });
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
                        url : '{{ $api_url."slider/delete" }}',
                        method : 'post',
                        data : {
                            id : id,
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

        $(document).on('click', '.slider-detail', function(){
            var id = $(this).data('id');
            $('#modalSlider').modal();
            $.ajax({
                url : '{{ $api_url."slider/detail/" }}'+id,
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
                url : '{{ $api_url."slider/status" }}',
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
            dataTable.ajax.reload();
        }
    </script>
@endpush