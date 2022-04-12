@extends('layouts.be.be')

@push('css')

@endpush

@section('content')
	<div id='mainContent'>
		<div class="container-fluid">
            <div class="grid_layouts --two-auto">
                <div class="head-lst">
                    <h5 class="page-title">
                        Set Hot Weekly Sale
                    </h5>
                </div>
                <div class="mn-rght">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li class="active">
                            <a href="{{ route('be.product.sale') }}">
                                Set Hot Weekly Sale
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
                            <h3 class="page-title">Hot Weekly Sale List</h3>
                        </div>
                        <div class="mn-rght">
                            <button class="addbsnt --pluses">
                                <a class="sale-product">
									<i class="ti-plus"></i>
								</a>
                            </button>
                        </div>
                    </div>
					<table id="ProductSaleDataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>Discount</th>
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
    <div id="modalSetSale" data-backdrop="static" data-keyboard="false" class="modal fade modal-pln" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">
                        Set Sale Product Weekly
                    </h4>
                </div>
                <div class="modal-body lazy pt-0 pb-0">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-pln --view" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-customize" onclick="insertProduk()">Submit</button>
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
        var datatableProductSale;
        var product   = [];

        (function($) {
            'use strict';
            $(document).ready(function() {
                datatableProductSale = $('#ProductSaleDataTable').DataTable({
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
                        searchPlaceholder: 'Search Product'
                    },
                    ajax: {
                        url: "{{ $api_url.'product/set/table' }}",
                        type: "post",
                        dataType: "json",
                        data: {
                            sale: 'yes',
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
                        { data: "discount",
                            render: function (data, type, row) {
                                if(row.discount_type == 2 ){
                                    return data+'%';
                                }else{
                                    return data;
                                }
                            }
                        },
                        {
                            orderable: false,
                            className: 'text-center',
                            render: function (data, type, row) {
                                return '<button class="btn cur-p btn-danger"><a class="btn-pln --delete" href="javascript:void(0)" onclick="deleteRow('+row.id+');">delete</a></button>';
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

        $(document).on('click', '.sale-product', function(){
            $('#modalSetSale').modal();
            $.ajax({
                url : '{{ $api_url."product/sale/detail" }}',
                method : 'post',
                beforeSend: function (xhr) {
                },
                success : function (response) {
                    $('#modalSetSale .modal-body').empty();
                    if (response.modal) {
                        $('#modalSetSale .modal-body').append(response.modal);
                        $('#modalSetSale .modal-body').removeClass('lazy');
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
                    _token: "{{ csrf_token() }}"
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

        function reindex(table) {
            var c = 1;
            table.rows().every( function () {
                var d = this.data();
                d.no = c;
                c++;
                this.invalidate();
            });
            table.draw();
        }

        function insertProduk() {
            var product_ele      = $('#productSale');
            var discount_type   = $('#discount_type');
            var discount         = $('#discount');
            var is_submit   = false;

            <?php if(isset($flash_sale)): ?>
            var products = product;
            <?php else: ?>
            var products = [];

             $.each(datatableProductSale.rows().data().toArray(), function (index,v) {
                products[index] = v.product_id;
            });

            <?php endif ?>
            var pro = product_ele.val();
            $.each(datatableProductSale.rows().data().toArray(), function (i, e) {
                if(e.id == product_ele.val()){
                    swal({
                       title: "Warning",
                        text: "Produk sudah pernah ada di daftar",
                        type: "error",
                        allowOutsideClick: false,
                    });
                    e.remove();
                    return;
                }
            });

            if(product_ele.val() != 0 && discount_type.val() && discount.val()){
                is_submit = true;
            }else{
                is_submit = false;
            }

            if (is_submit == true) {
                $.ajax({
                    type: 'POST',
                    data: {
                        id : product_ele.val(),
                        discount : discount.val(),
                        discount_type : discount_type.val(),
                        type : 'sale',
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    url : '{{ $api_url."product/set/save" }}',
                    success: function(data){
                        console.log(data);
                        if (data.success) {
                            swal({
                                title: "Sukses",
                                text: "Data berhasil ditambah!",
                                type: "success",
                            });
                        } else {
                            swal({
                                title: "Gagal",
                                text: "Data gagal ditambah!",
                                type: "error",
                            });
                        }
                        datatableProductSale.ajax.reload();
                    },
                    error: function(data){
                        console.log(data);
                    }
                });

                $('#productSale').val(0);
                $('#discount').val('');
                $('#discount_type').val($("#discount_type option:first").val());
                $('#productSale').trigger('change');

            } else {
                swal({
                   title: "Warning",
                    text: "Input berbintang merah tidak boleh kosong, mohon cek kembali inputan Anda!",
                    type: "error",
                    allowOutsideClick: false,
                });
            }
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
                        url : '{{ $api_url."product/set/delete" }}',
                        method : 'post',
                        data : {
                            id : id,
                            type : 'sale',
                        },
                        success : function (response) {
                            datatableProductSale.ajax.reload();
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


        function datatable_reload() {
            // Reload datatable
            dataTable.ajax.reload();
        }
    </script>
@endpush
