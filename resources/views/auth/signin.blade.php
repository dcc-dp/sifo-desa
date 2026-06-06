<x-guest-layout>
    <!-- <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-guest.sidenav-guest />
            </div>
        </div>
    </div> -->
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
                            <div class="card-header pb-0 text-center bg-white border-0">

                                <img src="{{ asset('uploads/galeri/logo_sifo.png') }}" alt="Logo SIFO"
                                    style="height:70px;">

                                <h2 class="mt-3 fw-bold text-dark">
                                    SIFO DESA
                                </h2>

                                <p class="text-secondary mb-0">
                                    Sistem Informasi Desa
                                </p>

                                <p class="small text-muted mt-2">
                                    Silakan masuk untuk mengakses panel administrasi
                                </p>

                            </div>

                            <div class="text-center">

                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                @error('message')
                                    <div class="alert alert-danger mx-4 mt-3" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="card-body px-4 pb-4">

                                <form role="form" class="text-start" method="POST" action="sign-in">

                                    @csrf

                                    <label class="fw-semibold">
                                        Email
                                    </label>

                                    <div class="mb-3">

                                        <input type="email" id="email" name="email" class="form-control form-control-lg"
                                            placeholder="Masukkan email" value="{{ old('email') }}">

                                    </div>

                                    <label class="fw-semibold">
                                        Password
                                    </label>

                                    <div class="mb-3">
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg" placeholder="Masukkan password">
                                    </div>

                                    <div class="d-flex align-items-center">

                                        <div class="form-check form-check-info text-left mb-0">

                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">

                                            <label class="font-weight-normal text-dark mb-0" for="flexCheckDefault">

                                                Remember me

                                            </label>

                                        </div>

                                        <!-- <a href="{{ route('password.request') }}"
                                            class="text-xs font-weight-bold ms-auto">
                                            Forgot password
                                        </a> -->

                                    </div>

                                    <div class="text-center">

                                        <button type="submit" class="btn btn-dark w-100 btn-lg mt-4 mb-0">

                                            Login

                                        </button>

                                        <p class="text-center text-muted mt-4 small">
                                            © {{ date('Y') }} Sistem Informasi Desa
                                        </p>
                                    </div>

                                </form>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8"
                                    style="
                                            background-image:url('../assets/img/image-sign-in.jpg');
                                            background-position:center;
                                            background-size:cover;
                                        ">

                                    <div class="position-absolute top-0 start-0 w-100 h-100" style="
                                                background:rgba(7,22,52,0.25);
                                            ">
                                    </div>
                                    <!-- <div
                                        class="blur mt-12 p-4 text-center border border-white border-radius-md position-absolute fixed-bottom m-4">
                                        <h2 class="mt-3 text-dark font-weight-bold">Enter our global community of
                                            developers.</h2>
                                        <h6 class="text-dark text-sm mt-5">Copyright © 2022 Corporate UI Design System
                                            by Creative Tim.</h6>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</x-guest-layout>