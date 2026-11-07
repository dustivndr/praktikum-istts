@extends('layouts.app')

@section('title', 'BEM ABSENSI')
@section('pageTitle', 'Dashboard Overview')

@section('content')
<div class="card welcome-card shadow-sm mb-4">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="h3 fw-bold">Welcome to CampusConnect!</h2>
            <p class="text-secondary mb-0">Kelola informasi organisasi mahasiswa dan pantau kehadiran anggota kampus.</p>
        </div>
        <div class="rounded-circle bg-warning-subtle p-3 fs-2"><i class="bi bi-mortarboard"></i></div>
    </div>
</div>

<div class="row g-3 mb-4">
    @foreach ([['Total UKM', $totalUkm, 'bi-people', 'bg-primary-subtle', 'text-primary'], ['Total UKK', $totalUkk, 'bi-heart', 'bg-info-subtle', 'text-info'], ['Total Members', $totalMembers, 'bi-person-check', 'bg-success-subtle', 'text-success'], ['Open Recruitment', $openRecruitment, 'bi-megaphone', 'bg-purple-subtle', 'text-purple']] as $stat)
        <div class="col-sm-6 col-xl-3">
            <div class="card section-card shadow-sm h-100"><div class="card-body d-flex justify-content-between align-items-center">
                <div><div class="text-secondary small">{{ $stat[0] }}</div><div class="fs-3 fw-bold">{{ $stat[1] }}</div></div>
                <div class="stat-icon {{ $stat[3] }} {{ $stat[4] }}"><i class="bi {{ $stat[2] }}"></i></div>
            </div></div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 fw-bold mb-0">Explore Organizations</h2>
</div>
<div class="row g-4">
    <div class="col-md-6"><div class="card section-card shadow-sm h-100"><div class="card-body p-4">
        <div class="icon-box mb-3"><i class="bi bi-people"></i></div>
        <h3 class="h5 fw-bold">Unit Kegiatan Mahasiswa</h3>
        <p class="text-secondary">Temukan komunitas minat dan bakat mahasiswa di berbagai bidang.</p>
        <a href="{{ route('organizations.ukm') }}" class="btn btn-dark">Lihat Semua UKM <i class="bi bi-arrow-right"></i></a>
    </div></div></div>
    <div class="col-md-6"><div class="card section-card shadow-sm h-100"><div class="card-body p-4">
        <div class="icon-box mb-3"><i class="bi bi-heart"></i></div>
        <h3 class="h5 fw-bold">Unit Kegiatan Kerohanian</h3>
        <p class="text-secondary">Kenali organisasi kerohanian dan kegiatan positif di lingkungan kampus.</p>
        <a href="{{ route('organizations.ukk') }}" class="btn btn-dark">Lihat Semua UKK <i class="bi bi-arrow-right"></i></a>
    </div></div></div>
</div>
@endsection
