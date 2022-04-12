@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ isset($product_category) ? 'Edit Product Category' : 'Add Product Category' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ isset($product_category) ? route('be.product_category.edit', $product_category->id) : route('be.product_category.create') }}">
                            {{ isset($product_category) ? 'Edit Product Category' : 'Add Product Category' }}
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
							<h3 class="page-title">{{ isset($product_category) ? 'Edit Product Category' : 'Add Product Category' }}</h3>
						</div>
					</div>
                    <div>
                        <form id="formProductCategory" class="form-vegan" method="POST" action="{{ isset($product_category) ? $api_url.'product/category/update' : $api_url.'product/category/store' }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ isset($product_category) ? $product_category->id : '' }}">
                            <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="supplier">Parent Category</label>
                                    <select class="form-control select2" name="parent_category_id" id="parent_category_id">
                                        <option value="top_parent" selected>Select This Option If You Want to Create a Parent Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (isset($product_category) && $product_category->parent_id == $category->id)
                                                    selected
                                                @endif
                                            >   {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ isset($product_category) ? $product_category->name : '' }}" placeholder="Product Category Name" required>
                                </div>
                            </div>
                            @isset($product_category)
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Old Image</label>
                                    <div>
                                        <img src="{{ env('APP_DOWNLOAD') . $product_category->image }}" alt="product-category-image" style="width: 120px;">
                                    </div>
                                </div>
                            </div>
                            @endisset
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="Product Category Image" @empty($product_category) required @endempty>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" name="is_active" id="is_active"
                                        @if(isset($product_category) && $product_category->is_active == true)
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
                            <a type="button" class="btn cur-p btn-warning" href="{{ route('be.product_category') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">


    submitData('formProductCategory', '{{ route('be.product_category') }}');
    </script>
@endpush
