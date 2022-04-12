@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ isset($product_subcategory) ? 'Edit Product Subcategory' : 'Add Product Subcategory' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ isset($product_subcategory) ? route('be.product_category.edit', $product_subcategory->id) : route('be.product_category.create') }}">
                            {{ isset($product_subcategory) ? 'Edit Product Subcategory' : 'Add Product Subcategory' }}
                        </a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row gap-20 pos-r">
            <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">{{ isset($product_subcategory) ? 'Edit Product Subcategory' : 'Add Product Subcategory' }}</h6>
                    <div class="mT-30">
                    <form id="formProductSubcategory" method="POST" action="{{ isset($product_subcategory) ? $api_url.'product/subcategory/update' : $api_url.'product/subcategory/store' }}">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ isset($product_subcategory) ? $product_subcategory->id : '' }}">
                        <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="supplier">Parent Category</label>
                                <select class="form-control" name="category_id" id="category_id" required>
                                    <option value="" selected disabled>--Select Parent Category--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @isset($product_subcategory)
                                                @if ($product_subcategory->parent_id == $category->id)
                                                    selected
                                                @endif
                                            @endisset
                                        >   {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="name">Subcategory Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ isset($product_subcategory) ? $product_subcategory->name : '' }}" placeholder="Subcategory Name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="is_active" type="checkbox"
                                            @if(isset($product_subcategory) && $product_subcategory->is_active == true)
                                                checked
                                            @endif
                                        > Active
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="button" class="btn cur-p btn-warning" href="{{ route('be.product_subcategory') }}">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">


    submitData('formProductSubcategory');
    </script>
@endpush
