@if ($data['type'] == 'pdf')
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

            .tgl-unduh p {
                text-align: end;
                color: #a8a8a8
            }
        </style>
    </head>

    <body>
        <h3 class="header">Laporan Transaksi</h3>
        <div>
            <p style="float: left; margin-right: 10px;"><strong>Nama Outlet</strong></p>
            <p style="float: left;">: {{ $data['outlet']->outlet_name }}</p>
            <div style="clear: both;"></div>
        </div>
        <div>
            <p style="float: left; margin-right: 10px;"><strong>Alamat</strong></p>
            <p style="float: left;">: {{ $data['outlet']->address }}</p>
            <div style="clear: both;"></div>
        </div>
        <div>
            <p style="float: left; margin-right: 10px;"><strong>Telepon</strong></p>
            <p style="float: left;">: {{ $data['outlet']->phone }}</p>
            <div style="clear: both;"></div>
        </div>
        <div>
            <p style="float: left; margin-right: 10px;"><strong>Tanggal Laporan</strong></p>
            <p style="float: left;">: {{ $data['fromDate'] }} - {{ $data['toDate'] }}</p>
            <div style="clear: both;"></div>
        </div>
        <hr>
        <div class="tgl-unduh" style="text-align: right">
            <p>Tanggal diunduh : {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
        </div>
@endif
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
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>
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
@if ($data['type'] == 'pdf')
    </body>

    </html>
@endif
