<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>
    <div class="container">
        <h2>Data Buku</h2>
        @if (count($data_buku))
            <div class="alert alert-success">
                Ditemukan <strong>{{ count($data_buku) }}</strong>
                data dengan kata: <strong>{{ $cari }}</strong>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('buku.search') }}" method="GET" style="margin-top: 10px;">
                        @csrf
                        <input type="text" name="kata" class="form-control" placeholder="Cari..." style="width: 30%; margin-bottom: 10px;">
                    </form>

                    <table id="myTable" class="display table table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Judul Buku</td>
                                <td>Penulis</td>
                                <td>Harga</td>
                                <td>Tanggal Terbit</td>
                                @auth
                                    <td>Aksi</td>
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_buku as $index => $buku)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $buku->judul }}</td>
                                    <td>{{ $buku->penulis }}</td>
                                    <td>{{ "Rp. " . number_format($buku->harga, 2, '.', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($buku->tahun_terbit)->format('d/m/Y') }}</td>
                                    @auth
                                        <td>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <form action="{{ route('buku.edit', $buku->id) }}" method="GET">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                                <div class="col-md-4">
                                                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div>{{ $data_buku->links('pagination::bootstrap-5') }}</div>
                    <p>Jumlah buku: {{ $count }} buku</p>
                @else
                    <div class="alert alert-warning">
                        <h4>Data {{ $cari }} tidak ditemukan</h4>
                        <a href="{{ route('buku.index') }}">Kembali</a>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
