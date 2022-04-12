@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Blog - {{$category_detail->category}}</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/blog/category.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/blog/sidebar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/content/card_product.css') }}">
@endpush

@section('content')
    <div class="blogcategory-section container">
        <!-- Blog Category Header -->
        <!-- ============================================================== -->
        <section class="ct-blog-header">
            <div class="grid_layouts gr-blog-detail">
                <div class="ls-menucategory">
                    <ul>
                        @foreach($category as $menucategory)
                        <li>
                            <a href="{{ route('blog.category', [$menucategory->slug]) }}" class="main-sub-text text-capitalize">
                                {{$menucategory->name}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <form class="form-vegan" autocomplete="off" id="searchblogcategoryForm" action="" method="get">
                        <div class="input-group search-inputs">
                            <input id="searchblogcategoryData" name="searchblog" type="text" class="form-control --search" placeholder="Cari Artikel" aria-label="" aria-describedby="search" value="{{ isset(request()->searchblog) ? request()->searchblog : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text --nobg" id="searchblogcategory">
                                    <button class="search-icn" type="button"></button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Blog Category Header -->

        <!-- Blog Top Category Content -->
        <!-- ============================================================== -->
        <section class="ct-blog-category">
            <!-- Breadcrumb -->
            <!-- ============================================================== -->
            <div class="sec-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('blog')}}">Vegan News</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$category_detail->category}}
                        </li>
                    </ol>
                </nav>
            </div>
            <!-- ============================================================== -->
            <!-- End Breadcrumb -->

            <div class="head-ct-slider pt-0">
                <div class="head-ttle">
                    <h3 class="mb-0 text-uppercase">
                        artikel populer
                    </h3>
                </div>
            </div>

            <div class="card-artikel">
                <a href="{{ route('blog.detail', [$category_detail->urlcategory, $category_detail->urlblog]) }}" class="imgs-artikel">
                    <div class="image-cvr img-lazy images-slider big-lazy" data-src="{{ asset($category_detail->image_cover) }}"></div>
                </a>
                <div class="desc-artikel">
                    <div>
                        <a style="margin-bottom: 5px !important;" href="{{ route('blog.detail', [$category_detail->urlcategory, $category_detail->urlblog]) }}" class="main-text mb-1 text-left text-black truncate-texts f-Asap_reg title-hm-nws">
                            {{ $category_detail->title }}
                        </a>
                    </div>
                    <div class="ctg-sec">
                        <a href="{{ route('blog.category', [$category_detail->urlcategory]) }}" class="f-Asap_light sml-tct clr-light-gry truncate-texts">
                            {{$category_detail->category}}
                        </a>
                    </div>
                    <div class="grid_layouts gr-middle-blg">
                        <div class="date-blg rhegr">
                            <small class="small-fnt">
                                {{ Carbon\Carbon::parse($category_detail->created_at)->format('d F Y') }}
                            </small>
                            @if($category_detail->hits > 0)
                            <small class="sml-tct viewers-pts small-fnt">
                                <div class="viewers-icn --blck"></div>
                                <span class="constantformatnumber" data-content="{{$category_detail->hits}}">{{$category_detail->hits}}</span>
                            </small>
                            @endif
                        </div>
                        <div class="position-relative shares-smd share-btn" id="share-oz{{ $category_detail->idblog }}" data-url="{{ route('blog.detail', [$category_detail->urlcategory, $category_detail->urlblog]) }}" data-title="{{ $category_detail->post_title }}" data-desc="{{ $category_detail->post_title }}">
                            <div>
                                <a class="btn-facebook" data-id="fb">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </div>
                            <div>
                                <a class="btn-twitter" data-id="tw">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                            <div>
                                <a data-target="{{ $category_detail->idblog }}" class="copyclp-vegan-btn copyclp position-relative" data-clipboard-text="{{ route('blog.detail', [$category_detail->urlcategory, $category_detail->urlblog]) }}" type="button">
                                    <i class="fas fa-link"></i>
                                </a>
                            </div>
                            <div class="ct-tggle ct-tggle1" id="copyclip-vegan{{ $category_detail->idblog }}" style="display: none">
                                <div class="position-relative">
                                    <small class="small-fnt">Copied</small>
                                    <div class="mn-arrw"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <article class="frs-desc">
                        <p class="mb-2 clr-gry text-left main-sub-text f-Asap_light">
                            <span class="truncate-texts --eight">
                                {!! strip_tags($category_detail->contentblog) !!}
                            </span>
                            
                            <a href="{{ route('blog.detail', [$category_detail->urlcategory, $category_detail->urlblog]) }}" class="mb-0 clr-blue text-capitalize">
                                baca selengkapnya
                            </a>
                        </p>
                    </article>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Blog Top Category Content -->

        <!-- Blog Bottom Category Content -->
        <!-- ============================================================== -->
        <section class="bottom-blog-category">
            @if(count($product_related) > 0)
            <div class="grid_layouts gr-blog-detail">
            @else
            <div class="no-grids">
            @endif
                <div class="ct-blog-sc">
                    @if(count($get_blogs) > 0)
                    <div class="grid_layouts gr-artkles">
                        @foreach($get_blogs as $get_blog)
                        <div class="card-artikel ls-category" style="display: none;">
                            <a href="{{ route('blog.detail', [$get_blog->urlcategory, $get_blog->urlblog]) }}" class="imgs-artikel">
                                <div class="image-cvr @if(count($product_related) > 0) @else no-gr-img @endif img-lazy images-slider small-lazy" data-src="{{ asset($get_blog->image_cover) }}"></div>
                            </a>
                            <div class="desc-artikel">
                                <div>
                                    <a style="margin-bottom: 10px !important;" href="{{ route('blog.detail', [$get_blog->urlcategory, $get_blog->urlblog]) }}" class="main-sub-text mb-1 text-left text-black truncate-texts --two f-Asap_reg title-hm-nws">
                                        {{ $get_blog->title }}
                                    </a>
                                </div>
                                <div class="ctg-sec">
                                    <a href="{{ route('blog.category', [$get_blog->urlcategory]) }}" class="f-Asap_light clr-green truncate-texts">
                                        {{ $get_blog->category }}
                                    </a>
                                </div>
                                <div class="date-blg rhegr mt-0">
                                    <small class="clr-light-gry truncate-texts text-left f-Asap_medium small-fnt">
                                        {{ Carbon\Carbon::parse($get_blog->created_at)->format('d F Y') }}
                                    </small>
                                    @if($get_blog->hits > 0)
                                    <small class="sml-tct viewers-pts small-fnt ml-0">
                                        <div class="viewers-icn --blck"></div>
                                        <span class="constantformatnumber" data-content="{{$get_blog->hits}}">{{$get_blog->hits}}</span>
                                    </small>
                                    @endif
                                </div>
                                <article class="frs-desc">
                                    <p class="mb-0 clr-gry text-left main-sub-text truncate-texts --eight f-Asap_light">
                                        {!! strip_tags($get_blog->content) !!}
                                    </p>
                                </article>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if(count($get_blogs) > 9)
                    <div class="btn-view-sec">
                        <button id="loadMore" class="btn-vegan green-btn text-capitalize">muat lebih banyak</button>
                    </div>
                    @endif
                    @endif
                </div>
                @if(count($product_related) > 0)
                <div class="sidebar-blog">
                    <div class="top-menu">
                        <h6 class="f-Asap_medium text-capitalize">produk terkait</h6>
                    </div>
                    <div class="bottom-menu">
                        @foreach($product_related->take(2) as $products_related)
                            <div class="box-sldr">
                                @include('public.produk.card_product', ['produk'=>$products_related])
                            </div>
                        @endforeach
                        @if(count($product_related) > 2)
                        <div class="view-details">
                            <a href="#">
                                lihat produk lainnya ({{count($product_related)-2}})
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Blog Bottom Category Content -->
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".ls-category").slice(0, 9).show();
            $('#loadMore').on('click', function(e){
                e.preventDefault();
                $(".ls-category:hidden").slice(0, 3).slideDown();
                if ($(".ls-category:hidden").length == 0) {
                    $("#load").fadeOut('slow');
                    $(this).hide();
                }
            });
        });
    </script>
@endpush