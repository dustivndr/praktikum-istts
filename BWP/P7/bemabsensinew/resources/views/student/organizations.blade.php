@extends('layouts.app')
@section('title', 'Organisasi Saya')
@section('pageTitle', 'Organisasi Saya')
@section('content')
<div class="d-flex justify-content-between mb-4"><div><h2 class="fw-bold">UKM & UKK yang Saya Ikuti</h2><p class="text-secondary">Terdaftar di {{ count($organizations) }} organisasi.</p></div><a href="{{ route('student.explore') }}" class="btn btn-yellow">+ Cari UKM & UKK Lain</a></div><div class="row g-4">@forelse($organizations as $organization)<div class="col-md-6"><div class="card shadow-sm h-100"><div class="card-body"><div class="icon-box mb-3"><i class="bi {{ $organization['icon'] }}"></i></div><span class="badge text-bg-dark">{{ $organization['type'] }}</span><h3 class="h5 fw-bold mt-2">{{ $organization['name'] }}</h3><p>{{ $organization['description'] }}</p><p class="text-secondary">Ketua: {{ $organization['chairman_name'] }}</p><strong>Kegiatan Rutin</strong><ul>@foreach($organization['activities'] as $activity)<li>{{ $activity }}</li>@endforeach</ul></div></div></div>@empty<p>Belum mengikuti organisasi.</p>@endforelse</div>
@endsection
