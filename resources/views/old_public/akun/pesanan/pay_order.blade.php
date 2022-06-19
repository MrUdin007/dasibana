@extends('layouts.fe.fe')

@section('metadata')
    <title>Veganesia - Informasi Pembayaran {{$order_detail->transaction_code}}</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/akun/pesanan/pay_order.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/fe/css/content/sidebar_akun.css') }}">
@endpush

@section('content')
    <div class="akun-payorder">
        <!-- Content Profile -->
        <!-- ============================================================== -->
        <section class="sec-akun-payorder container">
            <!-- Sidebar Akun Mobile -->
            <!-- ============================================================== -->
            <div class="mob-sdbr-acc mobl-sdbr-acc">
                <button id="filter-akun" class="btn-vegan green-bg-btn text-capitalize" type="button">
                    <span><i class="fas fa-sliders-h"></i></span>
                    &nbsp;filter
                </button>
            </div>
            <!-- ============================================================== -->
            <!-- End Sidebar Akun Mobile -->

            <div class="grid_layouts gr-akun">
                <div>
                    <!-- Sidebar Akun Desktop -->
                    <!-- ============================================================== -->
                    <div id="desk-sdbr">
                        @include('layouts.fe.sidebar.sidebar-akun')
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Sidebar Akun Desktop -->
                </div>
                <div class="order-content">
                    <!-- Content -->
                    <!-- ============================================================== -->
                    <div class="box-akun-payorder">
                        <div class="border-bottom-large menu-payorder">
                            <a href="{{route('akun_pesanan.detail', $order_detail->transaction_code)}}" class="ksjak main-sub-text f-Asap_medium text-capitalize mb-0 clr-lght-gsh">
                                <span class="arrow-icns"></span>
                                bayar belanjaan
                            </a>
                        </div>

                        <!-- Start Header Menu Order -->
                        <div class="menu-payorder">
                            <div class="frstgdsdg">
                                <p class="mb-0 text-center">
                                    Silahkan selesaikan pembayaran sebelum tanggal 07 April 2020 jam 12.00 WIB untuk menghindari pembatalan transaksi secara otomatiss.
                                </p>
                            </div>
                        </div>
                        <!-- End Header Menu Order -->

                        <!-- Start Info Price -->
                        <div class="ddshdjs menu-payorder">
                            <div class="grid_layouts gr-mdslklds">
                                <div>
                                    <p class="mb-0 text-capitalize main-sub-text">total pembayaran</p>
                                </div>
                                <div class="hfjdfhada">
                                    <div>
                                        <h5 style="color: #E24667;" class="mb-0 desc-main-text">Rp. {{ number_format($order_detail->grandtotal ,2,",",".")}}</h5>
                                    </div>
                                    <div class="position-relative shares-smd share-btn">
                                        <div>
                                            <a style="color: #2F80ED;" id="copyclpGr" class="copyclp position-relative" data-clipboard-text="{{$order_detail->grandtotal}}" type="button">
                                                Salin
                                            </a>
                                        </div>
                                        <div class="ct-tggle ct-tggle1" id="ct-tggleGr" style="display: none">
                                            <div class="position-relative">
                                                <small class="small-fnt">Copied</small>
                                                <div class="mn-arrw"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Info Price -->

                        <!-- Start Info Payment Method -->
                        @if($order_detail->payment_id == 1)
                        <div class="transfer-payment --qris-pay">
                            <h6 class="main-sub-text f-Asap_medium mb-20 text-center">
                                Silahkan Scan Qris dibawah ini
                            </h6>
                            <div class="barcode-qris img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/barcode.png') }}"></div>
                            <h6 class="main-sub-text f-Asap_medium mb-0 mt-20 text-center clr-light-gry">
                                Menerima pembayaran
                            </h6>
                        </div>
                        @elseif($order_detail->payment_id == 2)
                        <div class="transfer-payment --manual-pay">
                            <h6 class="main-sub-text f-Asap_medium mb-0">
                                Transfer dapat dilakukan di salah satu rekening tujuan an. Veganesia
                            </h6>
                            <div class="grid_layouts gr-bank-transfer">
                                @foreach($payment_bank as $bank)
                                <div class="grid_layouts icn-bank">
                                    @if($bank->title == 'BCA (Bank Central Asia)')
                                    <div class="img-bank img-lazy small-lazy --bca" data-src="{{ $bank->icon }}"></div>
                                    @elseif($bank->title == 'Mandiri')
                                    <div class="img-bank img-lazy small-lazy --mandiri" data-src="{{ $bank->icon }}"></div>
                                    @elseif($bank->title == 'BNI (Bank Nasional Indonesia)')
                                    <div class="img-bank img-lazy small-lazy --bni" data-src="{{ $bank->icon }}"></div>
                                    @elseif($bank->title == 'BRI (Bank Rakyat Indonesia)')
                                    <div class="img-bank img-lazy small-lazy --bri" data-src="{{ $bank->icon }}"></div>
                                    @endif
                                    <div class="desc-bank">
                                        <h6 class="text-norek f-Asap_medium">
                                            {{$bank->no_rekening}}
                                        </h6>
                                        <div class="position-relative">
                                            <button class="copyclp btn-vegan txt-btn clr-blue text-right f-Asap_medium" type="button" data-target="bri{{$bank->id}}" data-clipboard-text="{{$bank->no_rekening}}">
                                                salin
                                            </button>
                                            <div class="ct-tggle ct-tgglesc --pymn" id="ct-tggle{{$bank->id}}" style="display: none">
                                                <div class="position-relative">
                                                    <small class="small-fnt">Copied</small>
                                                    <div class="mn-arrw"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <!-- End Info Payment Method -->

                        <!-- Start Pay Section -->
                        <div class="footer-menu-payorder">
                            @if($order_detail->payment_id == 2)
                            <div class="grid_layouts footer-payment">
                                <div>
                                    <p class="mb-0 clr-light-gry">Silahkan upload Bukti bayar untuk mempercepat proses verifikasi </p>
                                </div>
                                <div class="m-auto">
                                    <button class="text-capitalize btn-vegan f-Asap_medium green-bg-btn" data-toggle="modal" data-target="#uploadbuktibayar" data-backdrop="static" data-keyboard="false">
                                        upload bukti bayar
                                    </button>
                                </div>
                            </div>
                            @elseif($order_detail->payment_id == 3)
                            <div class="grid_layouts footer-payment">
                                <div>
                                    <p class="mb-0 clr-light-gry">Silahkan lakukan pembayaran untuk mempercepat proses verifikasi </p>
                                </div>
                                <div class="m-auto">
                                    <button id="midtransPay" data-payment="{{$order_detail->payment_id}}" data-id="{{$order_detail->id}}" data-total="{{$order_detail->grandtotal}}" class="btn-vegan text-capitalize green-bg-btn f-Asap_medium">
                                        bayar belanjaan
                                    </button>
                                </div>
                            </div>
                            @endif
                        </div>
                        <!-- End Pay Section -->
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Content -->
                </div>
                <!-- Start Modal Upload Bukti Bayar -->
                <div class="modal-vegan mdl-dwn" data-backdrop="static" data-keyboard="false">
                    <div class="modal fade" id="uploadbuktibayar" tabindex="-1" role="dialog" aria-labelledby="uploadbuktibayarLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-capitalize text-left desc-main-text f-Asap_medium" id="uploadbuktibayarLabel">
                                        upload bukti bayar
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="FormUploadBukti" class="modal-body">
                                    <div class="mb-4">
                                        <p class="mb-0">
                                            Info untuk menjelaskan alamat ini untuk ke checout, consectetur adipiscing elit. Dignissim ullamcorper maecenas montes, arcu sit augue donec in porttitor.
                                        </p>
                                    </div>
                                    <form action="" class="form-vegan" id="saveBuktiBayar_pay" autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="id_order" name="id_order" value="{{ $order_detail->id}}">
                                        <div>
                                            <label for="name_penerima" class="clr-grey-txt mb-2 f-Asap_medium text-capitalize">nama bank</label>
                                            <div class="main-form-vg">
                                                <div class="--custom-select">
                                                    <select class="text-capitalize select2" id="namabank" name="namabank" required>
                                                        <option disabled selected class="selected">Pilih Nama Bank</option>
                                                        @foreach($payment_bank as $bank)
                                                        <option value="{{$bank->id}}" selected>{{$bank->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="nama_pengirim" class="clr-grey-txt mb-2 f-Asap_medium text-capitalize">nama pengirim</label>
                                            <div class="main-form-vg">
                                                <input required type="text" class="form-control" id="namapengirim" name="namapengirim" aria-describedby="namapengirim" placeholder="Nama Pengirim">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="name_penerima" class="clr-grey-txt mb-2 f-Asap_medium text-capitalize">nomor rekening</label>
                                            <div class="main-form-vg">
                                                <input required type="number" class="form-control" id="norek" name="norek" aria-describedby="norek" placeholder="Nomor Rekening" value="{{ isset($order_detail) ? $order_detail->rekening_bukti_bayar : '' }}">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="name_penerima" class="clr-grey-txt mb-2 f-Asap_medium text-capitalize">jumlah transfer</label>
                                            <div class="main-form-vg">
                                                <input required type="number" class="form-control" id="total" name="total" aria-describedby="total" placeholder="Jumlah Transfer" value="{{ isset($order_detail) ? $order_detail->jumlah_transfer : '' }}">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="main-form-vg">
                                                <div class="brw-fields">
                                                    <div class="file-upload-wrapper truncate-texts --upld" data-text="Slahkan Upload foto bukti transaksi">
                                                        <input accept="image/x-png,image/gif,image/jpeg" required name="cover" id="cover" name="cover" type="file" class="upload file-upload-field" value=""/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 pt-2">
                                            <button type="submit" class="btn-vegan green-bg-btn text-capitalize">kirim bukti bayar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:/ Modal Upload Bukti Bayar -->
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Content Profile -->
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            /********************************/
            /*Pembayaran Midtrans*/
            /********************************/
            $('#midtransPay').on('click',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var total = $(this).data('total');

                $.ajax({
                    url: "{{ route('akun_pesanan.bayarmidtrans') }}",
                    method: 'POST',
                    dataType: "json",
                    data : {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        total: total
                    },
                    success: function (response) {
                        if(response.midtrans == true){
                            var transactionData = response.total;
                            var snapToken = response.getPayment.token;
                            var midtrans_route = response.getPayment.redirect_url;
                            console.log('token : '+response.getPayment.token);
                            console.log('route : '+response.getPayment.redirect_url);
                            if (snapToken) {
                                // window.location = midtrans_route;
                                snap.pay(snapToken,{
                                    onSuccess: function(result){
                                        console.log('success');
                                        console.log('token : '+response.getPayment.token);
                                        console.log('route : '+response.getPayment.redirect_url);
                                        console.log(result);
                                        Swal.close();
                                        window.location.reload()
                                    },
                                    onPending: function(result){
                                        console.log('pending');
                                        console.log(result);
                                        Swal.close();
                                        window.location.reload()
                                    },
                                    onError: function(result){
                                        console.log('error');
                                        console.log(result);
                                        Swal.close();
                                    },
                                    onClose: function(){
                                        console.log('customer closed the popup without finishing the payment');
                                        Swal.close();
                                    }
                                });
                            }
                        }
                    },
                    error : function (xhr) {
                        var res = xhr.responseJSON;
                        console.log(res);
                        // Return Form Validation if Exist
                        if ($.isEmptyObject(res) == false) {
                            $.each(res.errors, function (key, value) {
                                $('#' + key)
                                    .closest('.input-group')
                                    // .closest('div')
                                    .addClass('has-error')
                                    .append('<div class="invalid-feedback">' + value + '</div>');
                                $('#' + key).addClass('is-invalid');
                            });
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups!',
                            text: 'Mohon cek kembali inputan Anda',
                        });
                    }
                })
            });

            /********************************/
            /*Pembayaran Bank Transfer*/
            /********************************/
            $('#saveBuktiBayar_pay').on('submit',function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                console.log(formData);

                $.ajax({
                    url: "{{ route('akun_pesanan.bayar') }}",
                    method: 'POST',
                    dataType: "json",
                    data : formData,
                    processData : false,
                    contentType : false,
                    success: function (response) {
                        console.log(response.success);
                        if (response.success) {
                            Swal.fire({
                                type: 'Bukti pembayaran berhasil di upload !',
                                title: 'Yes!',
                                type: 'success',
                                text: 'Admin kami mengkonfirmasi pembayaran yang anda lakukan. Kami akan mengirimkan pemberitahuan tentang status pembayaran anda. Terima kasih telah berbelanja di Veganesia.',
                                confirmButtonText: 'Ok',
                                allowOutsideClick: false
                            }).then(function() {
                                window.location = '{{ route("akun_pesanan") }}';
                            });
                        }
                        else{
                            Swal.fire({
                                type: 'error',
                                title: 'Maaf!',
                                icon: 'error',
                                text: 'Mohon masukkan data dengan benar',
                                confirmButtonText: 'Ok',
                                allowOutsideClick: false
                            }).then(function() {
                                $('#saveBuktiBayar_pay').valid();
                            });
                        }
                    },
                    error : function (xhr) {
                        var res = xhr.responseJSON;
                        console.log(res);
                        // Return Form Validation if Exist
                        if ($.isEmptyObject(res) == false) {
                            $.each(res.errors, function (key, value) {
                                $('#' + key)
                                    .closest('.input-group')
                                    // .closest('div')
                                    .addClass('has-error')
                                    .append('<div class="invalid-feedback">' + value + '</div>');
                                $('#' + key).addClass('is-invalid');
                            });
                            // Flush Submit Status
                            form.data('submitted', false);
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups!',
                            text: 'Mohon cek kembali inputan Anda',
                        }).then(function() {
                            $('#saveBuktiBayar_pay').valid();
                        });
                    }
                })
            });
        });
    </script>
@endpush
