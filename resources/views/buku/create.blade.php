@extends('template')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <br>
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Buku</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="foto">Cover Buku</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="judul">Judul Buku</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="kategori_id">Kategori</label>
                        <select class="form-control" name="kategori_id">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->namakategori }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger">{{ $errors->first('kategori_id') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="penulis">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" value="{{ old('penulis') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="tahunterbit">Tahun Terbit</label>
                        <input type="number" class="form-control" id="tahunterbit" name="tahunterbit" value="{{ old('tahunterbit') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="stok">Stok Buku</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection
