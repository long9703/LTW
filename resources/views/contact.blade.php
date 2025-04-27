@extends('layouts.master')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4">Liên hệ</h3>
        </div>
    </div>

    <div class="row">
        <!-- Thông tin cửa hàng + Form liên hệ -->
        <div class="col-md-6">
            <h4 class="mb-3">LID Gym - Cung cấp sản phẩm chất lượng</h4>
            <p>Địa chỉ: Đại Mỗ, Hà Nội</p>
            <p>Điện thoại: 0377702202</p>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form id="form-contact"  class="mt-3">
                @csrf
                <p class="mb-3">Đừng ngần ngại, hãy liên hệ ngay với chúng tôi:</p>

                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Họ và tên" required>
                </div>

                <div class="mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" required>
                </div>

                <div class="mb-3">
                    <input type="email" name="emailCustomer" class="form-control" placeholder="Email" required>
                </div>

                <div class="mb-3">
                    <textarea name="content" rows="4" class="form-control" placeholder="Nội dung cần liên hệ" required></textarea>
                </div>

                <div class="mb-3">
                    <select name="emailContact" class="form-control" required>
                        <option value="">Chọn bộ phận hỗ trợ</option>
                        <option value="long78180@gmail.com">Bộ phận hỗ trợ bán hàng</option>
                        <option value="long78180@gmail.com">Bộ phận hỗ trợ tài khoản</option>
                        <option value="long78180@gmail.com">Bộ phận hỗ trợ phản ánh</option>
                    </select>
                </div>

                {{-- Google reCAPTCHA --}}
                {{-- <div class="g-recaptcha mb-3" data-sitekey="{{ $recaptcha_site_key }}"></div> --}}

                <div class="text-end">
                    <button type="submit" class="btn btn-danger">Gửi đi</button>
                </div>
            </form>
        </div>

        <!-- Google Maps -->
        <div class="col-md-6 mt-4 mt-md-0">
            <div class="ratio ratio-4x3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1862.59632770295!2d105.7660723!3d20.9849131!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313453006c33b95b%3A0x4ba251649fa3e52f!2zSOG7jWMgVmnhu4duIEPDtG5nIE5naOG7hyBCxrB1IENow61uaCBWaeG7hW4gVGjDtG5nIC0gUFRJVA!5e0!3m2!1svi!2s!4v1740638853267!5m2!1svi!2s"
                        width="600" height="450" style="border:0;" allowfullscreen loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>
<!-- 
{{-- Google reCAPTCHA --}}
{{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}

{{-- Kiểm tra reCAPTCHA bằng JS nếu bật --}}
<script>
    document.getElementById('form-contact').addEventListener('submit', function(event) {
       
        var recaptcha = grecaptcha.getResponse();
        if (recaptcha.length === 0) {
            event.preventDefault();
            alert("Vui lòng xác nhận reCAPTCHA!");
        }
    });
</script> -->
@endsection
