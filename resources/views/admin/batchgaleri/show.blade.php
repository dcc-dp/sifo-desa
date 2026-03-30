<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <h5 class="mb-3">
                Folder : {{ $batch->nama }}
            </h5>

            <a href="{{ route('galeri.create', $batch->id) }}" class="btn btn-sm btn-dark d-flex align-items-center me-2 mb-3" style="width: fit-content;">
                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor" class="d-block me-2">
                    <path
                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                </svg>
                Tambah Gambar
            </a>

            <div class="row">
                @forelse ($batch->galeris as $g)
                    <div class="col-md-3 mb-4">
                        <div class="card position-relative">

                            <form action="{{ route('galeri.destroy', $g->id) }}" method="POST"
                                class="position-absolute top-0 end-0" style="z-index: 10;"
                                onsubmit="return confirm('Yakin hapus gambar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-danger btn-sm shadow-sm m-2 d-flex align-items-center justify-content-center"
                                    style="width: 32px; height: 32px; padding: 0; border-radius: 8px;"
                                    title="Hapus Gambar">
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>
                            </form>

                            <img src="{{ url($g->gambar) }}" class="card-img-top"
                                style="height: 200px; object-fit: cover;" alt="{{ $g->judul }}">

                            <div class="card-body text-center">
                                <small>{{ $g->judul }}</small>
                            </div>
                        </div>
                    </div>

                @empty
                    <p class="text-muted">Belum ada gambar di batch ini.</p>
                @endforelse

                <div class="d-flex justify-content-start mt-2">
                    <a href="{{ route('batchgaleri.index') }}" class="btn btn-sm btn-primary">
                        Kembali
                    </a>
                </div>
            </div>

        </div>

        <x-app.footer />
    </main>
</x-app-layout>