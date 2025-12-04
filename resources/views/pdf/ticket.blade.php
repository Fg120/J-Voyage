<!DOCTYPE html>
<html>

<head>
    <title>E-Ticket J-Voyage</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            border: 1px solid #ddd;
        }

        /* Header Ungu */
        .header {
            background-color: #5D5FEF;
            color: white;
            padding: 30px;
        }

        .header table {
            width: 100%;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .sub-logo {
            font-size: 10px;
            opacity: 0.8;
            text-transform: uppercase;
        }

        .booking-id {
            text-align: right;
        }

        /* Gambar & Judul */
        .hero {
            margin-top: 20px;
        }

        .wisata-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        /* Body Putih */
        .body {
            padding: 20px;
        }

        .info-table {
            width: 100%;
            margin-top: 20px;
        }

        .info-table td {
            padding-bottom: 15px;
            width: 50%;
            vertical-align: top;
        }

        .label {
            font-size: 10px;
            color: #888;
            font-weight: bold;
            text-transform: uppercase;
        }

        .value {
            font-size: 14px;
            font-weight: bold;
            color: #000;
        }

        .price {
            color: #059669;
            font-size: 16px;
        }

        /* QR Code */
        .qr-area {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px dashed #ccc;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            color: #aaa;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <table>
                <tr>
                    <td>
                        <div class="logo">J-Voyage</div>
                        <div class="sub-logo">Official E-Ticket</div>
                    </td>
                    <td class="booking-id">
                        <div class="sub-logo">Booking ID</div>
                        <div style="font-size: 16px; font-weight: bold;">#{{ $transaksi->id }}</div>
                    </td>
                </tr>
            </table>

            <div class="hero">
                <h2 style="margin:0; font-size: 22px;">{{ $transaksi->pengelola->nama_wisata }}</h2>
                <p style="margin:5px 0 0 0; font-size: 12px; opacity: 0.9;">
                    📍 {{ $transaksi->pengelola->alamat_wisata }}
                </p>
            </div>
        </div>

        <div class="body">

            <div style="text-align: center; margin-bottom: 20px;">

                <img src="data:image/svg+xml;base64, {!! base64_encode(
                    QrCode::format('svg')->size(120)->generate($transaksi->kode ?? 'TRX-' . $transaksi->id),
                ) !!} " width="120">
                <div style="font-size: 12px; font-weight: bold; margin-top: 5px;">
                    {{ $transaksi->kode ?? 'TRX-' . $transaksi->id }}
                </div>
            </div>

            <table class="info-table">
                <tr>
                    <td>
                        <div class="label">Nama Pemesan</div>
                        <div class="value">{{ $transaksi->nama }}</div>
                    </td>
                    <td>
                        <div class="label">Tanggal Kunjungan</div>
                        <div class="value">
                            {{ \Carbon\Carbon::parse($transaksi->tanggal_kunjungan)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Jumlah Tiket</div>
                        <div class="value">{{ $transaksi->jumlah }} Orang</div>
                    </td>
                    <td>
                        <div class="label">Total Pembayaran</div>
                        <div class="value price">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</div>
                    </td>
                </tr>
            </table>

            <div class="footer">
                Harap tunjukkan tiket ini kepada petugas saat masuk.
            </div>
        </div>
    </div>

</body>

</html>
