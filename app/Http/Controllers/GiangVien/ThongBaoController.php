<?php

namespace App\Http\Controllers\GiangVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\Semester;
use App\Models\Notification;

class ThongBaoController extends Controller
{
    /**
     * Hiển thị danh sách và chi tiết thông báo giảng viên
     */
    public function index(Request $request)
    {
        // 1. Thông tin giảng viên mặc định chuẩn Figma
        $userName = 'Nguyễn Minh Anh';
        $userCode = 'GV00128';
        $userInitials = 'MA';
        $semesterBadge = 'Học kỳ 1 · 2026–2027';

        // 2. Danh sách 10 thông báo mẫu chuẩn Figma
        $allNotices = [
            [
                'id' => 1,
                'title' => 'Nhắc hạn hoàn tất điểm giữa kỳ',
                'sender' => 'Phòng Đào tạo',
                'sender_initials' => 'ĐT',
                'sender_scope' => 'Gửi đến giảng viên',
                'date' => '20/11/2026 · 08:30',
                'date_full' => '20/11/2026 lúc 08:30',
                'group' => 'HÔM NAY',
                'is_unread' => true,
                'is_archived' => false,
                'tag' => 'Nhập điểm',
                'snippet' => 'Vui lòng hoàn tất và rà soát điểm giữa kỳ của các lớp được phân công trước thời hạn khóa điểm.',
                'content_paragraphs' => [
                    'Phòng Đào tạo nhắc giảng viên hoàn tất và rà soát điểm giữa kỳ cho các lớp học phần được phân công.',
                    'Vui lòng kiểm tra các ô điểm còn thiếu, đảm bảo điểm nằm trong phạm vi cho phép và lưu bảng điểm trước thời hạn.',
                ],
                'related_course' => [
                    'title' => 'Lớp học phần',
                    'name' => 'WEB302.01 · Lập trình Web',
                    'due' => 'Hạn cập nhật: 25/11/2026',
                    'link' => url('/giang-vien/nhap-diem?section=WEB302.01'),
                ],
                'action_link' => url('/giang-vien/nhap-diem?section=WEB302.01'),
                'action_text' => 'Mở bảng nhập điểm',
            ],
            [
                'id' => 2,
                'title' => 'Kế hoạch khóa điểm học kỳ 1',
                'sender' => 'Phòng Đào tạo',
                'sender_initials' => 'ĐT',
                'sender_scope' => 'Gửi đến giảng viên',
                'date' => '19/11/2026 · 15:10',
                'date_full' => '19/11/2026 lúc 15:10',
                'group' => 'TUẦN NÀY',
                'is_unread' => true,
                'is_archived' => false,
                'tag' => 'Đào tạo',
                'snippet' => 'Giảng viên hoàn tất điểm thành phần theo lịch công bố. Vui lòng kiểm tra các mốc thời gian áp dụng cho lớp phụ trách.',
                'content_paragraphs' => [
                    'Phòng Đào tạo thông báo kế hoạch khóa sổ điểm học kỳ 1 năm học 2026–2027.',
                    'Giảng viên hoàn tất nhập điểm thành phần theo lịch công bố. Sau thời gian này, hệ thống sẽ tự động khóa sổ điểm.',
                ],
                'related_course' => null,
                'action_link' => url('/giang-vien/lop-hoc-phan'),
                'action_text' => 'Xem danh sách lớp',
            ],
            [
                'id' => 3,
                'title' => 'Lịch họp chuyên môn tuần tới',
                'sender' => 'Khoa Công nghệ thông tin',
                'sender_initials' => 'CN',
                'sender_scope' => 'Gửi đến giảng viên trong khoa',
                'date' => '18/11/2026 · 09:20',
                'date_full' => '18/11/2026 lúc 09:20',
                'group' => 'TUẦN NÀY',
                'is_unread' => true,
                'is_archived' => false,
                'tag' => 'Họp chuyên môn',
                'snippet' => 'Thời gian và nội dung cuộc họp chuyên môn đã được cập nhật. Vui lòng xem chi tiết trong thông báo.',
                'content_paragraphs' => [
                    'Khoa Công nghệ thông tin tổ chức cuộc họp chuyên môn đánh giá tiến độ giảng dạy học kỳ 1 và thống nhất ma trận đề thi kết thúc học phần.',
                    'Thời gian: 14:00 Thứ Ba tuần tới tại Văn phòng Khoa (Nhà B · Phòng 402).',
                ],
                'related_course' => null,
                'action_link' => null,
                'action_text' => null,
            ],
            [
                'id' => 4,
                'title' => 'Cập nhật sĩ số lớp WEB302.01',
                'sender' => 'EduManager',
                'sender_initials' => 'EM',
                'sender_scope' => 'Thông báo hệ thống',
                'date' => '18/11/2026 · 08:45',
                'date_full' => '18/11/2026 lúc 08:45',
                'group' => 'TUẦN NÀY',
                'is_unread' => false,
                'is_archived' => false,
                'tag' => 'Sĩ số',
                'snippet' => 'Danh sách sinh viên của lớp học phần đã được đồng bộ. Mở danh sách lớp để xem sĩ số mới nhất.',
                'content_paragraphs' => [
                    'Hệ thống EduManager đã hoàn tất đồng bộ danh sách sinh viên sau đợt đăng ký học phần bổ sung.',
                    'Sĩ số hiện tại của lớp WEB302.01 là 42 sinh viên.',
                ],
                'related_course' => [
                    'title' => 'Lớp học phần',
                    'name' => 'WEB302.01 · Lập trình Web',
                    'due' => 'Sĩ số hiện tại: 42 sinh viên',
                    'link' => url('/giang-vien/lop-hoc-phan'),
                ],
                'action_link' => url('/giang-vien/lop-hoc-phan'),
                'action_text' => 'Xem danh sách lớp',
            ],
            [
                'id' => 5,
                'title' => 'Điều chỉnh phòng học lớp DBI202.03',
                'sender' => 'Phòng Đào tạo',
                'sender_initials' => 'ĐT',
                'sender_scope' => 'Gửi đến giảng viên phụ trách',
                'date' => '17/11/2026 · 11:10',
                'date_full' => '17/11/2026 lúc 11:10',
                'group' => 'TUẦN NÀY',
                'is_unread' => false,
                'is_archived' => false,
                'tag' => 'Thời khóa biểu',
                'snippet' => 'Phòng học của lớp được cập nhật. Vui lòng kiểm tra lại thời khóa biểu giảng dạy.',
                'content_paragraphs' => [
                    'Phòng học của lớp DBI202.03 (Cơ sở dữ liệu) đã được chuyển từ phòng C301 sang phòng B105 để phục vụ bảo trì trang thiết bị.',
                    'Thời khóa biểu mới áp dụng bắt đầu từ tuần này.',
                ],
                'related_course' => [
                    'title' => 'Thời khóa biểu',
                    'name' => 'DBI202.03 · Thứ Tư · Ca 2 (09:45 – 12:15)',
                    'due' => 'Phòng học mới: B105',
                    'link' => url('/giang-vien/thoi-khoa-bieu?section=DBI202.03'),
                ],
                'action_link' => url('/giang-vien/thoi-khoa-bieu?section=DBI202.03'),
                'action_text' => 'Xem trên Thời khóa biểu',
            ],
            [
                'id' => 6,
                'title' => 'Rà soát điểm thành phần trước khi lưu',
                'sender' => 'EduManager',
                'sender_initials' => 'EM',
                'sender_scope' => 'Hệ thống hỗ trợ',
                'date' => '16/11/2026 · 10:42',
                'date_full' => '16/11/2026 lúc 10:42',
                'group' => 'TUẦN NÀY',
                'is_unread' => false,
                'is_archived' => false,
                'tag' => 'Hướng dẫn',
                'snippet' => 'Kiểm tra điểm nhập trong khoảng 0–10 và hoàn tất các ô còn thiếu trước khi lưu bảng điểm.',
                'content_paragraphs' => [
                    'Khi thực hiện nhập điểm, giảng viên có thể dùng chức năng Lưu nháp để tiếp tục chỉnh sửa bất kỳ lúc nào.',
                    'Trước khi chọn Lưu bảng điểm chính thức, vui lòng rà soát đầy đủ các cột Chuyên cần, Giữa kỳ và Cuối kỳ.',
                ],
                'related_course' => null,
                'action_link' => url('/giang-vien/nhap-diem'),
                'action_text' => 'Mở sổ nhập điểm',
            ],
            [
                'id' => 7,
                'title' => 'Phân công giảng dạy học kỳ 1',
                'sender' => 'Phòng Đào tạo',
                'sender_initials' => 'ĐT',
                'sender_scope' => 'Gửi đến giảng viên',
                'date' => '15/11/2026 · 08:00',
                'date_full' => '15/11/2026 lúc 08:00',
                'group' => 'TRƯỚC ĐÓ',
                'is_unread' => false,
                'is_archived' => false,
                'tag' => 'Phân công',
                'snippet' => 'Danh sách lớp học phần được phân công đã có trên hệ thống EduManager.',
                'content_paragraphs' => [
                    'Phòng Đào tạo đã hoàn thành phân công giảng dạy cho học kỳ 1 năm học 2026–2027.',
                    'Giảng viên kiểm tra các lớp học phần và thời khóa biểu được phân công trong không gian giảng viên.',
                ],
                'related_course' => null,
                'action_link' => url('/giang-vien/lop-hoc-phan'),
                'action_text' => 'Xem lớp phân công',
            ],
            [
                'id' => 8,
                'title' => 'Thông báo lịch dự giờ',
                'sender' => 'Khoa Công nghệ thông tin',
                'sender_initials' => 'CN',
                'sender_scope' => 'Gửi đến giảng viên',
                'date' => '12/11/2026 · 13:30',
                'date_full' => '12/11/2026 lúc 13:30',
                'group' => 'TRƯỚC ĐÓ',
                'is_unread' => false,
                'is_archived' => false,
                'tag' => 'Dự giờ',
                'snippet' => 'Lịch dự giờ trong tháng đã được gửi đến giảng viên. Vui lòng kiểm tra lớp và thời gian được phân công.',
                'content_paragraphs' => [
                    'Khoa CNTT thông báo kế hoạch dự giờ định kỳ nhằm nâng cao chất lượng giảng dạy trong tháng 11/2026.',
                ],
                'related_course' => null,
                'action_link' => null,
                'action_text' => null,
            ],
            [
                'id' => 9,
                'title' => 'Hướng dẫn sử dụng sổ nhập điểm',
                'sender' => 'EduManager',
                'sender_initials' => 'EM',
                'sender_scope' => 'Hỗ trợ kỹ thuật',
                'date' => '09/11/2026 · 16:00',
                'date_full' => '09/11/2026 lúc 16:00',
                'group' => 'TRƯỚC ĐÓ',
                'is_unread' => false,
                'is_archived' => false,
                'tag' => 'Hướng dẫn',
                'snippet' => 'Tài liệu hướng dẫn nhập, lưu nháp và rà soát điểm thành phần đã được cập nhật.',
                'content_paragraphs' => [
                    'Sổ nhập điểm phiên bản mới cho phép giảng viên nhập điểm theo thời gian thực và tự động đồng bộ.',
                ],
                'related_course' => null,
                'action_link' => url('/giang-vien/nhap-diem'),
                'action_text' => 'Thử nghiệm nhập điểm',
            ],
            [
                'id' => 10,
                'title' => 'Mở quyền truy cập lớp học phần',
                'sender' => 'Phòng Đào tạo',
                'sender_initials' => 'ĐT',
                'sender_scope' => 'Gửi đến giảng viên',
                'date' => '02/11/2026 · 08:00',
                'date_full' => '02/11/2026 lúc 08:00',
                'group' => 'TRƯỚC ĐÓ',
                'is_unread' => false,
                'is_archived' => false,
                'tag' => 'Học vụ',
                'snippet' => 'Các lớp học phần đã được phân công sẵn sàng để giảng viên theo dõi danh sách và lịch học.',
                'content_paragraphs' => [
                    'Hệ thống đã kích hoạt quyền truy cập lớp học phần cho toàn bộ giảng viên cơ hữu và thỉnh giảng.',
                ],
                'related_course' => null,
                'action_link' => url('/giang-vien/lop-hoc-phan'),
                'action_text' => 'Xem lớp phân công',
            ],
        ];

        // 3. Đọc trạng thái đã đọc từ session (hoặc CSDL)
        $readIds = session('read_notice_ids', []);
        foreach ($allNotices as &$n) {
            if (in_array($n['id'], $readIds)) {
                $n['is_unread'] = false;
            }
        }
        unset($n);

        // 4. Lọc theo Tab
        $currentTab = $request->query('tab', 'all');
        $filteredNotices = $allNotices;

        if ($currentTab === 'unread') {
            $filteredNotices = array_filter($filteredNotices, fn($n) => $n['is_unread']);
        } elseif ($currentTab === 'read') {
            $filteredNotices = array_filter($filteredNotices, fn($n) => !$n['is_unread']);
        } elseif ($currentTab === 'archived') {
            $filteredNotices = array_filter($filteredNotices, fn($n) => $n['is_archived']);
        }

        // 5. Tìm kiếm theo keyword
        $keyword = trim($request->query('keyword', ''));
        if ($keyword !== '') {
            $filteredNotices = array_filter($filteredNotices, function ($n) use ($keyword) {
                return mb_stripos($n['title'], $keyword) !== false || mb_stripos($n['snippet'], $keyword) !== false || mb_stripos($n['sender'], $keyword) !== false;
            });
        }

        // 6. Nhóm thông báo theo thời gian (HÔM NAY, TUẦN NÀY, TRƯỚC ĐÓ)
        $groupedNotices = [];
        foreach ($filteredNotices as $n) {
            $grp = $n['group'];
            if (!isset($groupedNotices[$grp])) {
                $groupedNotices[$grp] = [];
            }
            $groupedNotices[$grp][] = $n;
        }

        // 7. Thông báo được chọn xem chi tiết bên phải
        $selectedId = intval($request->query('id', 1));
        $selectedNotice = collect($allNotices)->firstWhere('id', $selectedId) ?? $allNotices[0];

        // 8. Đếm số thông báo
        $totalCount = count($allNotices);
        $unreadCount = count(array_filter($allNotices, fn($n) => $n['is_unread']));

        return view('giangvien.thong-bao', compact(
            'userName',
            'userCode',
            'userInitials',
            'semesterBadge',
            'currentTab',
            'keyword',
            'groupedNotices',
            'selectedNotice',
            'selectedId',
            'totalCount',
            'unreadCount'
        ));
    }

    /**
     * Đánh dấu 1 thông báo đã đọc
     */
    public function markRead(Request $request, $id)
    {
        $readIds = session('read_notice_ids', []);
        if (!in_array($id, $readIds)) {
            $readIds[] = intval($id);
            session(['read_notice_ids' => $readIds]);
        }

        return redirect()->route('giangvien.thongbao', ['id' => $id])
            ->with('success', 'Đã đánh dấu thông báo là đã đọc.');
    }

    /**
     * Đánh dấu tất cả thông báo là đã đọc
     */
    public function markAllRead(Request $request)
    {
        $allIds = range(1, 10);
        session(['read_notice_ids' => $allIds]);

        return redirect()->route('giangvien.thongbao')
            ->with('success', 'Đã đánh dấu tất cả thông báo là đã đọc.');
    }
}
