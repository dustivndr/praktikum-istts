@extends('layouts.app')

@section('title', 'Organization Detail')
@section('pageTitle', 'Organization Detail')

@section('content')
<a href="{{ route($organization['type'] === 'UKM' ? 'organizations.ukm' : 'organizations.ukk') }}" class="btn btn-light shadow-sm mb-4">
    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar {{ $organization['type'] }}
</a>

<div class="card section-card shadow-sm mb-4"><div class="card-body p-4">
    <div class="d-flex flex-wrap gap-3 justify-content-between align-items-start">
        <div class="d-flex gap-3">
            <div class="icon-box"><i class="bi {{ $organization['icon'] }}"></i></div>
            <div><h2 class="h3 fw-bold mb-1">{{ $organization['name'] }}</h2><div class="text-secondary">{{ $organization['type'] }} · {{ $organization['category'] }}</div></div>
        </div>
        @include('partials.status-badge', ['status' => $organization['status']])
    </div>
    <p class="text-secondary mt-4 mb-0">{{ $organization['description'] }}</p>
</div></div>

<div class="card section-card shadow-sm mb-4"><div class="card-body p-4">
    <h2 class="h5 fw-bold mb-3">Daftar Mahasiswa <span class="badge text-bg-warning ms-2">{{ count($members) }} Members</span></h2>
    <div class="table-responsive"><table class="table align-middle mb-0">
        <thead class="table-light"><tr><th>No</th><th>NRP</th><th>Nama Mahasiswa</th></tr></thead>
        <tbody>@forelse ($members as $member)<tr><td>{{ $loop->iteration }}</td><td>{{ $member['nrp'] }}</td><td>{{ $member['name'] }}</td></tr>@empty<tr><td colspan="3" class="text-center text-secondary">Belum ada mahasiswa.</td></tr>@endforelse</tbody>
    </table></div>
</div></div>

<div class="card section-card shadow-sm mb-4"><div class="card-body p-4">
    <h2 class="h5 fw-bold mb-3">Organization Activities</h2>
    <div class="list-group list-group-flush">@foreach ($organization['activities'] as $activity)<div class="list-group-item px-0"><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $activity }}</div>@endforeach</div>
</div></div>

<div class="card section-card shadow-sm"><div class="card-body p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
        <div><h2 class="h5 fw-bold mb-1">Attendance Records <span class="badge text-bg-warning ms-2">{{ count($attendance) }} Records</span></h2><p class="text-secondary mb-0">Daftar kehadiran anggota {{ $organization['name'] }}</p></div>
    </div>
    <div class="table-responsive"><table class="table align-middle mb-0">
        <thead class="table-light"><tr><th>No</th><th>NRP</th><th>Nama Mahasiswa</th><th>Tanggal</th><th>Check-in</th><th>Check-out</th><th>Status</th><th>Durasi</th></tr></thead>
        <tbody>@forelse ($attendance as $record)
            <tr>
                <td>{{ $loop->iteration }}</td><td>{{ $record['nrp'] }}</td><td>{{ $record['name'] }}</td><td>{{ $record['date'] }}</td>
                <td class="text-success">{{ $record['check_in'] ?? '-' }}</td><td class="text-danger">{{ $record['check_out'] ?? '-' }}</td>
                <td>@include('partials.status-badge', ['status' => $record['status']])</td>
                <td>@if ($record['duration'])<span class="badge rounded-pill text-bg-primary">{{ $record['duration'] }}</span>@else-@endif</td>
            </tr>
        @empty<tr><td colspan="8" class="text-center text-secondary">Belum ada attendance record.</td></tr>@endforelse</tbody>
    </table></div>
</div></div>
@endsection
