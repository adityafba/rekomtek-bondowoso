<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Form Permohonan Rekomtek</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 40px;
        }
        .header {
            text-align: left;
            margin-bottom: 30px;
        }
        .date {
            text-align: right;
            margin-bottom: 20px;
        }
        .address {
            margin-bottom: 30px;
        }
        .subject {
            margin-bottom: 30px;
        }
        .content {
            margin-bottom: 30px;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        td {
            padding: 8px;
            vertical-align: top;
        }
        .label {
            width: 200px;
        }
    </style>
</head>
<body>
    <div class="header">
        {{ $application->instansi }}<br>
        {{ $application->alamat }}
    </div>

    <div class="date">
        Nomor: {{ $application->getFormattedId() }}<br>
        ID Permohonan: {{ $application->getTrackingId() }}<br>
        {{ now()->format('d/m/Y') }}
    </div>

    <div class="address">
        Yth.<br>
        PU SDA Bondowoso<br>
        di Tempat<br>
    </div>

    <div class="subject">
        <strong>Perihal: Permohonan Rekomendasi Teknis {{ ucfirst($application->jenis_izin) }} 
        {{ $application->sub_jenis_izin }} Untuk Kegiatan {{ $application->nama_pekerjaan }}</strong>
    </div>

    <div class="content">
        Yang bertanda tangan di bawah ini:<br><br>

        <table>
            <tr>
                <td class="label">Nama</td>
                <td>: {{ $application->nama }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>: {{ $application->nama_pekerjaan }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>: {{ $application->jabatan }}</td>
            </tr>
        </table>

        <p>Bertindak untuk atas nama</p>

        <table>
            <tr>
                <td class="label">Nama Perusahaan</td>
                <td>: {{ $application->instansi }}</td>
            </tr>
            <tr>
                <td>Alamat Perusahaan</td>
                <td>: {{ $application->alamat }}</td>
            </tr>
        </table>

        <p>Mengajukan permohonan rekomendasi teknis untuk kegiatan {{ $application->nama_pekerjaan }} 
        guna melengkapi persyaratan permohonan {{ ucfirst($application->jenis_izin) }} {{ $application->sub_jenis_izin }}, 
        dengan data-data sebagai berikut:</p>

        <table>
            <tr>
                <td colspan="2"><strong>A. Lokasi</strong></td>
            </tr>
            <tr>
                <td class="label">Koordinat</td>
                <td>: {{ $application->latitude }}, {{ $application->longitude }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>B. {{ ucfirst($application->jenis_izin) }} Air</strong></td>
            </tr>
            <tr>
                <td>Tujuan</td>
                <td>: {{ $application->tujuan }}</td>
            </tr>
            <tr>
                <td>Cara Pengambilan</td>
                <td>: {{ $application->cara_pengambilan }}</td>
            </tr>
            <tr>
                <td>Volume Pengambilan</td>
                <td>: {{ $application->volume_pengambilan }} liter/detik</td>
            </tr>
            <tr>
                <td>Jenis/Tipe Konstruksi</td>
                <td>: {{ $application->jenis_konstruksi }}</td>
            </tr>
            <tr>
                <td>Jadwal Pelaksanaan</td>
                <td>: {{ $application->jadwal_pelaksanaan }} hari kalender</td>
            </tr>
            <tr>
                <td>Rencana Pelaksanaan</td>
                <td>: {{ $application->rencana_pelaksanaan_mulai->format('d/m/Y') }} - {{ $application->rencana_pelaksanaan_selesai->format('d/m/Y') }}</td>
            </tr>
        </table>

        <p>Sebagai bahan pertimbangan, kami sampaikan dokumen pendukung sebagai berikut:</p>
        <ol>
            <li>Gambar Lokasi/Peta Situasi (disertai titik koordinat pengambilan dan/atau jalur konstruksi)</li>
            <li>Gambar Desain Bangunan (pengambilan, pembuangan air maupun prasarana lainnya)</li>
            <li>Spesifikasi Teknis Bangunan</li>
            <li>Proposal Teknik/Penjelasan {{ ucfirst($application->jenis_izin) }} Air</li>
            <li>Manual Operasi dan Pemeliharaan Konstruksi</li>
            <li>Rencana Operasi dan Pemeliharaan pada Sumber Air</li>
            <li>Metodologi Pelaksanaan Pekerjaan</li>
            @if($application->jenis_pemohon === 'perpanjangan')
            <li>Salinan Izin {{ ucfirst($application->jenis_izin) }} yang akan diperpanjang</li>
            @endif
        </ol>
    </div>

    <div class="signature">
        <p>Pemohon</p>
        <br><br><br>
        <p>({{ $application->nama }})</p>
    </div>

    <div style="margin-top: 30px">
        <p><strong>Tembusan:</strong></p>
        <ol>
            <li>Unit Rekomendasi Teknis PU SDA.</li>
        </ol>
    </div>
</body>
</html>
