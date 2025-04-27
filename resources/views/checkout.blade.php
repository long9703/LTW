@extends('layouts.master')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Thanh toán</h2>
    <div class="row">
        <!-- Form thông tin người nhận -->
        <div class="col-md-7">
            <div class="card p-4">
                <h4>Thông tin nhận hàng</h4>
                <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ nhận hàng</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Ghi chú (không bắt buộc)</label>
                        <textarea class="form-control" id="note" name="note" rows="2"></textarea>
                    </div>
                    <input type="hidden" name="totalMoney" value="{{ $totalMoney + $shippingFee }}">

                    <button type="submit" class="btn btn-success w-100">Xác nhận đặt hàng</button>
                </form>
            </div>
        </div>

        <!-- Tóm tắt đơn hàng -->
        <div class="col-md-5">
            <div class="card p-4 bg-light">
                <h4>Đơn hàng của bạn</h4>
                <ul class="list-group mb-3">
                    @forelse ($cartItems as $item)
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">{{ $item->product->name }}</h6>
                            <small class="text-muted">x{{ $item->quantity }}</small>
                        </div>
                        <span class="text-muted">{{ number_format($item->product->price) }} VNĐ</span>
                    </li>
                    @empty
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Giỏ hàng trống</span>
                    </li>
                    @endforelse
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Tạm tính</span>
                        <strong>{{ number_format($totalMoney) }} VNĐ</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Phí vận chuyển</span>
                        <strong>{{ number_format($shippingFee) }} VNĐ</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Tổng thanh toán</span>
                        <strong class="text-danger">{{ number_format($totalMoney + $shippingFee) }} VNĐ</strong>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('checkout-form').addEventListener('submit', function(event) {
        const fullname = document.getElementById('fullname').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const address = document.getElementById('address').value.trim();

        if (!fullname || !phone || !address) {
            alert('Vui lòng điền đầy đủ thông tin nhận hàng!');
            event.preventDefault(); // Ngừng gửi form nếu thiếu thông tin
        }
    });

    @if(session('success'))
    // Nếu có session success thì show popup
    setTimeout(function() {
        alert("{{ session('success') }}");
        window.location.href = "{{ url('/products') }}";
    }, 100);
    @endif
</script>
@endpush