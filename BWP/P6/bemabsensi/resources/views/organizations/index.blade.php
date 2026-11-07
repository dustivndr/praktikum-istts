@extends('layouts.app')

@section('title', 'Daftar '.$type)
@section('pageTitle', 'Daftar '.$type)

@section('content')
<div class="card section-card shadow-sm mb-4"><div class="card-body p-4">
    <h2 class="h3 fw-bold">Daftar {{ $type }}</h2>
    <p class="text-secondary mb-0">{{ $type === 'UKM' ? 'Temukan Unit Kegiatan Mahasiswa yang sesuai dengan minat dan bakatmu.' : 'Temukan Unit Kegiatan Kerohanian di lingkungan kampus.' }}</p>
</div></div>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 fw-bold mb-0">Semua {{ $type }}</h2>
    <span class="badge text-bg-warning">{{ count($organizations) }} Organisasi</span>
</div>
<div class="row g-4">
    @foreach ($organizations as $organization)
        <div class="col-md-6 col-xl-4">
            <a href="{{ route('organizations.show', $organization['id']) }}" class="card organization-card shadow-sm h-100 text-decoration-none text-reset">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="icon-box mb-3"><i class="bi {{ $organization['icon'] }}"></i></div>
                    <h3 class="h5 fw-bold mb-1">{{ $organization['name'] }}</h3>
                    <div class="text-secondary small mb-3">{{ $organization['category'] }}</div>
                    <div class="text-secondary small mb-3"><i class="bi bi-person me-1"></i>{{ $organization['members'] }} Members</div>
                    <div class="mb-4">@include('partials.status-badge', ['status' => $organization['status']])</div>
                    <span class="mt-auto text-primary">Lihat Detail <i class="bi bi-arrow-right"></i></span>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection
