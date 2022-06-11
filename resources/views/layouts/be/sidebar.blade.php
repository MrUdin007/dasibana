<div class="sidebar">
    <div class="sidebar-inner">
        <!-- ### $Sidebar Header ### -->
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer">
                                <div class="logo">
                                    <img class="logo-vgn" src="" alt="">
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
                <a class="sidebar-link text-capitalize" href="">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-home"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-link text-capitalize" href="{{ route('admin')}}">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-user"></i>
                    </span>
                    <span class="title">admin</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-link text-capitalize" href="{{ route('sosmed')}}">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-user"></i>
                    </span>
                    <span class="title">sosmed</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-link text-capitalize" href="{{ route('kontak')}}">
                    <span class="icon-holder">
                        <i class="c-blue-500 ti-user"></i>
                    </span>
                    <span class="title">kontak</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle text-capitalize" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="c-teal-500 ti-bell"></i>
                    </span>
                    <span class="title">produk</span>
                    <span class="arrow">
                        <i class="ti-angle-right"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown">
                        <a href="{{ route('produkkategori')}}" class="text-capitalize">
                            <span>produk kategori</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('product')}}" class="text-capitalize">
                            <span>data produk</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</div>
