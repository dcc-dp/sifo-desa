@extends('layouts.user')

@section('title', 'Agenda Kegiatan | Sistem Informasi Desa')

@section('content')

    <section>
            <div class="container">
                <h2><i class="fas fa-calendar-alt"></i> Agenda & Kegiatan Desa</h2>

                <ul class="agenda-list">
                    @foreach ($agendas as $agenda)
                    <li>
                        <div class="details">
                            <h4>{{ $agenda->nama_kegiatan }}</h4>
                            <span><i class="fas fa-clock"></i>{{ $agenda->waktu_pelaksanaan }}</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </section>

@endsection