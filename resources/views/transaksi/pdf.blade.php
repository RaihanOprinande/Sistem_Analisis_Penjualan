<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">Laporan Transaksi</h1>
    <p>Periode: {{ date('d-m-Y', strtotime($tanggal_mulai)) }} s/d {{ date('d-m-Y', strtotime($tanggal_akhir)) }}</p>
    @if ($ringkasanBulanIni->total_laba_kotor)
        <div style="margin-bottom: 20px;">
            <p><b>Ringkasan Bulan Ini:</b></p>
            <ul>
                <li>Total Laba Kotor: Rp {{ number_format($ringkasanBulanIni->total_laba_kotor, 2, ',', '.') }}</li>
                <li>Total Penjualan: {{ number_format($ringkasanBulanIni->total_penjualan, 0, ',', '.') }} unit</li>
            </ul>
        </div>
    @endif

    @if ($ringkasanPerPlatform->isNotEmpty())
        <div style="margin-bottom: 20px;">
            <p><b>Ringkasan Per Platform:</b></p>
            <table>
                <thead>
                    <tr>
                        <th>Platform</th>
                        <th>Total Penjualan</th>
                        <th>Total Laba Kotor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ringkasanPerPlatform as $ringkasan)
                        <tr>
                            <td>{{ $ringkasan->platfrom_name }}</td>
                            <td>{{ number_format($ringkasan->total_penjualan, 0, ',', '.') }} unit</td>
                            <td>Rp {{ number_format($ringkasan->total_laba_kotor, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Platform</th>
                <th>Menu</th>
                <th>Jumlah Pesanan</th>
                <th>Harga</th>
                <th>Laba Kotor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->tanggal_transaksi }}</td>
                    <td>{{ $transaksi->platfrom->platfrom }}</td>
                    <td>{{ $transaksi->menu->menu_name }}</td>
                    <td>{{ $transaksi->jumlah_pesanan }}</td>
                    <td>Rp {{ number_format($transaksi->harga, 3, ',', '.') }}</td>
                    <td>Rp {{ number_format($transaksi->laba_kotor, 3, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
