@extends('layouts.user')

@section('title', 'Layanan Pengaduan | Sistem Informasi Desa')

@section('content')

    <section>
        <div class="container">
            <h2><i class="fas fa-comment-dots"></i> Sistem Pengaduan Masyarakat</h2>

            <div class="card" style="padding: 30px;">
                <h3>Submit New Complaint</h3>
                <form id="complaint-form">
                    <div class="form-group">
                        <label for="comp-nama">nama</label>
                        <input type="text" id="comp-nama" required>
                    </div>
                    <div class="form-group">
                        <label for="comp-title">Title</label>
                        <input type="text" id="comp-title" required>
                    </div>
                    <div class="form-group">
                        <label for="comp-category">Category</label>
                        <select id="comp-category" required>
                            <option value="">Select Category</option>
                            <option value="pelayanan">Service</option>
                            <option value="infrastruktur">Infrastucture</option>
                            <option value="apbdes">APBDes</option>
                            <option value="lainnya">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comp-desc">Description</label>
                        <textarea id="comp-desc" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="comp-image">Upload Image (Optional)</label>
                        <input type="file" id="comp-image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="comp-file">Upload File (Optional)</label>
                        <input type="file" id="comp-file">
                    </div>
                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="comp-anon">
                        <label for="comp-anon" style="margin-bottom: 0;">Submit as Anonymous</label>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 15px;">Submit
                        Complaint</button>
                </form>
            </div>

            <h3 style="margin-top: 40px;">Your Previous Complaints</h3>
            <div class="complaint-history">
                <div class="card" onclick="showComplaintDetail(1)">
                    <div>
                        <h4>Lampu Jalan Mati di Depan Balai Desa</h4>
                        <span style="font-size: 0.9rem; color: var(--color-text-light);">Submitted: 15 Oct 2025</span>
                    </div>
                    <span class="status-badge status-completed">Completed</span>
                </div>
                <div class="card" onclick="showComplaintDetail(2)">
                    <div>
                        <h4>Respon Lambat Permintaan Surat Pengantar</h4>
                        <span style="font-size: 0.9rem; color: var(--color-text-light);">Submitted: 20 Oct 2025</span>
                    </div>
                    <span class="status-badge status-in-process">In Process</span>
                </div>
                <div class="card" onclick="showComplaintDetail(3)">
                    <div>
                        <h4>Usulan Penolakan Pembangunan Posyandu</h4>
                        <span style="font-size: 0.9rem; color: var(--color-text-light);">Submitted: 28 Oct 2025</span>
                    </div>
                    <span class="status-badge status-rejected">Rejected</span>
                </div>
            </div>
        </div>
    </section>

@endsection