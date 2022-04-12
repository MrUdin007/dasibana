<div class="sidebar">
    <div class="sidebar-inner">
        <!-- ### $Sidebar Header ### -->
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="{{route('be.dashboard')}}">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer">
                                <div class="logo">
                                    <img class="logo-vgn" src="{{ asset('dist/be/icons/veganesia.png') }}" alt="">
                                </div>
                            </div>
                            <div class="peer peer-greed">
                                <h5 class="lh-1 mB-0 logo-text logo-text-vegan f-pattaya_reg">Veganesia</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="peer">
                    <div class="mobile-toggle sidebar-toggle">
                        <a href="" class="td-n">
                            <i class="ti-arrow-circle-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ### $Sidebar Menu ### -->
        <ul class="sidebar-menu scrollable pos-r">
            <li class="nav-item">
                <a class="sidebar-link {{ Route::is('be.dashboard') ? 'actives' : '' }}" href="{{ route('be.dashboard') }}">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-home"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-link {{ Route::is('be.staff.edit') ? 'actives' : '' }}" href="{{ route('be.staff.edit', ['id' => Auth::id()]) }}">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-user"></i>
                    </span>
                    <span class="title">Edit Profile</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ Route::is('be.transaction.new') || Route::is('be.transaction.view') || Route::is('be.product.stock') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-bell"></i>
                    </span>
                    <span class="title">Notifications</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.transaction.new') }}" class="{{ Route::is('be.transaction.new') || Route::is('be.transaction.view') ? 'actives' : '' }}">
                            <span>New Orders</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.payment_proof') }}">
                            <span>New Payment Proof</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>New Reviews</span>
                        </a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.product.stock') }}" class="{{ Route::is('be.product.stock') ? 'actives' : '' }}">
                            <span>Stock Habis</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Expired Soon</span>
                        </a>
                    </li> -->
                </ul>
            </li>
            <li class="nav-item dropdown {{ Route::is('be.supplier') || Route::is('be.supplier.*') || Route::is('be.stockin') || Route::is('be.stockin.*') || Route::is('be.retur_pembelian') || Route::is('be.retur_pembelian.*') || Route::is('be.stock_adjustment') || Route::is('be.stock_adjustment.*') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-view-list-alt"></i>
                    </span>
                    <span class="title">Warehouse Management</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.supplier') }}" class="{{ Route::is('be.supplier') || Route::is('be.supplier.*') ? 'actives' : '' }}">
                            <span>Supplier Management</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                       <a href="{{ route('be.stockin')}}" class="{{ Route::is('be.stockin') || Route::is('be.stockin.*') ? 'actives' : '' }}">
                            <span>Pembelian (Purchase) Management</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.retur_pembelian')}}" class="{{ Route::is('be.retur_pembelian') || Route::is('be.retur_pembelian.*') ? 'actives' : '' }}">
                            <span>Retur Pembelian</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.stock_adjustment')}}" class="{{ Route::is('be.stock_adjustment') || Route::is('be.stock_adjustment.*') ? 'actives' : '' }}">
                            <span>Stock Adjustment (Limited)</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Product Stock</span>
                        </a>
                    </li> -->
                    <!-- <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Expired Soon</span>
                        </a>
                    </li> -->
                    <!-- <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Purchase Log</span>
                        </a>
                    </li> -->
                </ul>
            </li>
            <li class="nav-item dropdown {{ Route::is('be.product') || Route::is('be.product.*') || Route::is('be.product_category') || Route::is('be.product_category.*') || Route::is('be.product_size_chart') || Route::is('be.product_size_chart.*') || Route::is('be.product_size') || Route::is('be.product_size.*') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-package"></i>
                    </span>
                    <span class="title">Products Management</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.product') }}" class="{{ Route::is('be.product') || Route::is('be.product.*') ? 'actives' : '' }}">
                            <span>Product List</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.product_category') }}" class="{{ Route::is('be.product_category') || Route::is('be.product_category.*') ? 'actives' : '' }}">
                            <span>Product Categories</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.product_size_chart') }}" class="{{ Route::is('be.product_size_chart') || Route::is('be.product_size_chart.*') ? 'actives' : '' }}">
                            <span>Product Size Chart</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.product_size') }}" class="{{ Route::is('be.product_size') || Route::is('be.product_size.*') ? 'actives' : '' }}">
                            <span>Product Size</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Product Varian</span>
                        </a>
                    </li> -->
                </ul>
            </li>
            <li class="nav-item dropdown {{ Route::is('be.review_approve') || Route::is('be.review_approve.*') || Route::is('be.review') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-layers"></i>
                    </span>
                    <span class="title">Reviews Management</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{route('be.review_approve')}}" class="{{ Route::is('be.review_approve') || Route::is('be.review_approve.*') ? 'actives' : '' }}">
                            <span>Approve New Review</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.review')}}" class="{{ Route::is('be.review') ? 'actives' : '' }}">
                            <span>Review List</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Route::is('be.transaction') || Route::is('be.transaction.*') || Route::is('be.retur_penjualan') || Route::is('be.retur_penjualan.*') || Route::is('be.voucher') || Route::is('be.voucher.*') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-bag"></i>
                    </span>
                    <span class="title">Transaction Management</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{route('be.transaction')}}" class="{{ Route::is('be.transaction') || Route::is('be.transaction.*') ? 'actives' : '' }}">
                            <span>Orders List</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.retur_penjualan')}}" class="{{ Route::is('be.retur_penjualan') || Route::is('be.retur_penjualan.*') ? 'actives' : '' }}">
                            <span>Retur Penjualan</span>
                        </a>
                    </li>
                     <li class="nav-item dropdown">
                        <a href="{{route('be.voucher')}}" class="{{ Route::is('be.voucher') || Route::is('be.voucher.*') ? 'actives' : '' }}">
                            <span>Voucher</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Payment Confirmation</span>
                        </a>
                    </li> -->
                    <!-- <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Orders Log</span>
                        </a>
                    </li> -->
                </ul>
            </li>
            <li class="nav-item dropdown {{ Route::is('be.slider') || Route::is('be.slider.*') || Route::is('be.product.new') || Route::is('be.product.sale') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-files"></i>
                    </span>
                    <span class="title">Marketing Tools</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{route('be.slider')}}" class="{{ Route::is('be.slider') || Route::is('be.slider.*') ? 'actives' : '' }}">
                            <span>Slider Homepage</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.product.new')}}" class="{{ Route::is('be.product.new') ? 'actives' : '' }}">
                            <span>Set New Products</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.product.sale')}}" class="{{ Route::is('be.product.sale') ? 'actives' : '' }}">
                            <span>Set Hot Weekly Sale</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.recommendation_tag')}}">
                            <span>Recommendation Tag</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.search_hint')}}">
                            <span>Search Hint</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Promo Management</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Voucher Management</span>
                        </a>
                    </li> -->
                </ul>
            </li>
            <li class="nav-item dropdown {{ Route::is('be.app_setting') || Route::is('be.app_setting.*') || Route::is('be.cs_whatsapp') || Route::is('be.cs_whatsapp.*') || Route::is('be.faq') || Route::is('be.faq.*') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-archive"></i>
                    </span>
                    <span class="title">Store Settings</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{route('be.app_setting', ['set'=>'1'])}}" class="{{ Route::is('be.app_setting') || Route::is('be.app_setting.*') ? 'actives' : '' }}">
                            <span>Set Point Value</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.app_setting', ['set'=>'2'])}}" class="{{ Route::is('be.app_setting') || Route::is('be.app_setting.*') ? 'actives' : '' }}">
                            <span>Set Default Point for New Users</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Bank Account Management</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.cs_whatsapp') }}" class="{{ Route::is('be.cs_whatsapp') || Route::is('be.cs_whatsapp.*') ? 'actives' : '' }}">
                            <span>Whatsapp CS Settings</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.faq') }}" class="{{ Route::is('be.faq') || Route::is('be.faq.*') ? 'actives' : '' }}">
                            <span>FAQ Management</span>
                        </a>
                    </li>
                </ul>
            </li>
           <!--  <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-stats-up"></i>
                    </span>
                    <span class="title">Statistics</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Most Liked Categories</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Most liked Products</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Kategori terlaris</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Produk terlaris</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Promo / Voucher terlaris</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Sale Terlaris</span>
                        </a>
                    </li>
                </ul>
            </li> -->
            <li class="nav-item dropdown {{ Route::is('be.report.*') || Route::is('be.report.stock_history') || Route::is('be.report.stock_history.*') || Route::is('be.report.nilai_stock') || Route::is('be.report.nilai_stock.*') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-menu-alt"></i>
                    </span>
                    <span class="title">Reports</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{route('be.report.stock_history')}}" class="{{ Route::is('be.report.stock_history') || Route::is('be.report.stock_history.*') ? 'actives' : '' }}">
                            <span>Stock History</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.report.nilai_stock')}}" class="{{ Route::is('be.report.nilai_stock') || Route::is('be.report.nilai_stock.*') ? 'actives' : '' }}">
                            <span>Nilai Stock</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.report.cash_flow')}}" class="{{ Route::is('be.report.cash_flow') || Route::is('be.report.cash_flow.*') ? 'actives' : '' }}">
                            <span>Laporan Cash Flow</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.report.laba_rugi')}}" class="{{ Route::is('be.report.laba_rugi') || Route::is('be.report.laba_rugi.*') ? 'actives' : '' }}">
                            <span>Laba Rugi</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.report.profit_bersih')}}" class="{{ Route::is('be.report.profit_bersih') || Route::is('be.report.profit_bersih.*') ? 'actives' : '' }}">
                            <span>Profit bersih Penjualan</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('be.report.review')}}" class="{{ Route::is('be.report.review') ? 'actives' : '' }}">
                            <span>Review</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- <li class="nav-item dropdown {{ Route::is('be.faq') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-notepad"></i>
                    </span>
                    <span class="title">Pages</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.tag') }}">
                            <span>Tag Management</span>
                        </a>
                    </li>
                </ul>
            </li> -->
            <li class="nav-item dropdown {{ Route::is('be.blog_category') || Route::is('be.blog_category.*') || Route::is('be.blog_post') || Route::is('be.blog_post.*') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-pencil-alt2"></i>
                    </span>
                    <span class="title">Content Writing</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.blog_category') }}" class="{{ Route::is('be.blog_category') || Route::is('be.blog_category.*') ? 'actives' : '' }}">
                            <span>Blog Categories</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.blog_post') }}" class="{{ Route::is('be.blog_post') || Route::is('be.blog_post.*') ? 'actives' : '' }}">
                            <span>Blog Posts</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Route::is('be.customer') || Route::is('be.customer.*') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-align-justify"></i>
                    </span>
                    <span class="title">Customer Management</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.customer') }}" class="{{ Route::is('be.customer') || Route::is('be.customer.*') ? 'actives' : '' }}">
                            <span>Customer List</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.customer.voucher') }}" class="{{ Route::is('be.customer.voucher') || Route::is('be.customer.*') ? 'actives' : '' }}">
                            <span>Customer Voucher</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Customer Levels</span>
                        </a>
                    </li> -->
                    <!-- <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Banned Customers</span>
                        </a>
                    </li> -->
                    <!-- <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Customer Wishlist</span>
                        </a>
                    </li> -->
                </ul>
            </li>
            @can('staff')
            <li class="nav-item dropdown {{ Route::is('be.staff') || Route::is('be.staff.*') || Route::is('be.role') || Route::is('be.role.*') || Route::is('be.permission') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-layout-list-thumb"></i>
                    </span>
                    <span class="title">Staff Management</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.staff') }}" class="{{ Route::is('be.staff') || Route::is('be.staff.*') ? 'actives' : '' }}">
                            <span>Staff List</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.role') }}" class="{{ Route::is('be.role') || Route::is('be.role.*') ? 'actives' : '' }}">
                            <span>Staff Role</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('be.permission') }}" class="{{ Route::is('be.permission') ? 'actives' : '' }}">
                            <span>Permissions</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            <li class="nav-item">
                <a class="sidebar-link logout-veg" href="javascript:void(0)">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-power-off"></i>
                    </span>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
