@extends('layouts.fe.template.template_fe')

@section('metadata')
    <title>veganesia - FAQ</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/faq.css') }}">
@endpush

@section('content')
    <div class="faq-section">
        <!-- Faq Content -->
        <!-- ============================================================== -->
        <section class="sec-faq container mb-5">
            <div>
                <div class="head-ct-slider pt-0 pb-3 mb-4" style="border-bottom: 1px solid #CECECE;">
                    <div class="head-ttle">
                        <h3 class="mb-0 f-brandonText_medium text-uppercase">faq</h3>
                    </div>
                </div>
                <div class="content-faq">
                    @if(count($faqs) > 0)
                    <!-- Start: If there is faq -->
                    <div class="accordion" id="accordionExample">
                        @foreach($faqs as $key => $faq)
                        <div class="card @if($loop->first) --active @endif">
                            <div class="card-header" id="heading_{{$key}}">
                                <button class="btn-faq main-sub-text" type="button" data-toggle="collapse" data-target="#faq_{{$key}}" aria-expanded="{{$loop->first ? 'true' : 'false'}}" aria-controls="faq_{{$key}}">
                                    {{ $faq->question }}
                                </button>
                            </div>

                            <div id="faq_{{$key}}" class="collapse @if($loop->first) show @endif" aria-labelledby="heading_{{$key}}" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p class="mid-main-sub-text">
                                        {{ $faq->answer}}   
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- End:/ If there is faq -->
                    @else
                    <!-- Start Tidak Ada Pesanan -->
                    <div class="no-post-list">
                        <div class="desc-no-post">
                            <h6 class="f-Asap_medium main-sub-text">FAQ Tidak Tersedia</h6>
                        </div>
                    </div>
                    <!-- End:/ Tidak Ada Pesanan -->
                    @endif
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Faq Content -->
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $(".btn-faq").click(function() {
                if($(this).attr('aria-expanded') === "false"){
                    $(this).parent().parent().addClass('--active').siblings().removeClass('--active');
                } else {
                    $(this).parent().parent().removeClass('--active');
                }
            });
        });
    </script>
@endpush
