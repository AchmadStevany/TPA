@extends('master-nav')
@section('title')
    Register
@endsection
@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="/home" class="mb-3 d-block auth-logo">
                            <img src="{{ URL::asset('/assets/images/logo-bank-sampah.jpg') }}" alt="" height="200"
                                class="logo">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h4 class="text-primary">Register !</h4>
                            </div>
                            <div class="p-2 mt-4">
                                <form method="POST" action="{{ route('register.store') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Username</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter username">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" class="form-control" name="password" id="userpassword"
                                            placeholder="Enter password">
                                    </div>
                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Sudah punya akun ? <a href="/login"
                                                class="fw-medium text-primary"> Login sekarang </a> </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
@endsection
