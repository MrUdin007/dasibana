@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        Staff Permission
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.permission') }}">
                                Staff Permission
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
							<h3 class="page-title">Staff Permission</h3>
						</div>
					</div>
					<table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Permission Name</th>
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
                        searchPlaceholder: 'Search Staff Permission'
                    },
                    ajax: {
                        url: "{{ $api_url.'permission/table' }}",
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
                        { data: "DT_RowIndex", "width": "10%", className: 'dt-center' },
                        { data: "name", className: 'dt-center' },
                    ],
                });
            });
        })(jQuery);

        function datatable_reload() {
            dataTable.ajax.reload();
        }

    </script>
@endpush
