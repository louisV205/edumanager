<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'EduManager — Cổng Giảng Viên')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/edumanager.css') }}" />
  @stack('styles')
</head>
<body>
  <div class="app">
    <!-- Topbar (Header 72px) -->
    <header class="topbar">
      <a href="{{ url('/giang-vien/dashboard') }}" class="brand">
        <span class="brand-mark">E</span>
        <span>EduManager</span>
      </a>

      <div class="top-actions">
        <select class="term-select" aria-label="Học kỳ">
          <option selected>Học kỳ 1 · 2026–2027</option>
          <option>Học kỳ 2 · 2025–2026</option>
        </select>
        <button class="icon-button" aria-label="Trợ giúp" title="Trợ giúp">?</button>
        <a href="{{ url('/giang-vien/thong-bao') }}" class="icon-button notification-button" aria-label="Thông báo" title="Thông báo">
          ♧<span class="notification-dot"></span>
        </a>
        <a href="{{ url('/giang-vien/ho-so') }}" class="profile" style="text-decoration: none; color: inherit; cursor: pointer;">
          <div class="avatar">{{ $userInitials ?? 'MA' }}</div>
          <div class="profile-info">
            <div class="profile-name">{{ $userName ?? 'Nguyễn Minh Anh' }}</div>
            <span class="profile-id">Giảng viên · {{ $userCode ?? 'GV00128' }}</span>
          </div>
        </a>
        <a href="{{ route('logout') }}" class="icon-button" aria-label="Đăng xuất" title="Đăng xuất" style="text-decoration: none; color: #dc2626; font-size: 15px;">
          ⎋
        </a>
      </div>
    </header>

    <div class="layout">
      <!-- Sidebar (248px) -->
      <aside class="sidebar">
        <div>
          <div class="side-label">Không gian giảng viên</div>
          <nav class="nav" aria-label="Điều hướng giảng viên">
            <a class="{{ request()->is('giang-vien/dashboard*') ? 'active' : '' }}" href="{{ url('/giang-vien/dashboard') }}">
              <span class="nav-icon">⌂</span>Tổng quan
            </a>
            <a class="{{ request()->is('giang-vien/lop-hoc-phan*') ? 'active' : '' }}" href="{{ url('/giang-vien/lop-hoc-phan') }}">
              <span class="nav-icon">▤</span>Lớp học phần của tôi
            </a>
            <a class="{{ request()->is('giang-vien/thoi-khoa-bieu*') ? 'active' : '' }}" href="{{ url('/giang-vien/thoi-khoa-bieu') }}">
              <span class="nav-icon">▦</span>Thời khóa biểu
            </a>
            <a class="{{ request()->is('giang-vien/nhap-diem*') ? 'active' : '' }}" href="{{ url('/giang-vien/nhap-diem') }}">
              <span class="nav-icon">✓</span>Nhập điểm
            </a>
            <a class="{{ request()->is('giang-vien/thong-bao*') ? 'active' : '' }}" href="{{ url('/giang-vien/thong-bao') }}">
              <span class="nav-icon">◉</span>Thông báo
            </a>
            <a class="{{ request()->is('giang-vien/ho-so*') ? 'active' : '' }}" href="{{ url('/giang-vien/ho-so') }}">
              <span class="nav-icon">●</span>Hồ sơ cá nhân
            </a>
          </nav>
        </div>

        <div class="sidebar-note">
          @section('sidebar_note')
          <strong>Hỗ trợ giảng viên</strong>
          <p>Dashboard chỉ hiển thị các lớp học phần được phân công cho bạn.</p>
          @show
        </div>
      </aside>

      <!-- Main Content Area -->
      <main>
        @yield('content')
      </main>
    </div>
  </div>

  @stack('scripts')
</body>
</html>
