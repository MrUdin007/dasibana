@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ isset($user) ? 'Edit Staff' : 'Add Staff' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ isset($user) ? route('be.staff.edit', $user->id) : route('be.staff.create') }}">
                            {{ isset($user) ? 'Edit Staff' : 'Add Staff' }}
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
                            <h3 class="page-title">{{ isset($user) ? 'Edit Staff' : 'Add Staff' }}</h3>
                        </div>
                    </div>
                    <div>
                        <form class="form-vegan" id="formStaff" method="POST" action="{{ isset($user) ? $api_url.'staff/update' : $api_url.'staff/store' }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ isset($user) ? $user->id : '' }}">
                            <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="staff">Staff Role</label>
                                    <select class="form-control select2" name="roles[]" id="roles" multiple="multiple" required>
                                        <option value="" disabled>--Select Role--</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                @isset($user)
                                                    @foreach ($roles_user as $item)
                                                        @if ($role->id == $item->role_id)
                                                            selected
                                                        @endif
                                                    @endforeach
                                                @endisset
                                            >   {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Staff Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Staff Name" value="{{ isset($user) ? $user->name : '' }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Staff Email" value="{{ isset($user) ? $user->email : '' }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="float-inpt-fld">
                                        <input type="password" class="floatfield form-control field-main-oz" id="password" name="password" placeholder="Staff Password" value="" required aria-describedby="password" autocomplete="current-password">
                                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="float-inpt-fld">
                                        <input type="password" class="floatfield form-control field-main-oz" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" value="" required aria-describedby="password_confirmation" autocomplete="current-password">
                                        <span toggle="#password_confirmation" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                </div>
                            </div>
                            <div id="match" class="form-row">
                                <div class="form-group col-md-6">
                                    <span class="help-block">Password does not match</span>
                                </div>
                            </div>
                            <!-- <div class="form-row">
                                <div class="form-group col-md-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" id="show_password" type="checkbox"
                                            > Show Password
                                        </label>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" name="is_active" id="is_active"
                                        @if(isset($user) && $user->is_active == true)
                                            checked
                                        @endif
                                        >
                                        <label for="is_active" class="custom-control-label">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <a type="button" class="btn cur-p btn-warning" href="{{ route('be.staff') }}">Cancel</a>
                            <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
    $('#match').hide();
    $(function () {
        $('#password, #password_confirmation').on('keyup', function () {
            if ($('#password').val() == $('#password_confirmation').val()) {
                $('#match').fadeOut(1000);
                $('#submit').prop('disabled', false);
            } else {
                $('#match').fadeIn(1000);
                $('#submit').prop('disabled', true);
            }
        });

        $('#show_password').change(function() {
            var x = document.getElementById("password");
            var y = document.getElementById("password_confirmation");

            if (this.checked) {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        });
    })

    submitData('formStaff', '{{ route('be.staff') }}');
    </script>
@endpush
