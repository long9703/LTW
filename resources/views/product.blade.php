@extends('layouts.master')

@section('page-title', 'Sản Phẩm')

@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar lọc sản phẩm -->
        <div class="col-md-3">
            <h5>Danh mục</h5>
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('product') }}">Tất cả</a></li>
                <!-- Nếu bạn có danh sách danh mục, thêm vào -->
                @foreach($categories as $category)
                <li class="list-group-item"><a href="{{ route('product', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>

            <hr>

            <!-- Lọc theo giá -->
            <h5>Giá</h5>
            <form method="GET" action="{{ route('product') }}">
                <input type="range" class="form-range" id="priceRange" name="price" min="0" max="10000000" step="10000" value="{{ request()->get('price', 10000000) }}">
                <label for="priceRange">{{ number_format(request()->get('price', 10000000)) }} VNĐ</label>
                <button type="submit" class="btn btn-primary btn-block mt-3">Lọc</button>
            </form>

            <hr>
        </div>

        <!-- Nội dung sản phẩm -->
        <div class="col-md-9">
            <div class="d-flex flex-wrap justify-content-start">
                <h3 class="text-center mb-4 w-100">Sản phẩm nổi bật</h3>

                <div class="row" id="product-list">
                    @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="product-image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ number_format($product->price) }} VNĐ</p>
                                <a href="{{ route('product_detail', $product->id) }}" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


            </div>
        </div><!-- Phân trang -->
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
    /* Mặc định: hiển thị theo lưới */
    .grid-view .card {
        display: block;
    }

    /* Chế độ danh sách: card sẽ có chiều rộng đầy đủ */
    .list-view .card {
        display: flex;
        flex-direction: row;
        width: 100%;
    }

    /* Tùy chỉnh khác cho chế độ danh sách */
    .list-view .card-img-top {
        width: 150px;
        height: 150px;
        object-fit: cover;
        margin-right: 20px;
    }

    .list-view .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
</style>
@endsection