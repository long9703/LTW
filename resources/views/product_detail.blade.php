@extends('layouts.master')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="container py-5">
    <div class="row">
        {{-- Ảnh sản phẩm --}}
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
        </div>

        {{-- Thông tin sản phẩm --}}
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <h4 class="text-danger mb-3">{{ number_format($product->price) }} VNĐ</h4>
            <p>{{ $product->description }}</p>

            {{-- Số lượng & tạm tính --}}
            <div class="mb-3">
                
               
            </div>

            <p><strong>Tạm tính:</strong> <span id="subtotal">{{ number_format($product->price) }} VNĐ</span></p>

            {{-- Form gửi sản phẩm vào giỏ hàng --}}
            @if (session('success'))
            <div aria-live="polite" aria-atomic="true" class="position-relative">
                <div id="toast-container" class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
                    <!-- Toasts sẽ được thêm ở đây -->
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Tạo Toast mới
                    const toastContainer = document.getElementById('toast-container');

                    const toastElement = document.createElement('div');
                    toastElement.className = 'toast align-items-center text-bg-success border-0';
                    toastElement.setAttribute('role', 'alert');
                    toastElement.setAttribute('aria-live', 'assertive');
                    toastElement.setAttribute('aria-atomic', 'true');
                    toastElement.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;

                    toastContainer.appendChild(toastElement);

                    // Kích hoạt Toast
                    const toast = new bootstrap.Toast(toastElement, {
                        delay: 3000
                    });
                    toast.show();
                });
            </script>
            @endif


            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <label for="quantity" class="form-label">Số lượng:</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    const unitPrice = {
        {
            $product - > price
        }
    };

    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(amount);
    }
</script>
@endpush