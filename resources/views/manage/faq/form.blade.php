@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ isset($faq) ? 'Edit FAQ' : 'Add FAQ' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ isset($faq) ? route('be.faq.edit', $faq->id) : route('be.faq.create') }}">
                            {{ isset($faq) ? 'Edit FAQ' : 'Add FAQ' }}
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
                            <h3 class="page-title">{{ isset($faq) ? 'Edit FAQ' : 'Add FAQ' }}</h3>
                        </div>
                    </div>
                    <div>
                        <form id="formFAQ" method="POST" action="{{ isset($faq) ? $api_url.'faq/update' : $api_url.'faq/store' }}" class="form-vegan">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ isset($faq) ? $faq->id : '' }}">
                            <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Question</label>
                                    <input type="text" class="form-control" id="question" name="question" placeholder="Question" value="{{ isset($faq) ? $faq->question : '' }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="phone">Answer</label>
                                    <textarea id="answer" name="answer" class="form-control">{{ isset($faq) ? $faq->answer : '' }}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="image">Order</label>
                                    <input min="1" type="number" class="form-control" id="order" name="order" aria-describedby="order" value="{{ isset($faq) ? $faq->order : '' }}" placeholder="Order" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" name="is_active" id="is_active"
                                            @if(isset($faq) && $faq->show == true)
                                                checked
                                            @endif
                                        >
                                        <label for="is_active" class="custom-control-label">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <a type="button" class="btn cur-p btn-warning" href="{{ route('be.faq') }}">Cancel</a>
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

    submitData('formFAQ', '{{ route('be.faq') }}');
    </script>
@endpush
