@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ isset($cs) ? 'Edit CS Whatsapp' : 'Add CS Whatsapp' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ isset($cs) ? route('be.cs_whatsapp.edit', $cs->id) : route('be.cs_whatsapp.create') }}">
                            {{ isset($cs) ? 'Edit CS Whatsapp' : 'Add CS Whatsapp' }}
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
                            <h3 class="page-title">{{ isset($cs) ? 'Edit CS Whatsapp' : 'Add CS Whatsapp' }}</h3>
                        </div>
                    </div>
                    <div>
                        <form id="formCs" method="POST" action="{{ isset($cs) ? $api_url.'cs/update' : $api_url.'cs/store' }}" class="form-vegan">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ isset($cs) ? $cs->id : '' }}">
                            <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">CS Whatsapp Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="CS Whatsapp Name" value="{{ isset($cs) ? $cs->name : '' }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="number" min="1" class="form-control" id="phone" name="phone" placeholder="CS Whatsapp Phone" value="{{ isset($cs) ? $cs->phone : '' }}" required>
                                </div>
                            </div>
                            @isset($cs)
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Old Image</label>
                                    <div>
                                        <img src="{{ env('APP_DOWNLOAD') . $cs->image }}" alt="cs-image" style="width: 120px;">
                                    </div>
                                </div>
                            </div>
                            @endisset
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="CS Whatsapp Image" @empty($cs) required @endempty>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" name="is_active" id="is_active"
                                            @if(isset($cs) && $cs->is_active == true)
                                                checked
                                            @endif
                                        >
                                        <label for="is_active" class="custom-control-label">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a type="button" class="btn cur-p btn-warning" href="{{ route('be.cs_whatsapp') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">

    submitData('formCs', '{{ route('be.blog_post') }}');
    </script>
@endpush
