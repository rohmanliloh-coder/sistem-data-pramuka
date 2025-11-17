<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Daftar Kegiatan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #333;
            padding: 6px;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>
    <h4>Daftar Kegiatan</h4>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Peserta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kegiatans as $i => $k)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $k->nama_kegiatan }}</td>
                    <td>{{ $k->tanggal }}</td>
                    <td>
                        @foreach ($k->anggotas as $a)
                            {{ $a->nama }}@if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
