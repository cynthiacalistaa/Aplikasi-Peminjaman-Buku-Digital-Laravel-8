@extends('template')

@section('content')
    <div class="search-container mb-4">
        <form action="{{ route('buku.search') }}" method="GET" class="form-inline">
            <div class="form-group mr-2">
                <label for="kategori" class="mr-2">Pilih Kategori:</label>
                <select name="kategori" id="kategori" class="form-control">
                    <option value="" selected>Semua Kategori</option>
                    @foreach ($kategori as $v)
                        <option value="{{ $v->id }}">{{ $v->namakategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>

    <div class="result-container row">
        @forelse ($buku as $p)
            <div class="col-lg-3 mb-4 mt-3">
                <div class="card shadow" style="border-radius: 20px; height: 100%;">
                    <a href="#" data-toggle="modal" data-target="#gambarModal{{ $p->id }}">
                        <img src="{{ asset('storage/' . $p->foto) }}" class="card-img-top" alt="cover buku"
                            style="object-fit: cover; height: 200px;">
                    </a>
                    <p class="card-text mb-0">
                        <span class="badge @if ($p->stok > 0) bg-success @else bg-danger @endif">
                            @if ($p->stok > 0)
                                Buku Tersedia
                            @else
                                Buku Tidak Tersedia
                            @endif
                        </span>
                    </p>
                    <div class="card-body">
                        <h5 class="card-title mb-auto">{{ $p->judul }}</h5>
                        <p class="card-text mb-2">{{ $p->penulis }}</p>

                        <div class="d-flex justify-content-between mt-2">
                            @if ($p->stok > 0)
                                <form action="{{ route('pinjam.create', $p->id) }}" method="get">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Pinjam</button>
                                </form>
                            @endif
                            <form action="{{ route('koleksi.store') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="BukuID" value="{{ $buku->buku_id }}" />
                                <input type="hidden" name="UserID" value="{{ auth::user()->user_id }}" />
                                @if ($buku->koleksipribadi->contains('UserID', $userID))
                                    <button class="btn btn-icon btn-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                        title="<i class='bx bx-heart bx-xs' ></i> <span>Hapus dari Koleksi</span>">
                                        <span class="tf-icons bx bx-heart"></span>
                                    </button>
                                @else
                                    <button class="btn btn-icon btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                        title="<i class='bx bx-heart bx-xs' ></i> <span>Tambah ke Koleksi</span>">
                                        <span class="tf-icons bx bx-heart"></span>
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="gambarModal{{ $p->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="gambarModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('storage/' . $p->foto) }}" alt="cover buku" class="img-fluid"
                                        style="max-width: 100%; height: auto;">
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text mt-3">{{ $p->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-12">Tidak ada buku yang ditemukan sesuai dengan kategori yang dipilih.</p>
        @endforelse
    </div>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
