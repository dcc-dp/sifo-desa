<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
            line-height: 1.6;
        }

        .header {
            text-align: center;
        }

        .judul {
            text-align: center;
            margin-top: 20px;
        }

        .nomor {
            text-align: center;
            font-size: 13px;
        }

        .judul h3 {
            margin: 0;
            text-decoration: underline;
        }

        table {
            width: 100%;
        }

        .ttd {
            margin-top: 50px;
            text-align: right;
        }

        table.identitas {
            margin-left: 30px;
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

                <div style="font-size:16px; font-weight:bold;">
                    PEMERINTAH KABUPATEN MAKASSAR
                </div>

                <div style="font-size:16px; font-weight:bold;">
                    KECAMATAN MAKASSAR
                </div>

                <div style="font-size:22px; font-weight:bold;">
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
            <h3>SURAT KETERANGAN USAHA</h3>
        </div>
        
        <div class="nomor">
            Nomor : {{ $surat->nomor_surat }}
        </div>

    <br><br>

    <p>
        Yang bertanda tangan di bawah ini Kepala {{ $setting->nama_desa }}
        menerangkan dengan sebenar-benarnya bahwa :
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
            <td>:
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
            <td>Agama</td>
            <td>: {{ $surat->penduduk->agama }}</td>
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
    </p>

    <table>

        <tr>
            <td width="35%">Nama Usaha</td>
            <td>: {{ $surat->usaha->nama_usaha }}</td>
        </tr>

        <tr>
            <td>Alamat Usaha</td>
            <td>: {{ $surat->usaha->alamat_usaha }}</td>
        </tr>

    </table>

    <br>

    <p>
        Demikian surat keterangan ini dibuat agar dapat
        dipergunakan sebagaimana mestinya.
    </p>

    <br>

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
