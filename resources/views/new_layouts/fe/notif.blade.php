<?php  use Carbon\Carbon;
        use App\Models\BlogPost;
        use App\Models\Transaction;
        use App\Models\Product;
        use App\Models\Notifications;
?>
<div id="notifbox" class="cart-vegan d-none">
    <div class="sec-cart">
        <div id="top-notif-vegan">
            <div class="grid_layouts top-cart">
                <div>
                    <h6 class="title-cart f-Asap_medium text-capitalize">
                        <span id="icnNotif" class="icon-cart"></span>
                        <?php 
                            if(auth('fe')->user() != null){ 
                                $notifications = Notifications::where('customer_id',auth('fe')->user()->id)->orderBy('created_at', 'desc')->get();
                                $notification_total = Notifications::where('customer_id',auth('fe')->user()->id)->where('read_at', null)->get();
                            }else{
                                $notifications = [];
                            } 
                        ?>
                        notifikasi 
                        @if(count($notifications) > 0 && count($notification_total) != 0)
                        (<span class="constantformatnumberCN" data-content="{{count($notification_total)}}">{{count($notification_total)}}</span>)
                        @else
                        (0)
                        @endif
                    </h6>
                </div>
                <div>
                    <button id="closeNotif" class="icon-cart icn-cart-scr"></button>
                </div>
            </div>
        </div>
        <div class="middle-cart navs-vegan notifikasi-header-menus">
            <ul class="nav nav-tabs nav-justified" id="tabnotif" role="tablist">
                <li class="nav-item">
                    <a class="nav-link notifnavs text-capitalize active" id="update-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="true">
                        update
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link notifnavs text-capitalize" id="transaksi-tab" data-toggle="tab" href="#transaksi" role="tab" aria-controls="transaksi" aria-selected="false">
                        transaksi
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="tabnotifContent">
                <div class="tab-pane fade show active" id="update" role="tabpanel" aria-labelledby="update-tab">
                    <div class="ls-vegan-notif --scrlbrr">
                        @if(count($notifications) > 0)
                        @foreach($notifications as $notification)
                        @if($notification->type == 1)
                        <?php 
                            $transaksi = Notifications::selectRaw('notifications.id, transactions.transaction_code')
                                                        ->leftJoin('transactions', 'transactions.id', '=', 'notifications.related_id')
                                                        ->where('transactions.id', $notification->related_id)
                                                        ->first(); 
                        ?>
                        <a href="{{route('akun_pesanan.detail.notif', [$transaksi->transaction_code, $notification->id])}}" class="list-notifikasi-vegan @if($notification->read_at == null) --active-notif @endif">
                        @elseif($notification->type == 2 || $notification->type == 3 || $notification->type == 5)
                        <?php 
                            $productNotif = Notifications::selectRaw('notifications.id, products.slug as urlproduct, products_categories.slug as urlcategory')
                                                        ->leftJoin('products','products.id','=','notifications.related_id')
                                                        ->leftJoin('products_products_categories','products_products_categories.product_id','=','products.id')
                                                        ->leftJoin('products_categories','products_categories.id','=','products_products_categories.category_id')
                                                        ->where('products.id', $notification->related_id)
                                                        ->first(); 
                        ?>
                        <a href="{{ route('produk.detail.notif', [$productNotif->urlcategory, $productNotif->urlproduct, $notification->id]) }}" class="list-notifikasi-vegan @if($notification->read_at == null) --active-notif @endif">
                        @elseif($notification->type == 4)
                        <?php 
                            $news = Notifications::selectRaw('notifications.id, blog_posts.slug as urlblog, blogs_categories.slug as urlcategory')
                                                        ->leftJoin('blog_posts', 'blog_posts.id', '=', 'notifications.related_id')
                                                        ->leftJoin('blogs_categories', 'blogs_categories.id', '=', 'blog_posts.blog_category_id')
                                                        ->where('blog_posts.id', $notification->related_id)
                                                        ->first(); 
                        ?>
                        <a href="{{ route('blog.detail.notif', [$news->urlcategory, $news->urlblog, $notification->id]) }}" class="list-notifikasi-vegan @if($notification->read_at == null) --active-notif @endif">
                        @else
                        <a href="#" class="list-notifikasi-vegan @if($notification->read_at == null) --active-notif @endif">
                        @endif
                            <div class="card-box-notif">
                                <div class="icn-notifikasi">
                                    @if($notification->type == 2 || $notification->type == 3 || $notification->type == 5)
                                    <div class="icn-ntf img-lazy small-lazy icn-ntf-info" data-src="{{ asset('dist/fe/icons/notif/notif-info.png') }}"></div>
                                    @elseif($notification->type == 1)
                                    <div class="icn-ntf img-lazy small-lazy icn-ntf-transaksi" data-src="{{ asset('dist/fe/icons/notif/notif-transaksi.png') }}"></div>
                                    @elseif($notification->type == 4)
                                    <div class="icn-ntf img-lazy small-lazy icn-ntf-news" data-src="{{ asset('dist/fe/icons/notif/notif-news.png') }}"></div>
                                    @endif
                                    <small class="clr-light-gry small-fnt mb-0">
                                        . {{Carbon::parse($notification->created_at)->format('d F Y - H:i')}}
                                    </small>
                                </div>
                                <h6 class="text-capitalize f-Asap_medium mb-0 clr-blck">{{$notification->title}}</h6>
                                <p class="clr-light-gry mb-0">
                                    {!! strip_tags($notification->data) !!}
                                </p>
                            </div>
                        </a>
                        @endforeach
                        @else
                        <!-- Start Tidak Ada Notifikasi -->
                        <div class="no-post-list">
                            <div class="img-no-post img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/no_notif.png') }}" style="background-size: contain;"></div>
                            <div class="desc-no-post">
                                <h6 class="text-capitalize f-Asap_medium main-sub-text">maaf! tidak ada notifikasi apapun</h6>
                            </div>
                        </div>
                        <!-- End:/ Tidak Ada Notifikasi -->
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="transaksi" role="tabpanel" aria-labelledby="transaksi-tab">
                    <div class="ls-vegan-notif --scrlbrr">
                        <?php 
                            if(auth('fe')->user() != null){
                                $notifications_transaksi = Notifications::selectRaw('notifications.id, notifications.title, notifications.type, notifications.data, notifications.related_id, notifications.created_at, notifications.read_at, transactions.transaction_code')
                                                            ->leftJoin('transactions', 'transactions.id', '=', 'notifications.related_id')
                                                            ->where('notifications.customer_id',auth('fe')->user()->id)
                                                            ->where('notifications.type', 1)
                                                            ->orderBy('notifications.created_at', 'desc')
                                                            ->get();
                            }else{
                                $notifications_transaksi = [];
                            } 
                        ?>
                        @if(count($notifications_transaksi) > 0)
                        @foreach($notifications_transaksi as $notification)
                        <a href="{{route('akun_pesanan.detail.notif', [$notification->transaction_code, $notification->id])}}" class="list-notifikasi-vegan @if($notification->read_at == null) --active-notif @endif">
                            <div class="card-box-notif">
                                <div class="icn-notifikasi">
                                    <div class="icn-ntf img-lazy small-lazy icn-ntf-transaksi" data-src="{{ asset('dist/fe/icons/notif/notif-transaksi.png') }}"></div>
                                    <small class="clr-light-gry small-fnt mb-0">
                                        . {{Carbon::parse($notification->created_at)->format('d F Y - H:i')}}
                                    </small>
                                </div>
                                <h6 class="text-capitalize f-Asap_medium mb-0 clr-blck">{{$notification->title}}</h6>
                                <p class="clr-light-gry mb-0">
                                    {{$notification->data}}  
                                </p>
                            </div>
                        </a>
                        @endforeach
                        @else
                        <!-- Start Tidak Ada Notifikasi -->
                        <div class="no-post-list">
                            <div class="img-no-post img-lazy small-lazy" data-src="{{ asset('dist/fe/icons/no_notif.png') }}" style="background-size: contain;"></div>
                            <div class="desc-no-post">
                                <h6 class="text-capitalize f-Asap_medium main-sub-text">maaf! tidak ada notifikasi apapun</h6>
                            </div>
                        </div>
                        <!-- End:/ Tidak Ada Notifikasi -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            
        });
    </script>
@endpush