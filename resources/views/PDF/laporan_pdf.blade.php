<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        thead {
            background-color: #a8a8a8;
        }

        .header {
            text-align: center
        }

        .laporan {
            width: 100%;
        }

        .row {
            display: flex;
            margin-bottom: 10px;
        }

        .label {
            flex: 1;
            font-weight: bold;
        }

        .value {
            flex: 2;
        }

        .tgl-unduh p {
            text-align: end;
            color: #a8a8a8
        }
    </style>
</head>

<body>
    <h3 class="header">Laporan Transaksi</h3>
    <div class="laporan">
        <div class="row">
            <div class="label">Alamat</div>
            <div class="value">: Jl. Mendut Gang 5 Taman Baru</div>
        </div>
        <div class="row">
            <div class="label">Telepon</div>
            <div class="value">: 082131077330</div>
        </div>
        <div class="row">
            <div class="label">Email</div>
            <div class="value">: suryakopitiam@gmail.com</div>
        </div>
        <div class="row">
            <div class="label">Tanggal Laporan</div>
            <div class="value">: 01 Oktober 2024 - 01 November 2024</div>
        </div>
    </div>
    <hr>
    <div class="tgl-unduh">
        <p>Tanggal diunduh : Selasa, 08 Oktober 2024</p>
    </div>
    <table>
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Penjualan</th>
                <th>Pajak</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @php
                $totalPajak = 0;
                $totalJumlah = 0;
                $totalPenjualan = 0;
            @endphp
            @foreach ($data['transactions'] as $item)
                @php
                    $totalPajak += $item->taxs->sum('pivot.total');
                    $totalJumlah += $item->total_penjualan + $item->taxs->sum('pivot.total');
                    $totalPenjualan += $item->total_penjualan;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->total_penjualan }}</td>
                    <td>{{ $item->taxs->sum('pivot.total') }}</td>
                    <td>{{ $item->total_penjualan + $item->taxs->sum('pivot.total') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2"><strong>Jumlah : </strong></td>
                <td><strong>{{ $totalPenjualan }}</strong></td>
                <td><strong>{{ $totalPajak }}</strong></td>
                <td><strong>{{ $totalJumlah }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
