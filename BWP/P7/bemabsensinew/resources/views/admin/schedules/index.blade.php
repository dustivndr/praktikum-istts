@extends('layouts.app')
@section('title', 'Jadwal Kegiatan')
@section('pageTitle', 'Jadwal Kegiatan')
@section('content')
<div class="d-flex justify-content-between mb-4"><h2 class="fw-bold">Jadwal Kegiatan</h2><a href="{{ route('admin.schedules.create') }}" class="btn btn-yellow">+ Create Schedule</a></div><div class="card shadow-sm"><div class="card-body"><table class="table"><thead><tr><th>Organisasi</th><th>Kegiatan</th><th>Tanggal</th><th>Jam</th><th>Lokasi</th></tr></thead><tbody>@forelse($schedules as $schedule)<tr><td>{{ $schedule['organization_name'] }}</td><td>{{ $schedule['title'] }}</td><td>{{ $schedule['date'] }}</td><td>{{ $schedule['start_time'] }}-{{ $schedule['end_time'] }}</td><td>{{ $schedule['location'] }}</td></tr>@empty<tr><td colspan="5">Belum ada jadwal.</td></tr>@endforelse</tbody></table></div></div>
@endsection
