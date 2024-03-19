@extends('template')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<div class="container">
    <div class="card mt-3">
        <div class="row">
            <div class="col-sm-4 col-md-4 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-5">
                    <div class="d-flex justify-content-center mb-4 mt-4">
                        <img src="{{ asset('storage/' . $book->foto) }}" class="card-img-top" alt="cover buku"
                            style="max-height: 320px;">
                    </div>
                    <p class="text-muted">{{ $book->judul }}</p>
                </div>
            </div>
            <div class="col-sm-7 mt-4">
                <div class="card-body">
                    <h5 class="card-title text-primary">Apakah kamu yakin ingin mengajukan pinjaman untuk buku ini?</h5>

                    <p class="color-red">Rules:</p>
                    <ol>
                        <li>Satu Peminjam hanya dapat meminjam satu buku yang sama</li>
                        <li>Batas peminjaman buku adalah 7 hari</li>
                        <li>Siap bertanggung jawab atas buku</li>
                        <li>Mengembalikan buku kepada pengawas tepat waktu</li>
                    </ol>

                    <form action="{{ route('pinjam.store', ['id' => $book->id]) }}" method="POST">
                        @csrf
                        <label for="nama">Nama: {{ Auth::user()->namalengkap }}</label>
                        <br>
                        <label>Tanggal Pengembalian: {{ \Carbon\Carbon::now()->addDays(7)->format('Y-m-d') }}</label>
                        <br>
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="buku_id" value="{{ $book->id }}">
                        <br>
                        <button type="submit" class="btn btn-sm btn-outline-primary mr-2">Ajukan Pinjaman</button>
                        <a href="{{ route('list.buku') }}" class="btn btn-sm btn-outline-danger">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
