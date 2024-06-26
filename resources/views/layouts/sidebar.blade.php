<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu" style="background-color: lightgrey">

    <!-- LOGO -->
    <div class="navbar-brand-box" style="background-color: lightgrey">
        <div class="logo">
            <span class="logo-lg" style="margin-left: 20px">
                <img src="{{ URL::asset('/assets/images/coffeeshop.png') }}" alt="" height="80" width="100">
            </span>
        </div>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" style="color:#383c40;font-weight:bold">Menu</li>

                <li>
                    <a href="/dashboard">
                        <i class="uil-home-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/product">
                        <i class="uil-coffee"></i>
                        <span>Mengelola Sampah</span>
                    </a>
                </li>
                <li>
                    <a href="/customer">
                        <i class="uil-users-alt"></i>
                        <span>Mengelola Saldo</span>
                    </a>
                </li>
                <li>
                    <a href="/order">
                        <i class="uil-transaction"></i>
                        <span>Tarik Saldo</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
