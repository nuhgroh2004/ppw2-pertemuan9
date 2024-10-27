<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <div class="container mt-5">

        @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul style="list-style: none">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif

        <h4 class="mb-4">Tambah Buku</h4>
        <form method="post" action="{{Route('buku.store')}}">

            @csrf
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul buku">
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Masukkan nama penulis">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukkan harga buku">
            </div>
            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="date" class="form-control" id="tahun_terbit" name="tahun_terbit">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{Route('buku.index')}}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <!-- Bootstrap JS (optional) -->
    <script type="text/javascript">
        $('.date').datepicker({
            dateFormat: 'yy/mm/dd',
            autoclose: true
        });
    </script>
</body>
</html>
