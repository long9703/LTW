@extends('layouts.master')

@section('title', 'Đăng nhập')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h3>Đăng nhập</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email') }}" placeholder="Nhập email">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mật khẩu --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Nhập mật khẩu">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nút Đăng nhập --}}
                        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                    </form>


                    {{-- Quên mật khẩu --}}
                    <div class="mt-3 text-center">
                        <a href="#" class="text-decoration-none">Quên mật khẩu?</a>
                    </div>

                    {{-- Đăng ký tài khoản --}}
                    <div class="mt-3 text-center">
                        <span>Chưa có tài khoản?</span>
                        <a href="{{ route('register') }}" class="text-decoration-none">Đăng ký ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection