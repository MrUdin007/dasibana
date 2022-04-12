@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        Stock Adjustment
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.stock_adjustment') }}">
                                Stock Adjustment
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
							<h3 class="page-title">Stock Adjustment</h3>
						</div>
						<div class="mn-rght">
							<button class="addbsnt --pluses">
								<a href="{{ route('be.stock_adjustment.add') }}">
									<i class="ti-plus"></i>
								</a>
							</button>
						</div>
					</div>
					<table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Adjustment Code</th>
                            <th>Adjustment Date</th>
                            <th>Product</th>
                            <th>Variant</th>
                            <th>Adjustment Qty</th>
                            <th>Stok Sebelumnya</th>
                            <th>Notes</th>
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
                    searchPlaceholder: 'Search Stock Adjustment'
                },
                ajax: {
                    url: "{{ $api_url.'stock_adjustment/table' }}",
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
                    { data: "DT_RowIndex", "width": "3%" , className:'text-center'},
                    { data: "code" , className:'text-center'},
                    { data: "date_adjustment", className:'text-center'},
                    { data: "product_name" },
                    { data: "size_name", className:'text-center' },
                    { data: "qty", className:'text-center' },
                    { data: "stock_before", className:'text-center' },
                    { data: "notes" }
                ],
            });
        });
    })(jQuery);

</script>
@endpush
