
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>EduManager — Hồ sơ cá nhân</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <style>
    * { box-sizing: border-box; }

    body {
      margin: 0;
      min-width: 1440px;
      background: #f4f7fa;
      color: #1f2937;
      font: 14px/1.5 "Be Vietnam Pro", Arial, sans-serif;
    }

    button, input, select { font: inherit; }
    button { cursor: pointer; }

    /* HEADER */
    .topbar {
      height: 72px;
      padding: 0 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #fff;
      border-bottom: 1px solid #d9e1e8;
    }

    .brand, .top-actions, .profile {
      display: flex;
      align-items: center;
    }

    .brand {
      gap: 12px;
      color: #17324d;
      font-size: 20px;
      font-weight: 700;
      text-decoration: none;
    }

    .brand-mark {
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      background: #245b8f;
      color: #fff;
      font-size: 17px;
    }

    .top-actions { gap: 16px; }

    .term-select, .icon-button, .edit-button {
      border: 1px solid #d9e1e8;
      border-radius: 8px;
      background: #fff;
    }

    .term-select {
      padding: 9px 12px;
      color: #17324d;
      font-size: 12px;
    }

    .icon-button {
      width: 38px;
      height: 38px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #5b6673;
      text-decoration: none;
    }

    .notification-button { position: relative; }

    .notification-dot {
      position: absolute;
      top: 7px;
      right: 7px;
      width: 7px;
      height: 7px;
      border: 1px solid #fff;
      border-radius: 50%;
      background: #e26a5c;
    }

    .profile {
      gap: 9px;
      text-decoration: none;
      cursor: pointer;
    }

    .avatar {
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background: #d5e7f2;
      color: #245b8f;
      font-size: 13px;
      font-weight: 700;
    }

    .profile-name {
      color: #17324d;
      font-size: 12px;
      font-weight: 600;
    }

    .profile-id {
      display: block;
      color: #5b6673;
      font-size: 10px;
      font-weight: 400;
    }

    /* LAYOUT */
    .layout {
      display: flex;
      min-height: calc(100vh - 72px);
    }

    .sidebar {
      width: 248px;
      flex: 0 0 248px;
      padding: 26px 16px;
      background: #fff;
      border-right: 1px solid #d9e1e8;
    }

    .side-label {
      margin: 10px 0 12px;
      padding: 0 12px;
      color: #83909c;
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .nav {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .nav a {
      min-height: 44px;
      padding: 0 12px;
      display: flex;
      align-items: center;
      gap: 12px;
      border-radius: 9px;
      color: #526170;
      text-decoration: none;
      font-size: 13px;
    }

    .nav-icon {
      width: 20px;
      color: #71808e;
      text-align: center;
      font-size: 16px;
    }

    .nav a.active {
      background: #e8f1f8;
      color: #245b8f;
      font-weight: 600;
    }

    .nav a.active .nav-icon { color: #245b8f; }

    .sidebar-note {
      margin: 30px 4px 0;
      padding: 15px;
      border: 1px solid #d8e9e8;
      border-radius: 12px;
      background: #f5fbfa;
    }

    .sidebar-note strong {
      color: #17324d;
      font-size: 12px;
    }

    .sidebar-note p {
      margin: 6px 0 0;
      color: #5b6673;
      font-size: 11px;
      line-height: 1.6;
    }

    main {
      width: 1192px;
      min-width: 0;
      flex: 1;
      margin: 0 auto;
      padding: 30px 36px 42px;
    }

    /* PAGE HEADING */
    .breadcrumb {
      margin-bottom: 13px;
      color: #7a8794;
      font-size: 12px;
    }

    .breadcrumb b {
      color: #245b8f;
      font-weight: 500;
    }

    .page-heading {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 16px;
      margin-bottom: 20px;
    }

    h1 {
      margin: 0;
      color: #17324d;
      font-size: 30px;
      line-height: 1.25;
    }

    .subtitle {
      margin: 7px 0 0;
      color: #5b6673;
      font-size: 14px;
    }

    .edit-button {
      height: 38px;
      padding: 0 14px;
      color: #245b8f;
      font-size: 12px;
      font-weight: 600;
    }

    /* PROFILE BANNER */
    .profile-banner {
      display: flex;
      align-items: center;
      gap: 18px;
      margin-bottom: 18px;
      padding: 20px 22px;
      border: 1px solid #d9e1e8;
      border-radius: 12px;
      background: #fff;
    }

    .large-avatar {
      width: 72px;
      height: 72px;
      flex: 0 0 72px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 4px solid #e8f1f8;
      border-radius: 50%;
      background: #d5e7f2;
      color: #245b8f;
      font-size: 23px;
      font-weight: 700;
    }

    .banner-info {
      min-width: 0;
      flex: 1;
    }

    .student-name {
      color: #17324d;
      font-size: 22px;
      font-weight: 700;
    }

    .student-meta {
      display: flex;
      align-items: center;
      gap: 9px;
      margin-top: 5px;
      color: #687583;
      font-size: 12px;
    }

    .meta-dot {
      width: 4px;
      height: 4px;
      border-radius: 50%;
      background: #aab5be;
    }

    .student-status {
      padding: 6px 10px;
      border-radius: 20px;
      background: #e9f7f0;
      color: #16805f;
      font-size: 10px;
      font-weight: 600;
      white-space: nowrap;
    }

    /* CONTENT COLUMNS */
    .content-columns {
      display: flex;
      align-items: flex-start;
      gap: 16px;
    }

    .left-column {
      min-width: 0;
      flex: 1;
    }

    .right-column {
      width: 370px;
      flex: 0 0 370px;
    }

    .info-card {
      margin-bottom: 16px;
      overflow: hidden;
      border: 1px solid #d9e1e8;
      border-radius: 12px;
      background: #fff;
    }

    .card-heading {
      padding: 15px 18px;
      border-bottom: 1px solid #edf1f4;
    }

    .card-title {
      color: #17324d;
      font-size: 14px;
      font-weight: 600;
    }

    .card-description {
      margin-top: 3px;
      color: #7b8794;
      font-size: 10px;
    }

    .info-grid {
      display: flex;
      flex-wrap: wrap;
      padding: 4px 18px 10px;
    }

    .info-item {
      width: 50%;
      min-height: 66px;
      padding: 12px 12px 10px 0;
      border-bottom: 1px solid #f0f3f5;
    }

    .info-item.full { width: 100%; }

    .info-label {
      color: #7b8794;
      font-size: 11px;
    }

    .info-value {
      margin-top: 4px;
      color: #273849;
      font-size: 13px;
      font-weight: 500;
    }

    .info-value.muted {
      color: #8b97a2;
      font-weight: 400;
    }

    /* CONTACT */
    .contact-heading {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding: 15px 18px;
      border-bottom: 1px solid #edf1f4;
    }

    .small-edit {
      border: 0;
      background: transparent;
      color: #245b8f;
      font-size: 10px;
      font-weight: 600;
    }

    .contact-list { padding: 4px 18px 10px; }

    .contact-row {
      min-height: 64px;
      display: flex;
      align-items: center;
      gap: 12px;
      border-bottom: 1px solid #f0f3f5;
    }

    .contact-row:last-child { border-bottom: 0; }

    .contact-icon {
      width: 34px;
      height: 34px;
      flex: 0 0 34px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 9px;
      background: #e8f1f8;
      color: #245b8f;
      font-size: 14px;
    }

    .contact-text { min-width: 0; }

    .contact-label {
      color: #7b8794;
      font-size: 10px;
    }

    .contact-value {
      margin-top: 2px;
      color: #273849;
      font-size: 12px;
      font-weight: 500;
      overflow-wrap: anywhere;
    }

    /* PROGRAM CARD */
    .program-card {
      padding: 17px 18px;
      border: 1px solid #d9e1e8;
      border-radius: 12px;
      background: #fff;
    }

    .program-head {
      display: flex;
      align-items: center;
      gap: 11px;
    }

    .program-icon {
      width: 38px;
      height: 38px;
      flex: 0 0 38px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      background: #e8f6f4;
      color: #168c8c;
      font-size: 16px;
    }

    .program-title {
      color: #17324d;
      font-size: 13px;
      font-weight: 600;
    }

    .program-subtitle {
      margin-top: 2px;
      color: #7b8794;
      font-size: 10px;
    }

    .program-separator {
      height: 1px;
      margin: 15px 0;
      background: #edf1f4;
    }

    .program-field { margin-top: 12px; }
    .program-field:first-of-type { margin-top: 0; }

    .program-label {
      color: #7b8794;
      font-size: 10px;
    }

    .program-value {
      margin-top: 3px;
      color: #273849;
      font-size: 12px;
      font-weight: 500;
    }

    .readonly-note {
      margin-top: 15px;
      padding: 11px 12px;
      border: 1px solid #e4edf3;
      border-radius: 9px;
      background: #f8fafc;
      color: #687583;
      font-size: 10px;
      line-height: 1.6;
    }

    .readonly-note strong { color: #17324d; }

    .data-note {
      margin: 2px;
      color: #8995a0;
      font-size: 10px;
      text-align: right;
    }
  </style>
</head>

<body>

  <!-- HEADER -->
  <header class="topbar">

    <a href="/sinhvien/dashboard" class="brand">
      <span class="brand-mark">E</span>
      EduManager
    </a>

    <div class="top-actions">

      <select class="term-select" aria-label="Học kỳ">
        <option>Học kỳ 1 · 2026–2027</option>
        <option>Học kỳ 2 · 2025–2026</option>
        <option>Học kỳ 1 · 2025–2026</option>
      </select>

      <button class="icon-button" aria-label="Trợ giúp">?</button>

      <a href="/sinhvien/thong-bao"
         class="icon-button notification-button"
         aria-label="Thông báo">
        ♧
        <span class="notification-dot"></span>
      </a>

      <!-- CLICK AVATAR OR USER INFO TO OPEN PROFILE -->
      <a href="/sinhvien/ho-so"
         class="profile"
         aria-label="Mở hồ sơ cá nhân">

        <div class="avatar">NA</div>

        <div class="profile-name">
          Nguyễn An
          <span class="profile-id">Sinh viên · 22A10001</span>
        </div>

      </a>

    </div>
  </header>

  <div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

      <div class="side-label">Không gian sinh viên</div>

      <nav class="nav" aria-label="Điều hướng chính">

        <a href="/sinhvien/dashboard">
          <span class="nav-icon">⌂</span>
          Dashboard
        </a>

        <a href="/sinhvien/dang-ky">
          <span class="nav-icon">▤</span>
          Đăng ký học phần
        </a>

        <a href="/sinhvien/thoi-khoa-bieu">
          <span class="nav-icon">▦</span>
          Thời khóa biểu
        </a>

        <a href="/sinhvien/ket-qua">
          <span class="nav-icon">◷</span>
          Kết quả học tập
        </a>

        <a href="/sinhvien/thong-bao">
          <span class="nav-icon">◉</span>
          Thông báo
        </a>

      </nav>

      <div class="sidebar-note">
        <strong>Hồ sơ sinh viên</strong>
        <p>
          Thông tin cá nhân và đào tạo được quản lý theo hồ sơ sinh viên của bạn.
        </p>
      </div>

    </aside>

    <!-- MAIN -->
    <main>

      <div class="breadcrumb">
        Sinh viên&nbsp; / &nbsp;<b>Hồ sơ cá nhân</b>
      </div>

      <!-- PAGE HEADING -->
      <section class="page-heading">

        <div>
          <h1>Hồ sơ cá nhân</h1>
          <p class="subtitle">
            Xem thông tin cá nhân, liên hệ và chương trình đào tạo.
          </p>
        </div>

        <button class="edit-button">
          ✎&nbsp; Chỉnh sửa thông tin liên hệ
        </button>

      </section>

      <!-- PROFILE BANNER -->
      <section class="profile-banner">

        <div class="large-avatar">NA</div>

        <div class="banner-info">

          <div class="student-name">Nguyễn An</div>

          <div class="student-meta">
            <span>Mã sinh viên: 22A10001</span>
            <span class="meta-dot"></span>
            <span>Lớp: 22A1</span>
            <span class="meta-dot"></span>
            <span>Ngành Công nghệ thông tin</span>
          </div>

        </div>

        <span class="student-status">Đang theo học</span>

      </section>

      <!-- CONTENT -->
      <section class="content-columns">

        <!-- LEFT COLUMN -->
        <div class="left-column">

          <!-- PERSONAL INFORMATION -->
          <div class="info-card">

            <div class="card-heading">
              <div class="card-title">Thông tin cá nhân</div>
              <div class="card-description">
                Thông tin định danh trong hồ sơ sinh viên
              </div>
            </div>

            <div class="info-grid">

              <div class="info-item">
                <div class="info-label">Họ và tên</div>
                <div class="info-value">Nguyễn An</div>
              </div>

              <div class="info-item">
                <div class="info-label">Mã sinh viên</div>
                <div class="info-value">22A10001</div>
              </div>

              <div class="info-item">
                <div class="info-label">Giới tính</div>
                <div class="info-value">Nam</div>
              </div>

              <div class="info-item">
                <div class="info-label">Ngày sinh</div>
                <div class="info-value">15/03/2004</div>
              </div>

              <div class="info-item full">
                <div class="info-label">Nơi sinh</div>
                <div class="info-value">Hà Nội</div>
              </div>

            </div>
          </div>

          <!-- CONTACT INFORMATION -->
          <div class="info-card">

            <div class="contact-heading">

              <div>
                <div class="card-title">Thông tin liên hệ</div>
                <div class="card-description">
                  Các thông tin bạn có thể đề nghị cập nhật
                </div>
              </div>

              <button class="small-edit">Chỉnh sửa</button>

            </div>

            <div class="contact-list">

              <div class="contact-row">

                <span class="contact-icon">✉</span>

                <div class="contact-text">
                  <div class="contact-label">Email sinh viên</div>
                  <div class="contact-value">
                    22a10001@student.huce.edu.vn
                  </div>
                </div>

              </div>

              <div class="contact-row">

                <span class="contact-icon">☎</span>

                <div class="contact-text">
                  <div class="contact-label">Số điện thoại</div>
                  <div class="contact-value">0912 000 001</div>
                </div>

              </div>

              <div class="contact-row">

                <span class="contact-icon">⌖</span>

                <div class="contact-text">
                  <div class="contact-label">Địa chỉ liên hệ</div>
                  <div class="contact-value">
                    Số 10 Láng Hạ, Đống Đa, Hà Nội
                  </div>
                </div>

              </div>

            </div>
          </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="right-column">

          <!-- EDUCATION INFORMATION -->
          <div class="info-card">

            <div class="card-heading">
              <div class="card-title">Thông tin đào tạo</div>
              <div class="card-description">
                Chương trình và lớp học hiện tại
              </div>
            </div>

            <div class="info-grid">

              <div class="info-item full">
                <div class="info-label">Ngành</div>
                <div class="info-value">Công nghệ thông tin</div>
              </div>

              <div class="info-item">
                <div class="info-label">Lớp</div>
                <div class="info-value">22A1</div>
              </div>

              <div class="info-item">
                <div class="info-label">Khóa học</div>
                <div class="info-value">K67 (2022–2026)</div>
              </div>

              <div class="info-item">
                <div class="info-label">Bậc đào tạo</div>
                <div class="info-value">Đại học</div>
              </div>

              <div class="info-item">
                <div class="info-label">Loại hình</div>
                <div class="info-value">Chính quy</div>
              </div>

            </div>
          </div>

          <!-- STUDY INFORMATION -->
          <div class="program-card">

            <div class="program-head">

              <span class="program-icon">▤</span>

              <div>
                <div class="program-title">Thông tin học tập</div>
                <div class="program-subtitle">
                  Hồ sơ đào tạo hiện hành
                </div>
              </div>

            </div>

            <div class="program-separator"></div>

            <div class="program-field">
              <div class="program-label">Cơ sở đào tạo</div>
              <div class="program-value">
                Trường Đại học Xây dựng Hà Nội (HUCE)
              </div>
            </div>

            <div class="program-field">
              <div class="program-label">Trạng thái hồ sơ</div>
              <div class="program-value">Đang theo học</div>
            </div>

            <div class="readonly-note">
              <strong>Lưu ý</strong><br />
              Thông tin định danh và đào tạo do nhà trường quản lý.
              Nếu cần điều chỉnh, vui lòng liên hệ Phòng Quản lý Đào tạo.
            </div>

          </div>

        </div>

      </section>

    </main>
  </div>

</body>
</html>
