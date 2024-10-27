@extends('auth.layouts')

@section('content')
    <form action="{{ route('buku.search') }}" method="GET" style="margin-top: 20px; margin-left: 20px;">
        @csrf
        <input type="text" name="kata" class="form-control" placeholder="Cari..."
               style="width: 30%; margin-bottom: 10px; border: 2px solid #007bff; box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);">
    </form>

    <table class="table mt-3">
        @if (Session::has('successadd'))
        <div class="alert alert-success" id="success-alert" style="background-color: rgb(57, 182, 57); color: white;">{{ Session::get('successadd') }}</div>
        @endif
        @if (Session::has('successedit'))
            <div class="alert alert-success" id="success-alert" style="background-color: rgb(45, 101, 255); color: white;">{{ Session::get('successedit') }}</div>
        @endif
        @if (Session::has('successdel'))
            <div class="alert alert-success" id="success-alert" style="background-color: rgb(255, 98, 98); color: white;">{{ Session::get('successdel') }}</div>
        @endif
        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);
        </script>
        <thead class="table-light">
            <tr>
                <th>id</th>
                <th>Judul Buku</th>
                <th>Penerbit</th>
                <th>Harga</th>
                <th>Tahun Terbit</th>
                @if($isAuthenticated)
                    <th class="text-center">Hapus</th>
                    <th class="text-center">Update</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($data_buku as $index => $Buku)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $Buku->judul }}</td>
                    <td>{{ $Buku->penulis }}</td>
                    <td>Rp. {{ number_format($Buku->harga, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($Buku->tahun_terbit)->format('d/m/Y') }}</td>
                    @if($isAuthenticated)
                        <td class="text-center">
                            <form action="{{ route('buku.destroy', $Buku->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('Yakin mau dihapus')" type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('buku.edit', $Buku->id) }}" class="btn btn-primary">Update</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-right: 20px">{{ $data_buku->links('pagination::bootstrap-5') }}</div>

    @if($isAuthenticated)
        <div class="d-flex justify-content-center mt-3 mb-3">
            <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a>
        </div>
    @endif
@endsection
