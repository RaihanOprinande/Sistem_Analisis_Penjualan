<!DOCTYPE html>
<html>

<head>
    @vite('resources/css/app.css')
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
    <p>Periode: {{ $tanggal_mulai_formatted }} s/d {{ $tanggal_akhir_formatted }}</p>
    @if ($ringkasanBulanIni->total_laba_kotor)
        <div style="margin-bottom: 20px;">
            <p><b>Ringkasan Bulan Ini:</b></p>
            <ul>
                <li>Total Laba/Rugi Kotor: Rp {{ number_format($ringkasanBulanIni->total_laba_kotor, 2, ',', '.') }}
                </li>
                <li>Total Penjualan: {{ number_format($ringkasanBulanIni->total_penjualan, 0, ',', '.') }} unit</li>
                <li>Total Omset: Rp {{ number_format($ringkasanBulanIni->total_omset, 2, ',', '.') }}</li>
                {{-- <li>Total HPP: Rp {{ number_format($ringkasanBulanIni->total_hpp, 2, ',', '.') }}</li> --}}
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
                        <th>Total Laba/Rugi Kotor</th>
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
                <th>Platfrom</th>
                <th>Komisi</th>
                <th>Menu</th>
                <th>Hpp</th>
                <th class="">Jumlah</th>
                <th>Harga Jual</th>
                <th>Omset</th>
                <th>Laba Kotor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $item)
                <tr>
                    <td class="whitespsace-nowrap">{{ $item->tanggal_transaksi }}</td>
                    <td>{{ $item->platfrom->platfrom }}</td>
                    <td>{{ $item->komisi->komisi }} %</td>
                    <td>{{ $item->menu->menu_name }}</td>
                    <td>{{ 'Rp.' . number_format($item->menu->hpp, 0, ',', '.') }}</td>
                    <td>{{ $item->jumlah_pesanan }}</td>
                    <td>{{ 'Rp. ' . number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ 'Rp. ' . number_format($item->harga * $item->jumlah_pesanan, 0, ',', '.') }}</td>
                    <td>{{ 'Rp.' . number_format($item->laba_kotor, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
