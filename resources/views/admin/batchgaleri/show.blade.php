<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <a href="{{ route('batchgaleri.index') }}" class="btn-admin-secondary py-1 px-2 fs-7">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <span class="text-muted">/</span>
                        <span class="badge bg-light text-dark border px-2 py-1 fs-7">Album Foto</span>
                    </div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-folder-open"></i>
                        <span>{{ $batch->nama }}</span>
                    </h2>
                    <p class="admin-page-subtitle">Daftar foto dokumentasi yang tersimpan dalam album ini</p>
                </div>
                <div>
                    <a href="{{ route('galeri.create', $batch->id) }}" class="btn-admin-primary">
                        <i class="fas fa-upload"></i>
                        <span>Upload Foto Baru</span>
                    </a>
                </div>
            </div>

            <!-- GALLERY GRID -->
            <div class="row">
                @forelse ($batch->galeris as $g)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="admin-card mb-0 h-100 d-flex flex-column position-relative shadow-sm hover-shadow transition">
                            
                            <!-- Delete Button -->
                            <form action="{{ route('galeri.destroy', $g->id) }}" method="POST"
                                class="position-absolute top-0 end-0 m-2" style="z-index: 5;"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-action-delete shadow"
                                    data-bs-toggle="tooltip" data-bs-title="Hapus Foto">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>

                            <!-- Image Container -->
                            <div style="height: 180px; overflow: hidden; background: #f1f5f9;">
                                <img src="{{ url($g->gambar) }}" class="w-100 h-100"
                                    style="object-fit: cover; transition: transform 0.3s ease;" 
                                    alt="{{ $g->judul }}"
                                    onerror="this.src='{{ asset('assets/img/illustrations/image-placeholder.png') }}'">
                            </div>

                            <!-- Caption -->
                            <div class="p-3 text-center flex-grow-1 d-flex align-items-center justify-content-center">
                                <span class="fw-semibold text-dark fs-7">{{ $g->judul }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="admin-card">
                            <div class="admin-table-empty">
                                <i class="fas fa-images"></i>
                                <h6>Album Ini Masih Kosong</h6>
                                <p>Belum ada foto yang diunggah ke dalam album <strong>{{ $batch->nama }}</strong>.</p>
                                <a href="{{ route('galeri.create', $batch->id) }}" class="btn-admin-primary mt-3">
                                    <i class="fas fa-upload"></i> Upload Foto Pertama
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>