
@extends('template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-0">
                <br>
                <form action="{{ route('buku.search') }}" method="GET" id="searchForm" class="mb-3">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="input-group">
                                <select name="kategori" id="kategori" class="form-select">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->namakategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-8">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                                    aria-describedby="search-addon" name="title" />
                                <button type="submit" class="btn btn-primary"><i class="bx bx-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            @foreach ($buku as $p)
                <div class="col-lg-3 mb-4">
                    <div class="card shadow">
                        <a href="{{ route('buku.show', $p->id) }}">
                            <img src="{{ asset('storage/' . $p->foto) }}" class="card-img-top" alt="cover buku" style="height: 400px; object-cover: cover">
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
                                <form action="{{ route('koleksi.store') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $p->id }}" />
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                                    @if ($p->koleksipribadi->contains('users_id', $users_id))
                                        <button class="btn btn-icon btn-danger btn-sm" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                            title="<i class='bx bx-heart bx-xs'></i> <span>Hapus dari Koleksi</span>">
                                            <span class="tf-icons bx bx-heart"></span>
                                        </button>
                                    @else
                                        <button class="btn btn-icon btn-outline-danger btn-sm"
                                            data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom"
                                            data-bs-html="true"
                                            title="<i class='bx bx-heart bx-xs'></i> <span>Tambah ke Koleksi</span>">
                                            <span class="tf-icons bx bx-heart"></span>
                                        </button>
                                    @endif
    
                                    <a href="{{route('pinjam.create',$p->id)}}" class="{{$p->stok == 0 ? 'btn btn-outline-danger btn-sm disabled' : 'btn btn-outline-primary btn-sm'}} ">Pinjam</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <script>
            document.getElementById('kategori').addEventListener('change', function () {
                document.getElementById('searchForm').submit();
            });
        </script>
@endsection

