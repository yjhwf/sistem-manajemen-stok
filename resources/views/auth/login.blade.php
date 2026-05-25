@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="height:80vh;">

<div class="card p-4" style="width:350px;">

    <h4 class="mb-3 text-center">Login</h4>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

        <button class="btn btn-success w-100">Login</button>
    </form>

    <div class="text-center mt-3">
        <a href="/register">Belum punya akun?</a>
    </div>

</div>

</div>

@endsection