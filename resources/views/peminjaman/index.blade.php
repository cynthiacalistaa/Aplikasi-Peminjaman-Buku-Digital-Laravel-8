@extends('template')

@section('content')
    <div class="card-body mx-2">
        <div style="background-color: white; padding: 15px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            @if ($count > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><i class="bx bx-info-circle"></i></th>
                            <th><i class="bx bx-book"></i></th>
                            <th><i class="bx bx-calendar"></i></th>
                            <th><i class="bx bx-calendar"></i></th>
                            <th><i class="bx bx-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $peminjamanItem)
                            <tr>
                                <td>
                                    @if ($peminjamanItem->status == 0)
                                        <span class="badge bg-info">Sedang Dipinjam</span>
                                    @elseif ($peminjamanItem->status == 1)
                                        <span class="badge bg-success">Telah Dikembalikan</span>
                                    @elseif (strtotime($peminjamanItem->tanggalpengembalian) < strtotime(now()))
                                        <span class="badge bg-danger">Waktunya buku dikembalikan</span>
                                    @endif

                                </td>
                                <td>{{ $peminjamanItem->buku->judul }}</td>
                                <td>{{ date('d-m-Y', strtotime($peminjamanItem->tanggalpeminjaman)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($peminjamanItem->tanggalpengembalian)) }}</td>
                                <td>
                                    @if ($peminjamanItem->status == 0)
                                        <form method="POST" action="{{ route('pengembalian', $peminjamanItem->id) }}"
                                            onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan buku?')">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Kembalikan</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#ulasanModal-{{ $peminjamanItem->id }}">
                                            Berikan Ulasan
                                        </button>

                                        <div class="modal fade" id="ulasanModal-{{ $peminjamanItem->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="ulasanModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ulasanModalLabel">Berikan Ulasan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"
                                                            action="{{ route('ulasan.store', $peminjamanItem->id) }}"
                                                            onsubmit="return confirm('Apakah Anda yakin ingin memberikan ulasan?')">
                                                            @csrf
                                                            <input type="hidden" name="users_id"
                                                                value="{{ Auth::id() }}">
                                                            <input type="hidden" name="buku_id"
                                                                value="{{ $peminjamanItem->buku->id }}">


                                                            <div class="mb-3">
                                                                <label for="Rating" class="form-label">Rating</label>
                                                                <div class="rating">
                                                                    <i class="far fa-star" data-rating="1"></i>
                                                                    <i class="far fa-star" data-rating="2"></i>
                                                                    <i class="far fa-star" data-rating="3"></i>
                                                                    <i class="far fa-star" data-rating="4"></i>
                                                                    <i class="far fa-star" data-rating="5"></i>
                                                                    <input type="hidden" name="rating"
                                                                        id="selected-rating" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="ulasan" class="form-label">Ulasan:</label>
                                                                <textarea name="ulasan" rows="3" class="form-control" required></textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="mt-4">Tidak ada buku yang sedang dipinjam saat ini.</p>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stars = document.querySelectorAll('.rating i');
            const ratingInput = document.getElementById('selected-rating');
            let selectedRating = 0;

            stars.forEach(star => {
                star.addEventListener('mouseover', () => {
                    const ratingValue = star.getAttribute('data-rating');
                    highlightStars(ratingValue);
                });

                star.addEventListener('mouseout', () => {
                    resetStars();
                });

                star.addEventListener('click', () => {
                    const ratingValue = star.getAttribute('data-rating');
                    selectedRating = ratingValue;
                    ratingInput.value = selectedRating;
                });
            });

            function highlightStars(rating) {
                stars.forEach(star => {
                    const starRating = star.getAttribute('data-rating');
                    star.classList.toggle('fas', starRating <= rating);
                });
            }

            function resetStars() {
                stars.forEach(star => {
                    star.classList.remove('fas');
                });

                // Restore the color of the selected stars
                if (selectedRating !== 0) {
                    stars.forEach(star => {
                        const starRating = star.getAttribute('data-rating');
                        star.classList.toggle('fas', starRating <= selectedRating);
                    });
                }
            }
        });
    </script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

@endsection
