@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Blog</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/blog/blog.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/vendor/slick_slider.css') }}">
@endpush

@section('content')
    <div class="blog-section container">
        <!-- Blog Detail Header -->
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
                    <form class="form-vegan" action="{{route('blog')}}">
                        <div class="input-group search-inputs">
                            <input id="searchblogData" name="searchblog" type="text" class="form-control --search" placeholder="Cari Artikel" aria-label="" aria-describedby="search" value="{{ isset(request()->searchblog) ? request()->searchblog : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text --nobg" id="searchblog">
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

        @if(count($blogpost) > 0)
        <!-- All Blog -->
        <!-- ============================================================== -->
        <section class="all-blog">
            <div class="grid_layouts gr-all-blg">
                @foreach($blogpost as $blogs)
                <div class="card-artikel item-blog">
                    <div class="cover-sldr img-lazy images-slider big-lazy" data-src="{{ asset($blogs->image_cover) }}">
                        <div class="bg-overlay"></div>
                        <div class="kategories">
                            <a href="{{ route('blog.category', [$blogs->urlcategory]) }}" class="catg-ttl">
                                {{$blogs->category}}
                            </a>
                        </div>
                        <div class="contents">
                            <a href="{{ route('blog.detail', [$blogs->urlcategory, $blogs->urlblog]) }}" class="ttle-blg truncate-texts --two main-text">
                                {{$blogs->title}}
                            </a>
                            <div class="small-txt rhegr">
                                <small class="sml-tct small-fnt">
                                    {{ Carbon\Carbon::parse($blogs->post_time)->format('d M Y') }}
                                </small>
                                @if($blogs->hits > 0)
                                <small class="sml-tct viewers-pts small-fnt">
                                    <div class="viewers-icn --whts"></div>
                                    <span class="constantformatnumber" data-content="{{$blogs->hits}}">{{$blogs->hits}}</span>
                                </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End All Blog -->
        @endif

        @if(count($blogpopular_slider) > 0)
        <!-- Popular Blog -->
        <!-- ============================================================== -->
        <section class="popular-blog">
            <div class="head-ct-slider pt-0">
                <div class="head-ttle">
                    <h3 class="mb-0 text-uppercase">
                        artikel dan video popular
                    </h3>
                </div>
            </div>
            <div class="slider-artikel">
                <div class="frst-sldr-nws grid_layouts gr-artkles">
                    @foreach($blogpopular as $news)
                    <div class="gr-artkl">
                        <div class="card-artikel">
                            <a href="{{ route('blog.detail', [$news->urlcategory, $news->urlblog]) }}" class="imgs-artikel">
                                <div class="image-cvr img-lazy images-slider big-lazy" data-src="{{ asset($news->image_cover) }}"></div>
                            </a>
                            <div class="desc-artikel">
                                <div>
                                    <a href="{{ route('blog.detail', [$news->urlcategory, $news->urlblog]) }}" class="main-sub-text mb-2 text-left text-black truncate-texts f-Asap_reg title-hm-nws">
                                        {{ $news->title }}
                                    </a>
                                </div>
                                <div class="ctg-sec">
                                    <a href="{{ route('blog.category', [$news->urlcategory]) }}" class="f-Asap_light clr-green truncate-texts">
                                        {{ $news->category }}
                                    </a>
                                </div>
                                <div class="--date rhegr">
                                    <small class="clr-light-gry truncate-texts text-left f-Asap_medium small-fnt">
                                        <span class="f-Asap_reg">{{ Carbon\Carbon::parse($news->post_time)->format('d M Y') }}</span>
                                    </small>
                                    @if($news->hits > 0)
                                    <small class="sml-tct viewers-pts small-fnt">
                                        <div class="viewers-icn --blck"></div>
                                        <span class="constantformatnumber" data-content="{{$news->hits}}">{{$news->hits}}</span>
                                    </small>
                                    @endif
                                </div>
                                <article class="frs-desc">
                                    <p class="mb-2 clr-gry text-left main-sub-text f-Asap_light">
                                        <span class="truncate-texts --five">
                                            {!! strip_tags($news->content) !!}
                                        </span>
                                        
                                        <a style="color: #1FBC9D !important;" href="{{ route('blog.detail', [$news->urlcategory, $news->urlblog]) }}" class="mb-0 clr-blue text-capitalize">
                                            baca selengkapnya
                                        </a>
                                    </p>
                                </article>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="sldr-gr-artkles slidersss">
                    <div class="main-new-sldr-populer slider-lazy big-lazy">
                        <div class="new-sldr-populer slider-temp --slider-main">
                            @foreach($blogpopular as $newsmain)
                            <div class="gr-artkl" id="mobileView">
                                <div class="card-artikel">
                                    <a href="{{ route('blog.detail', [$newsmain->urlcategory, $newsmain->urlblog]) }}" class="imgs-artikel" style="line-height: 0;">
                                        <div class="image-cvr img-lazy images-slider big-lazy" data-src="{{ asset($newsmain->image_cover) }}"></div>
                                    </a>
                                    <div class="desc-artikel">
                                        <div>
                                            <a href="{{ route('blog.detail', [$newsmain->urlcategory, $newsmain->urlblog]) }}" class="main-sub-text mb-2 text-left text-black truncate-texts f-Asap_reg title-hm-nws">
                                                {{ $newsmain->title }}
                                            </a>
                                        </div>
                                        <div class="ctg-sec">
                                            <a href="{{ route('blog.category', [$newsmain->urlcategory]) }}" class="f-Asap_light clr-green truncate-texts">
                                                {{ $newsmain->category }}
                                            </a>
                                        </div>
                                        <div class="--date rhegr">
                                            <small class="clr-light-gry small-fnt truncate-texts text-left f-Asap_medium">
                                                <span class="f-Asap_reg">{{ Carbon\Carbon::parse($newsmain->post_time)->format('d M Y') }}</span>
                                            </small>
                                            @if($newsmain->hits > 0)
                                            <small class="sml-tct viewers-pts small-fnt">
                                                <div class="viewers-icn --blck"></div>
                                                <span class="constantformatnumber" data-content="{{$newsmain->hits}}">{{$newsmain->hits}}</span>
                                            </small>
                                            @endif
                                        </div>
                                        <article class="frs-desc">
                                            <p class="mb-0 clr-gry text-left main-sub-text truncate-texts --eight f-Asap_light">
                                                {!! strip_tags($newsmain->content) !!}
                                            </p>
                                        </article>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @foreach($blogpopular_slider as $news)
                            <div class="gr-artkl">
                                <div class="card-artikel">
                                    <a href="{{ route('blog.detail', [$news->urlcategory, $news->urlblog]) }}" class="imgs-artikel" style="line-height: 0;">
                                        <div class="image-cvr img-lazy images-slider big-lazy" data-src="{{ asset($news->image_cover) }}"></div>
                                    </a>
                                    <div class="desc-artikel">
                                        <div>
                                            <a href="{{ route('blog.detail', [$news->urlcategory, $news->urlblog]) }}" class="main-sub-text mb-2 text-left text-black truncate-texts f-Asap_reg title-hm-nws">
                                                {{ $news->title }}
                                            </a>
                                        </div>
                                        <div class="ctg-sec">
                                            <a href="{{ route('blog.category', [$news->urlcategory]) }}" class="f-Asap_light clr-green truncate-texts">
                                                {{ $news->category }}
                                            </a>
                                        </div>
                                        <div class="--date rhegr">
                                            <small class="clr-light-gry truncate-texts text-left f-Asap_medium small-fnt">
                                                <span class="f-Asap_reg">{{ Carbon\Carbon::parse($news->post_time)->format('d M Y') }}</span>
                                            </small>
                                            @if($news->hits > 0)
                                            <small class="sml-tct viewers-pts small-fnt">
                                                <div class="viewers-icn --blck"></div>
                                                <span class="constantformatnumber" data-content="{{$news->hits}}">{{$news->hits}}</span>
                                            </small>
                                            @endif
                                        </div>
                                        <article class="frs-desc">
                                            <p class="mb-0 clr-gry text-left main-sub-text truncate-texts --eight f-Asap_light">
                                                {!! strip_tags($news->content) !!}
                                            </p>
                                        </article>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Popular Blog -->
        @endif

        @if(count($blogrecommendation) > 0)
        <!-- Recommendation Blog -->
        <!-- ============================================================== -->
        <section class="recommendation-blog">
            <div class="head-ct-slider pt-0">
                <div class="head-ttle">
                    <h3 class="mb-0 text-uppercase">
                        news vegan rekomendasi
                    </h3>
                </div>
            </div>
            <div class="sldr-gr-artkles">
                <div class="main-recommendation-slider slider-lazy big-lazy">
                    <div class="recommendation-slider slider-temp --slider-main">
                        @foreach($blogrecommendation as $blogsrecommendation)
                        <div class="gr-artkl">
                            <div class="card-artikel">
                                <a href="{{ route('blog.detail', [$blogsrecommendation->urlcategory, $blogsrecommendation->urlblog]) }}" class="imgs-artikel">
                                    <div class="image-cvr img-lazy images-slider small-lazy" data-src="{{ asset($blogsrecommendation->image_cover) }}"></div>
                                </a>
                                <div class="desc-artikel">
                                    <div>
                                        <a href="{{ route('blog.detail', [$blogsrecommendation->urlcategory, $blogsrecommendation->urlblog]) }}" class="main-sub-text mb-2 text-left text-black truncate-texts f-Asap_reg --three">
                                            {{$blogsrecommendation->title}}
                                        </a>
                                    </div>
                                    <div class="ctg-sec">
                                        <a href="{{ route('blog.category', [$blogsrecommendation->urlcategory]) }}" class="f-Asap_light sml-tct clr-light-gry truncate-texts">
                                            {{$blogsrecommendation->category}}
                                        </a>
                                    </div>
                                    <div class="--date rhegr">
                                        <small class="clr-light-gry truncate-texts text-left f-Asap_medium small-fnt">
                                            {{ Carbon\Carbon::parse($blogsrecommendation->post_time)->format('d M Y') }}
                                        </small>
                                        @if($blogsrecommendation->hits > 0)
                                        <small class="sml-tct viewers-pts small-fnt">
                                            <div class="viewers-icn --blck"></div>
                                            <span class="constantformatnumber" data-content="{{$blogsrecommendation->hits}}">{{$blogsrecommendation->hits}}</span>
                                        </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Recommendation Blog -->
        @endif
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('dist/vendors/slick-slider/slick/slick.js')}}"></script>
    <script type="text/javascript" src="{{ asset('dist/fe/js/pages/blog.js') }}"></script>
@endpush