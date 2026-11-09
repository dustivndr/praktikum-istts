@extends('layouts.app')
@section('title', 'Dashboard Mahasiswa')
@section('pageTitle', 'Dashboard Mahasiswa')
@section('content')
    <h2 class="fw-bold">Selamat Datang, {{ $user['nama'] }}!</h2>
    <p class="text-secondary">Pantau kehadiran dan kegiatan UKM/UKK Anda. NRP: {{ $user['nrp'] }}</p>
    <div class="row g-3 mb-4">
        @foreach([['Total Absensi', $stats['total'], 'bi-file-earmark'], ['Hadir Lengkap', $stats['complete'], 'bi-check-circle'], ['Tidak Hadir', $stats['absent'], 'bi-x-circle'], ['Belum Check-out', $stats['open'], 'bi-clock']] as $stat)
            <div class="col-sm-6 col-xl-3">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <div class="text-secondary">{{ $stat[0] }}</div>
                            <div class="fs-3 fw-bold">{{ $stat[1] }}</div>
                        </div>
                        <div class="stat-icon bg-primary-subtle text-primary"><i class="bi {{ $stat[2] }}"></i></div>
                    </div>
                </div>
        </div>@endforeach
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h3 class="h5 fw-bold mb-3">Jadwal Hari Ini</h3>
            <div class="d-grid gap-2">
                @forelse($schedules as $schedule)
                    <div class="bg-light rounded p-3">
                        <h4 class="h6 fw-bold mb-1">{{ $schedule['title'] }}</h4>
                        <div class="text-secondary small">
                            {{ $schedule['organization_name'] }} · {{ $schedule['start_time'] }}-{{ $schedule['end_time'] }}
                            · {{ $schedule['location'] }}
                        </div>
                    </div>
                @empty
                    <p class="text-secondary mb-0">Belum ada jadwal hari ini.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body d-flex flex-column flex-md-row justify-content-between gap-3">
            <div>
                <h3 class="h5 fw-bold mb-2">Ingin Bergabung dengan UKM / UKK?</h3>
                <p class="text-secondary mb-2">Pilih organisasi dan hubungi ketuanya melalui WhatsApp.</p>
                <p class="text-secondary small mb-0">Menghubungi ketua tidak otomatis membuat kamu menjadi anggota.
                    Admin akan mencatat keanggotaan setelah proses pendaftaran.</p>
            </div>
            <div>
                <a href="{{ route('student.explore') }}" class="btn btn-yellow text-nowrap">Jelajahi Organisasi</a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h3 class="h5 fw-bold mb-3">UKM & UKK yang Saya Ikuti</h3>
            <div class="row g-3">
                @forelse($organizations as $organization)
                    <div class="col-md-6 col-xl-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <div class="icon-box mb-3"><i class="bi {{ $organization['icon'] }}"></i></div>
                                <h4 class="h5 fw-bold">{{ $organization['name'] }}</h4>
                                <p class="text-secondary">{{ $organization['type'] }} · {{ $organization['category'] }}</p>
                                <ul class="mb-0">
                                    @foreach($organization['activities'] as $activity)
                                        <li>{{ $activity }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-secondary mb-0">Belum mengikuti organisasi.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="h5 fw-bold mb-3">Riwayat Kehadiran Terakhir</h3>
            <div class="table-responsive">
                <table class="table align-middle mb-3">
                    <thead>
                        <tr>
                            <th>Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentAttendance as $record)
                            <tr>
                                <td>{{ $record['title'] }}</td>
                                <td>{{ $record['date'] }}</td>
                                <td>@include('partials.status-badge', ['status' => $record['status']])</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-secondary">Belum ada riwayat kehadiran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <a href="{{ route('student.attendance') }}" class="btn btn-outline-dark">Seluruh Riwayat</a>
        </div>
    </div>
@endsection