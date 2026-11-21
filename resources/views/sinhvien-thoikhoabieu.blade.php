
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>EduManager — Thời khóa biểu</title>

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
      font-family: "Be Vietnam Pro", Arial, sans-serif;
      font-size: 14px;
      line-height: 1.55;
    }

    button, input, select {
      font: inherit;
    }

    button {
      cursor: pointer;
    }

    .app {
      min-height: 100vh;
    }

    /* HEADER */

    .topbar {
      height: 72px;
      background: #fff;
      border-bottom: 1px solid #d9e1e8;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 32px;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #17324d;
      font-weight: 700;
      font-size: 20px;
      letter-spacing: -.3px;
      text-decoration: none;
    }

    .brand-mark {
      width: 36px;
      height: 36px;
      border-radius: 11px;
      background: #245b8f;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 17px;
      font-weight: 700;
    }

    .top-actions {
      display: flex;
      align-items: center;
      gap: 18px;
    }

    .term-select {
      border: 1px solid #d9e1e8;
      border-radius: 8px;
      background: #fff;
      color: #17324d;
      padding: 9px 12px;
      font-size: 13px;
      font-weight: 500;
    }

    .icon-button {
      width: 38px;
      height: 38px;
      border: 1px solid #d9e1e8;
      border-radius: 10px;
      color: #5b6673;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 17px;
    }

    .notification-button {
      position: relative;
    }

    .notification-dot {
      position: absolute;
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: #e26a5c;
      top: 7px;
      right: 7px;
      border: 1px solid #fff;
    }

    .profile {
      display: flex;
      align-items: center;
      gap: 10px;
      padding-left: 4px;
      text-decoration: none;
      cursor: pointer;
    }

    .avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: #d5e7f2;
      color: #245b8f;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
    }

    .profile-name {
      font-size: 13px;
      font-weight: 600;
      color: #17324d;
    }

    .profile-id {
      display: block;
      color: #5b6673;
      font-size: 11px;
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
      background: #fff;
      border-right: 1px solid #d9e1e8;
      padding: 26px 16px;
    }

    .side-label {
      padding: 0 12px;
      color: #83909c;
      font-size: 11px;
      font-weight: 600;
      letter-spacing: .08em;
      text-transform: uppercase;
      margin: 10px 0 12px;
    }

    .nav {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .nav a {
      display: flex;
      align-items: center;
      gap: 12px;
      min-height: 44px;
      padding: 0 12px;
      color: #526170;
      text-decoration: none;
      border-radius: 9px;
      font-size: 13px;
      font-weight: 500;
    }

    .nav-icon {
      width: 20px;
      text-align: center;
      color: #71808e;
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
      background: #f5fbfa;
      border-radius: 12px;
    }

    .sidebar-note strong {
      color: #17324d;
      font-size: 12px;
    }

    .sidebar-note p {
      color: #5b6673;
      font-size: 11px;
      line-height: 1.6;
      margin: 6px 0 0;
    }

    main {
      min-width: 0;
      flex: 1;
      padding: 30px 36px 42px;
      width: 1192px;
      margin: 0 auto;
    }

    .breadcrumb {
      color: #7a8794;
      font-size: 12px;
      margin-bottom: 13px;
    }

    .breadcrumb b {
      color: #245b8f;
      font-weight: 500;
    }

    .page-heading {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 18px;
      margin-bottom: 20px;
    }

    h1 {
      color: #17324d;
      font-size: 30px;
      line-height: 1.25;
      letter-spacing: -.6px;
      margin: 0;
      font-weight: 700;
    }

    .subtitle {
      margin: 7px 0 0;
      color: #5b6673;
      font-size: 14px;
    }

    .outline-button {
      display: flex;
      align-items: center;
      gap: 8px;
      border: 1px solid #d9e1e8;
      color: #245b8f;
      background: #fff;
      border-radius: 8px;
      padding: 10px 14px;
      font-size: 13px;
      font-weight: 600;
      white-space: nowrap;
      text-decoration: none;
    }

    .term-badge {
      border-radius: 20px;
      padding: 7px 12px;
      background: #e8f1f8;
      color: #245b8f;
      font-size: 11px;
      font-weight: 600;
      white-space: nowrap;
    }

    /* WEEK TOOLBAR */

    .week-toolbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      background: #fff;
      border: 1px solid #d9e1e8;
      border-radius: 12px;
      padding: 13px 16px;
      margin-bottom: 14px;
    }

    .week-navigation {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .nav-button {
      width: 34px;
      height: 34px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #d9e1e8;
      border-radius: 8px;
      color: #526170;
      background: #fff;
      font-size: 16px;
    }

    .today-button {
      height: 34px;
      border: 1px solid #d9e1e8;
      border-radius: 8px;
      color: #245b8f;
      background: #fff;
      padding: 0 12px;
      font-size: 11px;
      font-weight: 600;
    }

    .week-range {
      color: #17324d;
      font-size: 13px;
      font-weight: 600;
      margin-left: 8px;
      white-space: nowrap;
    }

    .toolbar-filters {
      display: flex;
      align-items: center;
      gap: 9px;
    }

    .filter-select {
      height: 36px;
      min-width: 174px;
      border: 1px solid #d9e1e8;
      border-radius: 8px;
      color: #526170;
      background: #fff;
      padding: 0 10px;
      font-size: 11px;
    }

    /* CALENDAR */

    .calendar-card {
      overflow: hidden;
      background: #fff;
      border: 1px solid #d9e1e8;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(23, 50, 77, .05);
    }

    .calendar-heading {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding: 16px 18px 13px;
    }

    .calendar-title {
      color: #17324d;
      font-size: 15px;
      font-weight: 600;
    }

    .calendar-subtitle {
      color: #7b8794;
      font-size: 10px;
      margin-top: 2px;
    }

    .calendar-legend {
      display: flex;
      align-items: center;
      gap: 14px;
      color: #687583;
      font-size: 10px;
    }

    .legend-item {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .legend-swatch {
      width: 9px;
      height: 9px;
      border-radius: 3px;
      background: #245b8f;
    }

    .legend-swatch.today {
      background: #168c8c;
    }

    .calendar-scroll {
      overflow: hidden;
      border-top: 1px solid #edf1f4;
    }

    .week-header {
      display: flex;
      min-height: 58px;
      background: #f8fafc;
      border-bottom: 1px solid #e6edf2;
    }

    .time-heading {
      width: 78px;
      flex: 0 0 78px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #83909c;
      font-size: 9px;
      font-weight: 600;
      text-transform: uppercase;
      border-right: 1px solid #e6edf2;
    }

    .day-heading {
      min-width: 0;
      flex: 1 1 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border-right: 1px solid #e6edf2;
      color: #687583;
      font-size: 9px;
      font-weight: 600;
      text-transform: uppercase;
    }

    .day-heading:last-child {
      border-right: 0;
    }

    .day-number {
      width: 25px;
      height: 25px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      margin-top: 3px;
      color: #17324d;
      font-size: 11px;
      font-weight: 600;
    }

    .day-heading.today {
      color: #168c8c;
      background: #f4fbfa;
    }

    .day-heading.today .day-number {
      background: #168c8c;
      color: #fff;
    }

    .calendar-row {
      display: flex;
      min-height: 82px;
    }

    .time-label {
      width: 78px;
      flex: 0 0 78px;
      padding: 10px 9px 0 0;
      text-align: right;
      color: #83909c;
      font-size: 9px;
      border-right: 1px solid #e6edf2;
    }

    .day-cell {
      min-width: 0;
      flex: 1 1 0;
      padding: 5px;
      border-right: 1px solid #edf1f4;
      border-bottom: 1px solid #edf1f4;
      background: #fff;
    }

    .day-cell:last-child {
      border-right: 0;
    }

    .calendar-row:last-child .day-cell,
    .calendar-row:last-child .time-label {
      border-bottom: 0;
    }

    .day-cell.today {
      background: #fbfefd;
    }

    .class-block {
      height: 100%;
      min-height: 69px;
      border-left: 3px solid #245b8f;
      border-radius: 7px;
      background: #e8f1f8;
      padding: 7px 7px 6px;
      overflow: hidden;
    }

    .class-block.teal {
      border-left-color: #168c8c;
      background: #e8f6f4;
    }

    .class-block.gold {
      border-left-color: #c38738;
      background: #fff5e8;
    }

    .block-name {
      color: #17324d;
      font-size: 10px;
      font-weight: 600;
      line-height: 1.35;
    }

    .block-code {
      color: #526170;
      font-size: 8px;
      margin-top: 3px;
    }

    .block-detail {
      color: #5b6673;
      font-size: 8px;
      line-height: 1.35;
      margin-top: 4px;
    }

    .empty-slot {
      color: #c0c9d0;
      font-size: 9px;
      text-align: center;
      padding-top: 25px;
    }

    /* BOTTOM CARDS */

    .bottom-grid {
      display: flex;
      align-items: stretch;
      gap: 14px;
      margin-top: 16px;
    }

    .bottom-card {
      min-width: 0;
      flex: 1 1 0;
      background: #fff;
      border: 1px solid #d9e1e8;
      border-radius: 12px;
      padding: 15px 17px;
    }

    .bottom-title {
      color: #17324d;
      font-size: 13px;
      font-weight: 600;
    }

    .bottom-subtitle {
      color: #7b8794;
      font-size: 10px;
      margin-top: 2px;
    }

    .lesson-summary {
      display: flex;
      align-items: center;
      gap: 12px;
      padding-top: 13px;
    }

    .summary-icon {
      width: 34px;
      height: 34px;
      flex: 0 0 34px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 9px;
      color: #168c8c;
      background: #e8f6f4;
      font-size: 16px;
    }

    .summary-value {
      color: #17324d;
      font-size: 17px;
      line-height: 1.2;
      font-weight: 700;
    }

    .summary-label {
      color: #687583;
      font-size: 9px;
      margin-top: 2px;
    }

    .next-class {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      padding-top: 12px;
    }

    .next-time {
      flex: 0 0 auto;
      color: #168c8c;
      font-size: 10px;
      font-weight: 600;
    }

    .next-name {
      color: #17324d;
      font-size: 10px;
      font-weight: 600;
    }

    .next-detail {
      color: #7b8794;
      font-size: 9px;
      margin-top: 2px;
    }

    .data-note {
      color: #8995a0;
      font-size: 10px;
      text-align: right;
      margin: 11px 2px 0;
    }
  </style>
</head>

<body>
  <div class="app">

    <!-- HEADER -->
    <header class="topbar">
      <a href="/sinhvien/dashboard" class="brand">
        <span class="brand-mark">E</span>
        EduManager
      </a>

      <div class="top-actions">

        <select class="term-select" aria-label="Học kỳ">
          <option>Học kỳ 1 · 2026–2027</option>
        </select>

        <button class="icon-button" aria-label="Trợ giúp">?</button>

        <a href="/sinhvien/thong-bao"
           class="icon-button notification-button"
           aria-label="Thông báo"
           style="text-decoration:none; cursor:pointer;">
          ♧
          <span class="notification-dot"></span>
        </a>

        <!-- Nhấn avatar hoặc thông tin để mở hồ sơ -->
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

          <a class="active" href="/sinhvien/thoi-khoa-bieu">
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
          <strong>Hỗ trợ sinh viên</strong>
          <p>
            Xem lịch học cá nhân theo tuần và kiểm tra phòng học trước mỗi buổi.
          </p>
        </div>

      </aside>

      <!-- MAIN CONTENT -->
      <main>

        <div class="breadcrumb">
          Sinh viên&nbsp; / &nbsp;<b>Thời khóa biểu</b>
        </div>

        <section class="page-heading">

          <div>
            <h1>Thời khóa biểu</h1>
            <p class="subtitle">
              Theo dõi lịch học cá nhân theo tuần trong học kỳ hiện tại.
            </p>
          </div>

          <span class="term-badge">
            Học kỳ 1 · 2026–2027
          </span>

        </section>

        <!-- WEEK TOOLBAR -->
        <section class="week-toolbar">

          <div class="week-navigation">

            <button class="nav-button" aria-label="Tuần trước">
              ‹
            </button>

            <button class="today-button">
              Hôm nay
            </button>

            <button class="nav-button" aria-label="Tuần sau">
              ›
            </button>

            <span class="week-range">
              16 – 22 tháng 11, 2026
            </span>

          </div>

          <div class="toolbar-filters">

            <select class="filter-select" aria-label="Lọc học phần">
              <option>Tất cả học phần</option>
              <option>WEB302.01 · Lập trình Web</option>
              <option>DBI202.02 · Cơ sở dữ liệu</option>
              <option>UXD201.01 · Thiết kế giao diện</option>
              <option>ENG301.03 · Tiếng Anh chuyên ngành</option>
            </select>

            <button class="outline-button">
              ↓&nbsp; Xuất lịch
            </button>

          </div>

        </section>

        <!-- ĐÃ BỎ WEEK SUMMARY THEO YÊU CẦU -->

        <!-- WEEKLY CALENDAR -->
        <section class="calendar-card">

          <div class="calendar-heading">

            <div>
              <div class="calendar-title">
                Lịch học trong tuần
              </div>

              <div class="calendar-subtitle">
                Thứ Hai, 16/11 – Chủ Nhật, 22/11/2026
              </div>
            </div>

            <div class="calendar-legend">

              <span class="legend-item">
                <i class="legend-swatch"></i>
                Lịch học
              </span>

              <span class="legend-item">
                <i class="legend-swatch today"></i>
                Hôm nay
              </span>

            </div>

          </div>

          <div class="calendar-scroll">

            <!-- DAY HEADER -->
            <div class="week-header">

              <div class="time-heading">
                Giờ học
              </div>

              <div class="day-heading">
                <span>Thứ Hai</span>
                <span class="day-number">16</span>
              </div>

              <div class="day-heading">
                <span>Thứ Ba</span>
                <span class="day-number">17</span>
              </div>

              <div class="day-heading">
                <span>Thứ Tư</span>
                <span class="day-number">18</span>
              </div>

              <div class="day-heading">
                <span>Thứ Năm</span>
                <span class="day-number">19</span>
              </div>

              <div class="day-heading today">
                <span>Thứ Sáu</span>
                <span class="day-number">20</span>
              </div>

              <div class="day-heading">
                <span>Thứ Bảy</span>
                <span class="day-number">21</span>
              </div>

              <div class="day-heading">
                <span>Chủ Nhật</span>
                <span class="day-number">22</span>
              </div>

            </div>

            <!-- 07:00 - 09:30 -->
            <div class="calendar-row">

              <div class="time-label">
                07:00<br />09:30
              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell">

                <div class="class-block">

                  <div class="block-name">
                    Lập trình Web
                  </div>

                  <div class="block-code">
                    WEB302.01
                  </div>

                  <div class="block-detail">
                    Nguyễn Minh Anh<br />
                    Phòng A203
                  </div>

                </div>

              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell today">

                <div class="class-block teal">

                  <div class="block-name">
                    Tiếng Anh chuyên ngành
                  </div>

                  <div class="block-code">
                    ENG301.03
                  </div>

                  <div class="block-detail">
                    Phạm Ngọc Linh<br />
                    Phòng A104
                  </div>

                </div>

              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

            </div>

            <!-- 09:45 - 12:15 -->
            <div class="calendar-row">

              <div class="time-label">
                09:45<br />12:15
              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell">

                <div class="class-block teal">

                  <div class="block-name">
                    Cơ sở dữ liệu
                  </div>

                  <div class="block-code">
                    DBI202.02
                  </div>

                  <div class="block-detail">
                    Trần Thu Hà<br />
                    Phòng B105
                  </div>

                </div>

              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell today">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

            </div>

            <!-- 13:00 - 15:30 -->
            <div class="calendar-row">

              <div class="time-label">
                13:00<br />15:30
              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell">

                <div class="class-block gold">

                  <div class="block-name">
                    Thiết kế giao diện
                  </div>

                  <div class="block-code">
                    UXD201.01
                  </div>

                  <div class="block-detail">
                    Lê Hoàng Nam<br />
                    Phòng C302
                  </div>

                </div>

              </div>

              <div class="day-cell today">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

              <div class="day-cell">
                <div class="empty-slot">—</div>
              </div>

            </div>

          </div>
        </section>

        <!-- BOTTOM INFORMATION -->
        <section class="bottom-grid">

          <!-- WEEK OVERVIEW -->
          <div class="bottom-card">

            <div class="bottom-title">
              Tổng quan tuần
            </div>

            <div class="bottom-subtitle">
              Khối lượng học tập đã đăng ký
            </div>

            <div class="lesson-summary">

              <span class="summary-icon">
                ▦
              </span>

              <div>
                <div class="summary-value">
                  4 buổi học
                </div>

                <div class="summary-label">
                  11 tín chỉ · 4 học phần
                </div>
              </div>

            </div>

          </div>

          <!-- NEXT CLASS -->
          <div class="bottom-card">

            <div class="bottom-title">
              Buổi học tiếp theo
            </div>

            <div class="bottom-subtitle">
              Thứ Sáu, ngày 20/11/2026
            </div>

            <div class="next-class">

              <span class="next-time">
                07:00
              </span>

              <div>

                <div class="next-name">
                  Tiếng Anh chuyên ngành · ENG301.03
                </div>

                <div class="next-detail">
                  Phạm Ngọc Linh · Phòng A104 · 2 tín chỉ
                </div>

              </div>

            </div>

          </div>

          <!-- FREE DAYS -->
          <div class="bottom-card">

            <div class="bottom-title">
              Ngày không có lịch
            </div>

            <div class="bottom-subtitle">
              Bạn có thể dùng thời gian trống để ôn tập
            </div>

            <div class="lesson-summary">

              <span class="summary-icon">
                ✓
              </span>

              <div>

                <div class="summary-value">
                  3 ngày
                </div>

                <div class="summary-label">
                  Thứ Hai · Thứ Bảy · Chủ Nhật
                </div>

              </div>

            </div>

          </div>

        </section>

      </main>
    </div>
  </div>
</body>
</html>
