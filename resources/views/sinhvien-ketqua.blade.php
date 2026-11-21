<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>EduManager — Kết quả học tập</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <style>
  * { box-sizing: border-box; }
  body { margin: 0; min-width: 1440px; background: #f4f7fa; color: #1f2937; font: 14px/1.5 "Be Vietnam Pro", Arial, sans-serif; }
  button, input, select { font: inherit; }
  button { cursor: pointer; }
  .app { min-height: 100vh; }
  .topbar { height: 72px; padding: 0 32px; display: flex; align-items: center; justify-content: space-between; background: #fff; border-bottom: 1px solid #d9e1e8; }
  .brand, .top-actions, .profile { display: flex; align-items: center; }
  .brand { gap: 12px; color: #17324d; font-size: 20px; font-weight: 700; text-decoration: none; }
  .brand-mark { width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 10px; background: #245b8f; color: #fff; font-size: 17px; }
  .top-actions { gap: 16px; }
  .term-select, .icon-button, .select-filter, .export-button { border: 1px solid #d9e1e8; background: #fff; border-radius: 8px; }
  .term-select { padding: 9px 12px; color: #17324d; font-size: 12px; }
  .icon-button { width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; color: #5b6673; text-decoration: none; }
  .notification-button { position: relative; }
  .notification-dot { position: absolute; top: 7px; right: 7px; width: 7px; height: 7px; border: 1px solid #fff; border-radius: 50%; background: #e26a5c; }
  .profile { gap: 9px; text-decoration: none; }
  .avatar { width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: #d5e7f2; color: #245b8f; font-size: 13px; font-weight: 700; }
  .profile-name { color: #17324d; font-size: 12px; font-weight: 600; }
  .profile-id { display: block; color: #5b6673; font-size: 10px; font-weight: 400; }
  .layout { display: flex; min-height: calc(100vh - 72px); }
  .sidebar { width: 248px; flex: 0 0 248px; padding: 26px 16px; background: #fff; border-right: 1px solid #d9e1e8; }
  .side-label { margin: 10px 0 12px; padding: 0 12px; color: #83909c; font-size: 11px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; }
  .nav { display: flex; flex-direction: column; gap: 5px; }
  .nav a { min-height: 44px; padding: 0 12px; display: flex; align-items: center; gap: 12px; border-radius: 9px; color: #526170; text-decoration: none; font-size: 13px; }
  .nav-icon { width: 20px; color: #71808e; text-align: center; }
  .nav a.active { background: #e8f1f8; color: #245b8f; font-weight: 600; }
  .nav a.active .nav-icon { color: #245b8f; }
  .sidebar-note { margin: 30px 4px 0; padding: 15px; border: 1px solid #d8e9e8; border-radius: 12px; background: #f5fbfa; }
  .sidebar-note strong { color: #17324d; font-size: 12px; }
  .sidebar-note p { margin: 6px 0 0; color: #5b6673; font-size: 11px; line-height: 1.6; }
  main { width: 1192px; min-width: 0; flex: 1; margin: 0 auto; padding: 30px 36px 42px; }
  .breadcrumb { margin-bottom: 13px; color: #7a8794; font-size: 12px; }
  .breadcrumb b { color: #245b8f; font-weight: 500; }
  .page-heading, .filter-bar { display: flex; align-items: center; justify-content: space-between; gap: 16px; }
  .page-heading { align-items: flex-start; margin-bottom: 21px; }
  h1 { margin: 0; color: #17324d; font-size: 30px; line-height: 1.25; }
  .subtitle { margin: 7px 0 0; color: #5b6673; font-size: 14px; }
  .semester-badge { padding: 7px 12px; border-radius: 20px; background: #e8f1f8; color: #245b8f; font-size: 11px; font-weight: 600; white-space: nowrap; }
  .overview { display: flex; gap: 14px; margin-bottom: 18px; }
  .overview-card { flex: 1; min-width: 0; padding: 15px 17px; display: flex; align-items: center; gap: 13px; border: 1px solid #d9e1e8; border-radius: 12px; background: #fff; }
  .overview-icon { width: 38px; height: 38px; flex: 0 0 38px; display: flex; align-items: center; justify-content: center; border-radius: 10px; background: #e8f1f8; color: #245b8f; }
  .overview-icon.teal { background: #e8f6f4; color: #168c8c; }
  .overview-icon.gold { background: #fff5e8; color: #b8782f; }
  .overview-value { color: #17324d; font-size: 20px; font-weight: 700; }
  .overview-label { margin-top: 3px; color: #687583; font-size: 11px; }
  .filter-bar { padding: 14px 16px; border: 1px solid #d9e1e8; border-radius: 12px 12px 0 0; background: #fff; }
  .filter-title { color: #17324d; font-size: 14px; font-weight: 600; }
  .filter-caption { margin-top: 2px; color: #7b8794; font-size: 10px; }
  .filter-actions { display: flex; align-items: center; gap: 9px; }
  .search-box { width: 220px; height: 36px; padding: 0 10px; display: flex; align-items: center; gap: 8px; border: 1px solid #d9e1e8; border-radius: 8px; color: #83909c; }
  .search-box input { width: 100%; min-width: 0; border: 0; outline: 0; background: transparent; font-size: 11px; }
  .select-filter { height: 36px; min-width: 166px; padding: 0 10px; color: #526170; font-size: 11px; }
  .export-button { height: 36px; padding: 0 12px; color: #245b8f; font-size: 11px; font-weight: 600; white-space: nowrap; }
  .table-wrap { overflow: hidden; border: 1px solid #d9e1e8; border-top: 0; border-radius: 0 0 12px 12px; background: #fff; }
  table { width: 100%; border-collapse: collapse; table-layout: fixed; }
  thead { background: #f8fafc; }
  th { height: 48px; padding: 0 10px; border-bottom: 1px solid #e6edf2; color: #687583; font-size: 10px; font-weight: 600; text-align: left; }
  td { height: 74px; padding: 10px; border-bottom: 1px solid #edf1f4; color: #526170; font-size: 11px; vertical-align: middle; }
  tbody tr:last-child td { border-bottom: 0; }
  th:first-child, td:first-child { padding-left: 18px; }
  .col-course { width: 24%; }
  .col-credit { width: 7%; text-align: center; }
  .col-score { width: 8%; text-align: center; }
  .col-total, .col-scale { width: 9%; text-align: center; }
  .col-letter { width: 8%; text-align: center; }
  .col-result { width: 11%; }
  .col-credit, .col-score, .col-total, .col-scale, .col-letter { text-align: center; }
  .course-name { color: #17324d; font-size: 12px; font-weight: 600; }
  .course-meta { margin-top: 4px; color: #7b8794; font-size: 9px; }
  .score { color: #17324d; font-size: 12px; font-weight: 600; }
  .score-muted { color: #8895a0; font-size: 10px; }
  .grade-letter { padding: 4px 7px; border-radius: 6px; background: #e8f1f8; color: #245b8f; font-size: 10px; font-weight: 700; }
  .result-pass { padding: 5px 10px; border-radius: 20px; background: #e9f7f0; color: #16805f; font-size: 10px; font-weight: 600; white-space: nowrap; }
  .result-pending { background: #fff5e8; color: #a56a23; }
  .table-footer { padding: 12px 17px; border-top: 1px solid #edf1f4; color: #7b8794; font-size: 10px; }
  .summary-section { margin-top: 18px; overflow: hidden; border: 1px solid #d9e1e8; border-radius: 12px; background: #fff; }
  .summary-heading { padding: 15px 18px 12px; border-bottom: 1px solid #edf1f4; }
  .summary-title { color: #17324d; font-size: 14px; font-weight: 600; }
  .summary-caption { margin-top: 3px; color: #7b8794; font-size: 10px; }
  .summary-table th { height: 38px; background: #f8fafc; text-transform: uppercase; }
  .summary-table td { height: 38px; padding: 8px 18px; font-size: 11px; }
  .summary-table td:first-child { width: 68%; color: #526170; }
  .summary-table td:last-child { color: #17324d; font-weight: 600; }
  .summary-table tr.section-start td { border-top: 1px solid #e6edf2; }
  .notice { margin-top: 16px; padding: 12px 14px; display: flex; align-items: flex-start; gap: 10px; border: 1px solid #d8e9e8; border-radius: 10px; background: #f5fbfa; color: #526170; font-size: 10px; }
  .notice-icon { width: 18px; height: 18px; flex: 0 0 18px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: #168c8c; color: #fff; font-weight: 700; }
  .notice strong { color: #17324d; }
  .data-note { margin: 11px 2px 0; color: #8995a0; font-size: 10px; text-align: right; }
  </style>
</head>
<body>
  <div class="app">
    <header class="topbar">
      <a href="/sinhvien/dashboard" class="brand"><span class="brand-mark">E</span> EduManager</a>
      <div class="top-actions">
        <select class="term-select" aria-label="Học kỳ"><option>Học kỳ 1 · 2026–2027</option><option>Học kỳ 2 · 2025–2026</option><option>Học kỳ 1 · 2025–2026</option></select>
        <button class="icon-button" aria-label="Trợ giúp">?</button>
        <a href="/sinhvien/thong-bao" class="icon-button notification-button" aria-label="Thông báo">♧<span class="notification-dot"></span></a>
        <a href="/sinhvien/ho-so" class="profile"><div class="avatar">NA</div><div class="profile-name">Nguyễn An<span class="profile-id">Sinh viên · 22A10001</span></div></a>
      </div>
    </header>
    <div class="layout">
      <aside class="sidebar">
        <div class="side-label">Không gian sinh viên</div>
        <nav class="nav" aria-label="Điều hướng chính">
          <a href="/sinhvien/dashboard"><span class="nav-icon">⌂</span>Dashboard</a>
          <a href="/sinhvien/dang-ky"><span class="nav-icon">▤</span>Đăng ký học phần</a>
          <a href="/sinhvien/thoi-khoa-bieu"><span class="nav-icon">▦</span>Thời khóa biểu</a>
          <a class="active" href="/sinhvien/ket-qua"><span class="nav-icon">◷</span>Kết quả học tập</a>
          <a href="/sinhvien/thong-bao"><span class="nav-icon">◉</span>Thông báo</a>
        </nav>
        <div class="sidebar-note"><strong>Tra cứu điểm</strong><p>Kết quả được cập nhật theo học kỳ sau khi giảng viên công bố điểm.</p></div>
      </aside>
      <main>
        <div class="breadcrumb">Sinh viên&nbsp; / &nbsp;<b>Kết quả học tập</b></div>
        <section class="page-heading">
          <div><h1>Kết quả học tập</h1><p class="subtitle">Theo dõi điểm các học phần trong học kỳ đã chọn.</p></div>
          <span class="semester-badge">Học kỳ 1 · 2026–2027</span>
        </section>
        <section class="overview">
          <div class="overview-card"><span class="overview-icon">▤</span><div><div class="overview-value">4</div><div class="overview-label">Học phần trong học kỳ</div></div></div>
          <div class="overview-card"><span class="overview-icon teal">◫</span><div><div class="overview-value">11</div><div class="overview-label">Tín chỉ đã đăng ký</div></div></div>
          <div class="overview-card"><span class="overview-icon gold">◷</span><div><div class="overview-value">3 / 4</div><div class="overview-label">Học phần đã có kết quả</div></div></div>
        </section>
        <section class="filter-bar">
          <div><div class="filter-title">Bảng điểm học kỳ</div><div class="filter-caption">Đang hiển thị toàn bộ học phần của học kỳ đã chọn</div></div>
          <div class="filter-actions">
            <label class="search-box"><span>⌕</span><input type="search" placeholder="Tìm mã hoặc tên học phần" /></label>
            <select class="select-filter" aria-label="Chọn học kỳ"><option>Học kỳ 1 · 2026–2027</option><option>Học kỳ 2 · 2025–2026</option><option>Học kỳ 1 · 2025–2026</option></select>
            <button class="export-button">↓&nbsp; Xuất bảng điểm</button>
          </div>
        </section>
        <section class="table-wrap">
          <table>
            <thead>
              <tr>
                <th class="col-course">MÔN HỌC / LỚP HỌC PHẦN</th>
                <th class="col-credit">TÍN CHỈ</th>
                <th class="col-score">CHUYÊN CẦN</th>
                <th class="col-score">GIỮA KỲ</th>
                <th class="col-score">CUỐI KỲ</th>
                <th class="col-total">TỔNG KẾT</th>
                <th class="col-scale">THANG ĐIỂM 4</th>
                <th class="col-letter">ĐIỂM CHỮ</th>
                <th class="col-result">XẾP LOẠI</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><div class="course-name">Lập trình Web</div><div class="course-meta">WEB302.01 · Nguyễn Minh Anh</div></td>
                <td class="col-credit">3</td><td class="col-score"><span class="score">9.0</span></td><td class="col-score"><span class="score">8.5</span></td><td class="col-score"><span class="score">8.8</span></td><td class="col-total"><span class="score">8.7</span></td><td class="col-scale"><span class="score">4.0</span></td><td class="col-letter"><span class="grade-letter">A</span></td><td><span class="result-pass">Đạt</span></td>
              </tr>
              <tr>
                <td><div class="course-name">Cơ sở dữ liệu</div><div class="course-meta">DBI202.02 · Trần Thu Hà</div></td>
                <td class="col-credit">3</td><td class="col-score"><span class="score">8.5</span></td><td class="col-score"><span class="score">8.0</span></td><td class="col-score"><span class="score">8.2</span></td><td class="col-total"><span class="score">8.2</span></td><td class="col-scale"><span class="score">3.5</span></td><td class="col-letter"><span class="grade-letter">B+</span></td><td><span class="result-pass">Đạt</span></td>
              </tr>
              <tr>
                <td><div class="course-name">Thiết kế giao diện</div><div class="course-meta">UXD201.01 · Lê Hoàng Nam</div></td>
                <td class="col-credit">3</td><td class="col-score"><span class="score">9.5</span></td><td class="col-score"><span class="score">9.0</span></td><td class="col-score"><span class="score-muted">Chưa công bố</span></td><td class="col-total"><span class="score-muted">Chưa công bố</span></td><td class="col-scale"><span class="score-muted">Chưa công bố</span></td><td class="col-letter"><span class="score-muted">Chưa công bố</span></td><td><span class="result-pass result-pending">Chưa công bố</span></td>
              </tr>
              <tr>
                <td><div class="course-name">Tiếng Anh chuyên ngành</div><div class="course-meta">ENG301.03 · Phạm Ngọc Linh</div></td>
                <td class="col-credit">2</td><td class="col-score"><span class="score">8.0</span></td><td class="col-score"><span class="score">7.5</span></td><td class="col-score"><span class="score">8.0</span></td><td class="col-total"><span class="score">7.8</span></td><td class="col-scale"><span class="score">3.0</span></td><td class="col-letter"><span class="grade-letter">B</span></td><td><span class="result-pass">Đạt</span></td>
              </tr>
            </tbody>
          </table>
          <div class="table-footer">Hiển thị toàn bộ 4 học phần của Học kỳ 1 · 2026–2027</div>
        </section>
        <section class="summary-section">
          <div class="summary-heading"><div class="summary-title">Tổng kết kết quả học tập</div><div class="summary-caption">Điểm trung bình, tín chỉ và xếp loại theo học kỳ và toàn khóa</div></div>
          <table class="summary-table">
            <thead><tr><th>CHỈ SỐ</th><th>KẾT QUẢ</th></tr></thead>
            <tbody>
              <tr><td>Điểm trung bình học kỳ (hệ 10)</td><td>8,23</td></tr>
              <tr><td>Điểm trung bình học kỳ (hệ 4)</td><td>3,45</td></tr>
              <tr class="section-start"><td>Điểm trung bình tích lũy (hệ 10)</td><td>8,12</td></tr>
              <tr><td>Điểm trung bình tích lũy (hệ 4)</td><td>3,32</td></tr>
              <tr><td>Xếp loại học lực học kỳ</td><td>Giỏi</td></tr>
              <tr><td>Xếp loại học lực tích lũy</td><td>Giỏi</td></tr>
              <tr class="section-start"><td>Tổng số tín chỉ đã đăng ký</td><td>112</td></tr>
              <tr><td>Tổng số tín chỉ tích lũy</td><td>109</td></tr>
              <tr><td>Tổng số tín chỉ đạt</td><td>106</td></tr>
              <tr><td>Tổng số tín chỉ nợ</td><td>3</td></tr>
            </tbody>
          </table>
        </section>
        <div class="notice"><span class="notice-icon">i</span><div><strong>Lưu ý về kết quả tổng hợp</strong><br />Thang điểm 4 và xếp loại được hiển thị theo quy chế đào tạo của trường. Các chỉ số tổng kết cần được thay bằng dữ liệu và công thức chính thức của hệ thống.</div></div>
      </main>
    </div>
  </div>
</body>
</html>
