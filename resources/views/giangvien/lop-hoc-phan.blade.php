@extends('layouts.giangvien')

@section('title', 'EduManager — Lớp học phần của tôi')

@section('content')
  <!-- Breadcrumb với liên kết quay lại Dashboard -->
  <div class="breadcrumb">
    <a href="{{ route('giangvien.dashboard') }}" style="color: inherit; text-decoration: none;">Giảng viên</a>
    &nbsp; / &nbsp;<b>Lớp học phần của tôi</b>
  </div>

  <!-- Page Heading -->
  <section class="page-heading">
    <div>
      <h1>Lớp học phần của tôi</h1>
      <p class="subtitle">Theo dõi lớp được phân công, lịch học, sĩ số và tiến độ nhập điểm.</p>
    </div>
    <span class="heading-badge">{{ $tongSoLop }} lớp được phân công</span>
  </section>

  <!-- 3 Summary Cards -->
  <section class="summary-row">
    <div class="summary-card">
      <div class="summary-label">Học kỳ đang xem</div>
      <div class="summary-value">{{ $semesterName }}</div>
    </div>
    <div class="summary-card">
      <div class="summary-label">Năm học</div>
      <div class="summary-value">{{ $academicYear }}</div>
    </div>
    <div class="summary-card">
      <div class="summary-label">Lớp cần cập nhật điểm</div>
      <div class="summary-value">{{ $lopCanCapNhatDiem }} lớp</div>
    </div>
  </section>

  <!-- Filter Bar -->
  <form method="GET" action="{{ route('giangvien.lophocphan') }}">
    <section class="filters">
      <div>
        <div class="filter-title">Danh sách lớp được phân công</div>
        <div class="filter-subtitle">Tìm theo mã lớp hoặc tên môn học</div>
      </div>
      <div class="filter-actions">
        <label class="search-box">
          <span>⌕</span>
          <input type="search" name="keyword" value="{{ request('keyword') }}" placeholder="Tìm mã lớp hoặc tên môn" />
        </label>
        <select class="select-filter" aria-label="Chọn học kỳ">
          <option selected>Học kỳ 1 · 2026–2027</option>
          <option>Học kỳ 2 · 2025–2026</option>
        </select>
        <select class="select-filter" name="status" onchange="this.form.submit()" aria-label="Lọc tình trạng nhập điểm">
          <option value="Tất cả tình trạng" {{ request('status') == 'Tất cả tình trạng' ? 'selected' : '' }}>Tất cả tình trạng</option>
          <option value="Chưa nhập" {{ request('status') == 'Chưa nhập' ? 'selected' : '' }}>Chưa nhập</option>
          <option value="Đang nhập" {{ request('status') == 'Đang nhập' ? 'selected' : '' }}>Đang nhập</option>
          <option value="Đã hoàn tất" {{ request('status') == 'Đã hoàn tất' ? 'selected' : '' }}>Đã hoàn tất</option>
        </select>
      </div>
    </section>
  </form>

  <!-- Data Table -->
  <section class="table-wrap">
    <table>
      <thead>
        <tr>
          <th class="col-class">MÃ LỚP / MÔN HỌC</th>
          <th class="col-term">HỌC KỲ</th>
          <th class="col-schedule">LỊCH HỌC / PHÒNG</th>
          <th class="col-enrollment">SĨ SỐ</th>
          <th class="col-grade">TÌNH TRẠNG NHẬP ĐIỂM</th>
          <th class="col-action"></th>
        </tr>
      </thead>
      <tbody>
        @forelse($danhSachLop as $lop)
          <tr>
            <td>
              <div class="class-code">{{ $lop['class_code'] }}</div>
              <div class="class-name">{{ $lop['course_name'] }}</div>
              <div class="class-teacher">{{ $lop['teacher'] }}</div>
            </td>
            <td>
              <div class="term-name">{{ $lop['term'] }}</div>
              <div class="schedule-room">{{ $lop['year'] }}</div>
            </td>
            <td>
              <a href="{{ route('giangvien.thoikhoabieu', ['section' => $lop['class_code']]) }}" 
                 title="Xem lớp {{ $lop['class_code'] }} trên Thời khóa biểu tuần" 
                 style="text-decoration: none; color: inherit; display: block;">
                <div class="schedule-day" style="color: #245b8f; font-weight: 500;">{{ $lop['schedule_day'] }} ↗</div>
                <div class="schedule-room">{{ $lop['room'] }}</div>
              </a>
            </td>
            <td class="col-enrollment">
              <div class="enrollment-number">{{ $lop['current_enrollment'] }} / {{ $lop['capacity'] }}</div>
              <div class="enrollment-label">sinh viên</div>
            </td>
            <td>
              <a href="{{ url('/giang-vien/nhap-diem?section=' . $lop['class_code']) }}" 
                 style="text-decoration: none; color: inherit; display: block;" 
                 title="Bấm để mở sổ nhập điểm lớp {{ $lop['class_code'] }}">
                <div class="grade-top">
                  <span class="grade-status {{ $lop['status_class'] }}">{{ $lop['grade_status'] }}</span>
                  <span class="grade-count">{{ $lop['grade_text'] }}</span>
                </div>
                <div class="progress-track">
                  <div class="progress-value {{ $lop['status_class'] }}" style="width: {{ $lop['progress_percent'] }}%"></div>
                </div>
              </a>
            </td>
            <td class="col-action">
              <a href="{{ url('/giang-vien/nhap-diem?section=' . $lop['class_code']) }}" class="row-menu" title="Mở sổ nhập điểm cho lớp {{ $lop['class_code'] }}">···</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center; padding: 30px; color: #7b8794;">
              Không tìm thấy lớp học phần nào phù hợp.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <div class="table-footer">
      <span>Hiển thị {{ count($danhSachLop) }} lớp học phần được phân công</span>
      <div class="pagination">
        <button class="page-button" aria-label="Trang trước" disabled style="opacity: 0.5;">‹</button>
        <button class="page-button active">1</button>
        <button class="page-button" aria-label="Trang sau" disabled style="opacity: 0.5;">›</button>
      </div>
    </div>
  </section>

  <!-- Scope Note -->
  <div class="scope-note">
    <span class="scope-icon">i</span>
    <span><strong>Phạm vi dữ liệu:</strong> Danh sách này chỉ hiển thị các lớp học phần được phân công cho tài khoản giảng viên hiện tại.</span>
  </div>
@endsection
