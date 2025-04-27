@extends('layouts.master')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Kết quả tìm kiếm cho: "{{ $query }}"</h2>

    @if($products->isEmpty())
        <div class="alert alert-warning">
            Không tìm thấy sản phẩm nào phù hợp.
        </div>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-danger">{{ number_format($product->price) }} VNĐ</p>
                            <a href="{{ route('product_detail', $product->id) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
