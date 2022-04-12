@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ isset($blog_category) ? 'Edit Blog Category' : 'Add Blog Category' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ isset($blog_category) ? route('be.blog_category.edit', $blog_category->id) : route('be.blog_category.create') }}">
                            {{ isset($blog_category) ? 'Edit Blog Category' : 'Add Blog Category' }}
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
                            <h3 class="page-title">{{ isset($blog_category) ? 'Edit Blog Category' : 'Add Blog Category' }}</h3>
                        </div>
                    </div>
                    <div>
                    <form class="form-vegan" id="formProductCategory" method="POST" action="{{ isset($blog_category) ? $api_url.'blog/category/update' : $api_url.'blog/category/store' }}">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ isset($blog_category) ? $blog_category->id : '' }}">
                        <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="supplier">Parent Category</label>
                                <select class="form-control select2" name="parent_category_id" id="parent_category_id">
                                    <option value="top_parent" selected>Select This Option If You Want to Create a Parent Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (isset($blog_category) && $blog_category->parent_id == $category->id)
                                                selected
                                            @endif
                                        >   {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="name">Blog Category Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Blog Category Name" value="{{ isset($blog_category) ? $blog_category->name : '' }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <div class="main-form-vg custom-checkbox">
                                    <input class="form-control" type="checkbox" name="is_active" id="is_active"
                                        @if(isset($blog_category) && $blog_category->is_active == true)
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
                        <a type="button" class="btn cur-p btn-warning" href="{{ route('be.blog_category') }}">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">


    submitData('formProductCategory', '{{ route('be.blog_category') }}');
    </script>
@endpush
