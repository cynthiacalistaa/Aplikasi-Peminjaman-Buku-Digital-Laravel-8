@extends('template')

@section('content')
<div class="card mt-3 mx-auto">
    <h5 class="card-header">Edit Kategori</h5>
    <div class="card-body">
        <form method="POST" action="{{ route('kategori.update', ['id' => $kategori->id]) }}" class="category-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="namakategori">Nama Kategori:</label>
                <input id="namakategori" type="text" name="namakategori" value="{{ old('namakategori', $kategori->namakategori) }}" class="form-control" required autofocus>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>
</div>
@endsection
