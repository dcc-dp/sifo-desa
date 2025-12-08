@extends('layouts.user')

@section('title', 'Layanan Pengajuan | Sistem Informasi Desa')

@section('content')
    <section>
        <div class="container">
            <h2><i class="fas fa-file-alt"></i> Layanan Surat Desa</h2>

            <p style="margin-bottom: 30px;">Choose the type of letter you need to apply for:</p>

            <div class="service-menu-grid">
                <div class="card service-card" onclick="showServiceForm('usaha')">
                    <i class="fas fa-store"></i>
                    <h4>Surat Keterangan Usaha (SKU)</h4>
                </div>
                <div class="card service-card" onclick="showServiceForm('domisili')">
                    <i class="fas fa-map-marker-alt"></i>
                    <h4>Surat Keterangan Domisili</h4>
                </div>
                <div class="card service-card" onclick="showServiceForm('izin_acara')">
                    <i class="fas fa-calendar-day"></i>
                    <h4>Surat Izin Acara/Keramaian</h4>
                </div>
                <div class="card service-card" onclick="showServiceForm('pengantar')">
                    <i class="fas fa-envelope-open-text"></i>
                    <h4>Surat Pengantar Umum</h4>
                </div>
                <div class="card service-card" onclick="showServiceForm('sktm')">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h4>SKTM (Poverty Cert.)</h4>
                </div>
            </div>

            <div id="service-form-container" class="card" style="margin-top: 40px; display: none; padding: 30px;">
                <h3 id="service-form-title"></h3>
                <form id="dynamic-service-form">
                    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Submit
                        Request</button>
                </form>
            </div>

            <h3 style="margin-top: 40px;">Letter Request History</h3>
            <div class="card" style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background-color: var(--color-secondary);">
                            <th style="padding: 10px; border-radius: 8px 0 0 0;">Type</th>
                            <th style="padding: 10px;">Submission Date</th>
                            <th style="padding: 10px; border-radius: 0 8px 0 0;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px;">Surat Keterangan Usaha</td>
                            <td style="padding: 10px;">28 Oct 2025</td>
                            <td style="padding: 10px;"><span class="status-badge status-completed">Ready to Take</span></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px;">Surat Domisili</td>
                            <td style="padding: 10px;">2 Nov 2025</td>
                            <td style="padding: 10px;"><span class="status-badge status-in-process">In Process</span></td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;">SKTM</td>
                            <td style="padding: 10px;">1 Nov 2025</td>
                            <td style="padding: 10px;"><span class="status-badge status-rejected">Missing Docs</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection