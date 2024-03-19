@extends('template')

@section('content')
    <div class="card mt-3 mx-4">
        <div class="card-body">
            <form action="{{ route('cetak.peminjaman') }}" method="post" class="row">
                @csrf
                <div class="form-group col-md-2">
                    <label for="tanggal_pilih">Pilih Tanggal</label>
                    <input type="date" name="tanggal_pilih" class="form-control" required>
                </div>
                <div class="col-md-3 mt-4">
                    <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                </div>
            </form>

            <div class="card mt-4">
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
                                    <td>{{ $p->users->namalengkap }}</td>
                                    <td>{{ $p->buku->judul }}</td>
                                    <td>{{ $p->tanggalpeminjaman }}</td>
                                    <td>{{ $p->tanggalpengembalian ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
