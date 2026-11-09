@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('pageTitle', 'Dashboard Admin')
@section('content')
    @if (session('success') === 'Login berhasil.')
        <div class="alert alert-success mb-4" role="alert">
            Login berhasil.
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h2 class="fw-bold mb-2">Welcome to Admin Dashboard</h2>
            <p class="text-secondary mb-0">Pantau UKM, UKK, keanggotaan dan kehadiran mahasiswa.</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        @foreach ([['Total UKM', $stats['ukm'], 'bi-people'], ['Total UKK', $stats['ukk'], 'bi-heart'], ['Total Members', $stats['members'], 'bi-person-check'], ['Open Recruitment', $stats['open'], 'bi-megaphone'], ['Attendance Records', $stats['attendance'], 'bi-calendar-check']] as $stat)
            <div class="col-sm-6 col-xl">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <div class="text-secondary small">{{ $stat[0] }}</div>
                            <div class="fs-3 fw-bold">{{ $stat[1] }}</div>
                        </div>
                        <div class="stat-icon bg-info-subtle text-info"><i class="bi {{ $stat[2] }}"></i></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                <div>
                    <h3 class="h5 fw-bold mb-2">Quick Management</h3>
                    <p class="text-secondary mb-3">Kelola organisasi dan jadwal kegiatan dengan cepat.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.organizations') }}" class="btn btn-outline-dark">Kelola UKM &amp; UKK</a>
                        <a href="{{ route('admin.schedules') }}" class="btn btn-outline-dark">Daftar Jadwal</a>
                    </div>
                </div>
                <div>
                    <a href="{{ route('admin.schedules.create') }}" class="btn btn-yellow">+ Create Schedule</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h3 class="h5 fw-bold mb-3">Jadwal Hari Ini</h3>
            @forelse ($schedules as $schedule)
                <div class="bg-light rounded p-3 mb-2">
                    <p class="mb-1"><strong>{{ $schedule['title'] }}</strong> — {{ $schedule['organization_name'] }}</p>
                    <p class="text-secondary mb-0">{{ $schedule['start_time'] }}-{{ $schedule['end_time'] }} ·
                        {{ $schedule['location'] }}</p>
                </div>
            @empty
                <p class="text-secondary mb-0">Belum ada jadwal.</p>
            @endforelse
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="h5 fw-bold">Attendance Records</h3>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NRP</th>
                            <th>Nama</th>
                            <th>Organisasi</th>
                            <th>Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>@forelse ($attendance as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record['nrp'] }}</td>
                            <td>{{ $record['name'] }}</td>
                            <td>{{ $record['organization_name'] }}</td>
                            <td>{{ $record['title'] }}</td>
                            <td>{{ $record['date'] }}</td>
                            <td>@include('partials.status-badge', ['status' => $record['status']])</td>
                    </tr>@empty<tr>
                            <td colspan="7" class="text-center text-secondary">Belum ada attendance record.</td>
                        </tr>@endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection