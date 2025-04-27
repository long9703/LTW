<nav class="navbar navbar-expand-lg  navbar-big">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ url('/') }}">LID Gym</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      {{-- Bên trái: menu --}}
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Trang chủ</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('product') }}">Sản phẩm</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('cart') }}">Giỏ hàng</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Liên hệ</a></li>
      </ul>

      {{-- Giữa: thanh tìm kiếm --}}
      <form class="d-flex mx-auto" role="search" action="{{ route('product_search') }}" method="GET" style="max-width: 400px; width: 100%;">
        <input class="form-control me-2" type="search" name="query" placeholder="Tìm kiếm..." aria-label="Search" value="{{ request('query') }}">
        <button class="btn btn-outline-light" type="submit">Tìm</button>
      </form>


      {{-- Bên phải: Đăng ký / Đăng nhập --}}

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @if(Auth::check())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
            <img src="{{ asset('images/avt.jpg') }}" alt="Avatar" class="rounded-circle me-2" width="32" height="32">
            {{ Auth::user()->name }}
          </a>


          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="#">Trang cá nhân</a></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item" type="submit">Đăng xuất</button>
              </form>
            </li>
          </ul>
        </li>
        @else
        <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Đăng nhập</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Đăng ký</a></li>
        @endif
      </ul>

    </div>
  </div>
</nav>