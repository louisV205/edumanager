@extends('layouts.giangvien')

@section('title', 'Hồ sơ cá nhân · EduManager')

@section('sidebar_note')
<strong>Hồ sơ giảng viên</strong>
<p>Thông tin cá nhân và công tác được hiển thị theo hồ sơ giảng viên.</p>
@endsection

@section('content')
  <!-- Breadcrumb -->
  <div class="breadcrumb">
    <a href="{{ route('giangvien.dashboard') }}">Giảng viên</a>
    <span>/</span>
    <span class="active">Hồ sơ cá nhân</span>
  </div>

  @if(session('success'))
    <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 12px 16px; border-radius: 8px; margin-top: 12px; font-size: 13.5px; display: flex; align-items: center; justify-content: space-between;">
      <span>✓ {{ session('success') }}</span>
      <button onclick="this.parentElement.remove()" style="background:none; border:none; color:#065f46; cursor:pointer; font-size:16px;">&times;</button>
    </div>
  @endif

  <!-- Header Title & Action -->
  <div class="page-header" style="margin-top: 14px;">
    <div>
      <h1 class="page-title">Hồ sơ cá nhân</h1>
      <p class="page-subtitle">Xem thông tin cá nhân, liên hệ và thông tin công tác.</p>
    </div>
    <div>
      <button type="button" class="btn-subtle" onclick="openContactModal()" style="display: inline-flex; align-items: center; gap: 8px; color: #1d4ed8; border: 1px solid #bfdbfe; background: #ffffff; font-weight: 500;">
        <span style="color: #1d4ed8; font-size: 15px;">✎</span> Chỉnh sửa thông tin liên hệ
      </button>
    </div>
  </div>

  <!-- Profile Summary Banner (Hero Card) -->
  <div class="profile-banner">
    <div class="profile-banner-left">
      <div class="profile-avatar-large">
        {{ $profile['initials'] ?? 'MA' }}
      </div>
      <div>
        <div class="profile-banner-title">{{ $profile['name'] }}</div>
        <div class="profile-banner-meta">
          <span>Mã giảng viên: <strong>{{ $profile['code'] }}</strong></span>
          <span class="bullet">•</span>
          <span>{{ $profile['department'] }}</span>
          <span class="bullet">•</span>
          <span>{{ $profile['position'] }}</span>
        </div>
      </div>
    </div>
    <div>
      <span class="profile-status-badge">{{ $profile['status'] }}</span>
    </div>
  </div>

  <!-- 4 Information Cards (2x2 Grid) -->
  <div class="profile-grid">

    <!-- Card 1: Thông tin cá nhân -->
    <div class="profile-card">
      <div class="profile-card-header">
        <div>
          <div class="profile-card-title">Thông tin cá nhân</div>
          <div class="profile-card-subtitle">Thông tin định danh trong hồ sơ giảng viên</div>
        </div>
      </div>

      <div class="profile-fields-2col">
        <div class="profile-field-item">
          <span class="profile-field-label">Họ và tên</span>
          <span class="profile-field-value">{{ $profile['name'] }}</span>
        </div>
        <div class="profile-field-item">
          <span class="profile-field-label">Mã giảng viên</span>
          <span class="profile-field-value">{{ $profile['code'] }}</span>
        </div>
      </div>

      <div class="profile-divider"></div>

      <div class="profile-fields-2col">
        <div class="profile-field-item">
          <span class="profile-field-label">Giới tính</span>
          <span class="profile-field-value">{{ $profile['gender'] }}</span>
        </div>
        <div class="profile-field-item">
          <span class="profile-field-label">Ngày sinh</span>
          <span class="profile-field-value">{{ $profile['dob'] }}</span>
        </div>
      </div>

      <div class="profile-divider"></div>

      <div class="profile-fields-2col">
        <div class="profile-field-item">
          <span class="profile-field-label">Nơi sinh</span>
          <span class="profile-field-value">{{ $profile['pob'] }}</span>
        </div>
      </div>
    </div>

    <!-- Card 2: Thông tin công tác -->
    <div class="profile-card">
      <div class="profile-card-header">
        <div>
          <div class="profile-card-title">Thông tin công tác</div>
          <div class="profile-card-subtitle">Đơn vị và chuyên môn hiện tại</div>
        </div>
      </div>

      <div class="profile-field-item">
        <span class="profile-field-label">Đơn vị</span>
        <span class="profile-field-value">{{ $profile['department'] }}</span>
      </div>

      <div class="profile-divider"></div>

      <div class="profile-fields-2col">
        <div class="profile-field-item">
          <span class="profile-field-label">Bộ môn</span>
          <span class="profile-field-value">{{ $profile['specialization'] }}</span>
        </div>
        <div class="profile-field-item">
          <span class="profile-field-label">Học vị</span>
          <span class="profile-field-value">{{ $profile['academic_title'] }}</span>
        </div>
      </div>

      <div class="profile-divider"></div>

      <div class="profile-fields-2col">
        <div class="profile-field-item">
          <span class="profile-field-label">Chức danh</span>
          <span class="profile-field-value">{{ $profile['position'] }}</span>
        </div>
        <div class="profile-field-item">
          <span class="profile-field-label">Ngày công tác</span>
          <span class="profile-field-value">{{ $profile['start_working_date'] }}</span>
        </div>
      </div>
    </div>

    <!-- Card 3: Thông tin liên hệ -->
    <div class="profile-card">
      <div class="profile-card-header">
        <div>
          <div class="profile-card-title">Thông tin liên hệ</div>
          <div class="profile-card-subtitle">Liên hệ quản lý để đề nghị cập nhật thông tin</div>
        </div>
        <button type="button" class="profile-card-action" onclick="openContactModal()">Chỉnh sửa</button>
      </div>

      <div class="profile-contact-list">
        <div class="profile-contact-row">
          <div class="profile-contact-icon icon-mail">✉</div>
          <div>
            <div class="profile-field-label">Email công tác</div>
            <div class="profile-field-value">{{ $profile['email'] }}</div>
          </div>
        </div>

        <div class="profile-divider" style="margin: 4px 0;"></div>

        <div class="profile-contact-row">
          <div class="profile-contact-icon icon-phone">☎</div>
          <div>
            <div class="profile-field-label">Số điện thoại</div>
            <div class="profile-field-value">{{ $profile['phone'] }}</div>
          </div>
        </div>

        <div class="profile-divider" style="margin: 4px 0;"></div>

        <div class="profile-contact-row">
          <div class="profile-contact-icon icon-office">🏢</div>
          <div>
            <div class="profile-field-label">Phòng làm việc</div>
            <div class="profile-field-value">{{ $profile['office'] }}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Card 4: Thông tin tài khoản -->
    <div class="profile-card">
      <div class="profile-card-header">
        <div>
          <div class="profile-card-title">
            <span style="display:inline-flex; align-items:center; justify-content:center; width:22px; height:22px; background:#ecfdf5; color:#059669; border-radius:6px; font-size:12px;">📇</span>
            Thông tin tài khoản
          </div>
          <div class="profile-card-subtitle">Tài khoản EduManager của giảng viên</div>
        </div>
      </div>

      <div class="profile-fields-2col">
        <div class="profile-field-item">
          <span class="profile-field-label">Tên đăng nhập</span>
          <span class="profile-field-value">{{ $profile['username'] }}</span>
        </div>
        <div class="profile-field-item">
          <span class="profile-field-label">Vai trò</span>
          <span class="profile-field-value">{{ $profile['role'] }}</span>
        </div>
      </div>

      <div class="profile-divider"></div>

      <div class="profile-field-item">
        <span class="profile-field-label">Trạng thái tài khoản</span>
        <span class="profile-field-value" style="display: flex; align-items: center; gap: 6px; color: #15803d;">
          <span style="width: 7px; height: 7px; border-radius: 50%; background: #22c55e;"></span>
          {{ $profile['account_status'] }}
        </span>
      </div>

      <!-- Callout Box: Lưu ý -->
      <div class="profile-callout-box">
        <div class="profile-callout-title">
          <span>ℹ</span> Lưu ý
        </div>
        <div class="profile-callout-text">
          Thông tin định danh, đơn vị công tác và quyền tài khoản do nhà trường quản lý. Liên hệ Phòng Tổ chức hoặc quản trị hệ thống khi cần điều chỉnh.
        </div>
      </div>
    </div>

  </div>

  <!-- Modal Chỉnh sửa thông tin liên hệ -->
  <div id="contactModal" class="modal-overlay" style="display: none;">
    <div class="modal-card">
      <div class="modal-header">
        <div class="modal-title">Chỉnh sửa thông tin liên hệ</div>
        <button type="button" class="modal-close" onclick="closeContactModal()">&times;</button>
      </div>
      <form action="{{ route('giangvien.hoso.update') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="modal-form-group">
            <label class="modal-label" for="input_email">Email công tác</label>
            <input type="email" id="input_email" name="email" class="modal-input" value="{{ $profile['email'] }}" required>
          </div>

          <div class="modal-form-group">
            <label class="modal-label" for="input_phone">Số điện thoại</label>
            <input type="text" id="input_phone" name="phone" class="modal-input" value="{{ $profile['phone'] }}" required>
          </div>

          <div class="modal-form-group">
            <label class="modal-label" for="input_office">Phòng làm việc</label>
            <input type="text" id="input_office" name="office" class="modal-input" value="{{ $profile['office'] }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-subtle" onclick="closeContactModal()">Hủy</button>
          <button type="submit" class="btn-primary">Lưu thay đổi</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function openContactModal() {
    document.getElementById('contactModal').style.display = 'flex';
  }
  function closeContactModal() {
    document.getElementById('contactModal').style.display = 'none';
  }
  // Đóng modal khi click ra ngoài vùng nền mờ
  window.addEventListener('click', function(e) {
    const modal = document.getElementById('contactModal');
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
</script>
@endpush
