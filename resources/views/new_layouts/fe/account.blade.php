{{--
<div class="text-center lst-knvc {{ (Route::is('akun_point')) ? 'active' : '' }}">
    <a href="{{route('akun_point')}}" class="sd-acc-lnk small-fnt text-capitalize">
        <span class="text-left">
            poin 
            @if(($point) > 0)
                (<span class="constantformatnumber" data-content="{{$point}}">
                    {{$point}}
                </span>)
            @else
                0
            @endif
        </span>
    </a>
</div>
<div class="text-center lst-knvc {{ (Route::is('akun_voucher')) ? 'active' : '' }}">
    <a href="{{route('akun_voucher')}}" class="sd-acc-lnk small-fnt text-capitalize">
        <span class="text-left">
            voucher 
            @if(($voucher) > 0)
                (<span class="constantformatnumber" data-content="{{$voucher}}">
                    {{$voucher}}
                </span>)
            @else
                0
            @endif
        </span>
    </a>
</div>
--}}