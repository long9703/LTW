@extends('layouts.master')

@section('content')

{{-- 1. Banner --}}
<div class="container-fluid p-0">
  <div class="position-relative">
    <img src="{{ asset('images/banner.jpg') }}" class="img-fluid w-100 banner-img" alt="LID Gym Banner">
    <div class="position-absolute top-50 start-50 translate-middle text-white text-center">
      <h1 class="display-4 fw-bold">Chào mừng đến với LID Gym</h1>
      <p>Thời trang thể thao - Phong cách sống mạnh mẽ</p>
      <a href="{{ route('product') }}" class="btn btn-danger btn-lg mt-3">Khám phá ngay</a>
    </div>
  </div>
</div>

{{-- 2. Sản phẩm nổi bật --}}
<div class="container my-5">
  <h2 class="text-center mb-4">🔥 Sản phẩm nổi bật</h2>
  <div class="row">
    @for ($i = 1; $i <= 4; $i++)
      <div class="col-md-3 mb-4">
        <div class="card h-100">
          <img src="{{ asset('images/product1.jpg') }}" class="card-img-top" alt="Hot Product {{ $i }}">
          <div class="card-body text-center">
            <h5 class="card-title">Đồ Tập Gym {{ $i }}</h5>
            <p class="card-text text-danger fw-bold">₫{{ number_format(199000 + $i * 50000, 0, ',', '.') }}</p>
            <a href="{{ route('product') }}" class="btn btn-danger">Xem chi tiết sản phẩm</a>
          </div>
        </div>
      </div>
    @endfor
  </div>
</div>

{{-- 3. Sản phẩm mới --}}
<div class="container my-5">
  <h2 class="text-center mb-4">🆕 Sản phẩm mới nhất</h2>
  <div class="row">
    @for ($i = 1; $i <= 4; $i++)
      <div class="col-md-3 mb-4">
        <div class="card h-100">
          <img src="{{ asset('images/product1.jpg') }}" class="card-img-top" alt="New Product {{ $i }}">
          <div class="card-body text-center">
            <h5 class="card-title">Áo Tập Mới {{ $i }}</h5>
            <p class="card-text text-success fw-bold">₫{{ number_format(149000 + $i * 40000, 0, ',', '.') }}</p>
            <a href="{{ route('product') }}" class="btn btn-outline-success">Xem ngay</a>
          </div>
        </div>
      </div>
    @endfor
  </div>
</div>

@endsection
