<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu" style="background-color: lightgrey">

    <!-- LOGO -->
    <div class="navbar-brand-box" style="background-color: lightgrey">
        <div class="logo">
            <span class="logo-lg" style="margin-left: 30px">
                <img src="{{ URL::asset('/assets/images/logo-bank-sampah.jpg') }}" alt="" height="70" width=90">
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
                    <a href="/sampah-nasabah">
                        <i class="uil-trash-alt"></i>
                        <span>Data Sampah</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
