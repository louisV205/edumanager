<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>EduManager — Đăng nhập</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: "Be Vietnam Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      background: #ffffff;
      color: #0f172a;
      min-height: 100vh;
      display: flex;
    }
    .auth-container {
      display: flex;
      width: 100vw;
      min-height: 100vh;
    }

    /* --- CỘT TRÁI: BRANDING & GIỚI THIỆU (50%) --- */
    .auth-brand-pane {
      width: 50%;
      background: #f0f7ff;
      padding: 56px 64px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: relative;
      overflow: hidden;
      border-right: 1px solid #e2e8f0;
    }

    /* Họa tiết vòng cung tròn trang trí mờ ở góc dưới phải */
    .concentric-circles {
      position: absolute;
      bottom: -140px;
      right: -140px;
      width: 520px;
      height: 520px;
      pointer-events: none;
    }
    .circle-ring {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border-radius: 50%;
      border: 1px solid rgba(2, 132, 199, 0.12);
    }
    .ring-1 { width: 480px; height: 480px; }
    .ring-2 { width: 380px; height: 380px; border-color: rgba(2, 132, 199, 0.15); }
    .ring-3 { width: 280px; height: 280px; border-color: rgba(2, 132, 199, 0.18); }
    .ring-4 { width: 180px; height: 180px; border-color: rgba(2, 132, 199, 0.22); }

    .brand-top {
      display: flex;
      align-items: center;
      gap: 12px;
      z-index: 2;
    }
    .brand-logo-badge {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: #17324d;
      color: #ffffff;
      font-size: 20px;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 6px rgba(23, 50, 77, 0.15);
    }
    .brand-text-name {
      font-size: 20px;
      font-weight: 700;
      letter-spacing: -0.3px;
      color: #17324d;
    }

    .brand-center {
      margin: auto 0;
      max-width: 480px;
      z-index: 2;
    }
    .brand-tag {
      font-size: 13px;
      font-weight: 700;
      color: #0284c7;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .brand-heading {
      font-size: 38px;
      font-weight: 700;
      line-height: 1.25;
      letter-spacing: -0.8px;
      color: #0f172a;
      margin-bottom: 18px;
    }
    .brand-description {
      font-size: 15px;
      line-height: 1.65;
      color: #64748b;
      margin-bottom: 24px;
    }
    .brand-line {
      width: 60px;
      height: 3px;
      background: #0284c7;
      border-radius: 2px;
    }

    .brand-footer {
      font-size: 13px;
      color: #94a3b8;
      z-index: 2;
    }

    /* --- CỘT PHẢI: FORM ĐĂNG NHẬP (50%) --- */
    .auth-form-pane {
      width: 50%;
      background: #ffffff;
      padding: 56px 64px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    .form-wrapper {
      width: 100%;
      max-width: 440px;
    }

    .form-heading-group {
      margin-bottom: 28px;
    }
    .welcome-pill {
      font-size: 12px;
      font-weight: 700;
      color: #0284c7;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      margin-bottom: 8px;
    }
    .form-title {
      font-size: 30px;
      font-weight: 700;
      color: #0f172a;
      letter-spacing: -0.5px;
      margin-bottom: 6px;
    }
    .form-subtitle {
      font-size: 14px;
      color: #64748b;
    }

    /* Alert */
    .alert-error {
      background: #fef2f2;
      border: 1px solid #fecaca;
      color: #dc2626;
      padding: 12px 14px;
      border-radius: 8px;
      font-size: 13px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .alert-status {
      background: #ecfdf5;
      border: 1px solid #a7f3d0;
      color: #065f46;
      padding: 12px 14px;
      border-radius: 8px;
      font-size: 13px;
      margin-bottom: 20px;
    }

    /* Form Fields */
    .form-group {
      margin-bottom: 18px;
    }
    .form-label {
      display: block;
      font-size: 13.5px;
      font-weight: 600;
      color: #1e293b;
      margin-bottom: 7px;
    }
    .input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }
    .form-input {
      width: 100%;
      height: 46px;
      padding: 0 14px;
      font-size: 14px;
      color: #0f172a;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      background: #ffffff;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      font-family: inherit;
    }
    .form-input:focus {
      border-color: #0284c7;
      box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.12);
    }
    .password-toggle-btn {
      position: absolute;
      right: 14px;
      background: none;
      border: none;
      color: #0284c7;
      font-size: 13.5px;
      font-weight: 600;
      cursor: pointer;
      padding: 4px;
    }
    .password-toggle-btn:hover {
      text-decoration: underline;
    }

    /* Options Row */
    .form-options-row {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      margin-top: -6px;
      margin-bottom: 22px;
      font-size: 13.5px;
    }
    .forgot-link {
      color: #0284c7;
      text-decoration: none;
      font-weight: 500;
    }
    .forgot-link:hover {
      text-decoration: underline;
    }

    /* Submit Button */
    .btn-submit {
      width: 100%;
      height: 48px;
      background: #17324d;
      color: #ffffff;
      border: none;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      box-shadow: 0 2px 6px rgba(23, 50, 77, 0.2);
      transition: background 0.2s, transform 0.1s;
    }
    .btn-submit:hover {
      background: #102438;
    }
    .btn-submit:active {
      transform: translateY(1px);
    }

    /* Khối Lưu ý Bảo mật */
    .security-note {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      margin-top: 20px;
      padding: 12px 14px;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      font-size: 12.5px;
      color: #64748b;
      line-height: 1.5;
    }
    .security-note-icon {
      font-size: 15px;
      color: #0284c7;
      flex-shrink: 0;
      line-height: 1.3;
    }

    /* Footer support */
    .form-support-text {
      margin-top: 24px;
      text-align: center;
      font-size: 13px;
      color: #64748b;
    }
    .form-support-text a {
      color: #17324d;
      font-weight: 600;
      text-decoration: none;
    }
    .form-support-text a:hover {
      text-decoration: underline;
    }

    @media (max-width: 992px) {
      .auth-container { flex-direction: column; }
      .auth-brand-pane, .auth-form-pane { width: 100%; padding: 40px 24px; }
      .brand-center { margin: 40px 0; }
    }
  </style>
</head>
<body>

  <div class="auth-container">
    <!-- CỘT TRÁI: BRANDING & GIỚI THIỆU (50%) -->
    <div class="auth-brand-pane">
      <!-- Vòng cung đồng tâm trang trí mờ -->
      <div class="concentric-circles">
        <div class="circle-ring ring-1"></div>
        <div class="circle-ring ring-2"></div>
        <div class="circle-ring ring-3"></div>
        <div class="circle-ring ring-4"></div>
      </div>

      <div class="brand-top">
        <div class="brand-logo-badge">E</div>
        <div class="brand-text-name">EduManager</div>
      </div>

      <div class="brand-center">
        <div class="brand-tag">— CỔNG QUẢN LÝ ĐÀO TẠO</div>
        <h1 class="brand-heading">Quản lý học tập<br />trên một nền tảng</h1>
        <p class="brand-description">
          Kết nối sinh viên, giảng viên và Phòng Đào tạo với những thông tin học vụ cần thiết.
        </p>
        <div class="brand-line"></div>
      </div>

      <div class="brand-footer">
        EduManager · Cổng thông tin đào tạo
      </div>
    </div>

    <!-- CỘT PHẢI: FORM ĐĂNG NHẬP (50%) -->
    <div class="auth-form-pane">
      <div class="form-wrapper">

        <div class="form-heading-group">
          <div class="welcome-pill">CHÀO MỪNG BẠN</div>
          <h2 class="form-title">Đăng nhập</h2>
          <p class="form-subtitle">Sử dụng tài khoản EduManager để tiếp tục.</p>
        </div>

        @if(session('status'))
          <div class="alert-status">
            {{ session('status') }}
          </div>
        @endif

        @if($errors->has('login'))
          <div class="alert-error">
            <span>⚠</span>
            <span>{{ $errors->first('login') }}</span>
          </div>
        @endif

        <!-- Form Đăng nhập dùng chung (Single Sign-On) -->
        <form action="{{ route('login.post') }}" method="POST">
          @csrf

          <div class="form-group">
            <label class="form-label" for="loginInput">Tên đăng nhập hoặc email</label>
            <div class="input-wrapper">
              <input 
                type="text" 
                id="loginInput" 
                name="login" 
                class="form-input" 
                placeholder="Nhập mã tài khoản hoặc email" 
                value="{{ old('login') }}" 
                required 
                autofocus
              />
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="passwordInput">Mật khẩu</label>
            <div class="input-wrapper">
              <input 
                type="password" 
                id="passwordInput" 
                name="password" 
                class="form-input" 
                placeholder="Nhập mật khẩu" 
                value=""
                required
              />
              <button type="button" class="password-toggle-btn" id="togglePassBtn" onclick="togglePasswordVisibility()">
                Hiện
              </button>
            </div>
          </div>

          <div class="form-options-row">
            <a href="javascript:void(0)" onclick="alert('Vui lòng liên hệ Phòng Đào tạo hoặc Quản trị viên để được cấp lại mật khẩu.')" class="forgot-link">
              Quên mật khẩu?
            </a>
          </div>

          <button type="submit" class="btn-submit">
            Đăng nhập
          </button>
        </form>

        <!-- Khối Lưu ý Bảo mật chuẩn Figma -->
        <div class="security-note">
          <span class="security-note-icon">🛡</span>
          <span>Vui lòng không chia sẻ thông tin đăng nhập. Tài khoản được cấp bởi nhà trường.</span>
        </div>

        <!-- Cần hỗ trợ -->
        <div class="form-support-text">
          Cần hỗ trợ? <a href="mailto:daotao@edumanager.edu.vn">Liên hệ Phòng Đào tạo</a>
        </div>

      </div>
    </div>
  </div>

  <script>
    function togglePasswordVisibility() {
      const pass = document.getElementById('passwordInput');
      const btn = document.getElementById('togglePassBtn');
      if (pass.type === 'password') {
        pass.type = 'text';
        btn.innerText = 'Ẩn';
      } else {
        pass.type = 'password';
        btn.innerText = 'Hiện';
      }
    }
  </script>
</body>
</html>
