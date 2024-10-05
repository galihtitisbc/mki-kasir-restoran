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
    </style>
</head>

<body>
    <table>
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Kasir</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Outlet</th>
                <th>Harga Produk</th>
                <th>Quantity</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($transactions as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>
                        @foreach ($item->product->categories as $cat)
                            {{ $loop->last ? $cat->category_name : $cat->category_name . ',' }}
                        @endforeach
                    </td>
                    <td>{{ $item->outlet->outlet_name }}</td>
                    <td>{{ $item->product_price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->total_price }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
