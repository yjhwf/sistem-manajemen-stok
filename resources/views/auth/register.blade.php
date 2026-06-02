@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="auth-card">

        <div class="auth-logo">✨</div>
        <div class="auth-title">Buat Akun Baru</div>
        <div class="auth-sub">Daftarkan diri Anda untuk mulai</div>

        <form method="POST" action="/register">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Nama Anda" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-auth mt-1">Daftar Sekarang</button>
        </form>

        <p class="auth-link">
            Sudah punya akun? <a href="/login">Login di sini</a>
        </p>

    </div>

</div>

@endsection