@extends('layouts.app')
@section('title', 'Login BEM ABSENSI')
@section('content')
<div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-sm-10 col-md-6 col-lg-4">
        <div class="card shadow-sm border-top border-4 border-warning"><div class="card-body p-4">
            <h1 class="h3 fw-bold">Login BEM ABSENSI</h1>
            <p class="text-secondary">Masuk menggunakan username dan password akun contoh.</p>
            <form method="POST" action="{{ route('login.authenticate') }}">@csrf
                <label class="form-label">Username</label><input name="username" value="{{ old('username') }}" class="form-control mb-3" required>
                <label class="form-label">Password</label><input name="password" type="password" class="form-control mb-3" required>
                <button class="btn btn-yellow w-100">Login</button>
            </form>
            <p class="text-center mt-4 mb-0">Belum punya akun? <a href="{{ route('register') }}">Register mahasiswa</a></p>
        </div></div>
    </div>
</div>
@endsection
