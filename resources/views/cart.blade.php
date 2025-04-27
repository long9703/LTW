@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Giỏ hàng</h2>
    <div class="row">
        <div class="col-lg-8">
            <table class="table table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cartItems as $item)
                    <tr data-id="{{ $item->id }}">
                        <td>{{ $item->product->name }}</td>
                        <td><img src="{{ asset('storage/' . $item->product->image) }}" alt="" width="60"></td>
                        <td>{{ number_format($item->product->price) }} VNĐ</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-sm btn-secondary me-2 btn-decrease">-</button>
                                <input type="number" class="form-control quantity-input" value="{{ $item->quantity }}" min="1">
                                <button class="btn btn-sm btn-secondary ms-2 btn-increase">+</button>
                            </div>
                        </td>
                        <td class="item-total">
                            {{ number_format($item->product->price * $item->quantity) }} VNĐ
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger btn-delete">Xóa</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Giỏ hàng của bạn đang trống.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <div class="border p-3 rounded bg-light">
                <h4>Tóm tắt đơn hàng</h4>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Tạm tính:</span>
                    <strong id="subtotal">{{ number_format($subtotal) }} VNĐ</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Phí vận chuyển:</span>
                    <strong>30,000 VNĐ</strong>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Tổng thanh toán:</span>
                    <strong id="total" class="text-danger">{{ number_format($subtotal + 30000) }} VNĐ</strong>
                </div>
                <a href="{{ url('/checkout') }}" class="btn btn-primary w-100 mt-3">Tiến hành thanh toán</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateTotalUI() {
        let rows = document.querySelectorAll('tbody tr');
        let subtotal = 0;

        rows.forEach(row => {
            let price = parseInt(row.querySelector('td:nth-child(3)').innerText.replace(/[^\d]/g, '')) || 0;
            let qty = parseInt(row.querySelector('.quantity-input').value) || 1;
            let totalCell = row.querySelector('.item-total');

            let itemTotal = price * qty;
            totalCell.innerText = itemTotal.toLocaleString('vi-VN') + ' VNĐ';
            subtotal += itemTotal;
        });

        document.getElementById('subtotal').innerText = subtotal.toLocaleString('vi-VN') + ' VNĐ';
        document.getElementById('total').innerText = (subtotal + 30000).toLocaleString('vi-VN') + ' VNĐ';
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                let row = this.closest('tr');
                let id = row.getAttribute('data-id');
                let quantity = this.value;

                // Gửi request AJAX cập nhật số lượng
                fetch(`/cart/update/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ quantity: quantity })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateTotalUI();
                    }
                });
            });
        });

        // Tăng số lượng
        document.querySelectorAll('.btn-increase').forEach(button => {
            button.addEventListener('click', function() {
                let row = this.closest('tr');
                let input = row.querySelector('.quantity-input');
                input.value = parseInt(input.value) + 1;
                input.dispatchEvent(new Event('change'));
            });
        });

        // Giảm số lượng
        document.querySelectorAll('.btn-decrease').forEach(button => {
            button.addEventListener('click', function() {
                let row = this.closest('tr');
                let input = row.querySelector('.quantity-input');
                if (input.value > 1) {
                    input.value = parseInt(input.value) - 1;
                    input.dispatchEvent(new Event('change'));
                }
            });
        });

        // Xóa sản phẩm
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                let row = this.closest('tr');
                let id = row.getAttribute('data-id');

                if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                    // Gửi request AJAX xoá sản phẩm
                    fetch(`/cart/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            row.remove();
                            updateTotalUI();
                        }
                    });
                }
            });
        });
            
        updateTotalUI();
    });
</script>
@endpush
