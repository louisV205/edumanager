@extends('layouts.giangvien')

@section('title', 'EduManager — Nhập điểm học phần')

@section('content')
  <!-- Breadcrumb điều hướng -->
  <div class="breadcrumb">
    <a href="{{ route('giangvien.dashboard') }}" style="color: inherit; text-decoration: none;">Giảng viên</a>
    &nbsp; / &nbsp;<b>Nhập điểm</b>
  </div>

  <!-- Page Heading -->
  <section class="page-heading">
    <div>
      <h1>Nhập điểm</h1>
      <p class="subtitle">Nhập và lưu điểm thành phần cho sinh viên trong lớp học phần.</p>
    </div>
    <span class="term-badge">{{ $semesterBadge }}</span>
  </section>

  <!-- Flash Message nếu có thông báo lưu thành công -->
  @if(session('success'))
    <div class="alert-toast success">
      <span>✓&nbsp; {{ session('success') }}</span>
      <button type="button" onclick="this.parentElement.style.display='none'" style="background: none; border: none; font-size: 14px; cursor: pointer; color: inherit;">✕</button>
    </div>
  @endif

  <!-- Class Selector Banner (Lớp đang chọn) -->
  <section class="class-banner">
    <div>
      <div class="class-banner-label">Lớp đang chọn</div>
      <div class="class-banner-title">{{ $currentClass['name'] ?? $currentClass['code'] }}</div>
      <div class="class-banner-meta">
        <span>{{ $totalStudents }} sinh viên</span>
        <span>•</span>
        <span>{{ $currentClass['room'] ?? 'Phòng A203' }}</span>
        <span>•</span>
        <span>{{ $semesterBadge }}</span>
      </div>
    </div>
    <div>
      <select class="class-banner-select" aria-label="Chuyển lớp học phần" onchange="location.href='{{ route('giangvien.nhapdiem') }}?section=' + this.value">
        @foreach($classList as $c)
          <option value="{{ $c['code'] }}" {{ $selectedCode == $c['code'] ? 'selected' : '' }}>
            {{ $c['name'] }}
          </option>
        @endforeach
      </select>
    </div>
  </section>

  <!-- 4 Metric Cards (Summary Row) -->
  <section class="summary-row" style="grid-template-columns: repeat(4, 1fr);">
    <div class="summary-card">
      <div class="summary-value">{{ $totalStudents }}</div>
      <div class="summary-label">Sinh viên trong lớp</div>
    </div>
    <div class="summary-card">
      <div class="summary-value" style="color: #245b8f;">{{ $gradedStudents }}</div>
      <div class="summary-label">Đã có điểm thành phần</div>
    </div>
    <div class="summary-card">
      <div class="summary-value" style="color: #c9584d;">{{ $missingStudents }}</div>
      <div class="summary-label">Còn thiếu điểm</div>
    </div>
    <div class="summary-card">
      <div class="summary-value">{{ $gradeScale }}</div>
      <div class="summary-label">Thang điểm nhập</div>
    </div>
  </section>

  <!-- Form nhập & lưu điểm -->
  <form method="POST" action="{{ route('giangvien.nhapdiem.store') }}" id="gradeForm">
    @csrf
    <input type="hidden" name="section_code" value="{{ $selectedCode }}" />

    <!-- Grade Table Card -->
    <div class="grade-table-card">
      <!-- Toolbar: Title & Search Filter -->
      <div class="grade-table-toolbar">
        <div>
          <div class="grade-table-title">Bảng điểm thành phần</div>
          <div class="grade-table-subtitle">Điểm được nhập theo các cột đã cấu hình cho lớp</div>
        </div>
        <div class="grade-table-actions">
          <label class="search-box">
            <span>⌕</span>
            <input type="search" name="keyword" value="{{ $keyword }}" placeholder="Tìm mã SV hoặc họ tên" onkeydown="if(event.key==='Enter'){ event.preventDefault(); location.href='{{ route('giangvien.nhapdiem') }}?section={{ $selectedCode }}&keyword=' + encodeURIComponent(this.value); }" />
          </label>
          <select class="filter-select" aria-label="Lọc trạng thái điểm" onchange="location.href='{{ route('giangvien.nhapdiem') }}?section={{ $selectedCode }}&status_filter=' + encodeURIComponent(this.value)">
            <option value="Tất cả sinh viên" {{ $statusFilter === 'Tất cả sinh viên' ? 'selected' : '' }}>Tất cả sinh viên</option>
            <option value="Còn thiếu điểm" {{ $statusFilter === 'Còn thiếu điểm' ? 'selected' : '' }}>Còn thiếu điểm</option>
            <option value="Đã có điểm thành phần" {{ $statusFilter === 'Đã có điểm thành phần' ? 'selected' : '' }}>Đã có điểm thành phần</option>
          </select>
        </div>
      </div>

      <!-- Data Table -->
      <section class="table-wrap" style="border: none; border-radius: 0; margin-bottom: 0;">
        <table>
          <thead>
            <tr>
              <th style="width: 55px; text-align: center;">STT</th>
              <th style="min-width: 200px;">MÃ SINH VIÊN / HỌ TÊN</th>
              <th class="col-score-head" style="width: 110px;">
                CHUYÊN CẦN
                <span class="col-score-sub">0–10</span>
              </th>
              <th class="col-score-head" style="width: 110px;">
                GIỮA KỲ
                <span class="col-score-sub">0–10</span>
              </th>
              <th class="col-score-head" style="width: 110px;">
                CUỐI KỲ
                <span class="col-score-sub">0–10</span>
              </th>
              <th style="min-width: 140px;">CẬP NHẬT</th>
            </tr>
          </thead>
          <tbody>
            @forelse($students as $sv)
              <tr>
                <td style="text-align: center; color: #687583; font-weight: 500;">
                  {{ $sv['stt'] }}
                </td>
                <td>
                  <div class="class-code">{{ $sv['student_code'] }}</div>
                  <div class="class-name" style="font-size: 13px;">{{ $sv['student_name'] }}</div>
                </td>
                <td style="text-align: center;">
                  <input type="number" 
                         step="0.1" 
                         min="0" 
                         max="10" 
                         name="grades[{{ $sv['id'] }}][attendance]" 
                         value="{{ $sv['attendance'] }}" 
                         class="score-input" 
                         placeholder="—" />
                </td>
                <td style="text-align: center;">
                  <input type="number" 
                         step="0.1" 
                         min="0" 
                         max="10" 
                         name="grades[{{ $sv['id'] }}][midterm]" 
                         value="{{ $sv['midterm'] }}" 
                         class="score-input" 
                         placeholder="—" />
                </td>
                <td style="text-align: center;">
                  <input type="number" 
                         step="0.1" 
                         min="0" 
                         max="10" 
                         name="grades[{{ $sv['id'] }}][final_exam]" 
                         value="{{ $sv['final_exam'] }}" 
                         class="score-input" 
                         placeholder="—" />
                </td>
                <td>
                  @if($sv['status'] === 'saved')
                    <span class="status-tag saved">{{ $sv['status_text'] }}</span>
                    @if(!empty($sv['status_time']))
                      <span class="status-time">{{ $sv['status_time'] }}</span>
                    @endif
                  @elseif($sv['status'] === 'missing')
                    <span class="status-tag missing">{{ $sv['status_text'] }}</span>
                  @else
                    <span class="status-tag pending">{{ $sv['status_text'] }}</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" style="text-align: center; padding: 30px; color: #7b8794;">
                  Không tìm thấy sinh viên nào theo điều kiện tìm kiếm.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>

        <!-- Table Footer / Pagination -->
        <div class="table-footer">
          <span>Hiển thị 1 – {{ count($students) }} trong {{ $totalStudents }} sinh viên · 10 sinh viên mỗi trang</span>
          <div class="pagination">
            <button type="button" class="page-button" aria-label="Trang trước" disabled style="opacity: 0.5;">‹</button>
            <button type="button" class="page-button active">1</button>
            <button type="button" class="page-button">2</button>
            <button type="button" class="page-button">3</button>
            <button type="button" class="page-button">4</button>
            <button type="button" class="page-button">5</button>
            <button type="button" class="page-button" aria-label="Trang sau">›</button>
          </div>
        </div>
      </section>

      <!-- Bottom Action Bar (Lưu nháp / Lưu bảng điểm) -->
      <div class="bottom-action-bar">
        <div>
          <div class="last-saved-note">
            <span class="last-saved-dot"></span>
            <strong>Đã lưu các thay đổi gần nhất</strong>
          </div>
          <div class="status-time" style="margin-left: 14px;">Lần lưu cuối: {{ $lastSavedText }}</div>
        </div>
        <div class="action-buttons">
          <button type="submit" name="action" value="draft" class="btn-draft" title="Lưu tạm thời các điểm đã nhập">
            Lưu nháp
          </button>
          <button type="submit" name="action" value="publish" class="btn-save-grade" title="Cập nhật và hoàn tất lưu bảng điểm lớp này">
            Lưu bảng điểm
          </button>
        </div>
      </div>
    </div>
  </form>

  <!-- Scope Note (Hộp ghi chú phạm vi dưới cùng) -->
  <div class="scope-note">
    <span class="scope-icon">i</span>
    <span><strong>Phạm vi dữ liệu:</strong> Chỉ nhập điểm cho sinh viên thuộc lớp học phần được phân công. Điểm số hợp lệ từ 0.0 đến 10.0. Sau khi lưu, bảng điểm có thể chỉnh sửa cho đến thời hạn đóng sổ điểm của nhà trường.</span>
  </div>
@endsection
