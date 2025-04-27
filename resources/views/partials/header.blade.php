<!-- {{-- Hiển thị ở đầu mỗi trang con --}}
@if (!Request::is('/'))
<div class="bg-secondary text-white py-4 mb-4">
    <div class="container text-center">
        <h2 class="mb-0">
            @yield('page-title', 'Trang')
        </h2>
    </div>
</div>
@endif -->
