@extends('template')

@section('content')
<div class="card mt-3 mx-4">
    <h5 class="card-header">Koleksi Buku</h5>
    <div class="card-body">
        <a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">Tambah Buku</a>
        <a href="{{ route('cetak.pengguna') }}" class="btn btn-primary mb-3">Cetak Buku</a>
        <div class="card-datatable text-nowrap">
            <table class="dt-complex-header table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Kategori Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buku as $i => $v)
                    <tr>
                        <!-- <td>
                            <img src="{{ asset('storage/' . $v->foto) }}" alt="cover buku" width="50">
                        </td> -->
                        <td>{{$v->judul}}</td>
                        <td>{{$v->kategori->namakategori}}</td>
                        <td>{{$v->penulis}}</td>
                        <td>{{$v->penerbit}}</td>
                        <td>{{$v->tahunterbit}}</td>
                        <td>
                            <form action="{{route('buku.destroy', $v->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('buku.edit', $v->id) }}" class="btn btn-primary btn-sm"><i class="bx bx-pencil"></i></a>
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
