<div class="sidebar-prdct-vegan">
    <div class="head-sdr" id="hgt-ttle">
        <form class="form-vegan" autocomplete="off" id="formSearchProduk" action="" method="get">
            <div class="input-group search-inputs">
                <input id="globalSearchProduk" name="searchProduk" type="text" class="form-control --search" placeholder="Mau cari apa kak?" aria-label="" aria-describedby="search" @if(isset(request()->searchProduk)) value="{{request()->searchProduk}}" @endif>
                <div class="input-group-prepend">
                    <span class="input-group-text --nobg" id="searchProduk">
                        <button class="search-icn" type="button"></button>
                    </span>
                </div>
            </div>
        </form>
        <div class="close-menu">
            <button id="cls-produk" class="close-mn btn-vegan txt-btn" type="button">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="list-menu-sdr accordion">
        <div class="list-menu-filter --filter">
            <div class="title-menu-sdr" id="kategoriproduk">
                <h5 class="text-capitalize main-sub-text f-Asap_medium">
                    Kategori Produk
                </h5>
            </div>
            <ul class="mb-0 list-category --scrlbrr accordion" id="filter">
                <li>
                    <a class="text-capitalize sidebar_category_list sidebar_category_list_all {{ (Route::is('produk')) ? 'active' : '' }}" href="javascript:void(0)" data-slug="all-categry">
                        Semua
                    </a>
                </li>
                @foreach($category_list as $categorylist)
                @if($categorylist->depth < 1)
                <li id="ids_{{$categorylist->id}}">
                    @if(count($categorylist->children) > 0)
                    <div class="position-relative">
                        <a href="javascript:void(0)" class="text-capitalize sidebar-ctgr-sub child-child-{{$categorylist->id}} sidebar_category_list_parent" data-parent="parent-{{$categorylist->slug}}" data-slug="{{$categorylist->slug}}">
                            {{$categorylist->name}}
                        </a>
                        <button class="arrow-sidebar-products btn-vegan collapsed" type="button" data-toggle="collapse" data-target="#side_{{$categorylist->slug}}" aria-expanded="false" aria-controls="side_{{$categorylist->slug}}">
                            <i class="fas fa-angle-right"></i>
                        </button>
                    </div>
                    <ul id="side_{{$categorylist->slug}}" class="multiple-menus collapse" aria-labelledby="ids_{{$categorylist->id}}" data-parent="#filter">
                        @foreach($categorylist->children as $category_categorylist)
                        <li>
                            <a href="javascript:void(0)" data-child="child-{{$categorylist->id}}" class="parent-parent-{{$categorylist->slug}} text-capitalize sidebar_category_list_child" data-slug="{{$category_categorylist->slug}}">
                                {{$category_categorylist->name}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <a href="javascript:void(0)" class="text-capitalize sidebar_category_list" data-slug="{{$categorylist->slug}}">
                        {{$categorylist->name}}
                    </a>
                    @endif
                </li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            /********************************/
            /*Responsive Sidebar*/
            /********************************/
            if (window.matchMedia('(max-width: 991px)').matches) {
                var mxHght = $(window).height();
                var hgtHeader = $('#hgt-header').height();
                var hgttle = $('#hgt-ttle').height();
                var totalHeight = mxHght-(hgtHeader+hgttle+50);
            }
            if (window.matchMedia('(max-width: 575px)').matches) {
                var hgtHeader1 = $('#hgt-headermob').height()
                var totalHeight = mxHght-(hgtHeader1+hgttle+50);
                $('#filter').css('max-height', totalHeight);
            }
        });
    </script>
@endpush