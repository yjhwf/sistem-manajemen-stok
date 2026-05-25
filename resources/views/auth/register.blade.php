@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="height:80vh;">

<div class="card p-4" style="width:350px;">

    <h4 class="mb-3 text-center">Register</h4>

    <form method="POST" action="/register">
        @csrf

        <input type="text" name="name" class="form-control mb-3" placeholder="Nama" required>

        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

        <button class="btn btn-success w-100">Register</button>
    </form>

    <div class="text-center mt-3">
        <a href="/login">Sudah punya akun?</a>
    </div>

</div>

</div>

@endsection