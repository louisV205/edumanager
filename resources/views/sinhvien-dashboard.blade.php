
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>EduManager — Dashboard sinh viên</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    * { box-sizing: border-box; }
    body { margin: 0; min-width: 1440px; background: #f4f7fa; color: #1f2937; font-family: "Be Vietnam Pro", Arial, sans-serif; font-size: 14px; line-height: 1.55; }
    button, input, select { font: inherit; }
    button { cursor: pointer; }
    .app { min-height: 100vh; }
    .topbar { height: 72px; background: #ffffff; border-bottom: 1px solid #d9e1e8; display: flex; align-items: center; justify-content: space-between; padding: 0 32px; }
    .brand { display:flex; align-items:center; gap:12px; color:#17324d; font-weight:700; font-size:20px; letter-spacing:-.3px; }
    .brand-mark { width:36px; height:36px; border-radius:11px; background:#245b8f; display:flex; align-items:center; justify-content:center; color:#fff; font-size:17px; font-weight:700; }
    .top-actions { display:flex; align-items:center; gap:18px; }
    .term-select { border:1px solid #d9e1e8; border-radius:8px; background:#fff; color:#17324d; padding:9px 12px; font-size:13px; font-weight:500; }
    .icon-button { width:38px; height:38px; border:1px solid #d9e1e8; border-radius:10px; color:#5b6673; background:#fff; display:flex; align-items:center; justify-content:center; font-size:17px; }
    .notification-button { position:relative; }
    .notification-dot { position:absolute; width:7px; height:7px; border-radius:50%; background:#e26a5c; top:7px; right:7px; border:1px solid #fff; }
    .profile { display:flex; align-items:center; gap:10px; padding-left:4px; }
    .avatar { width:36px; height:36px; border-radius:50%; background:#d5e7f2; color:#245b8f; font-weight:700; display:flex; align-items:center; justify-content:center; font-size:13px; }
    .profile-name { font-size:13px; font-weight:600; color:#17324d; }
    .profile-id { display:block; color:#5b6673; font-size:11px; font-weight:400; }
    .layout { display:flex; min-height:calc(100vh - 72px); }
    .sidebar { width:248px; flex:0 0 248px; background:#ffffff; border-right:1px solid #d9e1e8; padding:26px 16px; }
    .side-label { padding:0 12px; color:#83909c; font-size:11px; font-weight:600; letter-spacing:.08em; text-transform:uppercase; margin:10px 0 12px; }
    .nav { display:flex; flex-direction:column; gap:5px; }
    .nav a { display:flex; align-items:center; gap:12px; min-height:44px; padding:0 12px; color:#526170; text-decoration:none; border-radius:9px; font-size:13px; font-weight:500; }
    .nav a .nav-icon { width:20px; text-align:center; color:#71808e; font-size:16px; }
    .nav a.active { background:#e8f1f8; color:#245b8f; font-weight:600; }
    .nav a.active .nav-icon { color:#245b8f; }
    .sidebar-note { margin:30px 4px 0; padding:15px; border:1px solid #d8e9e8; background:#f5fbfa; border-radius:12px; }
    .sidebar-note strong { color:#17324d; font-size:12px; }
    .sidebar-note p { color:#5b6673; font-size:11px; line-height:1.6; margin:6px 0 0; }
    main { min-width:0; flex:1; padding:30px 36px 48px; width:1192px; margin:0 auto; }
    .breadcrumb { color:#7a8794; font-size:12px; margin-bottom:13px; }
    .breadcrumb b { color:#245b8f; font-weight:500; }
    .page-heading { display:flex; align-items:flex-start; justify-content:space-between; gap:18px; margin-bottom:20px; }
    h1 { color:#17324d; font-size:30px; line-height:1.25; letter-spacing:-.6px; margin:0; font-weight:700; }
    .subtitle { margin:7px 0 0; color:#5b6673; font-size:14px; }
    .outline-button { display:flex; align-items:center; gap:8px; border:1px solid #d9e1e8; color:#245b8f; background:#fff; border-radius:8px; padding:10px 14px; font-size:13px; font-weight:600; white-space:nowrap; }
    .welcome-banner { display:flex; align-items:center; justify-content:space-between; gap:20px; border:1px solid #d4e5f0; background:#e8f1f8; border-radius:12px; padding:17px 20px; margin-bottom:18px; }
    .welcome-copy { display:flex; align-items:center; gap:14px; }
    .welcome-icon { width:42px; height:42px; flex:0 0 42px; display:flex; align-items:center; justify-content:center; border-radius:12px; color:#245b8f; background:#ffffff; font-size:20px; }
    .welcome-title { color:#17324d; font-size:15px; font-weight:600; }
    .welcome-description { color:#5b6673; font-size:12px; margin-top:2px; }
    .term-badge { border-radius:20px; padding:7px 12px; background:#ffffff; color:#245b8f; font-size:11px; font-weight:600; white-space:nowrap; }
    .kpi-row { display:flex; gap:14px; margin-bottom:18px; }
    .kpi-card { min-width:0; flex:1 1 0; background:#ffffff; border:1px solid #d9e1e8; border-radius:12px; padding:16px 17px; box-shadow:0 5px 18px rgba(23, 50, 77, .04); }
    .kpi-top { display:flex; align-items:center; justify-content:space-between; gap:10px; }
    .kpi-label { color:#687583; font-size:12px; font-weight:500; }
    .kpi-icon { width:32px; height:32px; border-radius:9px; display:flex; align-items:center; justify-content:center; font-size:15px; }
    .kpi-icon.blue { color:#245b8f; background:#e8f1f8; }
    .kpi-icon.teal { color:#168c8c; background:#e8f6f4; }
    .kpi-icon.gold { color:#a86b20; background:#fff5e8; }
    .kpi-icon.red { color:#b54747; background:#fff0ef; }
    .kpi-value { color:#17324d; font-size:25px; font-weight:700; line-height:1.2; margin-top:9px; }
    .kpi-unit { color:#6c7885; font-size:11px; font-weight:500; }
    .kpi-foot { color:#7b8794; font-size:10px; margin-top:5px; }
    .positive { color:#168c8c; font-weight:600; }
    .dashboard-grid { display:flex; align-items:flex-start; gap:18px; }
    .main-column, .side-column { min-width:0; display:flex; flex-direction:column; gap:18px; }
    .main-column { flex:1 1 auto; width:0; }
    .side-column { width:330px; flex:0 0 330px; }
    .card { background:#ffffff; border:1px solid #d9e1e8; border-radius:12px; box-shadow:0 8px 24px rgba(23, 50, 77, .05); }
    .card-head { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:17px 19px 13px; }
    .card-title { margin:0; color:#17324d; font-size:16px; line-height:1.4; font-weight:600; }
    .card-subtitle { color:#5b6673; font-size:11px; margin-top:3px; }
    .text-link { color:#245b8f; text-decoration:none; font-size:11px; font-weight:600; white-space:nowrap; }
    .schedule-list { padding:0 19px 14px; }
    .schedule-row { display:flex; align-items:center; gap:13px; border-top:1px solid #edf1f4; padding:12px 0; }
    .time-box { width:56px; flex:0 0 56px; text-align:center; border-radius:8px; background:#f4f7fa; padding:7px 4px; }
    .time-day { display:block; color:#6c7885; font-size:9px; font-weight:600; text-transform:uppercase; }
    .time-date { display:block; color:#17324d; font-size:16px; line-height:1.2; font-weight:700; margin-top:2px; }
    .class-detail { min-width:0; flex:1; }
    .class-name { color:#17324d; font-size:12px; font-weight:600; }
    .class-meta { color:#687583; font-size:10px; margin-top:3px; }
    .class-room { color:#687583; font-size:10px; white-space:nowrap; text-align:right; }
    .class-room strong { display:block; color:#435261; font-size:10px; font-weight:600; }
    .status-pill { display:inline-block; border-radius:20px; padding:4px 8px; background:#e8f6f4; color:#16736f; font-size:9px; font-weight:600; margin-top:5px; }

    /* Quick access */
    .quick-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 10px;
      padding: 0 18px 18px;
    }
    .quick-card {
      width: auto;
      min-width: 0;
      min-height: 88px;
      display: flex;
      align-items: center;
      gap: 10px;
      border: 1px solid #e4eaf0;
      border-radius: 10px;
      padding: 12px;
      background: #ffffff;
      text-decoration: none;
    }
    .quick-card:hover {
      border-color: #b8cede;
      background: #f8fbfd;
    }
    .quick-icon {
      width: 36px;
      height: 36px;
      flex: 0 0 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 9px;
      background: #e8f1f8;
      color: #245b8f;
      font-size: 16px;
    }
    .quick-name {
      display: block;
      flex: 1;
      min-width: 0;
      color: #17324d;
      font-size: 12px;
      font-weight: 600;
      line-height: 1.4;
      overflow-wrap: break-word;
    }

    .announcement-list { padding:0 19px 7px; }
    .announcement { display:flex; align-items:flex-start; gap:10px; border-top:1px solid #edf1f4; padding:11px 0; }
    .announcement-mark { width:8px; height:8px; flex:0 0 8px; border-radius:50%; background:#168c8c; margin-top:5px; }
    .announcement-mark.blue { background:#245b8f; }
    .announcement-mark.gold { background:#e39a42; }
    .announcement-content { min-width:0; flex:1; }
    .announcement-title { color:#17324d; font-size:11px; font-weight:600; line-height:1.45; }
    .announcement-meta { color:#83909c; font-size:9px; margin-top:3px; }
    .registration-card { padding:16px 17px; border-color:#cfe3e1; background:#f8fcfb; }
    .registration-label { display:flex; align-items:center; gap:8px; color:#17324d; font-size:13px; font-weight:600; }
    .registration-icon { width:28px; height:28px; display:flex; align-items:center; justify-content:center; background:#e8f6f4; color:#168c8c; border-radius:8px; }
    .registration-card p { color:#5b6673; font-size:10px; line-height:1.55; margin:10px 0 13px; }
    .primary-button { width:100%; border:0; border-radius:8px; background:#168c8c; color:#fff; padding:10px 12px; font-size:11px; font-weight:600; }
    .primary-button:hover { background:#117575; }
    .progress-heading { display:flex; align-items:center; justify-content:space-between; gap:10px; color:#5b6673; font-size:10px; margin-top:12px; }
    .progress-heading strong { color:#17324d; font-size:10px; }
    .progress { height:6px; border-radius:6px; background:#e6ecef; margin-top:7px; overflow:hidden; }
    .progress i { display:block; height:100%; width:60%; border-radius:6px; background:#168c8c; }
    .data-note { color:#8995a0; font-size:10px; text-align:right; margin:12px 2px 0; }
  </style>
</head>

<body>
  <div class="app">
    <header class="topbar">
      <div class="brand"><span class="brand-mark">E</span> EduManager</div>
      <div class="top-actions">
        <select class="term-select" aria-label="Học kỳ"><option>Học kỳ 1 · 2026–2027</option></select>
        <button class="icon-button" aria-label="Trợ giúp">?</button>
        <a href="/sinhvien/thong-bao" class="icon-button notification-button" aria-label="Thông báo" style="text-decoration:none; cursor:pointer;">♧<span class="notification-dot"></span></a>
        <a href="/sinhvien/ho-so" class="profile" style="text-decoration:none; cursor:pointer;"><div class="avatar">NA</div><div class="profile-name">Nguyễn An<span class="profile-id">Sinh viên · 22A10001</span></div></a>
      </div>
    </header>

    <div class="layout">
      <aside class="sidebar">
        <div class="side-label">Không gian sinh viên</div>
        <nav class="nav" aria-label="Điều hướng chính">
          <a class="active" href="/sinhvien/dashboard"><span class="nav-icon">⌂</span>Dashboard</a>
          <a href="/sinhvien/dang-ky"><span class="nav-icon">▤</span>Đăng ký học phần</a>
          <a href="/sinhvien/thoi-khoa-bieu"><span class="nav-icon">▦</span>Thời khóa biểu</a>
          <a href="/sinhvien/ket-qua"><span class="nav-icon">◷</span>Kết quả học tập</a>
          <a href="/sinhvien/thong-bao"><span class="nav-icon">◉</span>Thông báo</a>
        </nav>
        <div class="sidebar-note">
          <strong>Hỗ trợ sinh viên</strong>
          <p>Xem lịch học, kết quả và các thông báo mới nhất tại một nơi.</p>
        </div>
      </aside>

      <main>
        <div class="breadcrumb">Sinh viên&nbsp; / &nbsp;<b>Dashboard</b></div>

        <section class="page-heading">
          <div>
            <h1>Chào buổi sáng, An!</h1>
            <p class="subtitle">Đây là tổng quan học tập của bạn trong học kỳ hiện tại.</p>
          </div>
          <a href="/sinhvien/thoi-khoa-bieu" class="outline-button" style="text-decoration:none; cursor:pointer;">▦&nbsp; Xem thời khóa biểu</a>
        </section>

        <section class="welcome-banner">
          <div class="welcome-copy">
            <div class="welcome-icon">✦</div>
            <div>
              <div class="welcome-title">Chúc bạn có một học kỳ hiệu quả!</div>
              <div class="welcome-description">Theo dõi lịch học, tiến độ tín chỉ và thông báo mới ngay tại Dashboard.</div>
            </div>
          </div>
          <span class="term-badge">Học kỳ 1 · 2026–2027</span>
        </section>

        <section class="kpi-row" aria-label="Tổng quan học tập">
          <div class="kpi-card">
            <div class="kpi-top"><span class="kpi-label">Điểm trung bình tích lũy</span><span class="kpi-icon blue">◉</span></div>
            <div class="kpi-value">3.42<span class="kpi-unit"> / 4.0</span></div>
            <div class="kpi-foot"><span class="positive">+0.12</span> so với học kỳ trước</div>
          </div>
          <div class="kpi-card">
            <div class="kpi-top"><span class="kpi-label">Tín chỉ đã hoàn thành</span><span class="kpi-icon teal">✓</span></div>
            <div class="kpi-value">78<span class="kpi-unit"> / 130 tín chỉ</span></div>
            <div class="kpi-foot">Đã hoàn thành 60% chương trình</div>
          </div>
          <div class="kpi-card">
            <div class="kpi-top"><span class="kpi-label">Học phần học kỳ này</span><span class="kpi-icon gold">▤</span></div>
            <div class="kpi-value">6<span class="kpi-unit"> học phần</span></div>
            <div class="kpi-foot">Tổng cộng 18 tín chỉ</div>
          </div>
          <div class="kpi-card">
            <div class="kpi-top"><span class="kpi-label">Tình trạng học phí</span><span class="kpi-icon red">₫</span></div>
            <div class="kpi-value">85<span class="kpi-unit">%</span></div>
            <div class="kpi-foot">Còn lại 1.250.000 đ cần thanh toán</div>
          </div>
        </section>

        <div class="dashboard-grid">
          <div class="main-column">
            <section class="card">
              <div class="card-head">
                <div>
                  <h2 class="card-title">Lịch học sắp tới</h2>
                  <div class="card-subtitle">Các lớp học trong tuần này</div>
                </div>
                <a class="text-link" href="/sinhvien/thoi-khoa-bieu">Xem toàn bộ lịch&nbsp; →</a>
              </div>
              <div class="schedule-list">
                <div class="schedule-row">
                  <div class="time-box"><span class="time-day">Thứ Ba</span><span class="time-date">18</span></div>
                  <div class="class-detail">
                    <div class="class-name">Lập trình Web</div>
                    <div class="class-meta">WEB302.01 &nbsp;·&nbsp; Nguyễn Minh Anh &nbsp;·&nbsp; 3 tín chỉ</div>
                    <span class="status-pill">Sắp diễn ra</span>
                  </div>
                  <div class="class-room"><strong>07:00 – 09:30</strong>Phòng A203</div>
                </div>
                <div class="schedule-row">
                  <div class="time-box"><span class="time-day">Thứ Tư</span><span class="time-date">19</span></div>
                  <div class="class-detail">
                    <div class="class-name">Cơ sở dữ liệu</div>
                    <div class="class-meta">DBI202.02 &nbsp;·&nbsp; Trần Thu Hà &nbsp;·&nbsp; 3 tín chỉ</div>
                  </div>
                  <div class="class-room"><strong>09:45 – 12:15</strong>Phòng B105</div>
                </div>
                <div class="schedule-row">
                  <div class="time-box"><span class="time-day">Thứ Năm</span><span class="time-date">20</span></div>
                  <div class="class-detail">
                    <div class="class-name">Thiết kế giao diện</div>
                    <div class="class-meta">UXD201.01 &nbsp;·&nbsp; Lê Hoàng Nam &nbsp;·&nbsp; 3 tín chỉ</div>
                  </div>
                  <div class="class-room"><strong>13:00 – 15:30</strong>Phòng C302</div>
                </div>
              </div>
            </section>

            <section class="card">
              <div class="card-head">
                <div>
                  <h2 class="card-title">Thông báo mới</h2>
                  <div class="card-subtitle">Cập nhật từ nhà trường và khoa</div>
                </div>
                <a class="text-link" href="/sinhvien/thong-bao">Xem tất cả&nbsp; →</a>
              </div>
              <div class="announcement-list">
                <div class="announcement">
                  <span class="announcement-mark"></span>
                  <div class="announcement-content">
                    <div class="announcement-title">Mở đợt đăng ký học phần học kỳ 1 năm học 2026–2027</div>
                    <div class="announcement-meta">Phòng Đào tạo &nbsp;·&nbsp; Hôm nay, 08:30</div>
                  </div>
                </div>
                <div class="announcement">
                  <span class="announcement-mark blue"></span>
                  <div class="announcement-content">
                    <div class="announcement-title">Lịch thi giữa kỳ đã được cập nhật trên cổng sinh viên</div>
                    <div class="announcement-meta">Khoa Công nghệ thông tin &nbsp;·&nbsp; Hôm qua</div>
                  </div>
                </div>
                <div class="announcement">
                  <span class="announcement-mark gold"></span>
                  <div class="announcement-content">
                    <div class="announcement-title">Nhắc nhở hoàn thành học phí trước thời hạn quy định</div>
                    <div class="announcement-meta">Phòng Tài chính – Kế toán &nbsp;·&nbsp; 16/11/2026</div>
                  </div>
                </div>
              </div>
            </section>
          </div>

          <aside class="side-column">
            <section class="card registration-card">
              <div class="registration-label"><span class="registration-icon">◷</span>Đăng ký học phần</div>
              <p>Đợt đăng ký học phần đang mở. Chọn lớp còn chỗ và kiểm tra lịch học trước khi xác nhận.</p>
              <a href="/sinhvien/dang-ky" class="primary-button" style="display:block; text-align:center; text-decoration:none;">Đến trang đăng ký&nbsp; →</a>
            </section>

            <!-- Truy cập nhanh -->
            <section class="card">
              <div class="card-head">
                <div>
                  <h2 class="card-title">Truy cập nhanh</h2>
                  <div class="card-subtitle">Các mục bạn thường dùng</div>
                </div>
              </div>

              <div class="quick-grid">
                <a href="/sinhvien/dang-ky" class="quick-card">
                  <span class="quick-icon">▤</span>
                  <span class="quick-name">Đăng ký học phần</span>
                </a>

                <a href="/sinhvien/thoi-khoa-bieu" class="quick-card">
                  <span class="quick-icon">▦</span>
                  <span class="quick-name">Thời khóa biểu</span>
                </a>

                <a href="/sinhvien/ket-qua" class="quick-card">
                  <span class="quick-icon">◷</span>
                  <span class="quick-name">Kết quả học tập</span>
                </a>

                <a href="/sinhvien/hoc-phi" class="quick-card">
                  <span class="quick-icon">₫</span>
                  <span class="quick-name">Học phí</span>
                </a>
              </div>
            </section>

            <section class="card">
              <div class="card-head">
                <div>
                  <h2 class="card-title">Tiến độ chương trình</h2>
                  <div class="card-subtitle">Tín chỉ tích lũy</div>
                </div>
                <span class="text-link">60%</span>
              </div>
              <div style="padding:0 19px 17px;">
                <div class="progress-heading"><span>Đã hoàn thành</span><strong>78 / 130 tín chỉ</strong></div>
                <div class="progress"><i></i></div>
                <div class="progress-heading"><span>Còn lại</span><strong>52 tín chỉ</strong></div>
              </div>
            </section>
          </aside>
        </div>
      </main>
    </div>
  </div>
</body>
</html>
