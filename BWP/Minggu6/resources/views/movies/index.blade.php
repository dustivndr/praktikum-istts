<!-- ini kayak beritau kalau ini itu lanjutannya layouts/app.blade.php -->
@extends('layouts.app')

<!-- cuman naruh 1 bagian tok -->
@section('title', 'Daftar Film - M-TIX')

<!-- ini ntik dipanggil di app pakai yield('content') -->
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Daftar Film</h3>
        <span class="text-muted">Total: {{ count($movies) }} Film</span>
    </div>
    <div class="row">
        @foreach ($movies as $movie)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $movie['poster'] }}" class="card-img-top" alt="{{ $movie['title'] }}" style="height: 340px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $movie['title'] }}</h5>
                        <p class="card-text text-muted mb-1">{{ $movie['genre'] }}</p>
                        <p class="card-text small text-secondary mb-2">{{ $movie['duration'] }}</p>
                        <div class="mb-3">
                            <span class="badge bg-secondary">{{ $movie['age_rating'] }}</span>
                            <span class="badge bg-dark">{{ $movie['format'] }}</span>
                            <span class="badge bg-warning text-dark">&#9733; {{ $movie['rating'] }}</span>
                        </div>
                        <!-- ngelempar id ke route movies.show jadinya di controller idnya dapat -->
                        <a href="{{ route('movies.show', $movie['id']) }}" class="btn btn-outline-primary mt-auto">Info Film</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
