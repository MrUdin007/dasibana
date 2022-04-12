@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ isset($customer) ? 'Edit Customer' : 'Add Customer' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ isset($customer) ? route('be.customer.edit', $customer->id) : route('be.customer.create') }}">
                            {{ isset($customer) ? 'Edit Customer' : 'Add Customer' }}
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
                            <h3 class="page-title">{{ isset($customer) ? 'Edit Customer' : 'Add Customer' }}</h3>
                        </div>
                    </div>
                    <div>
                        <form id="formCustomer" class="form-vegan" method="POST" action="{{ isset($customer) ? $api_url.'customer/update' : $api_url.'customer/store' }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ isset($customer) ? $customer->id : '' }}">
                            <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name
                                        <span class="required_label">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Customer Name" value="{{ isset($customer) ? $customer->name : '' }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email
                                        <span class="required_label">*</span>
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Customer Email" value="{{ isset($customer) ? $customer->email : '' }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone
                                        <span class="required_label">*</span>
                                    </label>
                                    <input type="number" min="1" class="form-control" id="phone" name="phone" placeholder="Customer Phone" value="{{ isset($customer) ? $customer->phone : '' }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password
                                        <span class="required_label">*</span>
                                    </label>
                                    <div class="float-inpt-fld">
                                        <input type="password" class="floatfield form-control field-main-ozl" id="password" name="password" placeholder="Customer Password" {{ isset($customer) && isset($customer->password) ? '' : 'required' }}>
                                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="hidden" id="old_provinsi_id" value="{{ isset($customer) ? $customer->fetch_destination('provinsi_id') : '' }}">
                                    <div class="--custom-select">
                                        <select class="text-capitalize select2" id="provinsi_id" name="provinsi_id" required>
                                            <option disabled selected class="selected">-- Pilih Provinsi --</option>
                                            @foreach($provinsi as $value)
                                                <option value="{{ $value['province_id'] }}"
                                                @if (isset($customer) && $customer->provinsi_id == $value['province_id'])
                                                    selected
                                                @endif>{{ $value['province'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kabupaten">Kabupaten / Kota</label>
                                    <input type="hidden" id="old_kabupaten_id" value="{{ isset($customer) ? $customer->fetch_destination('city_id') : '' }}">
                                    <div class="--custom-select">
                                        <select class="text-capitalize select2" id="kabupaten_id" name="kabupaten_id" required>
                                            <option disabled selected class="selected">-- Pilih Kabupaten --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="hidden" id="old_kecamatan_id" value="{{ old('kecamatan_id') ?? ($customer->destination_code ?? '') }}">
                                    <div class="--custom-select">
                                        <select class="text-capitalize select2" id="kecamatan_id" name="kecamatan_id" required>
                                            <option disabled selected class="selected">-- Pilih Kecamatan --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <textarea id="address" name="address" class="form-control">{{ isset($customer) ? $customer->address : '' }}</textarea>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="post_code">Post Code</label>
                                    <input type="number" min="1" id="post_code" name="post_code" class="form-control" value="{{ isset($customer) ? $customer->post_code : '' }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="password">Gender</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="1"
                                        @if (isset($customer) && $customer->gender == 1)
                                            checked
                                        @endif >
                                        Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="2"
                                        @if (isset($customer) && $customer->gender == 2)
                                            checked
                                        @endif >
                                        Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @isset($customer)
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Old Image</label>
                                    <div>
                                        <img src="{{ env('APP_DOWNLOAD') . $customer->image }}" alt="customer-image" style="width: 120px;">
                                    </div>
                                </div>
                            </div>
                            @endisset
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="Customer Avatar (Optional)">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="fw-500">Birthdate</label>
                                    <div class="timepicker-input input-icon form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon bgc-white bd bdwR-0">
                                            <i class="ti-calendar"></i>
                                            </div>
                                            <input name="dob" type="text" class="form-control bdc-grey-200 start-date" placeholder="Datepicker" data-provide="datepicker" value="{{ isset($customer) && isset($customer->dob) ? Carbon\Carbon::createFromFormat('Y-m-d', $customer->dob)->format('m/d/Y') : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" name="is_active" id="is_active"
                                        @if(isset($customer) && $customer->is_active == true)
                                            checked
                                        @endif
                                        >
                                        <label for="is_active" class="custom-control-label">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <a type="button" class="btn cur-p btn-warning" href="{{ route('be.customer') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
    $(function () {

        $('#provinsi_id').change(() => {
            $('#kabupaten_id').find('option').remove();
            $('#kabupaten_id').append('<option value="0">-- Pilih Kabupaten --</option>');
            $('#kecamatan_id').find('option').remove();
            $('#kecamatan_id').append('<option value="0">-- Pilih Kecamatan --</option>');

            let id = $('select#provinsi_id option:checked').val();

            $.ajax({
                url: '{{ route("be.customer.location") }}',
                type: 'POST',
                data: {
                    id,
                    type: 'province',
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'JSON',
                success: (response) => {
                    $.each(response.data, (k, v) => {
                        $('#kabupaten_id').append(`<option value="${ v.city_id }">${ v.city_name }</option>`);
                    });
                }
            })
        })

        $('#kabupaten_id').change(() => {
            $('#kecamatan_id').find('option').remove();
            $('#kecamatan_id').append('<option value="0">-- Pilih Kecamatan --</option>');

            let id = $('select#kabupaten_id option:checked').val();

            $.ajax({
                url: '{{ route("be.customer.location") }}',
                type: 'POST',
                data: {
                    id,
                    type: 'city',
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'JSON',
                success: (response) => {
                    $.each(response.data, (k, v) => {
                        $('#kecamatan_id').append(`<option value="${ v.subdistrict_id }">${ v.subdistrict_name }</option>`);
                    });
                }
            })
        })

    })

    submitData('formCustomer', '{{ route('be.customer') }}');
    </script>

    @isset($customer)
    <script type="text/javascript">
    $(async function () {
        $('#kabupaten_id').find('option').remove();
        $('#kabupaten_id').append('<option value="0">-- Pilih Kabupaten --</option>');
        $('#kecamatan_id').find('option').remove();
        $('#kecamatan_id').append('<option value="0">-- Pilih Kecamatan --</option>');

        let id = $('select#provinsi_id option:checked').val();
        let current_city = '{{ $customer->kabupaten_id }}';

        await $.ajax({
            url: '{{ route("be.customer.location") }}',
            type: 'POST',
            data: {
                id,
                type: 'province',
                _token: "{{ csrf_token() }}"
            },
            dataType: 'JSON',
            success: (response) => {
                $.each(response.data, (k, v) => {
                    if (parseInt(v.city_id) === parseInt(current_city)) {
                        $('#kabupaten_id').append(`<option value="${ v.city_id }" selected>${ v.city_name }</option>`);
                    } else {
                        $('#kabupaten_id').append(`<option value="${ v.city_id }">${ v.city_name }</option>`);
                    }
                });
            }
        })

        let current_subdistrict = '{{ $customer->kecamatan_id }}';

        await $.ajax({
                url: '{{ route("be.customer.location") }}',
                type: 'POST',
                data: {
                    id: current_city,
                    type: 'city',
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'JSON',
                success: (response) => {
                    $.each(response.data, (k, v) => {
                        if (parseInt(v.subdistrict_id) === parseInt(current_subdistrict)) {
                            $('#kecamatan_id').append(`<option value="${ v.subdistrict_id }" selected>${ v.subdistrict_name }</option>`);
                        } else {
                            $('#kecamatan_id').append(`<option value="${ v.subdistrict_id }">${ v.subdistrict_name }</option>`);
                        }
                    });
                }
            })
    })
    </script>
    @endisset

@endpush
