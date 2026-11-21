
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>EduManager — Đăng ký học phần</title>
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
    .brand { display:flex; align-items:center; gap:12px; color:#17324d; font-weight:700; font-size:20px; letter-spacing:-.3px; text-decoration:none; }
    .brand-mark { width:36px; height:36px; border-radius:11px; background:#245b8f; display:flex; align-items:center; justify-content:center; color:#fff; font-size:17px; font-weight:700; }
    .top-actions { display:flex; align-items:center; gap:18px; }
    .term-select { border:1px solid #d9e1e8; border-radius:8px; background:#fff; color:#17324d; padding:9px 12px; font-size:13px; font-weight:500; }
    .icon-button { width:38px; height:38px; border:1px solid #d9e1e8; border-radius:10px; color:#5b6673; background:#fff; display:flex; align-items:center; justify-content:center; font-size:17px; }
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
    main { min-width:0; flex:1; padding:32px 36px 48px; width:1192px; margin:0 auto; }
    .breadcrumb { color:#7a8794; font-size:12px; margin-bottom:15px; }
    .breadcrumb b { color:#245b8f; font-weight:500; }
    .page-heading { display:flex; align-items:flex-start; justify-content:space-between; gap:18px; margin-bottom:22px; }
    h1 { color:#17324d; font-size:30px; line-height:1.25; letter-spacing:-.6px; margin:0; font-weight:700; }
    .subtitle { margin:7px 0 0; color:#5b6673; font-size:14px; }
    .outline-button { display:flex; align-items:center; gap:8px; border:1px solid #d9e1e8; color:#245b8f; background:#fff; border-radius:8px; padding:10px 14px; font-size:13px; font-weight:600; white-space:nowrap; text-decoration:none; }
    .period-banner { display:flex; align-items:center; justify-content:space-between; gap:18px; border:1px solid #cfe3e1; background:#e8f6f4; border-radius:12px; padding:15px 18px; margin-bottom:22px; }
    .period-main { display:flex; align-items:center; gap:13px; }
    .period-icon { width:38px; height:38px; flex:0 0 38px; display:flex; align-items:center; justify-content:center; border-radius:10px; color:#168c8c; background:#fff; font-size:18px; }
    .period-title { color:#17324d; font-size:14px; font-weight:600; }
    .period-copy { color:#5b6673; font-size:12px; margin-top:2px; }
    .period-state { border-radius:20px; padding:6px 11px; background:#d7f0eb; color:#16736f; font-size:11px; font-weight:600; white-space:nowrap; }
    .content-grid { display:flex; align-items:flex-start; gap:20px; }
    .left-column, .right-column { min-width:0; display:flex; flex-direction:column; gap:18px; }
    .left-column { flex:1 1 auto; width:0; }
    .right-column { width:310px; flex:0 0 310px; }
    .card { background:#ffffff; border:1px solid #d9e1e8; border-radius:12px; box-shadow:0 8px 24px rgba(23, 50, 77, .06); }
    .card-head { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:18px 20px 14px; }
    .card-title { margin:0; color:#17324d; font-size:16px; line-height:1.4; font-weight:600; }
    .card-subtitle { color:#5b6673; font-size:12px; margin-top:3px; }
    .count-pill { background:#e8f1f8; color:#245b8f; border-radius:20px; padding:5px 10px; font-size:11px; font-weight:600; white-space:nowrap; }
    .filters { display:flex; flex-wrap:wrap; gap:10px; padding:0 20px 16px; }
    .filters .search-wrap { flex:1 1 44%; }
    .filters > select { flex:1 1 25%; }
    .search-wrap { position:relative; }
    .search-wrap span { position:absolute; left:12px; top:9px; color:#8593a1; font-size:15px; }
    .filter-control { height:38px; width:100%; border:1px solid #d9e1e8; border-radius:8px; background:#fff; color:#596675; padding:0 11px; outline:none; font-size:12px; }
    .search-wrap input { padding-left:34px; }
    .table-wrap { overflow:auto; border-top:1px solid #edf1f4; }
    table { border-collapse:collapse; width:100%; min-width:750px; text-align:left; }
    th { background:#f8fafc; color:#6c7885; text-transform:uppercase; letter-spacing:.045em; font-size:10px; font-weight:600; padding:11px 12px; white-space:nowrap; }
    td { border-top:1px solid #edf1f4; padding:13px 12px; vertical-align:middle; font-size:12px; }
    th:first-child, td:first-child { padding-left:20px; }
    th:last-child, td:last-child { padding-right:20px; }
    .course-code { color:#245b8f; font-weight:600; font-size:11px; white-space:nowrap; }
    .course-name { color:#17324d; font-weight:600; font-size:12px; line-height:1.4; min-width:155px; }
    .subcell { display:block; color:#5b6673; font-size:10px; font-weight:400; margin-top:3px; line-height:1.4; }
    .schedule { color:#435261; white-space:nowrap; font-size:11px; }
    .seat-text { color:#435261; font-size:11px; white-space:nowrap; }
    .seatbar { height:4px; width:68px; background:#e8edf1; border-radius:4px; margin-top:5px; overflow:hidden; }
    .seatbar i { display:block; height:100%; background:#168c8c; border-radius:4px; }
    .seatbar i.warn { background:#e39a42; }
    .btn-add { border:0; border-radius:7px; padding:7px 10px; background:#245b8f; color:#fff; font-size:11px; font-weight:600; white-space:nowrap; }
    .btn-add:hover { background:#17324d; }
    .table-foot { display:flex; justify-content:space-between; color:#73808d; padding:12px 20px; font-size:11px; border-top:1px solid #edf1f4; }
    .summary-card { overflow:hidden; }
    .summary-top { background:#17324d; color:#fff; padding:18px 18px 16px; }
    .summary-top .eyebrow { color:#c4d5e2; font-size:10px; font-weight:500; letter-spacing:.06em; text-transform:uppercase; }
    .summary-top h2 { font-size:16px; margin:4px 0 0; font-weight:600; }
    .credit-total { display:flex; align-items:baseline; gap:6px; margin-top:17px; }
    .credit-total strong { font-size:30px; line-height:1; }
    .credit-total span { color:#d1dee8; font-size:12px; }
    .progress { height:6px; border-radius:6px; background:#456079; margin-top:12px; overflow:hidden; }
    .progress i { display:block; height:100%; width:50%; border-radius:6px; background:#55c2b5; }
    .summary-body { padding:15px 18px 18px; }
    .summary-line { display:flex; justify-content:space-between; gap:10px; padding:8px 0; border-bottom:1px solid #edf1f4; font-size:11px; }
    .summary-line span { color:#5b6673; }
    .summary-line b { color:#17324d; font-weight:600; text-align:right; }
    .selected-title { font-size:13px; font-weight:600; color:#17324d; margin:16px 0 10px; }
    .selected-item { display:flex; justify-content:space-between; gap:9px; padding:9px 0; border-top:1px solid #edf1f4; }
    .selected-item strong { display:block; color:#17324d; font-size:11px; font-weight:600; }
    .selected-item small { color:#5b6673; display:block; font-size:10px; margin-top:2px; }
    .selected-item b { color:#245b8f; font-size:10px; white-space:nowrap; }
    .empty-note { color:#7b8794; font-size:11px; margin:10px 0; }
    .confirm-button { width:100%; border:0; border-radius:8px; background:#168c8c; color:#fff; padding:11px 12px; margin-top:15px; font-size:12px; font-weight:600; }
    .confirm-button:hover { background:#117575; }
    .rules-card { padding:16px 18px; }
    .rules-card h3 { margin:0 0 10px; font-size:13px; color:#17324d; font-weight:600; }
    .rule { display:flex; gap:9px; color:#596675; font-size:11px; line-height:1.5; margin:8px 0; }
    .check { flex:0 0 17px; color:#168c8c; font-weight:700; }
    .alert { background:#fff5e8; color:#85501d; border:1px solid #f0ddc2; padding:10px 11px; border-radius:8px; font-size:10px; line-height:1.55; margin-top:13px; }
    .data-note { color:#8995a0; font-size:10px; text-align:right; margin:13px 2px 0; }
  </style>
</head>
<body>
  <div class="app">
    <header class="topbar">
      <a href="/sinhvien/dashboard" class="brand"><span class="brand-mark">E</span> EduManager</a>
      <div class="top-actions">
        <select class="term-select" aria-label="Học kỳ"><option>Học kỳ 1 · 2026–2027</option></select>
        <button class="icon-button" aria-label="Trợ giúp">?</button>
        <a href="/sinhvien/thong-bao" class="icon-button notification-button" aria-label="Thông báo" style="text-decoration:none; cursor:pointer;">♧</a>
        <a href="/sinhvien/ho-so" class="profile" style="text-decoration:none; cursor:pointer;"><div class="avatar">NA</div><div class="profile-name">Nguyễn An<span class="profile-id">Sinh viên · 22A10001</span></div></a>
      </div>
    </header>
    <div class="layout">
      <aside class="sidebar">
        <div class="side-label">Không gian sinh viên</div>
        <nav class="nav" aria-label="Điều hướng chính">
          <a href="/sinhvien/dashboard"><span class="nav-icon">⌂</span>Dashboard</a>
          <a class="active" href="/sinhvien/dang-ky"><span class="nav-icon">▤</span>Đăng ký học phần</a>
          <a href="/sinhvien/thoi-khoa-bieu"><span class="nav-icon">▦</span>Thời khóa biểu</a>
          <a href="/sinhvien/ket-qua"><span class="nav-icon">◷</span>Kết quả học tập</a>
          <a href="/sinhvien/thong-bao"><span class="nav-icon">◉</span>Thông báo</a>
        </nav>
        <div class="sidebar-note"><strong>Hỗ trợ đăng ký</strong><p>Kiểm tra học phần tiên quyết và lịch học trước khi xác nhận đăng ký.</p></div>
      </aside>
      <main>
        <div class="breadcrumb">Sinh viên&nbsp; / &nbsp;<b>Đăng ký học phần</b></div>
        <section class="page-heading">
          <div><h1>Đăng ký học phần</h1><p class="subtitle">Tìm lớp học phần phù hợp và theo dõi các môn đã chọn.</p></div>
          <a href="/sinhvien/thoi-khoa-bieu" class="outline-button">▣&nbsp; Xem thời khóa biểu</a>
        </section>
        <section class="period-banner">
          <div class="period-main"><div class="period-icon">◷</div><div><div class="period-title">Đợt đăng ký học phần đang mở</div><div class="period-copy">Thời gian đăng ký: 08:00 18/11/2026 – 23:59 25/11/2026</div></div></div>
          <span class="period-state">ĐANG MỞ</span>
        </section>
        <div class="content-grid">
          <div class="left-column">
            <section class="card">
              <div class="card-head"><div><h2 class="card-title">Danh sách lớp học phần</h2><div class="card-subtitle">Chọn lớp còn chỗ trong học kỳ hiện tại</div></div><span class="count-pill">12 lớp đang mở</span></div>
              <div class="filters">
                <label class="search-wrap"><span>⌕</span><input class="filter-control" placeholder="Tìm theo mã hoặc tên học phần" /></label>
                <select class="filter-control"><option>Tất cả khoa</option><option>Công nghệ thông tin</option></select>
                <select class="filter-control"><option>Tất cả số tín chỉ</option><option>3 tín chỉ</option></select>
              </div>
              <div class="table-wrap"><table>
                <thead><tr><th>Mã lớp</th><th>Học phần</th><th>Giảng viên</th><th>Lịch học</th><th>Chỗ trống</th><th>TC</th><th></th></tr></thead>
                <tbody>
                  <tr><td><span class="course-code">WEB302.01</span></td><td><div class="course-name">Lập trình Web<span class="subcell">WEB302 · Học phần chuyên ngành</span></div></td><td>Nguyễn Minh Anh<span class="subcell">Phòng A203</span></td><td class="schedule">T3 · 07:00–09:30</td><td><span class="seat-text">18 / 40</span><div class="seatbar"><i style="width:55%"></i></div></td><td>3</td><td><button class="btn-add">+ Đăng ký</button></td></tr>
                  <tr><td><span class="course-code">DBI202.02</span></td><td><div class="course-name">Cơ sở dữ liệu<span class="subcell">DBI202 · Học phần bắt buộc</span></div></td><td>Trần Thu Hà<span class="subcell">Phòng B105</span></td><td class="schedule">T4 · 09:45–12:15</td><td><span class="seat-text">9 / 35</span><div class="seatbar"><i style="width:74%"></i></div></td><td>3</td><td><button class="btn-add">+ Đăng ký</button></td></tr>
                  <tr><td><span class="course-code">UXD201.01</span></td><td><div class="course-name">Thiết kế giao diện<span class="subcell">UXD201 · Học phần tự chọn</span></div></td><td>Lê Hoàng Nam<span class="subcell">Phòng C302</span></td><td class="schedule">T5 · 13:00–15:30</td><td><span class="seat-text">4 / 30</span><div class="seatbar"><i class="warn" style="width:87%"></i></div></td><td>3</td><td><button class="btn-add">+ Đăng ký</button></td></tr>
                  <tr><td><span class="course-code">ENG301.03</span></td><td><div class="course-name">Tiếng Anh chuyên ngành<span class="subcell">ENG301 · Học phần bắt buộc</span></div></td><td>Phạm Ngọc Linh<span class="subcell">Phòng A104</span></td><td class="schedule">T6 · 07:00–09:30</td><td><span class="seat-text">22 / 35</span><div class="seatbar"><i style="width:37%"></i></div></td><td>2</td><td><button class="btn-add">+ Đăng ký</button></td></tr>
                </tbody>
              </table></div>
              <div class="table-foot"><span>Hiển thị 4 trong 12 lớp học phần</span><span>‹&nbsp; 1 &nbsp; 2 &nbsp; 3 &nbsp; ›</span></div>
            </section>
          </div>
          <aside class="right-column">
            <section class="card summary-card">
              <div class="summary-top"><div class="eyebrow">Tóm tắt đăng ký</div><h2>Học kỳ 1 · 2026–2027</h2><div class="credit-total"><strong>15</strong><span>/ 30 tín chỉ dự kiến</span></div><div class="progress"><i></i></div></div>
              <div class="summary-body">
                <div class="summary-line"><span>Đã đăng ký</span><b>12 tín chỉ</b></div>
                <div class="summary-line"><span>Đang chọn</span><b>3 tín chỉ</b></div>
                <div class="summary-line"><span>Giới hạn học kỳ</span><b>12–30 tín chỉ</b></div>
                <div class="selected-title">Học phần đã chọn <span class="count-pill">1</span></div>
                <div class="selected-item"><div><strong>WEB302 · Lập trình Web</strong><small>T3 · 07:00–09:30 · A203</small></div><b>3 TC</b></div>
                <button class="confirm-button">Xác nhận đăng ký</button>
              </div>
            </section>
            <section class="card rules-card">
              <h3>Điều kiện đăng ký</h3>
              <div class="rule"><span class="check">✓</span><span>Thời gian đăng ký đang trong đợt mở.</span></div>
              <div class="rule"><span class="check">✓</span><span>Lớp còn chỗ và chưa đăng ký trùng học phần.</span></div>
              <div class="rule"><span class="check">✓</span><span>Lịch học không trùng với các lớp đã chọn.</span></div>
              <div class="alert">Trước khi xác nhận, hãy rà soát học phần tiên quyết và tổng số tín chỉ theo quy định của trường.</div>
            </section>
          </aside>
        </div>
      </main>
    </div>
  </div>
</body>
</html>
