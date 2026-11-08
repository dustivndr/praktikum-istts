@extends('layouts.app')
@section('title', 'Tambah Organisasi')
@section('pageTitle', 'Tambah Organisasi')
@section('content')
<a href="{{ route('admin.organizations') }}" class="btn btn-light mb-3">← Kembali</a><div class="card shadow-sm"><div class="card-body p-4"><h2 class="h4 fw-bold mb-4">Create UKM / UKK</h2>
<form method="POST" action="{{ route('admin.organizations.store') }}">@csrf<div class="row g-3">
@foreach ([['type','Tipe Organisasi','select'],['name','Nama Organisasi','text'],['category','Kategori','text'],['icon','Icon Bootstrap','text'],['status','Status Recruitment','select'],['chairman_name','Nama Ketua UKM / UKK','text'],['chairman_username','Username Ketua','text'],['chairman_password','Password Akun Ketua','password']] as $field)<div class="col-md-6"><label class="form-label">{{ $field[1] }}</label>@if($field[2]==='select')<select name="{{ $field[0] }}" class="form-select" required>@if($field[0]==='type')<option>UKM</option><option>UKK</option>@else<option>Open Recruitment</option><option>Coming Soon</option><option>Closed</option>@endif</select>@else<input name="{{ $field[0] }}" type="{{ $field[2] }}" class="form-control" required>@endif</div>@endforeach
<div class="col-12"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" rows="3" required></textarea></div><div class="col-12"><label class="form-label">Kegiatan Rutin (satu kegiatan per baris)</label><textarea name="activities" class="form-control" rows="3" required></textarea></div></div><button class="btn btn-yellow mt-4">Tambah Organisasi</button></form></div></div>
@endsection
