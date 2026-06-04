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
            <img src="{{ public_path('uploads/galeri/desacantik.jpg') }}" width="98%">
        </td>

        <td width="82%" align="center">

            <div style="font-size:16px;font-weight:bold;">
                PEMERINTAH KABUPATEN MAKASSAR
            </div>

            <div style="font-size:16px;font-weight:bold;">
                KECAMATAN MAKASSAR
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
    <h3>SURAT KETERANGAN IZIN KERAMAIAN</h3>
</div>

<div class="nomor">
    Nomor : {{ $surat->nomor_surat }}
</div>

<br><br>

<p>
    Yang bertanda tangan di bawah ini Kepala
    {{ $setting->nama_desa }}
    menerangkan dengan sebenarnya bahwa:
</p>

<br>

<table>

    <tr>
        <td width="35%">Nama</td>
        <td>: {{ $surat->penduduk->nama }}</td>
    </tr>

    <tr>
        <td>Tempat / Tanggal Lahir</td>
        <td>
            :
            {{ $surat->penduduk->tempat_lahir }},
            {{ \Carbon\Carbon::parse($surat->penduduk->tanggal_lahir)->translatedFormat('d F Y') }}
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
    Orang tersebut di atas adalah benar-benar penduduk
    {{ $setting->nama_desa }}.
</p>

<p>
    Adapun surat keterangan ini untuk dipergunakan
    sebagai persyaratan izin keramaian pada:
</p>

<br>

<table>

    <tr>
        <td width="35%">Hari</td>
        <td>: {{ $surat->izin->hari }}</td>
    </tr>

    <tr>
        <td>Tanggal</td>
        <td>
            :
            {{ \Carbon\Carbon::parse($surat->izin->tanggal)->translatedFormat('d F Y') }}
        </td>
    </tr>

    <tr>
        <td>Acara</td>
        <td>: {{ $surat->izin->jenis_acara }}</td>
    </tr>

    <tr>
        <td>Jumlah Peserta</td>
        <td>: {{ $surat->izin->jumlah_peserta }} Orang</td>
    </tr>

    <tr>
        <td>Tempat Acara</td>
        <td>: {{ $surat->izin->tempat }}</td>
    </tr>

</table>

<br>

<p>
    Demikian surat keterangan izin keramaian ini dibuat
    dengan sebenarnya untuk dipergunakan sebagaimana mestinya.
</p>

<div class="ttd">

    {{ $setting->nama_desa }},
    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}

    <br><br>

    Kepala Desa

    <br><br><br>

    <strong>
        <u>{{ strtoupper($kepalaDesa->nama) }}</u>
    </strong>

</div>

</body>
</html>