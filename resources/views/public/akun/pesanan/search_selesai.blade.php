@if(count($orders->where('transaction_status', 4)->where('payment_status', 2)) > 0)
<!-- Start Ada Pesanan -->
@foreach($orders->where('transaction_status', 4)->where('payment_status', 2) as $order_done)
<div class="pt-list-order">
    <div class="grid_layouts head-pt-list-order">
        <div class="bx-head-mns code-order">
            <h5 class="nocode main-sub-text f-Asap_medium">
                {{$order_done->transaction_code}}
            </h5>
            <h6 class="clr-light-gry text-capitalize mb-0">
                {{ Carbon\Carbon::parse($order_done->created_at)->format('d F Y') }}
            </h6>
        </div>
        <div class="bx-head-mns stts-order">
            <h6 class="clr-light-gry small-fnt text-capitalize">status pesanan :</h6>
            <div class="stts-listjhdd --trsgc">
                {{--Selesai--}}
                <div class="status-order --done">
                    <h6 class="small-fnt text-capitalize mb-0 stts-order-text">{{$order_done->p_status}}</h6>
                </div>
                <div class="tracking-section">
                    <button class="btn-vegan txt-btn text-capitalize f-Asap_medium small-fnt" data-toggle="modal" data-target="#detStts-done-{{$order_done->id}}" data-backdrop="static" data-keyboard="false">lacak pesanan</h6>
                </div>
            </div>
        </div>
        <div class="bx-head-mns ttl-order">
            <h6 class="clr-light-gry small-fnt text-capitalize">total pembayaran :</h6>
            <h5 style="color: #FA591D;" class="mb-0 f-Asap_medium desc-main-text">
                Rp. {{ number_format($order_done->grandtotal ,2,",",".")}}
            </h5>
        </div>
    </div>
    <div class="body-pt-list-order">
        <div class="accordion" id="accordionProduct">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <button class="btn-vegan txt-btn" type="button" data-toggle="collapse" data-target="#listsproducts_{{$order_done->id}}" aria-expanded="true" aria-controls="listsproducts_{{$order_done->id}}">
                        Daftar Belanja (<span id="total_all" class="constantformatnumberCN" data-content="{{count($order_done->details)}}">{{count($order_done->details)}}</span>)
                        <span class="icn-arrow" style="background-image: url('{{ asset('dist/fe/icons/arrow-grey.png') }}')"></span>
                    </button>
                </div>
                <div id="listsproducts_{{$order_done->id}}" class="collapse show" aria-labelledby="headinglistsproducts_{{$order_done->id}}" data-parent="#accordionProduct">
                    <div class="grid_layouts card-body">
                        @if($search == true)
                            @if($order_done->transaction_status == 1 && $order_done->payment_status == 1)
                            <div class="grid_layouts gr-cart-prdct">
                            @else
                            <div class="grid_layouts gr-cart-prdct list-products-all-{{$order_done->id}}" data-qty="{{$order_done->qty}}" data-product="{{$order_done->product_id}}">
                            @endif
                                <div class="cover-img img-lazy small-lazy" data-src="{{ env('APP_DOWNLOAD') . $order_done->media }}"></div>
                                <div class="desc">
                                    <h6 class="prd-title truncate-texts mb-1">
                                        {{ $order_done->name }}
                                    </h6>
                                    <h6 class="prd-price clr-light-gry truncate-texts mb-0">
                                        Rp.{{ number_format($order_done->price ,2,",",".")}} &nbsp;&nbsp; x{{ $order_done->qty}}
                                    </h6>
                                </div>
                            </div>
                        @else
                            @foreach($order_done->details as $item)
                            <div class="grid_layouts gr-cart-prdct list-products-done-{{$order_done->id}}" data-qty="{{$item->qty}}" data-product="{{$item->product_id}}">
                                <div class="cover-img img-lazy small-lazy" data-src="{{ $item->item->cover_image }}"></div>
                                <div class="desc">
                                    <h6 class="prd-title truncate-texts mb-1">
                                        @if($item->product->is_variant == true)
                                        {{ $item->item->name }} - {{ $item->product_variant->name }}
                                        @else
                                        {{ $item->item->name }}
                                        @endif
                                    </h6>
                                    <h6 class="prd-price clr-light-gry truncate-texts mb-0">
                                        Rp.{{ number_format($item->price ,2,",",".")}} &nbsp;&nbsp; x{{ $item->qty}}
                                    </h6>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid_layouts footer-pt-list-order done-mode">
        <div class="pay-shopping">
        {{--<button data-price="{{$order_done->total_belanja}}" data-id="{{$order_done->id}}" class="rebuymainorder_done btn-vegan text-capitalize green-bg-btn f-Asap_medium">
                beli lagi
            </button>--}}
        </div>
        <div class="rincian-view-btns">
            <a href="{{route('akun_pesanan.detail', $order_done->transaction_code)}}" class="view-rincian btn-vegan txt-btn text-capitalize">
                lihat rincian pesanan
                <span class="icn-arrow" style="background-image: url('{{ asset('dist/fe/icons/arrow-grey.png') }}')"></span>
            </a>
        </div>
    </div>
</div>

@if($order_done->transaction_status == 4 && $order_done->payment_status == 2) 
 <!-- Start Modal Rebuy Products -->
 <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
    <div class="modal fade" id="rebuy" tabindex="-1" role="dialog" aria-labelledby="rebuyLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="rebuyLabel">
                        beli lagi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="rebuy-products">
                        <div class="sec-cart form-vegan" id="modl-rebuy">
                            <div id="products-lists-mdl" class="products-lists-mdl --scrlbrr">
                                <div class="middle-cart">
                                    <input id="rebuy_total_lama" type="hidden">
                                    @foreach($order_done->details as $cart)
                                    @if($cart->product->is_variant == true)
                                    @if($cart->product_variant->stock == 0)
                                    <div class="grid_layouts gr-cart-prdct" style="opacity: .5;">
                                    @else
                                    <div class="grid_layouts gr-cart-prdct">
                                    @endif
                                    @else
                                    @if($cart->product->stock == 0)
                                    <div class="grid_layouts gr-cart-prdct" style="opacity: .5;">
                                    @else
                                    <div class="grid_layouts gr-cart-prdct">
                                    @endif
                                    @endif
                                        <div class="rebuys_a custom-control main-form-vg custom-checkbox cart-checkbox">
                                            @if($cart->product->is_variant == true)
                                            <input class="custom-control-input checkbox-cart-input checkbox-rebuy" data-variant="{{$cart->product_variant->id}}" data-harga="{{$cart->product->only_final_price * $cart->qty }}" type="checkbox" id="rebuy-{{$cart->id}}" name="rebuy-{{$cart->product->id}}" data-id="{{$cart->id}}" data-product="{{$cart->product->id}}" data-qty="{{$cart->qty}}" data-stock="{{$cart->product_variant->stock}}">
                                            @else
                                            <input class="custom-control-input checkbox-cart-input checkbox-rebuy" data-variant="0" data-harga="{{$cart->product->only_final_price * $cart->qty }}" type="checkbox" id="rebuy-{{$cart->id}}" name="rebuy-{{$cart->product->id}}" data-id="{{$cart->id}}" data-product="{{$cart->product->id}}" data-qty="{{$cart->qty}}" data-stock="{{$cart->product->stock}}">
                                            @endif
                                            <input type="hidden" value="{{$cart->product->only_final_price * $cart->qty }}" id="price_{{$cart->product->id}}" class="totalPrice">
                                            <label class="custom-control-label" for="rebuy-{{ $cart->product->id }}"></label>
                                        </div>
                                        <div class="rebuys_b cover-img icon-cart img-slider img-lazy" data-src="{{ asset($cart->product->cover_image) }}"></div>
                                        <div class="rebuys_c position-relative h-100">
                                            <div class="desc">
                                                <h6 class="prd-title med-small-fntf-Asap_medium truncate-texts mb-1">
                                                    @if($cart->product->is_variant == true)
                                                    {{ $cart->product->name }} - {{$cart->product_variant->name}}
                                                    @else
                                                    {{ $cart->product->name }}
                                                    @endif
                                                </h6>
                                                @if($cart->product->is_variant == true)
                                                @if($cart->product_variant->stock == 0)
                                                <small id="not_enough_stock_{{ $cart->product_variant->id }}" style="color: red;" class="mb-0 small-fnt">Maaf Stok Yang Tersedia : {{$cart->product_variant->stock}}</small>
                                                @endif
                                                @else
                                                @if($cart->product->stock == 0)
                                                <small id="not_enough_stock_{{ $cart->product->id }}" style="color: red;" class="mb-0 small-fnt">Maaf Stok Yang Tersedia : {{$cart->product->stock}}</small>
                                                @endif
                                                @endif
                                                <input data-qty="{{ $cart->qty }}" class="listsprice rebuy-listsprice rebuyproducts-{{$cart->product->id}}" value="{{ $cart->product->only_final_price }}" id="cart-{{$cart->id}}" data-product="{{$cart->product->id}}" type="hidden">
                                                <input id="price_{{ $cart->product->id }}" type="hidden" class="listHarga rebuy_listsHarga" data-id="{{ $cart->product->id }}" value="{{ $cart->product->only_final_price }}">
                                                <h6 class="prd-price med-small-fnt truncate-texts mb-2 clr-warn">
                                                    {{ $cart->product->final_price }}
                                                </h6>
                                            </div>
                                            <div class="form-vegan">
                                                <input class="input-number form-control qty_input qty_buyagain" data-id="{{ $cart->id }}" data-product="{{ $cart->product->id }}" type="number" name="qty" value="{{ $cart->qty }}" step="1" min="1" data-min="1" max="{{ $cart->product->stock }}" data-max="{{ $cart->product->stock }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="grid_layouts bottom-cart" id="bottom-lists-mdl">
                                <div class="list-menu-cart-top">
                                    <div class="custom-control main-form-vg custom-checkbox mb-0">
                                        <input class="custom-control-input checkbox-cart-input-total checkbox-rebuy-all" type="checkbox" value="all" id="rebuy-pilihsemua">
                                        <label class="custom-control-label text-black text-capitalize pb-0" for="rebuy-pilihsemua">
                                            pilih semua (<span id="total_check">0</span>/<span id="total_chart"></span>)
                                        </label>
                                    </div>
                                </div>
                                <div class="gr-bhsbjsf">
                                    <div class="totalCart">
                                        <small class="text-capitalize clr-light-gry small-fnt">total belanja</small>
                                        <h6 class="totalCount" id="rebuy_totalCount">Rp 0,00</h6>
                                    </div>
                                    <div class="btn-chk">
                                        <input type="hidden" id="rebuy_totalPrice">
                                        <button id="checkoutRebuyDoneAll" class="btn-vegan orange-btn text-capitalize">checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End:/ Modal Rebuy Products -->
@endif

<!-- Start Modal Lacak Order -->
<div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
    <div class="modal fade" id="detStts-done-{{$order_done->id}}" tabindex="-1" role="dialog" aria-labelledby="detStts-done-{{$order_done->id}}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="detStts-done-{{$order_done->id}}Label">
                        status pengiriman
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="mdl-stts">
                        <div class="grid_layouts gr-head-mnsdhshs mdl-padd">
                            <div class="lhsajsha">
                                <div>
                                    <h5 class="mb-0 small-fnt clr-light-gry">
                                        ID Pesanan
                                    </h5>
                                </div>
                                <div class="mn-right sub-mn-right">
                                    <h5 class="text-uppercase mb-0 f-Asap_medium">
                                        {{ $order_done->transaction_code}}
                                    </h5>
                                </div>
                            </div>
                            <div class="lhsajsha">
                                <div>
                                    <h5 class="mb-0 text-capitalize small-fnt clr-light-gry">
                                        tanggal pesanan
                                    </h5>
                                </div>
                                <div class="mn-right sub-mn-right">
                                    <h5 class="mb-0 f-Asap_medium">
                                        {{ Carbon\Carbon::parse($order_done->created_at)->format('d F Y') }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="mdl-padd order-detl">
                            <div class="grid_layouts gr-krss mb-3">
                                <div class="kurir-descs">
                                    @if ($order_done->shipping_code == 'jnt')
                                    <div class="icn-kurirs --jnt"></div>
                                    @elseif ($order_done->shipping_code == 'jne')
                                    <div class="icn-kurirs --jne"></div>
                                    @elseif ($order_done->shipping_code == 'pos')
                                    <div class="icn-kurirs --pos"></div>
                                    @elseif ($order_done->shipping_code == 'sicepat')
                                    <div class="icn-kurirs --sicepat"></div>
                                    @endif
                                    <h6 class="mb-0 text-capitalize clr-gry">
                                        Reguler 2-3 Hari
                                    </h6>
                                </div>
                                <div class="rg-sect">
                                    @if(($order_done->no_resi) != null)
                                    <h5 class="mb-0 text-capitalize main-sub-text f-Asap_medium">
                                        {{$order_done->no_resi}} &nbsp;
                                        <span class="position-relative">
                                            <a data-target="noresimodal" class="copyclp position-relative btn-ouzen txt-btn clr-blue main-sub-text-mid" data-clipboard-text="{{$order_done->no_resi}}" type="button">
                                                salin
                                            </a>
                                            <div class="ct-tggle ct-tggletp" id="ct-tgglenoresimodal" style="display: none;">
                                                <div class="position-relative">
                                                    <small class="small-fnt">Copied</small>
                                                    <div class="mn-arrw"></div>
                                                </div>
                                            </div>
                                        </span>
                                    </h5>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mdl-padd lst-mn-stts">
                            <div class="stts-order">
                                <ul>
                                    {{--@if($waybill != '')
                                        @foreach($waybill as $w)
                                        <li class="mnu-stts">
                                            <div>
                                                <h6 class="mid-main-sub-text lnk-stts">{{$w->manifest_date}}</h6>
                                                <h6 class="mid-main-sub-text lnk-stts">{{$w->manifest_time}}</h6>
                                            </div>
                                            <div class="chcks">
                                                <div class="chck-icn"></div>
                                            </div>
                                            <div>
                                                <h6 class="mid-main-sub-text  text-capitalize">{{ $w->manifest_description}} - {{ $w->city_name}}</h6>
                                            </div>
                                        </li>
                                        @endforeach
                                    @endif--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End:/ Modal Lacak Order -->
@endforeach
<!-- End:/ Ada Pesanan -->
@else
<!-- Start Tidak Ada Pesanan -->
<div class="card-no-post-list">
    <div class="no-post-list">
        <div class="img-no-post img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/no-cart.png') }}"></div>
        <div class="desc-no-post">
            <h6 class="text-capitalize f-Asap_medium main-sub-text">belum ada belanjaan</h6>
            <p class="clr-light-gry">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Diam pretium adipiscing eleifend lectus. Et orci ornare habitant.
            </p>
            <a href="{{ route('produk') }}" class="btn-vegan text-capitalize text-center btn-shopping">mulai belanja</a>
        </div>
    </div>
</div>
<!-- End:/ Tidak Ada Pesanan -->
@endif

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            /*start: Check and Unchecked Cart Rebuy */
            $('#rebuy').on('shown.bs.modal', function(e) {
                $(".checkbox-rebuy").prop('checked', false);
                $("#rebuy-pilihsemua").prop('checked', false);
                var check_cart = $('.checkbox-rebuy:checkbox');
                var check_cart_total = $('.checkbox-rebuy-all:checkbox');
                var total_all_check= $('.checkbox-rebuy').length;
                $('#total_chart').html(total_all_check);
                $('#rebuy-pilihsemua').val(0);
                $('#rebuy_total_lama').val(0);
                $('.qty_input').prev().addClass('number-minus-rebuy');
                $('.qty_input').next().addClass('number-plus-rebuy');
                
                // start: checked every input
                $(".checkbox-rebuy").click(function(){
                    var total_check= $('.checkbox-rebuy:checked').length;
                    $('#total_check').html(total_check);

                    if($(this).is(':checked')) {
                        if($('#total_check').text() == $('#total_chart').text()){
                            $('#rebuy-pilihsemua').prop('checked', true);
                        }
                        else{
                            $('#rebuy-pilihsemua').prop('checked', false);
                        }

                        if($('#rebuy_total_lama').val() == 0){
                            var prices = parseInt($(this).data('harga'));
                            var qty = $(this).data('qty');

                            var jumlah = prices*qty;
                            $('#rebuy_total_lama').val(jumlah);
                            $('#rebuy_totalPrice').val(jumlah);
                        }
                        else{
                            var lama = parseInt($('#rebuy_total_lama').val());
                            var prices = parseInt($(this).data('harga'));
                            var qty = $(this).data('qty');
                            var baru = prices*qty;

                            var jumlah =  lama+baru;
                            $('#rebuy_total_lama').val(jumlah);
                            $('#rebuy_totalPrice').val(jumlah);
                        }
                    }
                    else{
                        if($('#total_check').text() == $('#total_chart').text()){
                            $('#rebuy-pilihsemua').prop('checked', true);
                        }
                        else{
                            $('#rebuy-pilihsemua').prop('checked', false);
                        }

                        if($('#rebuy_total_lama').val() == 0){
                            var prices = parseInt($(this).data('harga'));
                            var qty = $(this).data('qty');

                            var jumlah = prices*qty;
                            $('#rebuy_total_lama').val(jumlah);
                            $('#rebuy_totalPrice').val(jumlah);
                        }
                        else{
                            var lama = parseInt($('#rebuy_total_lama').val());
                            var prices = parseInt($(this).data('harga'));
                            var qty = $(this).data('qty');
                            var baru = prices*qty;

                            var jumlah =  lama-baru;
                            $('#rebuy_total_lama').val(jumlah);
                            $('#rebuy_totalPrice').val(jumlah);
                        }
                    }

                    var harga = parseInt($('#rebuy_total_lama').val());
                    var reverse = harga.toString().split('').reverse().join(''),
                        ribuan  = reverse.match(/\d{1,3}/g);
                        ribuan  = ribuan.join('.').split('').reverse().join('');

                    $('#rebuy_totalCount').html('Rp '+ribuan+',00');
                    $('#rebuy_totalPrice').val(harga);
                });
                // end:/ checked every input

                function hitungTotalRebuy() {
                    var total = 0;
                    var average = 0;
                    $('.checkbox-rebuy').each(function () {
                        var prices = parseInt($(this).data('harga'));
                        var qty = $(this).data('qty');
                        var counttotal = parseInt(prices*qty);
                        if (!isNaN(prices) && prices.length != 0) {
                            total += counttotal;
                        }
                    });

                    if (!isNaN(total) && total != 0) {
                        var txtboxes = $('.checkbox-rebuy').length;
                        average = parseInt(total) / txtboxes;
                    }

                    var reverse = total.toString().split('').reverse().join(''),
                        ribuan  = reverse.match(/\d{1,3}/g);
                        ribuan  = ribuan.join('.').split('').reverse().join('');

                    $('#rebuy_totalCount').text('Rp '+ribuan+',00');
                    $('#rebuy_total_lama').val(total);
                    $('#rebuy_totalPrice').val(total);
                }

                // start: checked all input
                $("#rebuy-pilihsemua").click(function(){
                    if($('.checkbox-rebuy').length == 1){
                        if($('.checkbox-rebuy').data('stock') == 0){
                            Swal.fire({
                                type: 'error',
                                title: 'Mohon maaf',
                                text: 'Produk ini telah habis terjual',
                                allowOutsideClick: false
                            })
                            $('#rebuy-pilihsemua').prop('checked', false);
                        }
                    }
                    else if($(this).is(":checked")) {
                        $(".checkbox-rebuy").attr({
                            "data-checked" : 'yes',
                        });

                        $('.checkbox-rebuy').each(function () {
                            // if( $(this).data('stock') == 0){
                            //     $(this).prop('checked', false);
                            // }else{
                                $(this).prop('checked', true);
                            // }
                        });
                        var total_check= $('.checkbox-rebuy:checked').length;
                        $('#total_check').html(total_check);

                        if($('#total_check').text() == $('#total_chart').text()){
                            hitungTotalRebuy();
                        }
                    }
                    else if(!$(this).is(":checked")) {
                        $(".checkbox-rebuy").attr({
                            "data-checked" : 'no',
                        });
                        $(".checkbox-rebuy").prop('checked', false);
                        $('#total_check').html(0);
                        $('#rebuy_totalCount').text('Rp '+0+',00');
                        $('#rebuy_total_lama').val(0);
                    }
                });
                // end:/ checked all input

                // start: input number
                $(".number-plus").bind('keyup mouseup change', function () {
                    if($(this).hasClass('number-plus-rebuy')){
                        var max = $(this).prev().data('max');
                        var qtys= +$(this).prev().val() + 1 > max ? max : +$(this).prev().val() + 1;
                        var products_id= $(this).prev().data('product');
                        var cart_id = $(this).prev().data('id');
                        $('.rebuyproducts-'+products_id+'').attr('data-qty', qtys);
                        $('input[name="rebuy-'+products_id+'"]').attr('data-qty', qtys);
                        $('input[name="rebuy-'+products_id+'"]').data('qty', qtys);

                    }
                });

                $(".number-minus").bind('keyup mouseup change', function () {
                    if($(this).hasClass('number-minus-rebuy')){
                        var min = $(this).next().data('min');
                        var cart_id = $(this).next().data('id')
                        var qtys = +$(this).next().val() - 1 < min ? min : +$(this).next().val() - 1;
                        var products_id= $(this).next().data('product');
                        $('.rebuyproducts-'+products_id+'').attr('data-qty', qtys);
                        $('input[name="rebuy-'+products_id+'"]').attr('data-qty', qtys);
                        $('input[name="rebuy-'+products_id+'"]').data('qty', qtys);
                    }
                });
                // end:/ input number

                $('#checkoutRebuy').on('click',function (e) {
                    e.preventDefault();
                    var id_product   = [];
                    var qty_buy_again   = [];
                    var id_variant   = [];
                    var hasilchck = $('#rebuy_totalPrice').val();

                    $.each($('.checkbox-rebuy'),function(index){
                        if($(this).is(":checked")){
                            id_product[index] = $(this).data('product');
                        }
                    });

                    $.each($('.checkbox-rebuy'),function(index){
                        if($(this).is(":checked")){
                            qty_buy_again[index] = $(this).data('qty');
                        }
                    });

                    $.each($('.checkbox-rebuy'),function(index){
                        if($(this).is(":checked")){
                            id_variant[index] = $(this).data('variant');
                        }
                    });

                    $.ajax({
                        url: "{{ route('rebuy') }}",
                        method: 'POST',
                        dataType: "json",
                        data: {
                            id_product: id_product,
                            qty: qty_buy_again,
                            variant: id_variant,
                            prc: hasilchck,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if(response.success == true){
                                console.log(response);
                                Swal.fire({
                                    type: 'success',
                                    title: 'Terimakasih',
                                    text: 'Anda akan diarahkan ke halaman checkout',
                                    allowOutsideClick: false
                                }).then(function() {
                                    window.location = response.redirect;
                                });
                                // window.location = '{{ route("checkout.index") }}';
                            }
                            // else if(response.no_stock == true){
                            //     Swal.fire({
                            //         type: 'error',
                            //         title: 'Maaf!',
                            //         text: 'Stok Produk Tidak Tersedia!',
                            //     }).then(function() {
                            //         if(response.product.is_variant == true){
                            //             $('#not_enough_stock_'+response.cart.id+'').html('Maaf, jumlah stok yang tersisa adalah '+response.cart.stock+'')
                            //         }
                            //         else{
                            //             $('#not_enough_stock_'+response.product.id+'').html('Maaf, jumlah stok yang tersisa adalah '+response.product.stock+'')
                            //         }
                            //     });
                            // }
                            else{
                                Swal.fire({
                                    type: 'error',
                                    title: 'Error!',
                                    text: 'Mohon cek kembali inputan Anda',
                                    allowOutsideClick: false
                                });
                            }
                        },
                        error : function (xhr) {
                            Swal.fire({
                                title: "Ups!",
                                text: "Mohon cek kembali inputan Anda",
                                type: "error",
                                allowOutsideClick: false
                            });
                            // .then(function() {
                            //     window.location.reload()
                            // });
                        }
                    });
                });
            });
            /*end:/ Check and Unchecked Cart Rebuy */

            /********************************/
            /*Rebuy Produk*/
            /********************************/
            $('#checkoutRebuyDoneAll').on('click',function (e) {
                e.preventDefault();
                var id_product   = [];
                var qty_buy_again   = [];
                var id_variant   = [];
                var hasilchck = $('#rebuy_totalPrice').val();

                $.each($('.checkbox-rebuy'),function(index){
                    if($(this).is(":checked")){
                        id_product[index] = $(this).data('product');
                    }
                });

                $.each($('.checkbox-rebuy'),function(index){
                    if($(this).is(":checked")){
                        qty_buy_again[index] = $(this).data('qty');
                    }
                });

                $.each($('.checkbox-rebuy'),function(index){
                    if($(this).is(":checked")){
                        id_variant[index] = $(this).data('variant');
                    }
                });

                $.ajax({
                    url: "{{ route('rebuy') }}",
                    method: 'POST',
                    dataType: "json",
                    data: {
                        id_product: id_product,
                        qty: qty_buy_again,
                        variant: id_variant,
                        prc: hasilchck,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if(response.success == true){
                            console.log(response);
                            Swal.fire({
                                type: 'success',
                                title: 'Terimakasih',
                                text: 'Anda akan diarahkan ke halaman checkout',
                                allowOutsideClick: false
                            }).then(function() {
                                window.location = response.redirect;
                            });
                            // window.location = '{{ route("checkout.index") }}';
                        }
                        // else if(response.no_stock == true){
                        //     Swal.fire({
                        //         type: 'error',
                        //         title: 'Maaf!',
                        //         text: 'Stok Produk Tidak Tersedia!',
                        //     }).then(function() {
                        //         if(response.product.is_variant == true){
                        //             $('#not_enough_stock_'+response.cart.id+'').html('Maaf, jumlah stok yang tersisa adalah '+response.cart.stock+'')
                        //         }
                        //         else{
                        //             $('#not_enough_stock_'+response.product.id+'').html('Maaf, jumlah stok yang tersisa adalah '+response.product.stock+'')
                        //         }
                        //     });
                        // }
                        else{
                            Swal.fire({
                                type: 'error',
                                title: 'Error!',
                                text: 'Mohon cek kembali inputan Anda',
                                allowOutsideClick: false
                            });
                        }
                    },
                    error : function (xhr) {
                        Swal.fire({
                            title: "Ups!",
                            text: "Mohon cek kembali inputan Anda",
                            type: "error",
                            allowOutsideClick: false
                        });
                        // .then(function() {
                        //     window.location.reload()
                        // });
                    }
                });
            });
        });
    </script>
@endpush