@extends('template')

@section('content')
<div class="card mt-3 mx-4">
    <h5 class="card-header">Data Peminjaman</h5>
    <div class="card-datatable text-nowrap">
        <table class="dt-complex-header table table-bordered table-sm">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $p)
                <tr>
                    <td>{{ $p->users->name }}</td>
                    <td>{{ $p->buku->judul }}</td>
                    <td>{{ $p->tanggal_peminjaman }}</td>
                    <td>{{ $p->tanggal_pengembalian ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection