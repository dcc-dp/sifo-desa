<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Galeri Desa</h3>
                            <p class="mb-0">Apps you might like!</p>
                        </div>
                        <button type="button"
                            class="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 ms-md-auto mb-sm-0 mb-2 me-2">
                            <span class="btn-inner--icon">
                                <span class="p-1 bg-success rounded-circle d-flex ms-auto me-2">
                                    <span class="visually-hidden">New</span>
                                </span>
                            </span>
                            <span class="btn-inner--text">Messages</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0">
                            <span class="btn-inner--icon">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-block me-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                            </span>
                            <span class="btn-inner--text">Sync</span>
                        </button>
                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="row">
                <div class="position-relative overflow-hidden">
                    <div class="swiper mySwiper mt-4 mb-2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div>
                                    <div
                                        class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                        <div class="full-background bg-cover"
                                            style="background-image: url('../assets/img/img-2.jpg')"></div>
                                        <div class="card-body text-start px-3 py-0 w-100">
                                            <div class="row mt-12">
                                                <div class="col-sm-3 mt-auto">
                                                    <h4 class="text-dark font-weight-bolder">#1</h4>
                                                    <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Name
                                                    </p>
                                                    <h5 class="text-dark font-weight-bolder">Secured</h5>
                                                </div>
                                                <div class="col-sm-3 ms-auto mt-auto">
                                                    <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">
                                                        Category</p>
                                                    <h5 class="text-dark font-weight-bolder">Banking</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/img-1.jpg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <h4 class="text-dark font-weight-bolder">#2</h4>
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Name</p>
                                                <h5 class="text-dark font-weight-bolder">Cyber</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Category
                                                </p>
                                                <h5 class="text-dark font-weight-bolder">Security</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/img-3.jpg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <h4 class="text-dark font-weight-bolder">#3</h4>
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Name</p>
                                                <h5 class="text-dark font-weight-bolder">Alpha</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Category
                                                </p>
                                                <h5 class="text-dark font-weight-bolder">Blockchain</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/img-4.jpg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <h4 class="text-dark font-weight-bolder">#4</h4>
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Name</p>
                                                <h5 class="text-dark font-weight-bolder">Beta</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Category
                                                </p>
                                                <h5 class="text-dark font-weight-bolder">Web3</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/img-5.jpg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <h4 class="text-dark font-weight-bolder">#5</h4>
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Name</p>
                                                <h5 class="text-dark font-weight-bolder">Gama</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Category
                                                </p>
                                                <h5 class="text-dark font-weight-bolder">Design</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/img-1.jpg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <h4 class="text-dark font-weight-bolder">#6</h4>
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Name</p>
                                                <h5 class="text-dark font-weight-bolder">Rompro</h5>
                                            </div>
                                            <div class="col-sm-3 ms-auto mt-auto">
                                                <p class="text-dark opacity-6 text-xs font-weight-bolder mb-0">Category
                                                </p>
                                                <h5 class="text-dark font-weight-bolder">Security</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>

</x-app-layout>
