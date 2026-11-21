<?php

namespace App\Http\Controllers\GiangVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\CourseSection;
use App\Models\SectionSchedule;
use App\Models\Semester;

class ThoiKhoaBieuController extends Controller
{
    /**
     * Hiển thị Thời khóa biểu dạng lưới tuần của Giảng viên
     */
    public function index(Request $request)
    {
        // 1. Dữ liệu mặc định chuẩn Figma
        $userName = 'Nguyễn Minh Anh';
        $userCode = 'GV00128';
        $userInitials = 'MA';
        $semesterBadge = 'Học kỳ 1 · 2026–2027';
        $weekRange = '16 – 22 tháng 11, 2026';
        $weekDateSubtitle = 'Thứ Hai, 16/11 – Chủ Nhật, 22/11/2026';

        $buoiDayTuan = 4;
        $lopDuocPhanCong = 4;
        $lopCanCapNhatDiem = 2;

        $days = [
            ['name' => 'Thứ Hai', 'number' => 16, 'is_today' => false, 'day_of_week' => 2],
            ['name' => 'Thứ Ba', 'number' => 17, 'is_today' => false, 'day_of_week' => 3],
            ['name' => 'Thứ Tư', 'number' => 18, 'is_today' => false, 'day_of_week' => 4],
            ['name' => 'Thứ Năm', 'number' => 19, 'is_today' => false, 'day_of_week' => 5],
            ['name' => 'Thứ Sáu', 'number' => 20, 'is_today' => true,  'day_of_week' => 6],
            ['name' => 'Thứ Bảy', 'number' => 21, 'is_today' => false, 'day_of_week' => 7],
            ['name' => 'Chủ Nhật', 'number' => 22, 'is_today' => false, 'day_of_week' => 8],
        ];

        // 3 ca dạy chuẩn
        $timeSlots = [
            [
                'time_start' => '07:00',
                'time_end' => '09:30',
                'slot_key' => 'ca1',
            ],
            [
                'time_start' => '09:45',
                'time_end' => '12:15',
                'slot_key' => 'ca2',
            ],
            [
                'time_start' => '13:00',
                'time_end' => '15:30',
                'slot_key' => 'ca3',
            ],
        ];

        // Lưới các lớp học mẫu trên Figma
        $grid = [
            // Ca 1 (07:00 - 09:30)
            'ca1' => [
                3 => [ // Thứ Ba
                    'course_name' => 'Lập trình Web',
                    'section_code' => 'WEB302.01',
                    'room' => 'Phòng A203',
                    'teacher' => 'Nguyễn Minh Anh',
                    'color_class' => '', // Mặc định xanh dương
                ],
            ],
            // Ca 2 (09:45 - 12:15)
            'ca2' => [
                4 => [ // Thứ Tư
                    'course_name' => 'Cơ sở dữ liệu',
                    'section_code' => 'DBI202.03',
                    'room' => 'Phòng B105',
                    'teacher' => 'Nguyễn Minh Anh',
                    'color_class' => 'teal',
                ],
                6 => [ // Thứ Sáu (Hôm nay)
                    'course_name' => 'Phân tích thiết kế hệ thống',
                    'section_code' => 'SWE301.01',
                    'room' => 'Phòng C202',
                    'teacher' => 'Nguyễn Minh Anh',
                    'color_class' => 'purple',
                ],
            ],
            // Ca 3 (13:00 - 15:30)
            'ca3' => [
                5 => [ // Thứ Năm
                    'course_name' => 'Lập trình Web',
                    'section_code' => 'WEB302.02',
                    'room' => 'Phòng A204',
                    'teacher' => 'Nguyễn Minh Anh',
                    'color_class' => 'gold',
                ],
            ],
        ];

        $selectedSection = $request->query('section');

        $filterClasses = [
            ['code' => 'WEB302.01', 'label' => 'WEB302.01 · Lập trình Web'],
            ['code' => 'DBI202.03', 'label' => 'DBI202.03 · Cơ sở dữ liệu'],
            ['code' => 'WEB302.02', 'label' => 'WEB302.02 · Lập trình Web'],
            ['code' => 'SWE301.01', 'label' => 'SWE301.01 · Phân tích thiết kế hệ thống'],
        ];

        if ($selectedSection && $selectedSection !== 'all') {
            $filteredCount = 0;
            foreach ($grid as $slot => $daysMap) {
                foreach ($daysMap as $dow => $item) {
                    if ($item['section_code'] !== $selectedSection) {
                        unset($grid[$slot][$dow]);
                    } else {
                        $filteredCount++;
                    }
                }
            }
            $buoiDayTuan = $filteredCount;
        }

        // 2. Kết nối CSDL MySQL (nếu có)
        try {
            $user = auth()->user();
            $lecturer = null;
            if ($user && $user->lecturer) {
                $lecturer = $user->lecturer;
            } else {
                $lecturer = Lecturer::where('lecturer_code', 'GV00128')->first();
            }

            if ($lecturer) {
                $userName = $lecturer->fullname;
                $userCode = $lecturer->lecturer_code;
                $words = explode(' ', trim($userName));
                $userInitials = mb_substr($words[count($words) - 2] ?? '', 0, 1) . mb_substr(end($words), 0, 1);

                $currentSemester = Semester::where('is_active', true)->first();
                if ($currentSemester) {
                    $semesterBadge = $currentSemester->semester_name . ' · ' . $currentSemester->academic_year;
                }

                $mySections = CourseSection::with(['course', 'schedules'])
                                ->where('lecturer_id', $lecturer->id)
                                ->get();

                if ($mySections->count() > 0) {
                    $lopDuocPhanCong = $mySections->count();
                    $lopCanCapNhatDiem = CourseSection::where('lecturer_id', $lecturer->id)
                        ->whereIn('grade_status', ['Chưa nhập', 'Đang nhập'])
                        ->count();

                    // Lọc theo lớp nếu chọn
                    $selectedSection = $request->query('section');

                    // Nạp danh sách lớp cho dropdown lọc
                    $filterClasses = $mySections->map(function ($s) {
                        return [
                            'code' => $s->section_code,
                            'label' => $s->section_code . ' · ' . ($s->course->course_name ?? 'Môn học')
                        ];
                    })->toArray();

                    // Xây dựng lưới lịch dạy từ CSDL
                    $dbGrid = [
                        'ca1' => [],
                        'ca2' => [],
                        'ca3' => [],
                    ];
                    $totalSchedules = 0;
                    $colors = ['', 'teal', 'purple', 'gold'];
                    $colorIdx = 0;

                    foreach ($mySections as $sec) {
                        if ($selectedSection && $selectedSection !== 'all' && $sec->section_code !== $selectedSection) {
                            continue;
                        }

                        foreach ($sec->schedules as $sched) {
                            $dow = (int)$sched->day_of_week;
                            $st = $sched->start_time;
                            $slotKey = 'ca1';
                            if ($st >= '09:30' && $st < '12:30') {
                                $slotKey = 'ca2';
                            } elseif ($st >= '12:30') {
                                $slotKey = 'ca3';
                            }

                            $dbGrid[$slotKey][$dow] = [
                                'course_name' => $sec->course->course_name ?? 'Môn học',
                                'section_code' => $sec->section_code,
                                'room' => $sched->room ?? 'Phòng học',
                                'teacher' => $userName,
                                'color_class' => $colors[$colorIdx % count($colors)],
                            ];
                            $colorIdx++;
                            $totalSchedules++;
                        }
                    }

                    if ($totalSchedules > 0) {
                        $grid = $dbGrid;
                        $buoiDayTuan = $totalSchedules;
                    }
                }
            }
        } catch (\Exception $e) {
            // Dùng dữ liệu mẫu Figma nếu CSDL chưa kết nối
        }

        return view('giangvien.thoi-khoa-bieu', compact(
            'userName',
            'userCode',
            'userInitials',
            'semesterBadge',
            'weekRange',
            'weekDateSubtitle',
            'buoiDayTuan',
            'lopDuocPhanCong',
            'lopCanCapNhatDiem',
            'days',
            'timeSlots',
            'grid',
            'filterClasses',
            'selectedSection'
        ));
    }
}
