@extends('layouts.be.be')
@section('content')
<div class="container-fluid">
    <div class="grid_layouts --two-auto">
        <div class="head-lst">
            <h5 class="page-title">
                {{ Request::get('id') ? 'Edit Voucher' : 'Add Voucher' }}
            </h5>
        </div>
        <div class="mn-rght">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0)">Home</a></li>
                <li class="active">
                    <a href="{{ Request::get('id') ? route('be.voucher.edit', Request::get('id')) : route('be.voucher.create') }}">
                        {{ Request::get('id') ? 'Edit Voucher' : 'Add Voucher' }}
                    </a>
                </li>
            </ol>
        </div>
    </div>
      <div class="row gap-20 pos-r">
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <div class="grid_layouts --two-auto">
                    <div class="head-lst">
                        <h3 class="page-title">{{ Request::get('id') ? 'Edit Voucher' : 'Add Voucher' }}</h3>
                    </div>
                </div>
                <div>
                    <form class="form-vegan" id="formPenjualan" method="POST" action="#">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Voucher Code</label>
                                    <input type="hidden" name="id" id="id" value="">
                                    <input type="text" class="form-control" id="voucher_code" name="voucher_code" value="" placeholder="Voucher Code" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="voucher_name" name="voucher_name" value="" placeholder="Voucher Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Start Date</label>
                                    <input type="text" data-provide="datepicker" class="form-control" id="start_date" name="start_date" value="" placeholder="Start Date" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">End Date</label>
                                    <input type="text" data-provide="datepicker" class="form-control" id="end_date" name="end_date" value="" placeholder="End Date" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Type</label>
                                    <select name="type" class="form-control" id="type">
                                        <option value="1">Voucher</option>
                                    <!--  <option value="2">Ongkir</option>
                                        <option value="3">Gift</option> -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Voucher Value</label>
                                    <input type="number" class="form-control" id="voucher_value" name="voucher_value" value="" placeholder="Voucher Value" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Point Required</label>
                                    <input type="number" class="form-control" id="point_required" name="point_required" value="" placeholder="Point Required" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Min Purchase</label>
                                    <input type="number" class="form-control" id="min_purchase" name="min_purchase" value="" placeholder="Min Purchase" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Max use</label>
                                    <input type="number" class="form-control" id="max_use" name="max_use" value="" placeholder="Max Use" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Keterangan</label>
                                    <textarea class="form-control" style="min-height: 120px;" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Ketentuan</label>
                                    <textarea class="form-control" style="min-height: 120px;" id="ketentuan" name="ketentuan" placeholder="Ketentuan"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{route('be.voucher')}}" class="btn btn-warning">Cancel</a>
                            <button class="btn btn-sm btn-primary btn-customize" type="button" id="submitProduk">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        @if(Request('id'))
            getEditData();
            //console.log(counter);
        @endif

            $('#submitProduk').click(function (e) {

           // e.preventDefault();

            $.ajax({
                type:'post',
                url :'{{ $api_url."voucher/save" }}' ,
                data: {
                    id:'{{Request("id") ? Request("id") : 0 }}',
                    _token: '{{ csrf_token() }}',
                    api_token: "{{ auth()->user()->api_token }}",
                    code : $('#voucher_code').val(),
                    name : $('#voucher_name').val(),
                    start_date : $('#start_date').val(),
                    end_date : $('#end_date').val(),
                    type:$('#type').val(),
                    voucher_value:$('#voucher_value').val(),
                    point_required:$('#point_required').val(),
                    min_purchase:$('#min_purchase').val(),
                    max_use:$('#max_use').val(),
                    keterangan:$('#keterangan').val(),
                    ketentuan:$('#ketentuan').val()
                },
                dataType:"json",
                beforeSend: function () {
                   swal({
                        title: "Please wait",
                        text: "Your request is being processed",
                        showConfirmButton: false,
                    });

                },
                success: function (response) {
                    console.log(response);
                     location.href = "{{route('be.voucher')}}";
                 // location.href = "{{ route('be.stockin') }}";
                },
                error:function(xhr){
                    console.log(xhr);
                }
            });
        });

       function getEditData(){
         $.ajax({
                type:'post',
                url :'{{ $api_url."voucher/edit" }}' ,
                data: {
                   _token: '{{ csrf_token() }}',
                   id:'{{Request::get("id")}}',
                   api_token: "{{ auth()->user()->api_token }}"
                },
                dataType:"json",
                beforeSend: function () {
                   swal({
                        title: "Please wait",
                        text: "Your request is being processed",
                        showConfirmButton: false,
                    });

                },
                success: function (response) {
                    swal.close();
                    console.log(response);
                    $('#id').val(response.id);
                    $('#voucher_code').val(response.kode);
                    $('#voucher_name').val(response.title);
                    $('#start_date').val(response.start_date);
                    $('#end_date').val(response.end_date);
                    $('#voucher_value').val(response.disc_idr);
                    $('#point_required').val(response.poin_required);
                    $('#min_purchase').val(response.min_pembelanjaan);
                    $('#max_use').val(response.max_use);
                    $('#keterangan').val(response.keterangan);
                    $('#ketentuan').val(response.ketentuan);

                }
            });
        }
    </script>
@endpush
