@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="auth-card">

        <div class="auth-logo">🛒</div>
        <div class="auth-title">Selamat Datang</div>
        <div class="auth-sub">Masuk ke Sistem Manajemen Stok</div>

        @if(session('error'))
            <div class="alert alert-danger mb-3">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-auth mt-1">Login</button>
        </form>

        <p class="auth-link">
            Belum punya akun? <a href="/register">Daftar sekarang</a>
        </p>

    </div>

</div>

@endsection