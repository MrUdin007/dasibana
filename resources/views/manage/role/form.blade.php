@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ isset($role) ? 'Edit Staff Role' : 'Add Staff Role' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ isset($role) ? route('be.role.edit', $role->id) : route('be.role.create') }}">
                            {{ isset($role) ? 'Edit Staff Role' : 'Add Staff Role' }}
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
                            <h3 class="page-title">{{ isset($role) ? 'Edit Staff Role' : 'Add Staff Role' }}</h3>
                        </div>
                    </div>
                    <div>
                        <form class="form-vegan" id="formRole" method="POST" action="{{ isset($role) ? $api_url.'role/update' : $api_url.'role/store' }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ isset($role) ? $role->id : '' }}">
                            <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Staff Role Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Staff Role Name" value="{{ isset($role) ? $role->name : '' }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Staff Role Description" value="{{ isset($role) ? $role->desc : '' }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" name="is_active" id="is_active"
                                            @if(isset($role) && $role->is_active == true)
                                                checked
                                            @endif
                                        >
                                        <label for="is_active" class="custom-control-label">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                @foreach($permissions as $permission)
                                <div class="form-group col-md-2">
                                    @if ($loop->index < 6)
                                    <label for="permission">Permission</label>
                                    @endif
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" value="{{ $permission->id }}" name="permissions[]" id="permissions[]"
                                            @isset($permissions_role)
                                                @foreach($permissions_role as $item)
                                                    @if (isset($role) && $permission->id == $item->permission_id)
                                                        checked
                                                    @endif
                                                @endforeach
                                            @endisset
                                        >
                                        <label for="permissions[]" class="custom-control-label">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a type="button" class="btn cur-p btn-warning" href="{{ route('be.role') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">

    submitData('formRole');
    </script>
@endpush
