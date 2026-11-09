@extends('layouts.app')
@section('title', 'Detail Organisasi')
@section('pageTitle', 'Detail Organisasi')
@section('content')
    <a href="{{ route('admin.organizations') }}" class="btn btn-light mb-3">← Kembali ke Daftar</a>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex gap-3">
                <div class="icon-box"><i class="bi {{ $organization['icon'] }}"></i></div>
                <div>
                    <h2 class="h4 fw-bold">{{ $organization['name'] }}</h2>
                    <p class="text-secondary">{{ $organization['type'] }} · {{ $organization['category'] }}</p>
                </div>
            </div>
            <p>{{ $organization['description'] }}</p><strong>Kegiatan Rutin</strong>
            <ul>@foreach($organization['activities'] as $activity)
            <li>{{ $activity }}</li>@endforeach
            </ul>@include('partials.status-badge', ['status' => $organization['status']])
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h3 class="h5 fw-bold">Calon Anggota Menghubungi Ketua ({{ count($requests) }})</h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NRP</th>
                            <th>Mahasiswa</th>
                            <th>Waktu Permintaan</th>
                        </tr>
                    </thead>
                    <tbody>@forelse($requests as $request)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $request['nrp'] }}</td>
                            <td>{{ $request['name'] }}</td>
                            <td>{{ $request['created_at'] }}</td>
                    </tr>@empty<tr>
                            <td colspan="4" class="text-center text-secondary">Belum ada permintaan bergabung.</td>
                        </tr>@endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h3 class="h5 fw-bold">Daftar Mahasiswa / Anggota ({{ count($members) }})</h3>
            <form method="POST" action="{{ route('admin.organizations.members.store', $organization['id']) }}"
                class="d-flex gap-2 mb-3">@csrf<select name="user_id" class="form-select" required>
                    <option value="">Pilih mahasiswa yang terdaftar</option>@foreach($availableStudents as $student)
                    <option value="{{ $student['id'] }}">{{ $student['nama'] }} ({{ $student['nrp'] }})</option>@endforeach
                </select><button class="btn btn-yellow text-nowrap">Tambah Anggota</button></form>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NRP</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>@forelse($members as $member)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $member['nrp'] }}</td>
                        <td>{{ $member['nama'] }}</td>
                </tr>@empty<tr>
                        <td colspan="3">Belum ada anggota.</td>
                    </tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h3 class="h5 fw-bold">Jadwal Kegiatan</h3>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule['title'] }}</td>
                                <td>{{ $schedule['date'] }}</td>
                                <td>{{ $schedule['start_time'] }}-{{ $schedule['end_time'] }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <details>
                                            <summary class="btn btn-sm btn-yellow">Catat Absensi</summary>
                                            <form method="POST"
                                                action="{{ route('admin.attendance.store', $schedule['id']) }}"
                                                class="row g-2 mt-2">
                                                @csrf
                                                <div class="col-md-6">
                                                    <select name="user_id" class="form-select" required>
                                                        <option value="">Mahasiswa</option>
                                                        @foreach($members as $member)
                                                            <option value="{{ $member['id'] }}">{{ $member['nama'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="status" class="form-select" required>
                                                        <option>Lengkap</option>
                                                        <option>Belum Check-out</option>
                                                        <option>Tidak Hadir</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="check_in" type="time" class="form-control"
                                                        aria-label="Jam check-in">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="check_out" type="time" class="form-control"
                                                        aria-label="Jam check-out">
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-yellow">Simpan Absensi</button>
                                                </div>
                                            </form>
                                        </details>
                                        <a href="#attendance-records" class="btn btn-sm btn-outline-dark">Lihat Absensi</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-secondary">Belum ada jadwal kegiatan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="attendance-records" class="card shadow-sm">
        <div class="card-body">
            <h3 class="h5 fw-bold">Attendance Records</h3>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NRP</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendance as $record)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $record['nrp'] }}</td>
                                <td>{{ $record['name'] }}</td>
                                <td>{{ $record['date'] }}</td>
                                <td>{{ $record['check_in'] ?? '-' }}</td>
                                <td>{{ $record['check_out'] ?? '-' }}</td>
                                <td>
                                    @include('partials.status-badge', [
                                        'status' => $record['status'] === 'Lengkap' ? 'Sudah Check-out' : $record['status'],
                                    ])
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-secondary">Belum ada attendance record.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection