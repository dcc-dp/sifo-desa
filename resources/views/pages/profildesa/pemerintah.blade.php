@extends('layouts.user')

@section('title', 'Pemerintah | Sistem Informasi Desa')

@section('content')

    <section>
        <div class="container">
            <h2><i class="fas fa-users"></i> Struktur Pemerintahan Desa</h2>
            <div class="gov-grid">
                <div class="card official-card">
                    <img src="{{URL::asset('/upload/pemerintah/said.png')}}" alt="Official Photo">
                    <h4>Said Sudirman</h4>
                    <p class="position">Kepala Desa</p>
                    <p class="duties">Bertanggung jawab atas penyelenggaraan pemerintahan, pembangunan, dan pelayanan
                        masyarakat desa.</p>
                </div>
                <div class="card official-card">
                    <img src="{{URL::asset('/upload/pemerintah/said.png')}}" alt="Official Photo">
                    <h4>Al-Fina Syarif</h4>
                    <p class="position">Sekretaris Desa</p>
                    <p class="duties">Membantu Kepala Desa dalam bidang administrasi dan memberikan pelayanan teknis
                        administrasi.</p>
                </div>
                <div class="card official-card">
                    <img src="{{URL::asset('/upload/pemerintah/said.png')}}" alt="Official Photo">
                    <h4>Hasniawati</h4>
                    <p class="position">Kepala Urusan Keuangan</p>
                    <p class="duties">Melaksanakan pengelolaan administrasi keuangan desa, termasuk penerimaan dan
                        pengeluaran.</p>
                </div>
                <div class="card official-card">
                    <img src="{{URL::asset('/upload/pemerintah/said.png')}}" alt="Official Photo">
                    <h4>Dewi Lestari</h4>
                    <p class="position">Kepala Seksi Pemerintahan</p>
                    <p class="duties">Membantu Kades dalam pelaksanaan urusan tata praja, pertanahan, dan kependudukan.</p>
                </div>
            </div>
        </div>
    </section>

@endsection