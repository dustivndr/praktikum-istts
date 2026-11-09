@extends('layouts.app')
@section('title', 'Kelola UKM & UKK')
@section('pageTitle', 'Kelola UKM & UKK')
@section('content')
    <div class="card shadow-sm mb-4">
        <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="fw-bold mb-2">Daftar Organisasi</h2>
                <p class="text-secondary mb-0">{{ count($organizations) }} organisasi sesuai filter.</p>
            </div>
            <a href="{{ route('admin.organizations.create') }}" class="btn btn-yellow">+ Tambah Organisasi</a>
        </div>
    </div>
    <div class="row g-4">@forelse ($organizations as $organization)
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between">
                        <div class="icon-box mb-3"><i class="bi {{ $organization['icon'] }}"></i></div><span
                            class="badge text-bg-dark h-25">{{ $organization['type'] }}</span>
                    </div>
                    <h3 class="h5 fw-bold">{{ $organization['name'] }}</h3>
                    <p class="text-secondary small">{{ $organization['category'] }} · {{ $organization['members'] }} anggota
                    </p>
                    <div class="mb-3">@include('partials.status-badge', ['status' => $organization['status']])</div><a
                        href="{{ route('admin.organizations.show', $organization['id']) }}"
                        class="btn btn-outline-primary mt-auto">Detail</a>
                </div>
            </div>
    </div>@empty<p>Belum ada organisasi.</p>@endforelse
    </div>
@endsection