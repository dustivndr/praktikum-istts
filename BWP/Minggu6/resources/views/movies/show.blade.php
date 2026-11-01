<!-- ini kayak beritau kalau ini itu lanjutannya layouts/app.blade.php -->
@extends('layouts.app')

<!-- cuman naruh 1 bagian tok -->
@section('title', 'Info Film: ' . $movie['title'] . ' - M-TIX')

<!-- ini ntik dipanggil di app pakai yield('content') -->
@section('content')
    <div class="mb-3">
        <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary btn-sm">
            &larr; Kembali ke Daftar Film
        </a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <img src="{{ $movie['poster'] }}" class="img-fluid rounded shadow-sm" alt="{{ $movie['title'] }}" style="max-height: 420px; width: 100%; object-fit: cover;">
                </div>
                <div class="col-md-8">
                    <h2 class="fw-bold mb-2">{{ $movie['title'] }}</h2>
                    <div class="mb-3">
                        @foreach ($movie['tags'] as $tag)
                            <span class="badge bg-secondary me-1">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <hr>
                    <table class="table table-borderless table-sm mb-4" style="max-width: 480px;">
                        <tbody>
                            <tr>
                                <th class="ps-0 text-muted" style="width: 140px;">Rating</th>
                                <td>
                                    <span class="badge bg-warning text-dark fs-6">
                                        &#9733; {{ $movie['rating'] }} / 10
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="ps-0 text-muted">Durasi</th>
                                <td class="fw-semibold">{{ $movie['duration'] }}</td>
                            </tr>
                            <tr>
                                <th class="ps-0 text-muted">Format Layar</th>
                                <td><span class="badge bg-dark">{{ $movie['format'] }}</span></td>
                            </tr>
                            <tr>
                                <th class="ps-0 text-muted">Batas Usia</th>
                                <td>
                                    @if ($movie['age_rating'] === 'SU')
                                        <span class="badge bg-success">SU (Semua Umur)</span>
                                    @elseif ($movie['age_rating'] === '13+')
                                        <span class="badge bg-primary">13+ (Remaja)</span>
                                    @else
                                        <span class="badge bg-danger">17+ (Dewasa)</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="ps-0 text-muted">Sutradara</th>
                                <td>{{ $movie['director'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h5 class="fw-bold mb-2">Sinopsis Film</h5>
                    <p class="text-secondary" style="line-height: 1.7;">
                        {{ $movie['description'] }}
                    </p>
                </div>

            </div>
        </div>
    </div>

@endsection
