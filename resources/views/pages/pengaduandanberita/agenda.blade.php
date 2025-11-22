@extends('layouts.user')

@section('title', 'Agenda Kegiatan | Sistem Informasi Desa')

@section('content')

    <section>
            <div class="container">
                <h2><i class="fas fa-calendar-alt"></i> Agenda & Kegiatan Desa</h2>

                <ul class="agenda-list">
                    <li>
                        <div class="icon"><i class="fas fa-handshake"></i></div>
                        <div class="details">
                            <h4>Rapat Persiapan HUT Desa ke-77</h4>
                            <span><i class="fas fa-clock"></i> Sunday, 2 Nov 2025 | 09:00 - 12:00 WIB</span>
                        </div>
                    </li>
                    <li>
                        <div class="icon"><i class="fas fa-hammer"></i></div>
                        <div class="details">
                            <h4>Gotong Royong Perbaikan Drainase RW 03</h4>
                            <span><i class="fas fa-clock"></i> Friday, 15 Nov 2025 | 07:00 - 10:00 WIB</span>
                        </div>
                    </li>
                    <li>
                        <div class="icon"><i class="fas fa-lightbulb"></i></div>
                        <div class="details">
                            <h4>Penyuluhan Kesehatan Ibu dan Anak (KIA)</h4>
                            <span><i class="fas fa-clock"></i> Wednesday, 20 Nov 2025 | 14:00 - 16:00 WIB</span>
                        </div>
                    </li>
                    <li>
                        <div class="icon"><i class="fas fa-tree"></i></div>
                        <div class="details">
                            <h4>Penanaman Pohon di Area Lahan Desa</h4>
                            <span><i class="fas fa-clock"></i> Saturday, 30 Nov 2025 | 08:00 - 11:00 WIB</span>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

@endsection