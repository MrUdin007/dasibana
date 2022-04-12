@extends('layouts.be.be')

@push('css')
	
@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        @if($set == 1)
                        Set Point Value
                        @elseif($set == 2)
                        Set Default Point for New Users
                        @endif
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.app_setting', ['set'=>$set]) }}">
                            @if($set == 1)
                            Set Point Value
                            @elseif($set == 2)
                            Set Default Point for New Users
                            @endif
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
                            <h3 class="page-title">
                                @if($set == 1)
                                Set Point Value
                                @elseif($set == 2)
                                Set Default Point for New Users
                                @endif
                            </h3>
                        </div>
                    </div>
					<table id="AppSettingDataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Target Url</th>
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
    <div id="modalAppSetting" data-backdrop="static" data-keyboard="false" class="modal fade modal-pln" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">
                        @if($set == 1)
                        Set Point Value
                        @elseif($set == 2)
                        Set Default Point for New Users
                        @endif
                        Detail
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
        var dataTable;
        var state = JSON.parse('{!! $status !!}');

        (function($) {
            'use strict';
            $(document).ready(function() {
                dataTable = $('#AppSettingDataTable').DataTable({
                    responsive: true,
                    scrollX: true,
                    DisplayLength: 50,
                    processing: true,
                    serverSide: true,
                    deferRender : true,
                    stateSave: true,
                    language: {
                        search: '<i class="fas fa-search" aria-hidden="true"></i>',
                        searchPlaceholder: 'Search App Setting'
                    },
                    ajax: {
                        url: "{{ $api_url.'app_setting/table' }}",
                        type: "post",
                        dataType: "json",
                		data: {
		                    key: '{{ $set }}',
		                    _token: "{{csrf_token()}}",
                            api_token: "{{ auth()->user()->api_token }}" }

                    },
                    columnDefs: [{
                        searchable: false,
                        orderable: false,
                        targets: 0
                    }],
                    order:[[1,'asc']],
                    columns: [
                        { data: "DT_RowIndex" },
                        { data: "name" },
                        { data: "value" },
                        { data: "target_url" },
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
                                return '<button class="btn cur-p btn-info"><a href="#" title="view" class="btn-pln --view app_setting-detail" data-id="'+row.id+'" data-toggle="modal">View</a></button>'+'<button class="btn cur-p btn-primary editForm"> <a title="Ubah" href="{{ route("be.app_setting.edit",["id"=>"/", "set"=>"/"]) }}/'+row.id+'/'+row.set+'" aria-pressed="false" autocomplete="off">Edit</a></button>';
                            }
                        },
                    ],
                });
            });
        })(jQuery);

        $(document).on('click', '.app_setting-detail', function(){
            var id = $(this).data('id');
            $('#modalAppSetting').modal();
            $.ajax({
                url : '{{ $api_url."app_setting/detail/" }}'+id,
                method : 'post',
                beforeSend: function (xhr) {
                },
                success : function (response) {
                    $('#modalAppSetting .modal-body').empty();
                    if (response.modal) {
                        $('#modalAppSetting .modal-body').append(response.modal);
                        $('#modalAppSetting .modal-body').removeClass('lazy'); 
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
                url : '{{ $api_url."app_setting/status" }}',
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