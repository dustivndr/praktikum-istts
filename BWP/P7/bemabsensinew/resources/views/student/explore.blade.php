@extends('layouts.app')
@section('title', 'Jelajahi UKM & UKK')
@section('pageTitle', 'Jelajahi UKM & UKK')
@section('content')
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h2 class="h4 fw-bold">Jelajahi UKM & UKK</h2>
            <p>Temukan organisasi yang sesuai minatmu. Klik Hubungi Ketua untuk mengirim permintaan bergabung lewat website.
            </p>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-2" method="GET">
                <div class="col-md-3"><select name="type" class="form-select">
                        <option value="">Semua UKM & UKK</option>
                        <option value="UKM" @selected($type === 'UKM')>UKM</option>
                        <option value="UKK" @selected($type === 'UKK')>UKK</option>
                    </select></div>
                <div class="col-md-6"><input name="search" value="{{ $search }}" class="form-control"
                        placeholder="Cari nama UKM atau UKK"></div>
                <div class="col-md-3"><button class="btn btn-dark w-100">Cari</button></div>
            </form>
        </div>
    </div>
    <div class="row g-4">@foreach($organizations as $organization)
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="icon-box"><i class="bi {{ $organization['icon'] }}"></i></div>
                        <span class="badge rounded-pill text-bg-dark fw-normal align-self-start">{{ $organization['type'] }}</span>
                    </div>
                    <h3 class="h5 fw-bold mt-3">{{ $organization['name'] }}</h3>
                    <p class="text-secondary">{{ $organization['category'] }} · {{ $organization['members'] }} anggota</p>
                    <p>{{ $organization['description'] }}</p>
                    <div class="mb-3">@include('partials.status-badge', ['status' => $organization['status']])
                        @if($organization['joined'])<span class="badge text-bg-primary">Sudah
                        Bergabung</span>@elseif($organization['requested'])<span
                            class="badge text-bg-secondary">Permintaan Terkirim</span>@endif</div>
                    <div class="bg-light rounded p-2 mb-3"><strong>Ketua:
                            {{ $organization['chairman_name'] }}</strong><br><small>Permintaan masuk ke notifikasi Dashboard
                            Ketua.</small></div>@if(!$organization['joined'] && !$organization['requested'])
                                <form method="POST" action="{{ route('student.organizations.join', $organization['id']) }}">@csrf<button
                            class="btn btn-yellow w-100">Hubungi Ketua</button></form>@elseif($organization['joined'])<a
                                class="btn btn-outline-primary w-100" href="{{ route('student.organizations') }}">Lihat di
                            Organisasi Saya</a>@else<span class="text-secondary small">Permintaan sudah dikirim.</span>@endif
                </div>
            </div>
    </div>@endforeach
    </div>
@endsection