@if(count($orders) > 0)
<!-- Start Ada Pesanan -->
@foreach($orders as $order_all)
<div class="pt-list-order">
    <div class="grid_layouts head-pt-list-order">
        <div class="bx-head-mns code-order">
            <h5 class="nocode main-sub-text f-Asap_medium">
                {{$order_all->transaction_code}}
            </h5>
            <h6 class="clr-light-gry text-capitalize mb-0">
                {{ Carbon\Carbon::parse($order_all->created_at)->format('d F Y') }}
            </h6>
        </div>
        <div class="bx-head-mns stts-order">
            <h6 class="clr-light-gry small-fnt text-capitalize">status pesanan :</h6>
            @if($order_all->transaction_status == 2 || $order_all->transaction_status == 3 || $order_all->transaction_status == 4 && $order_all->payment_status == 2)
            <div class="stts-listjhdd --trsgc">
            @else
            <div class="stts-listjhdd">
            @endif
                @if ($order_all->transaction_status == 1 && $order_all->payment_status == 2)
                {{--sudah dibayar--}}
                <div class="status-order --new-order">
                @elseif ($order_all->transaction_status == 1 && $order_all->payment_status == 1) 
                {{--Menunggu Pembayaran--}}
                <div class="status-order --waiting">
                @elseif ($order_all->transaction_status == 2 && $order_all->payment_status == 2) 
                {{--Diproses--}}
                <div class="status-order --process">
                @elseif ($order_all->transaction_status == 3 && $order_all->payment_status == 2) 
                {{--Dikirim--}}
                <div class="status-order --sent">
                @elseif ($order_all->transaction_status == 4 && $order_all->payment_status == 2) 
                {{--Selesai--}}
                <div class="status-order --done">
                @elseif ($order_all->transaction_status == 5 && $order_all->payment_status == 1) 
                {{--Dibatalkan--}}
                <div class="status-order --cancel">
                @endif
                    <h6 class="small-fnt text-capitalize mb-0 stts-order-text">{{$order_all->p_status}}</h6>
                </div>
                @if($order_all->transaction_status == 2 && $order_all->payment_status == 2) 
                <div class="tracking-section">
                    <button class="btn-vegan txt-btn text-capitalize f-Asap_medium small-fnt --nonactive-track">lacak pesanan</h6>
                </div>
                @elseif($order_all->transaction_status == 3 || $order_all->transaction_status == 4 && $order_all->payment_status == 2)
                <div class="tracking-section">
                    <button class="btn-vegan txt-btn text-capitalize f-Asap_medium small-fnt" data-toggle="modal" data-target="#detStts-all-{{$order_all->id}}" data-backdrop="static" data-keyboard="false">lacak pesanan</h6>
                </div>
                @endif
            </div>
        </div>
        <div class="bx-head-mns ttl-order">
            <h6 class="clr-light-gry small-fnt text-capitalize">total pembayaran :</h6>
            <h5 style="color: #FA591D;" class="mb-0 f-Asap_medium desc-main-text">
                Rp. {{ number_format($order_all->grandtotal ,2,",",".")}}
            </h5>
        </div>
    </div>
    <div class="body-pt-list-order">
        <div class="accordion" id="allaccordionProduct">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <button class="btn-vegan txt-btn" type="button" data-toggle="collapse" data-target="#listsproducts_{{$order_all->id}}" aria-expanded="true" aria-controls="listsproducts_{{$order_all->id}}">
                        Daftar Belanja (<span id="total_all" class="constantformatnumberCN" data-content="{{count($order_all->details)}}">{{count($order_all->details)}}</span>)
                        <span class="icn-arrow" style="background-image: url('{{ asset('dist/fe/icons/arrow-grey.png') }}')"></span>
                    </button>
                </div>
                <div id="listsproducts_{{$order_all->id}}" class="collapse show" aria-labelledby="headinglistsproducts_{{$order_all->id}}" data-parent="#allaccordionProduct">
                    <div class="grid_layouts card-body">
                        @if($search == true)
                            @if($order_all->transaction_status == 1 && $order_all->payment_status == 1)
                            <div class="grid_layouts gr-cart-prdct">
                            @else
                            <div class="grid_layouts gr-cart-prdct list-products-all-{{$order_all->id}}" data-qty="{{$order_all->qty}}" data-product="{{$order_all->product_id}}">
                            @endif
                                <div class="cover-img img-lazy small-lazy" data-src="{{ env('APP_DOWNLOAD') . $order_all->media }}"></div>
                                <div class="desc">
                                    <h6 class="prd-title truncate-texts mb-1">
                                        {{ $order_all->name }}
                                    </h6>
                                    <h6 class="prd-price clr-light-gry truncate-texts mb-0">
                                        Rp.{{ number_format($order_all->price ,2,",",".")}} &nbsp;&nbsp; x{{ $order_all->qty}}
                                    </h6>
                                </div>
                            </div>
                        @else
                            @foreach($order_all->details as $item)
                            @if($order_all->transaction_status == 1 && $order_all->payment_status == 1)
                            <div class="grid_layouts gr-cart-prdct">
                            @else
                            <div class="grid_layouts gr-cart-prdct list-products-all-{{$order_all->id}}" data-qty="{{$item->qty}}" data-product="{{$item->product_id}}">
                            @endif
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

    @if($order_all->transaction_status == 1 && $order_all->payment_status == 1)
    <div class="grid_layouts footer-pt-list-order waiting-mode">
    @elseif($order_all->transaction_status == 3 && $order_all->payment_status == 2)
    <div class="grid_layouts footer-pt-list-order send-mode">
    @elseif($order_all->transaction_status == 4 && $order_all->payment_status == 2)
    <div class="grid_layouts footer-pt-list-order done-mode">
    @elseif($order_all->transaction_status == 5 && $order_all->payment_status == 1)
    <div class="grid_layouts footer-pt-list-order done-mode">
    @else
    <div class="grid_layouts footer-pt-list-order">
    @endif
        @if($order_all->transaction_status == 1 && $order_all->payment_status == 1) 
        <div class="pay-shopping">
            <a href="{{ route('akun_pesanan_bayar.detail', $order_all->transaction_code) }}" class="text-center btn-vegan text-capitalize orange-btn f-Asap_medium">
                bayar belanjaan
            </a>
        </div>
        @elseif($order_all->transaction_status == 3 && $order_all->payment_status == 2)
        <div class="pay-shopping">
            <button class="text-center btn-vegan text-capitalize orange-btn f-Asap_medium receivedProductMain" data-id="{{$order_all->id}}" data-code="{{$order_all->transaction_code}}">
                terima barang
            </button>
        </div>
        @elseif($order_all->transaction_status == 4 && $order_all->payment_status == 2)
        <div class="pay-shopping">
        {{--<button data-id="{{$order_all->id}}" class="getDoneRebuyProduct btn-vegan text-capitalize green-bg-btn f-Asap_medium">
                beli lagi
            </button>--}}
        </div>
        @elseif($order_all->transaction_status == 5 && $order_all->payment_status == 1)
        <div class="pay-shopping">
        {{--<button data-price="{{$order_all->total_belanja}}" data-id="{{$order_all->id}}" class="btn-vegan text-capitalize green-bg-btn f-Asap_medium"  data-toggle="modal" data-target="#rebuy{{$order_all->id}}">
                beli lagi
            </button>--}}
        </div>
        @endif
        @if($order_all->transaction_status == 1 && $order_all->payment_status == 1) 
        <div>
            <h6 class="clr-light-gry small-fnt text-capitalize mb-0">bayar sebelum : </h6>
        </div>
        <div class="ft-date-order">
            <div class="icn-bell img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/bell.png') }}"></div>
            <h6 class="clr-lght-gsh mb-0">
                {{ Carbon\Carbon::parse($order_all->transaction_date)->format('d F Y H:i') }}
            </h6>
        </div>
        @elseif($order_all->transaction_status == 3 && $order_all->payment_status == 2) 
        <div class="ft-date-order">
            <div class="icn-bell img-lazy small-lazy loaded" data-src="{{ asset('dist/fe/icons/bell.png') }}"></div>
            <h6 class="clr-light-gry mb-0 text-capitalize f-Asap_italic">
                mohon konfirmasi jika barang sudah diterima
            </h6>
        </div>
        @endif
        <div class="rincian-view-btns">
            <a href="{{route('akun_pesanan.detail', $order_all->transaction_code)}}" class="view-rincian btn-vegan txt-btn text-capitalize">
                @if($order_all->transaction_status == 5 && $order_all->payment_status == 1)
                lihat rincian pembatalan
                @else
                lihat rincian pesanan
                @endif
                <span class="icn-arrow" style="background-image: url('{{ asset('dist/fe/icons/arrow-grey.png') }}')"></span>
            </a>
        </div>
    </div>
</div>

<!-- Start Modal Lacak Order -->
<div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
    <div class="modal fade" id="detStts-all-{{$order_all->id}}" tabindex="-1" role="dialog" aria-labelledby="detStts-all-{{$order_all->id}}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="detStts-all-{{$order_all->id}}Label">
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
                                        {{ $order_all->transaction_code}}
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
                                        {{ Carbon\Carbon::parse($order_all->created_at)->format('d F Y') }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="mdl-padd order-detl">
                            <div class="grid_layouts gr-krss mb-3">
                                <div class="kurir-descs">
                                    @if ($order_all->shipping_code == 'jnt')
                                    <div class="icn-kurirs --jnt"></div>
                                    @elseif ($order_all->shipping_code == 'jne')
                                    <div class="icn-kurirs --jne"></div>
                                    @elseif ($order_all->shipping_code == 'pos')
                                    <div class="icn-kurirs --pos"></div>
                                    @elseif ($order_all->shipping_code == 'sicepat')
                                    <div class="icn-kurirs --sicepat"></div>
                                    @endif
                                    <h6 class="mb-0 text-capitalize clr-gry">
                                        Reguler 2-3 Hari
                                    </h6>
                                </div>
                                <div class="rg-sect">
                                    @if(($order_all->no_resi) != null)
                                    <h5 class="mb-0 text-capitalize main-sub-text f-Asap_medium">
                                        {{$order_all->no_resi}} &nbsp;
                                        <span class="position-relative">
                                            <a data-target="noresimodal" class="copyclp position-relative btn-ouzen txt-btn clr-blue main-sub-text-mid" data-clipboard-text="{{$order_all->no_resi}}" type="button">
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
            <a href="{{ route('produk') }}" class="btn-vegan text-capitalize text-center btn-shopping">mulai belanja</a>
        </div>
    </div>
</div>
<!-- End:/ Tidak Ada Pesanan -->
@endif

<!-- Start Modal Rebuy Products -->
<div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
    <div class="modal fade" id="Mainrebuy" tabindex="-1" role="dialog" aria-labelledby="rebuyLabel" aria-hidden="true">
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
                        <div class="sec-cart form-vegan" id="modl-rebuy-all-main"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End:/ Modal Rebuy Products -->

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            /*start: Get Rebuy Products */
            $('.getDoneRebuyProduct').on('click',function (e) {
                e.preventDefault();
                id = $(this).data('id');

                $.ajax({
                    url: "{{ route('rebuy_product') }}",
                    method: 'POST',
                    dataType: "json",
                    data: {
                        id_transaction: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        var html  = '';
                        var response = data.product;
                        $.each(response, function(i,v){
                            html += '<div id="products-lists-mdl" class="products-lists-mdl --scrlbrr">'
                                html += '<div class="middle-cart">'
                                    html += '<input id="rebuy_total_lama" type="hidden">'
                                    html += '<div class="grid_layouts gr-cart-prdct">'
                                        html += '<div class="rebuys_a custom-control main-form-vg custom-checkbox cart-checkbox">'
                                            {{--html += '<input class="custom-control-input checkbox-cart-input checkbox-rebuy" data-variant="0" data-harga="{{$cart->product->only_final_price * $cart->qty }}" type="checkbox" id="rebuy-{{$cart->id}}" name="rebuy-{{$cart->product->id}}" data-id="{{$cart->id}}" data-product="{{$cart->product->id}}" data-qty="{{$cart->qty}}" data-stock="{{$cart->product->stock}}">';
                                            html += '<input type="hidden" value="{{$cart->product->only_final_price * $cart->qty }}" id="price_{{$cart->product->id}}" class="totalPrice">';
                                            html += '<label class="custom-control-label" for="rebuy-{{ $cart->product->id }}"></label>';--}}
                                        html += '</div>';
                                        html += '<div class="rebuys_b cover-img icon-cart img-slider img-lazy" data-src="'+v.media+'"></div>'
                                        html += '<div class="rebuys_c position-relative h-100">'
                                    
                                        html += '</div>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                            html += '<div class="grid_layouts bottom-cart" id="bottom-lists-mdl">'
                                
                            html += '</div>';
                        });
                        $('#modl-rebuy-all-main').html(html);
                        $('#Mainrebuy').modal({
                            backdrop: 'static', 
                            keyboard: false
                        });
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
            /*End:/ Get Rebuy Products */
            
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