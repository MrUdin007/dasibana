@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Hasil Pencarian "{{request()->searchblog}}"</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/blog/search.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/blog/sidebar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/content/card_product.css') }}">
@endpush

@section('content')
    <div class="blogdetail-section container">
        <!-- Blog Detail Header -->
        <!-- ============================================================== -->
        <section class="ct-blog-header">
            <div class="grid_layouts gr-blog-detail mb-2">
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
                    <form class="form-vegan" autocomplete="off" id="searchblogmainForm" action="" method="get">
                        <div class="input-group search-inputs">
                            <input id="searchblogmainData" name="searchblog" type="text" class="form-control --search" placeholder="Cari Artikel" aria-label="" aria-describedby="search" value="{{ isset(request()->searchblog) ? request()->searchblog : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text --nobg" id="searchblogmain">
                                    <button class="search-icn" type="button"></button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Blog Detail Header -->

        <!-- Blog Detail Content -->
        <!-- ============================================================== -->
        <section class="ct-blog-detail">
            {{--@if(count($product_related) > 0)
            <div class="grid_layouts gr-blog-detail">
            @else--}}
            <div class="no-grids">
            {{--@endif--}}
                <div class="detail-ct-sec">
                    <!-- Title Pencarian Artikel -->
                    <!-- ============================================================== -->
                    <div class="">
                        @if(isset(request()->searchblog))
                        <p class="mb-0 main-sub-text f-Asap_reg">Hasil Pencarian dengan kata kunci  
                            <span class="f-Asap_medium">
                                "{{request()->searchblog}} (<span class="constantformatnumber" data-content="{{count($allblogpost)}}">{{count($allblogpost)}}</span>)"
                            </span>
                        </p>
                        @endif
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Title Pencarian Artikel -->
                    @if(count($allblogpost) > 0)
                    @foreach($allblogpost as $blogs)
                    <div class="grid_layouts gr-search-dt">
                        <div class="cover-sc img-lazy images-slider big-lazy" data-src="{{ asset($blogs->image_cover) }}"></div>
                        <div class="desc-artikel">
                            <div>
                                <a style="margin-bottom: 5px !important;" href="{{ route('blog.detail', [$blogs->urlcategory, $blogs->urlblog]) }}" class="main-sub-text mb-1 text-left text-black truncate-texts --two">
                                    {{ $blogs->title }}
                                </a>
                            </div>
                            <div class="ctg-sec">
                                <a href="{{ route('blog.category', [$blogs->urlcategory]) }}" class="f-Asap_light clr-light-gry truncate-texts">
                                    {{ $blogs->category }}
                                </a>
                            </div>
                            <div class="--date rhegr">
                                <small class="clr-light-gry truncate-texts text-left f-Asap_medium small-fnt">
                                    <span class="f-Asap_reg">{{ Carbon\Carbon::parse($blogs->post_time)->format('d M Y') }}</span>
                                </small>
                                @if($blogs->hits > 0)
                                <small class="sml-tct viewers-pts small-fnt">
                                    <div class="viewers-icn --blck"></div>
                                    <span class="constantformatnumber" data-content="{{$blogs->hits}}">{{$blogs->hits}}</span>
                                </small>
                                @endif
                            </div>
                            <article class="frs-desc">
                                <p class="mb-2 clr-gry text-left main-sub-text f-Asap_light">
                                    <span class="truncate-texts --three">
                                        {!! strip_tags($blogs->content) !!}
                                    </span>
                                </p>
                            </article>
                        </div>
                    </div>
                    @endforeach

                    <!-- Pagination -->
                    <!-- ============================================================== -->
                    {{ $allblogpost->links('layouts.fe.pagination') }}
                    <!-- ============================================================== -->
                    <!-- End Pagination -->
                    @else
                    <!-- Start Tidak Ada Artikel -->
                    <div class="no-post-list">
                        <div class="img-no-post img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/artikel_not_found.png') }}"></div>
                        <div class="desc-no-post">
                            <h6 class="text-capitalize f-Asap_medium main-sub-text">maaf! artikel tidak ditemukan</h6>
                        </div>
                    </div>
                    <!-- End:/ Tidak Ada Artikel -->
                    @endif
                </div>
                {{--@if(count($product_related) > 0)
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
                @endif--}}
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Blog Detail Content -->
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        
    </script>
@endpush