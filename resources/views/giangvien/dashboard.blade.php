@extends('layouts.giangvien')

@section('title', 'EduManager — Dashboard giảng viên')

@section('content')
  <div class="breadcrumb">Giảng viên&nbsp; / &nbsp;<b>Tổng quan</b></div>

  <!-- Page Heading -->
  <section class="page-heading">
    <div>
      <h1>Chào buổi sáng, {{ $userName }}</h1>
      <p class="subtitle">Tổng quan lịch dạy, lớp học phần và công việc cần xử lý.</p>
    </div>
    <span class="date-badge">Thứ Sáu, 20/11/2026</span>
  </section>

  <!-- 4 Metric Cards (KPI) -->
  <section class="metric-row">
    <div class="metric-card">
      <span class="metric-icon">▤</span>
      <div>
        <div class="metric-value">{{ $soLopPhan }}</div>
        <div class="metric-label">Lớp học phần được phân công</div>
      </div>
    </div>
    <div class="metric-card">
      <span class="metric-icon teal">♙</span>
      <div>
        <div class="metric-value">{{ $tongSinhVien }}</div>
        <div class="metric-label">Sinh viên đang phụ trách</div>
      </div>
    </div>
    <a href="{{ route('giangvien.thoikhoabieu') }}" class="metric-card" style="text-decoration: none; color: inherit;" title="Bấm để xem Thời khóa biểu chi tiết">
      <span class="metric-icon gold">◷</span>
      <div>
        <div class="metric-value">{{ $soBuoiDayTuan }}</div>
        <div class="metric-label">Buổi dạy trong tuần này</div>
      </div>
    </a>
    <div class="metric-card">
      <span class="metric-icon red">!</span>
      <div>
        <div class="metric-value">{{ $lopCanCapNhatDiem }}</div>
        <div class="metric-label">Lớp cần cập nhật điểm</div>
      </div>
    </div>
  </section>

  <!-- Dashboard Columns Grid -->
  <section class="dashboard-columns">
    <!-- Cột trái: Lịch dạy & Lối tắt -->
    <div class="main-column">
      <div class="panel">
        <div class="panel-heading">
          <div>
            <h2 class="panel-title">Lịch dạy sắp tới</h2>
            <div class="panel-subtitle">Các buổi học trong thời khóa biểu được phân công</div>
          </div>
          <a class="text-link" href="{{ url('/giang-vien/thoi-khoa-bieu') }}">Xem thời khóa biểu&nbsp; →</a>
        </div>

        @foreach($lichDaySapToi as $lich)
          <a href="{{ route('giangvien.thoikhoabieu', ['section' => $lich['section_code']]) }}" 
             class="schedule-item" 
             style="text-decoration: none; color: inherit; cursor: pointer;"
             title="Bấm để xem lịch dạy lớp {{ $lich['section_code'] }} trên Thời khóa biểu">
            <div class="schedule-date">
              <div class="date-day">{{ $lich['day'] }}</div>
              <div class="date-month">{{ $lich['month'] }}</div>
            </div>
            <div class="schedule-info">
              <div class="schedule-course">{{ $lich['course_name'] }}</div>
              <div class="schedule-code">{{ $lich['section_code'] }}</div>
              <div class="schedule-detail">
                <span>{{ $lich['room'] }}</span>
                <span>{{ $lich['students_count'] }}</span>
              </div>
            </div>
            <div class="schedule-time">{{ $lich['time'] }}</div>
          </a>
        @endforeach
      </div>

      <!-- Quick Action Buttons -->
      <div class="quick-links">
        <a class="quick-link" href="{{ url('/giang-vien/lop-hoc-phan') }}">
          <span class="quick-link-icon">▤</span>
          <span class="quick-link-label">Lớp học phần của tôi</span>
        </a>
        <a class="quick-link" href="{{ url('/giang-vien/nhap-diem') }}">
          <span class="quick-link-icon">✓</span>
          <span class="quick-link-label">Mở sổ nhập điểm</span>
        </a>
      </div>
    </div>

    <!-- Cột phải: Lớp cần cập nhật điểm & Thông báo liên quan -->
    <div class="side-column">
      <!-- Panel: Lớp cần cập nhật điểm -->
      <div class="panel">
        <div class="panel-heading">
          <div>
            <h2 class="panel-title">Lớp cần cập nhật điểm</h2>
            <div class="panel-subtitle">Theo dõi tiến độ nhập điểm</div>
          </div>
          <a class="text-link" href="{{ route('giangvien.lophocphan') }}">Tất cả&nbsp; →</a>
        </div>

        @foreach($lopCanNhap as $lop)
          <a href="{{ url('/giang-vien/nhap-diem?section=' . $lop['code']) }}" 
             class="task-row" 
             style="text-decoration: none; color: inherit; display: block; cursor: pointer;" 
             title="Bấm để mở sổ nhập điểm lớp {{ $lop['code'] }}">
            <div class="task-top">
              <div>
                <div class="task-name">{{ $lop['name'] }}</div>
                <div class="task-code">{{ $lop['code'] }}</div>
              </div>
              <span class="task-badge">{{ $lop['badge'] }}</span>
            </div>
            <div class="task-meta">
              <span>Hạn cập nhật: {{ $lop['due_date'] }}</span>
              <span>{{ $lop['progress_text'] }}</span>
            </div>
            <div class="progress-track">
              <div class="progress-value" style="width: {{ $lop['progress_percent'] }}%"></div>
            </div>
          </a>
        @endforeach
      </div>

      <!-- Panel: Thông báo liên quan -->
      <div class="panel">
        <div class="panel-heading">
          <div>
            <h2 class="panel-title">Thông báo liên quan</h2>
            <div class="panel-subtitle">Cập nhật từ Phòng Đào tạo</div>
          </div>
          <a class="text-link" href="{{ url('/giang-vien/thong-bao') }}">Xem tất cả&nbsp; →</a>
        </div>

        @forelse($thongBao as $tb)
          <div class="message-row">
            <span class="message-icon">◉</span>
            <div>
              <div class="message-title">{{ $tb->title }}</div>
              <div class="message-text">{{ Str::limit($tb->content, 70) }}</div>
              <div class="message-date">
                {{ $tb->published_at ? \Carbon\Carbon::parse($tb->published_at)->format('d/m/Y · H:i') : 'Hôm nay' }}
              </div>
            </div>
          </div>
        @empty
          <div class="message-row">
            <span class="message-icon">◉</span>
            <div>
              <div class="message-title">Kế hoạch khóa điểm học kỳ 1</div>
              <div class="message-text">Vui lòng hoàn tất điểm thành phần trước thời hạn công bố.</div>
              <div class="message-date">19/11/2026 · 15:10</div>
            </div>
          </div>
          <div class="message-row">
            <span class="message-icon">▤</span>
            <div>
              <div class="message-title">Lịch họp chuyên môn tuần tới</div>
              <div class="message-text">Thông tin thời gian và nội dung họp đã được cập nhật.</div>
              <div class="message-date">18/11/2026 · 09:20</div>
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </section>
@endsection
