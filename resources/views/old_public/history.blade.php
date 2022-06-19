@extends('layouts.fe.template.template_fe')

@section('metadata')
    <title>Veganesia - Sejarah Veganesia</title>
    <meta name="description" content="">
    <meta name="tags" content="">
    <link rel="canonical" href="">
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/fe/css/pages/history.css') }}">
@endpush

@section('content')
    <div class="history-section">
        <!-- History Content -->
        <!-- ============================================================== -->
        <section class="sec-history">
            <div class="head-ct-slider pt-0 pb-3 mb-4" style="border-bottom: 1px solid #CECECE;">
                <div class="head-ttle">
                    <h3 class="mb-0 f-Asap_bold text-capitalize">sejarah veganesia</h3>
                </div>
            </div>
            <div>
                <div class="cover-history img-lazy big-lazy" data-src="{{ asset('dist/fe/icons/history-cover.png') }}"></div>
                <article>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget porttitor velit, ac vestibulum mauris. Nullam convallis tortor vel lectus porta, eget iaculis risus laoreet. Donec tempus, tortor luctus facilisis rhoncus, diam massa pellentesque erat, vitae imperdiet arcu lacus nec nunc. Mauris aliquet nisl nulla, sed scelerisque eros consequat laoreet. Nulla porta, libero vitae consequat semper, libero turpis ornare erat, et vehicula sem erat in tellus. Quisque et lectus sit amet neque consequat scelerisque eget eu massa. Sed risus felis, pharetra eget ornare ut, finibus mattis nulla.
                        Mauris rhoncus aliquet elementum. In venenatis, elit in tincidunt consectetur, dui felis pharetra risus, ultricies iaculis dolor ante at odio. Sed enim tortor, pretium nec purus eu, auctor vulputate elit. Praesent a mi vitae urna luctus lobortis ac a turpis. Maecenas auctor lorem risus, nec pretium massa dapibus eleifend. Suspendisse tristique lorem non augue rhoncus, sed aliquet eros malesuada. Maecenas vel vehicula arcu, nec lobortis sem. Proin accumsan accumsan ligula a congue. Phasellus quis sapien lobortis, hendrerit quam sit amet, rutrum dolor. Phasellus non lectus mollis, condimentum ligula et, viverra turpis.
                    </p>
                </article>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End History Content -->
    </div>
@endsection