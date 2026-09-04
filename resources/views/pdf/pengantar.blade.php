<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>
        body{
            font-family:"Times New Roman", serif;
            font-size:14px;
            line-height:1.7;
        }

        .judul{
            text-align:center;
            margin-top:20px;
        }

        .judul h3{
            margin:0;
            text-decoration:underline;
        }

        .nomor{
            text-align:center;
            font-size:13px;
        }

        table{
            width:100%;
        }

        .ttd{
            margin-top:50px;
            text-align:right;
        }
    </style>
</head>
<body>

<table width="100%">
    <tr>

        <td width="18%" align="center">
            @if (!empty($setting->logo_surat) && file_exists(public_path($setting->logo_surat)))
                <img src="{{ public_path($setting->logo_surat) }}" width="98%">
            @elseif (file_exists(public_path('uploads/galeri/logo_sifo.png')))
                <img src="{{ public_path('uploads/galeri/logo_sifo.png') }}" width="98%">
            @endif
        </td>

        <td width="82%" align="center">

            <div style="font-size:16px; font-weight:bold;">
                    PEMERINTAH KABUPATEN BUTON UTARA
                </div>

                <div style="font-size:16px; font-weight:bold;">
                    KECAMATAN BONE GUNU
                </div>

            <div style="font-size:22px;font-weight:bold;">
                {{ strtoupper($setting->nama_desa) }}
            </div>

            <div style="font-size:12px;">
                {{ $setting->alamat }}
            </div>

            <div style="font-size:12px;">
                Email : {{ $setting->email }}
                |
                Telp : {{ $setting->telepon }}
            </div>

        </td>

    </tr>
</table>

<hr style="border:2px solid black;">

<div class="judul">
    <h3>SURAT PENGANTAR</h3>
</div>

<div class="nomor">
    Nomor : {{ $surat->nomor_surat }}
</div>

<br><br>

<p>
Yang bertanda tangan di bawah ini Kepala
{{ $setting->nama_desa }}
menerangkan dengan sebenarnya bahwa :
</p>

<br>

<table>

    <tr>
        <td width="35%">Nama</td>
        <td>: {{ $surat->penduduk->nama }}</td>
    </tr>

    <tr>
        <td>NIK</td>
        <td>: {{ $surat->penduduk->nik }}</td>
    </tr>

    <tr>
        <td>Tempat / Tanggal Lahir</td>
        <td>
            :
            {{ $surat->penduduk->tempat_lahir }},
            {{ \Carbon\Carbon::parse($surat->penduduk->tanggal_lahir)->format('d-m-Y') }}
        </td>
    </tr>

    <tr>
        <td>Jenis Kelamin</td>
        <td>
            :
            {{ $surat->penduduk->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
        </td>
    </tr>

    <tr>
        <td>Pekerjaan</td>
        <td>: {{ $surat->penduduk->pekerjaan }}</td>
    </tr>

    <tr>
        <td>Alamat</td>
        <td>
            :
            {{ $surat->penduduk->alamat }}
            RT {{ $surat->penduduk->rt->nomor_rt ?? '-' }}
            /
            RW {{ $surat->penduduk->rw->nomor_rw ?? '-' }}
        </td>
    </tr>

</table>

<br>

<p>
Adalah benar warga {{ $setting->nama_desa }}
yang memerlukan surat pengantar untuk keperluan:
</p>

<p style="margin-left:40px;">
    <strong>
        {{ strtoupper($surat->pengantar->keperluan) }}
    </strong>
</p>

<p>
Demikian surat pengantar ini dibuat dengan sebenarnya
agar dapat dipergunakan sebagaimana mestinya.
</p>

<div class="ttd">

    <div>
        {{ $setting->nama_desa }},
        {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
    </div>

    <br>

    <div>
        Kepala Desa
    </div>

    <div style="position:relative; height:90px; width:250px; margin-left:auto; right:-40px;">
        @if (!empty($setting->stempel_surat) && file_exists(public_path($setting->stempel_surat)))
            <img
                src="{{ public_path($setting->stempel_surat) }}"
                width="110"
                style="
                    position:absolute;
                    left:20px;
                    top:10px;
                    z-index:1;
                ">
        @elseif (file_exists(public_path('uploads/galeri/stempel.png')))
            <img
                src="{{ public_path('uploads/galeri/stempel.png') }}"
                width="110"
                style="
                    position:absolute;
                    left:20px;
                    top:10px;
                    z-index:1;
                ">
        @endif
    
        @if (!empty($setting->ttd_kepala_desa) && file_exists(public_path($setting->ttd_kepala_desa)))
            <img
                src="{{ public_path($setting->ttd_kepala_desa) }}"
                width="130"
                style="
                    position:absolute;
                    left:90px;
                    top:0;
                    z-index:2;
                ">
        @elseif (file_exists(public_path('uploads/galeri/ttd_kedes.png')))
            <img
                src="{{ public_path('uploads/galeri/ttd_kedes.png') }}"
                width="130"
                style="
                    position:absolute;
                    left:90px;
                    top:0;
                    z-index:2;
                ">
        @endif
    </div>     

    <div style="margin-top:10px;">
        <strong>
            <u>{{ strtoupper($kepalaDesa->nama ?? $setting->nama_kepala_desa ?? 'KEPALA DESA') }}</u>
        </strong>
    </div>

</div>

</body>
</html>