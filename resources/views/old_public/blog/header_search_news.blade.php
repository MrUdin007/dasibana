@foreach($datas->take(3) as $artikel)
<a class="item-search-list" href="{{ route('blog.detail', [$artikel->urlcategory, $artikel->urlblog]) }}">
    <div class="display_grid grid-global-search --gr-news">
        <div class="search-img-container">
            <div class="search-img img-lazy loaded" style="background-image: url('{{ $artikel->image_cover }}')">
                <small class="category-pills">
                    {{$artikel->category}}
                </small>
            </div>
        </div>
        <div>
            <h6 class="truncate-texts --two mb-0">
                {{$artikel->title}}
            </h6>
            <div class="date-blg rhegr mt-0">
                <small>
                    {{ Carbon\Carbon::parse($artikel->created_at)->format('d F Y') }}
                </small>
                @if($artikel->hits > 0)
                <small class="sml-tct viewers-pts" style="color: rgba(0, 0, 0, 0.4);">
                    <div class="viewers-icn --blck"></div>
                    <span class="constantformatnumber" data-content="{{$artikel->hits}}">{{$artikel->hits}}</span>
                </small>
                @endif
            </div>
        </div>
    </div>
</a>
@endforeach
@if(count($datas) > 3)
<div class="view-all">
    <a class="text-capitalize" href="{{ route('blog') }}">lihat semua vegan news</a>
</div>
@endif