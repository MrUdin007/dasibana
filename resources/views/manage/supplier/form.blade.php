@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ isset($supplier) ? 'Edit Supplier' : 'Add Supplier' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ isset($supplier) ? route('be.supplier.edit', $supplier->id) : route('be.supplier.create') }}">
                            {{ isset($supplier) ? 'Edit Supplier' : 'Add Supplier' }}
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
							<h3 class="page-title">{{ isset($supplier) ? 'Edit Supplier' : 'Add Supplier' }}</h3>
						</div>
					</div>
                    <div>
                        <form id="formSupplier" class="form-vegan" method="POST" action="{{ Request::segment(4) ? $api_url.'supplier/update' : $api_url.'supplier/store' }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Supplier Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Supplier Name" value="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Contact Person Name (PIC)</label>
                                    <input type="text" class="form-control" id="pic" name="pic" placeholder="Contact Person Name (PIC)" value="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Supplier Phone" value="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Supplier Email" value="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" name="address" id="address" rows="4"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="note">Note</label>
                                    <textarea class="form-control" name="note" id="note" rows="4"></textarea>
                                </div>
                            </div>
                            <div>
                                <div class="main-form-vg custom-checkbox">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active">
                                    <label for="is_active" class="custom-control-label">
                                        Active
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a type="button" class="btn cur-p btn-warning" href="{{ route('be.supplier') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
    @if(Request::segment(4))
        getEditData('{{Request::segment(4)}}');

    @endif
    function getEditData(id){
         $.ajax({
            type: 'POST',
            data: {
                id : id,
                token: "{{ csrf_token() }}",
                api_token: "{{ auth()->user()->api_token }}"
            },
            beforeSend: function () {
               swal({
                    title: "Please wait",
                    text: "Your request is being processed",
                    showConfirmButton: false,
                });

            },
            dataType: "json",
            url: '{{ $api_url."supplier/view" }}',
            success: function(data){
               swal.close();
               console.log(data);
               $('#id').val(data.id);
               $('#name').val(data.name);
               $('#pic').val(data.cp_name);
               $('#phone').val(data.phone);
               $('#email').val(data.email);
               $('#address').val(data.address);
               $('#note').val(data.note);

               if(data.is_active == true){
                $('#is_active').attr('checked','checked');
               }
            },
            error: function(data){
                console.log(data);
            }
        });
    }
    submitData('formSupplier', '{{ route('be.supplier') }}');
    </script>
@endpush
