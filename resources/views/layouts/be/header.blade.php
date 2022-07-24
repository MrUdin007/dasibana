<div class="header navbar">
    <div class="header-container">
        <ul class="nav-left">
            <li>
                <a id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">
                    <i class="ti-menu"></i>
                </a>
            </li>
        </ul>
        <ul class="nav-right">
            <div class="dropdown-toggle no-after peers fxw-nw ai-c lh-1 mt-3 mr-3">
                <div class="peer mR-10">
                    <span class="fsz-sm f-asap_med" style="color: #ffffff; text-transform: capitalize">{{ auth()->user()->username }}</span>
                </div>
                <div class="peer">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="fsz-sm f-asap_med" style="color: #acacac;">(Logout)</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </ul>
    </div>
</div>
