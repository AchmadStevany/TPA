<header id="page-topbar">
    <div class="navbar-header" style="background-color: lightgrey">
        <div class="d-flex align-items-center">
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <div class="d-inline-block">
                <h5 class="m-3 font-size-16">Bank Sampah Resik</h5>
            </div>
        </div>
        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ URL::asset('/assets/images/logo-user.png') }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{Str::ucfirst(Auth::user()->name)}}</span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span
                                class="align-middle">Logout</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
