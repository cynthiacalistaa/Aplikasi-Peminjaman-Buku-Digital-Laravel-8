@extends('template')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <!-- Create Category Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">{{ __('Tambah Kategori') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="namakategori" class="form-label">Nama Kategori</label>
                            <input id="namakategori" type="text" name="namakategori" class="form-control" value="{{ old('namakategori') }}" required autofocus>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Kategori Index Cards -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List Kategori</div>
                <div class="card-body">
                    @foreach ($kategori as $v)
                        <div class="card mb-2">
                            <div class="card-body d-flex justify-content-between">
                                <h5 class="card-title" style="font-size: 1.2rem;">{{$v->namakategori}}</h5>
                                <div>
                                    <a href="{{ route('kategori.edit', $v->id) }}" class="btn btn-primary btn-sm"><i class="bx bx-pencil"></i></a>
                                    <form action="{{ route('kategori.destroy', $v->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
