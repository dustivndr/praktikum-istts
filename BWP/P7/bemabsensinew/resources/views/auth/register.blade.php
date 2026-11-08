@extends('layouts.app')
@section('title', 'Register Mahasiswa')
@section('content')
<div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-sm-10 col-md-7 col-lg-5">
        <div class="card shadow-sm border-top border-4 border-warning"><div class="card-body p-4">
            <h1 class="h3 fw-bold">Register Mahasiswa</h1><p class="text-secondary">Akun yang baru terdaftar hanya memiliki role Mahasiswa.</p>
            <form method="POST" action="{{ route('register.store') }}">@csrf
                @foreach ([['nama','Nama Lengkap','text'],['nrp','NRP','text'],['username','Username','text'],['password','Password','password'],['password_confirmation','Konfirmasi Password','password']] as $field)
                    <label class="form-label">{{ $field[1] }}</label><input name="{{ $field[0] }}" type="{{ $field[2] }}" value="{{ old($field[0]) }}" class="form-control mb-3" required>
                @endforeach
                <button class="btn btn-yellow w-100">Register</button>
            </form>
            <p class="text-center mt-4 mb-0"><a href="{{ route('login') }}">Kembali ke Login</a></p>
        </div></div>
    </div>
</div>
@endsection
