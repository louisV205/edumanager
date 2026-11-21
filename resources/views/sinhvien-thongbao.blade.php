
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>EduManager — Thông báo</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      min-width: 1440px;
      background: #f4f7fa;
      color: #1f2937;
      font: 14px/1.5 "Be Vietnam Pro", Arial, sans-serif;
    }

    button, input, select {
      font: inherit;
    }

    button {
      cursor: pointer;
    }

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

    .top-actions {
      gap: 16px;
    }

    .term-select,
    .icon-button,
    .primary-button,
    .light-button {
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

    .notification-button {
      position: relative;
    }

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

    .nav a.active .nav-icon {
      color: #245b8f;
    }

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

    .heading-actions {
      display: flex;
      align-items: center;
      gap: 9px;
    }

    .unread-counter {
      padding: 7px 11px;
      border-radius: 20px;
      background: #e8f1f8;
      color: #245b8f;
      font-size: 11px;
      font-weight: 600;
      white-space: nowrap;
    }

    .light-button,
    .primary-button {
      height: 36px;
      padding: 0 12px;
      font-size: 11px;
      font-weight: 600;
      white-space: nowrap;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .light-button {
      color: #245b8f;
    }

    .primary-button {
      border-color: #245b8f;
      background: #245b8f;
      color: #fff;
    }

    /* NOTIFICATION LAYOUT */

    .notice-layout {
      display: flex;
      align-items: flex-start;
      gap: 16px;
    }

    .list-panel {
      min-width: 0;
      flex: 1;
      overflow: hidden;
      border: 1px solid #d9e1e8;
      border-radius: 12px;
      background: #fff;
    }

    .list-toolbar {
      padding: 14px 16px;
      border-bottom: 1px solid #e8edf1;
    }

    .tabs {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .tab {
      padding: 7px 12px;
      border-radius: 7px;
      color: #687583;
      font-size: 11px;
      font-weight: 500;
      cursor: pointer;
    }

    .tab.active {
      background: #e8f1f8;
      color: #245b8f;
      font-weight: 600;
    }

    .search {
      height: 36px;
      margin-top: 12px;
      padding: 0 10px;
      display: flex;
      align-items: center;
      gap: 8px;
      border: 1px solid #d9e1e8;
      border-radius: 8px;
      color: #83909c;
    }

    .search input {
      width: 100%;
      border: 0;
      outline: 0;
      color: #526170;
      background: transparent;
      font-size: 11px;
    }

    .search input::placeholder {
      color: #9aa5af;
    }

    .list-caption {
      padding: 11px 16px 7px;
      color: #8995a0;
      font-size: 10px;
      font-weight: 600;
      text-transform: uppercase;
    }

    /* NOTIFICATION ITEMS */

    .notice-item {
      position: relative;
      padding: 15px 16px 15px 19px;
      border-top: 1px solid #edf1f4;
      cursor: pointer;
    }

    .notice-item.unread {
      background: #f8fbfe;
    }

    .notice-item.unread:before {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      width: 3px;
      background: #245b8f;
      content: "";
    }

    .item-top,
    .item-meta {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
    }

    .item-title {
      color: #17324d;
      font-size: 16px;
      line-height: 1.4;
      font-weight: 600;
    }

    .unread-label {
      padding: 4px 8px;
      border-radius: 20px;
      background: #e8f1f8;
      color: #245b8f;
      font-size: 9px;
      font-weight: 600;
      white-space: nowrap;
    }

    .item-meta {
      justify-content: flex-start;
      margin-top: 6px;
      color: #7b8794;
      font-size: 12px;
    }

    .meta-separator {
      color: #c2cbd2;
    }

    .item-preview {
      margin: 8px 0 0;
      color: #5b6673;
      font-size: 14px;
      line-height: 1.55;
    }

    /* DETAIL PANEL */

    .detail-panel {
      width: 370px;
      flex: 0 0 370px;
      padding: 20px;
      border: 1px solid #d9e1e8;
      border-radius: 12px;
      background: #fff;
    }

    .detail-label {
      display: inline-flex;
      padding: 5px 9px;
      border-radius: 20px;
      background: #e8f1f8;
      color: #245b8f;
      font-size: 10px;
      font-weight: 600;
    }

    .detail-title {
      margin: 13px 0 0;
      color: #17324d;
      font-size: 20px;
      line-height: 1.4;
      font-weight: 700;
    }

    .sender-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 15px;
      padding-bottom: 15px;
      border-bottom: 1px solid #edf1f4;
    }

    .sender-avatar {
      width: 34px;
      height: 34px;
      flex: 0 0 34px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background: #e8f1f8;
      color: #245b8f;
      font-size: 12px;
      font-weight: 700;
    }

    .sender-name {
      color: #17324d;
      font-size: 12px;
      font-weight: 600;
    }

    .sender-scope {
      color: #7b8794;
      font-size: 10px;
    }

    .detail-time {
      margin-top: 13px;
      color: #7b8794;
      font-size: 12px;
    }

    .detail-content {
      margin-top: 14px;
      color: #526170;
      font-size: 14px;
      line-height: 1.75;
    }

    .detail-content p {
      margin: 0 0 12px;
    }

    .detail-callout {
      margin-top: 15px;
      padding: 12px;
      border: 1px solid #e4edf3;
      border-radius: 9px;
      background: #f8fafc;
    }

    .callout-title {
      color: #17324d;
      font-size: 11px;
      font-weight: 600;
    }

    .callout-text {
      margin-top: 4px;
      color: #687583;
      font-size: 11px;
    }

    .detail-actions {
      display: flex;
      gap: 8px;
      margin-top: 17px;
    }

    .detail-actions button,
    .detail-actions a {
      flex: 1;
      text-align: center;
    }

    .data-note {
      margin: 12px 2px 0;
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

      <button class="icon-button" aria-label="Trợ giúp">
        ?
      </button>

      <a href="/sinhvien/thong-bao"
         class="icon-button notification-button"
         aria-label="Thông báo">
        ♧
        <span class="notification-dot"></span>
      </a>

      <!-- CLICK AVATAR / USER INFO TO OPEN PROFILE -->
      <a href="/sinhvien/ho-so"
         class="profile"
         aria-label="Mở hồ sơ cá nhân">

        <div class="avatar">NA</div>

        <div class="profile-name">
          Nguyễn An
          <span class="profile-id">
            Sinh viên · 22A10001
          </span>
        </div>

      </a>

    </div>
  </header>

  <div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

      <div class="side-label">
        Không gian sinh viên
      </div>

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

        <!-- ĐÃ BỎ MỤC HỒ SƠ CÁ NHÂN -->

        <a class="active" href="/sinhvien/thong-bao">
          <span class="nav-icon">◉</span>
          Thông báo
        </a>

      </nav>

      <div class="sidebar-note">
        <strong>Trung tâm thông báo</strong>
        <p>
          Theo dõi tin học vụ và cập nhật mới dành cho sinh viên.
        </p>
      </div>

    </aside>

    <!-- MAIN -->
    <main>

      <div class="breadcrumb">
        Sinh viên&nbsp; / &nbsp;<b>Thông báo</b>
      </div>

      <!-- PAGE HEADING -->
      <section class="page-heading">

        <div>
          <h1>Thông báo</h1>

          <p class="subtitle">
            Cập nhật tin học vụ, lịch học và thông tin dành cho bạn.
          </p>
        </div>

        <div class="heading-actions">

          <span class="unread-counter">
            2 thông báo chưa đọc
          </span>

          <button class="light-button">
            Đánh dấu tất cả đã đọc
          </button>

        </div>

      </section>

      <!-- NOTIFICATION CONTENT -->
      <section class="notice-layout">

        <!-- LEFT: NOTIFICATION LIST -->
        <div class="list-panel">

          <div class="list-toolbar">

            <div class="tabs">

              <span class="tab active">
                Tất cả <b>4</b>
              </span>

              <span class="tab">
                Chưa đọc <b>2</b>
              </span>

              <span class="tab">
                Đã đọc
              </span>

            </div>

            <label class="search">
              <span>⌕</span>
              <input
                type="search"
                placeholder="Tìm thông báo"
              />
            </label>

          </div>

          <div class="list-caption">
            Gần đây
          </div>

          <!-- NOTICE 1 -->
          <article class="notice-item unread">

            <div class="item-top">

              <div class="item-title">
                Lịch học tuần này đã được cập nhật
              </div>

              <span class="unread-label">
                Chưa đọc
              </span>

            </div>

            <div class="item-meta">
              <span>Phòng Đào tạo</span>
              <span class="meta-separator">•</span>
              <time>20/11/2026 · 08:30</time>
            </div>

            <p class="item-preview">
              Thời khóa biểu tuần 16–22/11 đã có cập nhật.
              Vui lòng kiểm tra thời gian và phòng học trước khi đến lớp.
            </p>

          </article>

          <!-- NOTICE 2 -->
          <article class="notice-item unread">

            <div class="item-top">

              <div class="item-title">
                Nhắc nhở kiểm tra đăng ký học phần
              </div>

              <span class="unread-label">
                Chưa đọc
              </span>

            </div>

            <div class="item-meta">
              <span>Phòng Đào tạo</span>
              <span class="meta-separator">•</span>
              <time>19/11/2026 · 14:15</time>
            </div>

            <p class="item-preview">
              Bạn hãy rà soát danh sách lớp đã đăng ký và thời khóa biểu
              để kịp thời phát hiện lịch học bị trùng.
            </p>

          </article>

          <!-- NOTICE 3 -->
          <article class="notice-item">

            <div class="item-top">

              <div class="item-title">
                Kết quả học tập đã được cập nhật
              </div>

            </div>

            <div class="item-meta">
              <span>Phòng Đào tạo</span>
              <span class="meta-separator">•</span>
              <time>18/11/2026 · 09:00</time>
            </div>

            <p class="item-preview">
              Một số điểm học phần đã được công bố.
              Truy cập mục Kết quả học tập để xem chi tiết theo học kỳ.
            </p>

          </article>

          <!-- NOTICE 4 -->
          <article class="notice-item">

            <div class="item-top">

              <div class="item-title">
                Xác nhận đăng ký học phần thành công
              </div>

            </div>

            <div class="item-meta">
              <span>EduManager</span>
              <span class="meta-separator">•</span>
              <time>16/11/2026 · 10:42</time>
            </div>

            <p class="item-preview">
              Danh sách học phần đăng ký của bạn đã được ghi nhận.
              Bạn có thể xem các lớp trong thời khóa biểu.
            </p>

          </article>

        </div>

        <!-- RIGHT: NOTIFICATION DETAIL -->
        <aside class="detail-panel">

          <span class="detail-label">
            Lịch học
          </span>

          <h2 class="detail-title">
            Lịch học tuần này đã được cập nhật
          </h2>

          <div class="sender-row">

            <span class="sender-avatar">
              ĐT
            </span>

            <div>

              <div class="sender-name">
                Phòng Đào tạo
              </div>

              <div class="sender-scope">
                Gửi đến sinh viên
              </div>

            </div>

          </div>

          <div class="detail-time">
            20/11/2026 lúc 08:30
          </div>

          <div class="detail-content">

            <p>
              Thời khóa biểu tuần từ ngày 16/11 đến 22/11
              đã được cập nhật trên hệ thống EduManager.
            </p>

            <p>
              Vui lòng kiểm tra lại lịch học, giảng viên và phòng học
              trước mỗi buổi. Nếu có thay đổi, thông tin mới nhất
              sẽ được hiển thị trong mục Thời khóa biểu.
            </p>

          </div>

          <div class="detail-callout">

            <div class="callout-title">
              Tuần đang xem
            </div>

            <div class="callout-text">
              16 – 22 tháng 11, 2026
            </div>

          </div>

          <div class="detail-actions">

            <button class="primary-button">
              Đánh dấu đã đọc
            </button>

            <a href="/sinhvien/thoi-khoa-bieu"
               class="light-button">
              Mở thời khóa biểu
            </a>

          </div>

        </aside>

      </section>

    </main>

  </div>

</body>
</html>
