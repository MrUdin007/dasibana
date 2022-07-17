<div class="sidebar">
    <div class="sidebar-inner">
        <!-- ### $Sidebar Header ### -->
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="">
                        <div class="logo">
                            <img class="logo-vgn" src="{{asset('images/dasibana.png')}}" alt="Dasibana Brand">
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
                <a class="sidebar-link text-capitalize" href="">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-home"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-link text-capitalize" href="{{ route('admin.index')}}">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-user"></i>
                    </span>
                    <span class="title">admin</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-link text-capitalize" href="{{ route('sosmed.index')}}">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-themify-favicon"></i>
                    </span>
                    <span class="title">sosmed</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-link text-capitalize" href="{{ route('kontak.index')}}">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-agenda "></i>
                    </span>
                    <span class="title">Perusahaan</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle text-capitalize" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-shopping-cart-full "></i>
                    </span>
                    <span class="title">produk</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{ route('produkkategori.index')}}" class="text-capitalize">
                            <span>produk kategori</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('produk.index')}}" class="text-capitalize">
                            <span>data produk</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
