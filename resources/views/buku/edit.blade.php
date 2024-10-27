{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<a, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>ini halaman update</h2>
<form action="{{ route('buku.update', $buku->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="judul">Judul Buku:</label>
        <input type="text" name="judul" value="{{ $buku->judul }}" required>

        <label for="penulis">Penulis:</label>
        <input type="text" name="penulis" value="{{ $buku->penulis }}" required>

        <label for="harga">Harga:</label>
        <input type="number" name="harga" value="{{ $buku->harga }}" required>

        <label for="tahun_terbit">tahun_terbit:</label>
        <input type="date" name="tahun_terbit" value="{{ $buku->tahun_terbit instanceof \DateTime ? $buku->tahun_terbit->format('d/m/y') : $buku->tahun_terbit }}" required>

        <button type="submit">Update</button>
        <a href="{{ route('buku.index') }}">Kembali</a>
    </form>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Update Buku</h2>
        @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul style="list-style: none">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif

        <form action="{{ route('buku.update', $buku->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku:</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}" required>
            </div>

            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis:</label>
                <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga:</label>
                <input type="text" class="form-control" id="harga" name="harga" value="{{ $buku->harga }}" required>
            </div>

            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit:</label>
                <input type="date" class="form-control" id="tahun_terbit" name="tahun_terbit" value="{{ $buku->tahun_terbit instanceof \DateTime ? $buku->tahun_terbit->format('Y-m-d') : $buku->tahun_terbit }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
