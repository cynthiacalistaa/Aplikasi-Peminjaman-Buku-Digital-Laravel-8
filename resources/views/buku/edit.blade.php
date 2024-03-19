@extends('template')

@section('content')
<div class="card mt-3 mx-4">
    <h5 class="card-header">Edit Buku</h5>
    <div class="card-body mb-5">
        <form action="{{ route('buku.update', $buku->id) }}" method="post" enctype="multipart/form-data" class="book-form">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="foto">Cover Buku:</label>
                <div class="card" style="width: 200px;">
                    <img src="{{ asset('storage/' . $buku->foto) }}" alt="Cover Buku" class="card-img-top">
                </div>
                <input type="file" name="foto" id="foto" accept="image/*" class="form-control mt-2">
            </div>

            <div class="form-group mb-3">
                <label for="judul">Judul Buku:</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $buku->judul) }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="kategori">Kategori:</label>
                <select name="kategori" id="kategori" class="form-control">
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori', $buku->kategori_id) == $kat->id ? 'selected' : '' }}>
                            {{ $kat->namakategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="penulis">Penulis:</label>
                <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $buku->penulis) }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="penerbit">Penerbit:</label>
                <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="tahunterbit">Tahun Terbit:</label>
                <input type="text" name="tahunterbit" id="tahunterbit" value="{{ old('tahunterbit', $buku->tahunterbit) }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="stok">Stok Buku:</label>
                <input type="number" name="stok" id="stok" value="{{ old('stok', $buku->stok) }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
