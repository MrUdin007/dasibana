@extends('layouts.be.be')

@section('content')
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    {{ isset($blog_post) ? 'Edit Blog Post' : 'Add Blog Post' }}
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ isset($blog_post) ? route('be.blog_post.edit', $blog_post->id) : route('be.blog_post.create') }}">
                            {{ isset($blog_post) ? 'Edit Blog Post' : 'Add Blog Post' }}
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
                            <h3 class="page-title">{{ isset($blog_post) ? 'Edit Blog Post' : 'Add Blog Post' }}</h3>
                        </div>
                    </div>
                    <div>
                        <form class="form-vegan" method="POST" id="formBlogPost" action="{{ isset($blog_post) ? $api_url.'blog/post/update' : $api_url.'blog/post/store' }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ isset($blog_post) ? $blog_post->id : '' }}">
                            <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="type">Blog Post Type</label>
                                    <select class="form-control" id="type" name="type" required="">
                                        <option selected value="" disabled>--Select Type--</option>
                                        <option value="1" {{ isset($blog_post) && $blog_post->is_video == false ? 'selected' : '' }}>Artikel</option>
                                        <option value="2" {{ isset($blog_post) && $blog_post->is_video == true ? 'selected' : '' }}>Video</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="title">Blog Post Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Blog Post Title" value="{{ isset($blog_post) ? $blog_post->title : '' }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input type="hidden" name="is_video_old" id="is_video_old" value="{{ isset($blog_post) ? $blog_post->is_video : '' }}">
                                    <div class="group_post_image_cover"
                                        @if(empty($blog_post))
                                            style="display: none"
                                        @elseif(isset($blog_post) && $blog_post->is_video == true )
                                            style="display: none"
                                        @endif
                                        >
                                        @isset($blog_post)
                                            <img src="{{ env('APP_DOWNLOAD') . $blog_post->image_cover }}" alt="old-image" style="width: 100px;"><br>
                                        @endisset
                                        <label class="control-label">{{ isset($blog_post) ? 'Ganti'  : '' }} Gambar<span class="text-danger">*</span></label>
                                        <input type="file" name="image_cover" id="image_cover" class="form-control" value="{{ isset($blog_post) ? $blog_post->image_cover  : '' }}"
                                            placeholder="{{ isset($blog_post) ? 'Ganti'  : 'Masukkan' }} Gambar" @empty($blog_post) required @endempty>
                                        <small class="form-text">Rekomendasi ukuran 1000x500 pixel dan size 2MB</small>
                                        <div>
                                            @isset($blog_post)
                                            <small>(Kosongkan apabila gambar tidak diganti)</small>
                                            @endisset
                                        </div>
                                    </div>
                                    <div class="group_url_video"
                                        @if(empty($blog_post))
                                            style="display: none"
                                        @elseif(isset($blog_post) && $blog_post->is_video == false )
                                            style="display: none"
                                        @endif
                                        >
                                        <label class="control-label">URL video<span class="text-danger">*</span></label>
                                        <input type="text" name="video" id="video" class="form-control" value="{{ old('video') ? old('video') : (isset($blog_post) ? $blog_post->video : '') }}" placeholder="Input URL Video" @empty($blog_post) required @endempty>
                                        <small>Contoh: https://google.com</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Content</label>
                                <textarea id="blog_post_content" name="content" required>@isset($blog_post) {{$blog_post->content}} @endisset</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="category">Blog Post Category</label>
                                    <select class="form-control select2" name="category_id" id="category_id" required>
                                        <option value="" selected disabled>--Select Category--</option>
                                        @foreach ($blog_categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if (isset($blog_post) && $blog_post->blog_category_id == $category->id)
                                                        selected
                                                    @endif
                                            >   {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="status">Status</label>
                                    <select class="form-control select2" name="status" id="status" required>
                                        <option value="" selected disabled>--Select Status--</option>
                                        @foreach ($status as $key => $value)
                                            <option value="{{ $key }}"
                                                    @if (isset($blog_post) && $blog_post->status == $key)
                                                        selected
                                                    @endif
                                            >   {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tags">Blog Post Tags</label>
                                    <select class="form-control select2" name="tags[]" id="tags" multiple="multiple" required>
                                        <option value="" disabled>--Select Tags--</option>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                @isset($blog_post)
                                                    @foreach ($blog_post_tags as $item)
                                                        @if ($tag->id == $item->tag_id)
                                                            selected
                                                        @endif
                                                    @endforeach
                                                @endisset
                                            >   {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <div class="main-form-vg custom-checkbox">
                                        <input class="form-control" type="checkbox" name="is_active" id="is_active"
                                            @if(isset($blog_post) && $blog_post->is_active == true)
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
                            <a type="button" class="btn cur-p btn-warning" href="{{ route('be.blog_post') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            let post_content = CKEDITOR.replace('blog_post_content', {
                filebrowserUploadUrl: "{{ $api_url.'blog/post/upload' }}",
                extraPlugins: 'justify',
            });
            if($('#status').val() == 2){
                $('#notifikasi_div').show();
            }else{
                $('#notifikasi_div').hide();
            }
            post_content.on('change', function(ev) {
                $("#post_content").val(post_content.getData());
            });
        });

        $('#type').on('change',function(){
        if($('#type').val() == 1){
            $('.group_post_image_cover').show();
            $('.group_url_video').css('display','none');
            $('#video').removeAttr('required');
        }else if($('#type').val() == 2){
            $('.group_url_video').show();
            $('.group_post_image_cover').css('display','none');
            $('#image_cover').removeAttr('required');
        }
      });

        submitData('formBlogPost', '{{ route('be.blog_post') }}');
    </script>
@endpush
