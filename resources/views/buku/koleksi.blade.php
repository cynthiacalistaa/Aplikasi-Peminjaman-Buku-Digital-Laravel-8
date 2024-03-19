@extends('template')

@section('content')
    <div class="container">
        <br>
        @if ($koleksiBuku->isEmpty())
            <p>Anda belum memiliki buku dalam koleksi.</p>
        @else
            <div
                style="background-color: white; padding: 15px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <table class="table">
                    <tbody>
                        @foreach ($koleksiBuku as $koleksi)
                            @if ($koleksi->buku)
                                <tr>
                                    <td style="width: 120px;">
                                        <a href="#" data-toggle="modal"
                                            data-target="#gambarModal{{ $koleksi->buku->id }}">
                                            <img src="{{ asset('storage/' . $koleksi->buku->foto) }}" alt="cover buku"
                                                width="100">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="mb-1">
                                            <h5>{{ $koleksi->buku->judul }}</h5>
                                            <h6>{{ $koleksi->buku->penulis }}</h6>
                                            <p>{{ $koleksi->buku->deskripsi }}</p>
                                        
                                            @php
                                                $averageRating = $koleksi->buku->ulasan->avg('rating');
                                            @endphp
                                        
                                            <ul class="list-inline">
                                                <li class="list-inline-item">Terpinjam
                                                    <small class="text-dark fw-semibold">({{ $jumlahPeminjaman }})</small>
                                                </li>
                                                <li class="list-inline-item rating"><i class="fas fa-star"></i>
                                                    {{ !$averageRating ? '0' : $averageRating }}
                                                    <small class="text-dark fw-semibold">(
                                                        {{ !$averageRating ? '0' : $averageRating }}
                                                        rating)</small>
                                                </li>
                                            </ul>
                                        </div>
                                        
                                        <form action="{{ route('pinjam.create', $koleksi->buku->id) }}" method="get"
                                            style="display: inline;">
                                            <input type="hidden" value="{{ $koleksi->buku->id }}" name="id">
                                            <button type="submit" class="btn btn-primary btn-sm">Pinjam Buku</button>
                                        </form>
                                        <form action="{{ route('koleksi.destroy', $koleksi->id) }}" method="post"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="bx bx-heart"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="gambarModal{{ $koleksi->buku->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="gambarModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img src="{{ asset('storage/' . $koleksi->buku->foto) }}" alt="cover buku"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <tr>
                                    <td colspan="2">Buku tidak ditemukan</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Sertakan library Bootstrap dan script JavaScript Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
