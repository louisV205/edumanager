@extends('layouts.giangvien')

@section('title', 'EduManager — Thời khóa biểu giảng viên')

@section('content')
  <!-- Breadcrumb điều hướng quay về Dashboard -->
  <div class="breadcrumb">
    <a href="{{ route('giangvien.dashboard') }}" style="color: inherit; text-decoration: none;">Giảng viên</a>
    &nbsp; / &nbsp;<b>Thời khóa biểu</b>
  </div>

  <!-- Page Heading -->
  <section class="page-heading">
    <div>
      <h1>Thời khóa biểu</h1>
      <p class="subtitle">Theo dõi lịch dạy theo tuần và thông tin phòng học.</p>
    </div>
    <span class="term-badge">{{ $semesterBadge }}</span>
  </section>

  <!-- Week Toolbar -->
  <section class="week-toolbar">
    <div class="week-navigation">
      <button class="control-button" aria-label="Tuần trước" title="Tuần trước">‹</button>
      <button class="today-button" title="Chuyển về tuần này">Hôm nay</button>
      <button class="control-button" aria-label="Tuần sau" title="Tuần sau">›</button>
      <span class="week-range">{{ $weekRange }}</span>
    </div>

    <div class="toolbar-actions">
      <select class="filter-select" aria-label="Lọc lớp học phần" onchange="location.href = this.value ? '{{ route('giangvien.thoikhoabieu') }}?section=' + this.value : '{{ route('giangvien.thoikhoabieu') }}'">
        <option value="">Tất cả lớp được phân công</option>
        @foreach($filterClasses as $fClass)
          <option value="{{ $fClass['code'] }}" {{ ($selectedSection ?? '') == $fClass['code'] ? 'selected' : '' }}>
            {{ $fClass['label'] }}
          </option>
        @endforeach
      </select>
      <button class="export-button" onclick="window.print()" title="In hoặc xuất file lịch dạy">
        ↓&nbsp; Xuất lịch
      </button>
    </div>
  </section>

  <!-- Calendar Weekly Grid Card -->
  <section class="calendar-card">
    <div class="calendar-heading">
      <div>
        <div class="calendar-title">Lịch dạy trong tuần</div>
        <div class="calendar-subtitle">{{ $weekDateSubtitle }}</div>
      </div>
      <div class="legend">
        <span class="legend-item"><i class="legend-dot"></i>Lịch dạy</span>
        <span class="legend-item"><i class="legend-dot today"></i>Hôm nay</span>
      </div>
    </div>

    <div class="calendar-scroll">
      <!-- Week Header (Ngày & Thứ) -->
      <div class="week-header">
        <div class="time-heading">Giờ dạy</div>
        @foreach($days as $day)
          <div class="day-heading {{ $day['is_today'] ? 'today' : '' }}">
            <span>{{ $day['name'] }}</span>
            <span class="day-number">{{ $day['number'] }}</span>
          </div>
        @endforeach
      </div>

      <!-- Calendar Time Rows -->
      @foreach($timeSlots as $slot)
        <div class="calendar-row">
          <div class="time-label">{{ $slot['time_start'] }}<br />{{ $slot['time_end'] }}</div>

          @foreach($days as $day)
            @php
              $item = $grid[$slot['slot_key']][$day['day_of_week']] ?? null;
            @endphp
            <div class="day-cell {{ $day['is_today'] ? 'today' : '' }}">
              @if($item)
                <a href="{{ url('/giang-vien/nhap-diem?section=' . $item['section_code']) }}" 
                   title="Bấm để mở sổ điểm lớp {{ $item['section_code'] }}" 
                   style="text-decoration: none; color: inherit; display: block; height: 100%;">
                  <div class="class-block {{ $item['color_class'] }}">
                    <div class="block-name">{{ $item['course_name'] }}</div>
                    <div class="block-code">{{ $item['section_code'] }}</div>
                    <div class="block-detail">{{ $item['room'] }}<br />{{ $item['teacher'] }}</div>
                  </div>
                </a>
              @else
                <div class="empty-slot">—</div>
              @endif
            </div>
          @endforeach
        </div>
      @endforeach
    </div>
  </section>

  <!-- Scope Note -->
  <div class="scope-note">
    <span class="scope-icon">i</span>
    <span><strong>Phạm vi dữ liệu:</strong> Lịch dạy được tổng hợp từ các lớp học phần giảng viên được phân công. Ngày không có buổi dạy được để trống. Bấm vào bất kỳ thẻ lớp học nào để mở nhanh sổ nhập điểm.</span>
  </div>
@endsection
