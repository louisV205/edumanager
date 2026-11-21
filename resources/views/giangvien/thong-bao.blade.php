@extends('layouts.giangvien')

@section('title', 'EduManager — Thông báo giảng viên')

@section('content')
  <!-- Breadcrumb điều hướng -->
  <div class="breadcrumb">
    <a href="{{ route('giangvien.dashboard') }}" style="color: inherit; text-decoration: none;">Giảng viên</a>
    &nbsp; / &nbsp;<b>Thông báo</b>
  </div>

  <!-- Page Heading -->
  <section class="page-heading">
    <div>
      <h1>Thông báo</h1>
      <p class="subtitle">Cập nhật thông tin học vụ, phân công lớp và công việc giảng dạy.</p>
    </div>
    <div class="notice-header-actions">
      @if($unreadCount > 0)
        <span class="unread-count-pill">{{ $unreadCount }} thông báo chưa đọc</span>
      @endif
      <form method="POST" action="{{ route('giangvien.thongbao.readall') }}" style="display: inline;">
        @csrf
        <button type="submit" class="btn-mark-all" title="Đánh dấu tất cả thông báo là đã đọc">
          Đánh dấu tất cả đã đọc
        </button>
      </form>
    </div>
  </section>

  <!-- Flash Message nếu có -->
  @if(session('success'))
    <div class="alert-toast success">
      <span>✓&nbsp; {{ session('success') }}</span>
      <button type="button" onclick="this.parentElement.style.display='none'" style="background: none; border: none; font-size: 14px; cursor: pointer; color: inherit;">✕</button>
    </div>
  @endif

  <!-- Layout 2 cột: Danh sách bên trái, Chi tiết bên phải -->
  <div class="notice-layout">
    <!-- Cột trái: Bộ lọc Tabs & Danh sách phân nhóm -->
    <div class="notice-list-container">
      <div class="notice-tabs-card">
        <!-- Tabs -->
        <div class="notice-tabs">
          <a href="{{ route('giangvien.thongbao', ['tab' => 'all', 'keyword' => $keyword]) }}" 
             class="notice-tab-btn {{ $currentTab === 'all' ? 'active' : '' }}">
            Tất cả {{ $totalCount }}
          </a>
          <a href="{{ route('giangvien.thongbao', ['tab' => 'unread', 'keyword' => $keyword]) }}" 
             class="notice-tab-btn {{ $currentTab === 'unread' ? 'active' : '' }}">
            Chưa đọc {{ $unreadCount }}
          </a>
          <a href="{{ route('giangvien.thongbao', ['tab' => 'read', 'keyword' => $keyword]) }}" 
             class="notice-tab-btn {{ $currentTab === 'read' ? 'active' : '' }}">
            Đã đọc
          </a>
          <a href="{{ route('giangvien.thongbao', ['tab' => 'archived', 'keyword' => $keyword]) }}" 
             class="notice-tab-btn {{ $currentTab === 'archived' ? 'active' : '' }}">
            Lưu trữ
          </a>
        </div>

        <!-- Search input -->
        <label class="search-box" style="width: 100%;">
          <span>⌕</span>
          <input type="search" 
                 placeholder="Tìm thông báo" 
                 value="{{ $keyword }}" 
                 onkeydown="if(event.key==='Enter'){ event.preventDefault(); location.href='{{ route('giangvien.thongbao') }}?tab={{ $currentTab }}&keyword=' + encodeURIComponent(this.value); }" />
        </label>
      </div>

      <!-- Danh sách phân nhóm theo thời gian -->
      @forelse($groupedNotices as $groupName => $notices)
        <div class="notice-group-title">{{ $groupName }}</div>
        @foreach($notices as $n)
          <a href="{{ route('giangvien.thongbao', ['id' => $n['id'], 'tab' => $currentTab, 'keyword' => $keyword]) }}" 
             class="notice-card {{ $selectedId == $n['id'] ? 'active' : '' }}">
            <div class="notice-card-top">
              <div class="notice-card-title">{{ $n['title'] }}</div>
              @if($n['is_unread'])
                <span class="notice-badge-unread">Chưa đọc</span>
              @endif
            </div>
            <div class="notice-card-meta">{{ $n['sender'] }} • {{ $n['date'] }}</div>
            <div class="notice-card-snippet">{{ $n['snippet'] }}</div>
          </a>
        @endforeach
      @empty
        <div style="background: #fff; padding: 30px; text-align: center; border: 1px solid #d9e1e8; border-radius: 10px; color: #7b8794;">
          Không có thông báo nào phù hợp với bộ lọc hiện tại.
        </div>
      @endforelse
    </div>

    <!-- Cột phải: Khung xem chi tiết thông báo được chọn -->
    <div class="notice-detail-container">
      <div class="notice-detail-card">
        <span class="notice-detail-tag">{{ $selectedNotice['tag'] ?? 'Thông báo' }}</span>
        <h2 class="notice-detail-title">{{ $selectedNotice['title'] }}</h2>

        <div class="notice-sender-box">
          <div class="notice-sender-avatar">{{ $selectedNotice['sender_initials'] ?? 'ĐT' }}</div>
          <div>
            <div class="notice-sender-name">{{ $selectedNotice['sender'] }}</div>
            <div class="notice-sender-scope">{{ $selectedNotice['sender_scope'] }}</div>
          </div>
        </div>

        <div class="notice-detail-time">{{ $selectedNotice['date_full'] }}</div>

        <div class="notice-detail-body">
          @foreach($selectedNotice['content_paragraphs'] as $p)
            <p>{{ $p }}</p>
          @endforeach
        </div>

        @if(!empty($selectedNotice['related_course']))
          <div class="notice-related-box">
            <div class="notice-related-label">{{ $selectedNotice['related_course']['title'] }}</div>
            <div class="notice-related-name">{{ $selectedNotice['related_course']['name'] }}</div>
            <div class="notice-related-due">{{ $selectedNotice['related_course']['due'] }}</div>
          </div>
        @endif

        <div class="notice-detail-actions">
          @if($selectedNotice['is_unread'])
            <form method="POST" action="{{ route('giangvien.thongbao.read', $selectedNotice['id']) }}" style="display: inline;">
              @csrf
              <button type="submit" class="btn-notice-primary">Đánh dấu đã đọc</button>
            </form>
          @else
            <button type="button" class="btn-notice-primary" style="background: #16a34a; cursor: default;" disabled>✓ Đã đọc</button>
          @endif

          @if(!empty($selectedNotice['action_link']))
            <a href="{{ $selectedNotice['action_link'] }}" class="btn-notice-secondary">
              {{ $selectedNotice['action_text'] }}
            </a>
          @endif
        </div>

        <div class="notice-detail-footer">
          Thông báo đã đọc vẫn được giữ lại. Dùng tab Lưu trữ để dọn danh sách khi cần.
        </div>
      </div>
    </div>
  </div>
@endsection
