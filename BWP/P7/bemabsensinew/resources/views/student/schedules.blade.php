@extends('layouts.app')
@section('title', 'Jadwal Saya')
@section('pageTitle', 'Jadwal Saya')
@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="h5 fw-bold">Jadwal Kegiatan UKM & UKK</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Organisasi</th>
                            <th>Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>@forelse($schedules as $schedule)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $schedule['organization_name'] }}</td>
                            <td>{{ $schedule['title'] }}</td>
                            <td>{{ $schedule['date'] }}</td>
                            <td>{{ $schedule['start_time'] }}-{{ $schedule['end_time'] }}</td>
                            <td>{{ $schedule['location'] }}</td>
                    </tr>@empty<tr>
                            <td colspan="6">Belum ada jadwal.</td>
                        </tr>@endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection