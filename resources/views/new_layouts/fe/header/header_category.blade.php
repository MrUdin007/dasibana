@if(count($productCategories) > 0)
<ul class="navbar-nav top-header-scrl" id="mxHght">
    @foreach($productCategories as $categories)
    @if($categories->depth < 1)
    <li class="nav-item">
        <a data-slug="{{$categories->slug}}" class="@if(count($categories->children) > 0) header-ctgr-sub @else header-ctgr @endif nav-link @if(Request::route('slug') == $categories->slug) active @endif" href="{{route('produk.category',['slug'=>$categories->slug])}}">
            {{$categories->name}}
        </a>
    </li>
    @endif
    @endforeach
</ul>
@endif