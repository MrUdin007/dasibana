<div class="sidebar-set-vegan --scrlbrr" id="hgt-acc">
    <div class="head-sdr" id="headakun">
        <div class="grid_layouts profile-sc">
            <div class="user-avatar-container">
                <div class="rounded-circle img-lazy images-slider small-lazy" data-src="@if(auth('fe')->user()->image != null) {{ asset(env('APP_DOWNLOAD').auth('fe')->user()->image) }} @else {{ asset(auth('fe')->user()->avatar) }} @endif"></div>
            </div>
            <a href="{{ route('akun.profile') }}" class="text-capitalize f-Asap_medium text-black">
                {{auth('fe')->user()->name}}
            </a>
        </div>
        <div class="close-menu">
            <button id="cls-akun" class="close-mn btn-vegan txt-btn" type="button">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="list-menu-sd">
        <ul class="ls-sd-acc-lnk">
            <li class="lst-mn-sd {{ (Route::is('akun_point') || Route::is('akun_detail_voucher')) ? 'active' : '' }}">
                <a class="lnk-mn sd-acc-lnk" href="{{ route('akun_point') }}">
                    Veganesia Poin @if(auth('fe')->user()->point > 0) (<span class="constantformatnumber" data-content="{{ auth('fe')->user()->point }}">{{ auth('fe')->user()->point }}</span>) @endif
                </a>
            </li>
            <li class="lst-mn-sd {{ (Route::is('akun.profile')) ? 'active' : '' }}">
                <a class="lnk-mn sd-acc-lnk" href="{{ route('akun.profile') }}">
                    Akun Saya
                </a>
            </li>
            <li class="lst-mn-sd {{ (Route::is('akun_mykupon') || Route::is('akun_detail_mykupon')) ? 'active' : '' }}">
                <a class="lnk-mn sd-acc-lnk" href="{{ route('akun_mykupon') }}">
                    Kupon Saya @if(count(auth('fe')->user()->kupon) > 0) (<span class="constantformatnumber" data-content="{{count(auth('fe')->user()->kupon)}}">{{count(auth('fe')->user()->kupon)}}</span>) @endif
                </a>
            </li>
            <li class="lst-mn-sd {{ (Route::is('akun_fav')) ? 'active' : '' }}">
                <a class="lnk-mn sd-acc-lnk" href="{{ route('akun_fav') }}">
                    Barang Favorit
                </a>
            </li>
            <li class="lst-mn-sd {{ (Route::is('akun_pesanan') || Route::is('akun_pesanan.*') || Route::is('akun_pesanan_bayar.*')) ? 'active' : '' }}">
                <a class="lnk-mn sd-acc-lnk" href="{{ route('akun_pesanan') }}">
                    Pesanan Saya
                </a>
            </li>
        </ul>
    </div>
    <div class="bttm-sdr">
        <a href="javascript:void(0)" onclick="$('#formLogout').submit();">
            log out
        </a>
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
                var totalHeight = mxHght-(hgtHeader+30);
                $('#hgt-acc').css('max-height', totalHeight);
            }
            if (window.matchMedia('(max-width: 575px)').matches) {
                var hgtHeader1 = $('#hgt-headermob').height()
                var totalHeight = mxHght-(hgtHeader1+30);
                $('#hgt-acc').css('max-height', totalHeight);
            }
        });
    </script>
@endpush