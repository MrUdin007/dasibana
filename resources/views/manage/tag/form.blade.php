@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ isset($tag) ? 'Edit Tag' : 'Add Tag' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ isset($tag) ? route('be.tag.edit', $tag->id) : route('be.tag.create') }}">
                            {{ isset($tag) ? 'Edit Tag' : 'Add Tag' }}
                        </a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row gap-20 pos-r">
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">{{ isset($tag) ? 'Edit Tag' : 'Add Tag' }}</h6>
                    <div class="mT-30">
                    <form id="formTag" method="POST" action="{{ isset($tag) ? $api_url.'tag/update' : $api_url.'tag/store' }}">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ isset($tag) ? $tag->id : '' }}">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="code">Tag Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Tag Name" value="{{ isset($tag) ? $tag->name : '' }}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="button" class="btn cur-p btn-warning" href="{{ route('be.tag') }}">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">

    submitData('formTag', '{{ route('be.tag') }}');
    </script>
@endpush
