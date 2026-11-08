@extends('layouts.app')
@section('title', 'Riwayat Absensi')
@section('pageTitle', 'Riwayat Absensi')
@section('content')
<div class="card shadow-sm"><div class="card-body"><h2 class="h5 fw-bold">Riwayat Kehadiran Saya</h2><div class="table-responsive"><table class="table"><thead><tr><th>No</th><th>UKM / UKK</th><th>Kegiatan</th><th>Tanggal</th><th>Check-in</th><th>Check-out</th><th>Status</th></tr></thead><tbody>@forelse($attendance as $record)<tr><td>{{ $loop->iteration }}</td><td>{{ $record['organization_name'] }}</td><td>{{ $record['title'] }}</td><td>{{ $record['date'] }}</td><td>{{ $record['check_in'] ?? '-' }}</td><td>{{ $record['check_out'] ?? '-' }}</td><td>@include('partials.status-badge',['status'=>$record['status']])</td></tr>@empty<tr><td colspan="7">Belum ada riwayat absensi.</td></tr>@endforelse</tbody></table></div></div></div>
@endsection
