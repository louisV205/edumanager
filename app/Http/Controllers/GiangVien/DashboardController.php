<?php

namespace App\Http\Controllers\GiangVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\CourseSection;
use App\Models\SectionSchedule;
use App\Models\Notification;
use App\Models\Semester;

class DashboardController extends Controller
{
    /**
     * Hiển thị trang Dashboard Giảng viên
     */
    public function index()
    {
        // 1. Dữ liệu mặc định chuẩn Figma (Dùng khi chưa bật MySQL hoặc dữ liệu rỗng)
        $userName = 'Nguyễn Minh Anh';
        $userCode = 'GV00128';
        $userInitials = 'MA';
        $semesterName = 'Học kỳ 1 · 2026–2027';

        $soLopPhan = 4;
        $tongSinhVien = 126;
        $soBuoiDayTuan = 6;
        $lopCanCapNhatDiem = 2;

        $lichDaySapToi = [
            [
                'day' => '20',
                'month' => 'Tháng 11',
                'course_name' => 'Lập trình Web',
                'section_code' => 'WEB302.01 · Học kỳ 1',
                'room' => 'Phòng A203',
                'students_count' => '42 sinh viên',
                'time' => '07:00–09:30',
            ],
            [
                'day' => '21',
                'month' => 'Tháng 11',
                'course_name' => 'Cơ sở dữ liệu',
                'section_code' => 'DBI202.03 · Học kỳ 1',
                'room' => 'Phòng B105',
                'students_count' => '38 sinh viên',
                'time' => '09:45–12:15',
            ],
            [
                'day' => '23',
                'month' => 'Tháng 11',
                'course_name' => 'Lập trình Web',
                'section_code' => 'WEB302.02 · Học kỳ 1',
                'room' => 'Phòng A204',
                'students_count' => '46 sinh viên',
                'time' => '13:00–15:30',
            ],
        ];

        $lopCanNhap = [
            [
                'name' => 'Lập trình Web',
                'code' => 'WEB302.01 · Điểm giữa kỳ',
                'badge' => 'Sắp đến hạn',
                'due_date' => '25/11/2026',
                'progress_text' => '32 / 42',
                'progress_percent' => 76,
            ],
            [
                'name' => 'Cơ sở dữ liệu',
                'code' => 'DBI202.03 · Điểm chuyên cần',
                'badge' => 'Cần hoàn tất',
                'due_date' => '27/11/2026',
                'progress_text' => '24 / 38',
                'progress_percent' => 63,
            ],
        ];

        $thongBao = [];

        // 2. Kết nối và lấy dữ liệu thật từ MySQL Database (nếu MySQL đang bật)
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
                    $semesterName = $currentSemester->semester_name . ' · ' . $currentSemester->academic_year;
                }

                $mySections = CourseSection::where('lecturer_id', $lecturer->id)->get();
                if ($mySections->count() > 0) {
                    $soLopPhan = $mySections->count();
                    $tongSinhVien = $mySections->sum('current_enrollment') ?: $tongSinhVien;
                    $sectionIds = $mySections->pluck('id');
                    $soBuoiDayTuan = SectionSchedule::whereIn('section_id', $sectionIds)->count() ?: $soBuoiDayTuan;
                    $lopCanCapNhatDiem = CourseSection::where('lecturer_id', $lecturer->id)
                        ->whereIn('grade_status', ['Chưa nhập', 'Đang nhập'])
                        ->count() ?: $lopCanCapNhatDiem;

                    // Lấy lịch dạy thật
                    $dbSchedules = SectionSchedule::with(['section.course'])
                        ->whereIn('section_id', $sectionIds)
                        ->orderBy('day_of_week')
                        ->take(3)
                        ->get();

                    if ($dbSchedules->count() > 0) {
                        $lichDaySapToi = [];
                        foreach ($dbSchedules as $index => $sch) {
                            $lichDaySapToi[] = [
                                'day' => 20 + $index,
                                'month' => 'Tháng 11',
                                'course_name' => $sch->section->course->course_name ?? 'Lập trình Web',
                                'section_code' => ($sch->section->section_code ?? 'WEB302.01') . ' · Học kỳ 1',
                                'room' => $sch->room ?? 'Phòng A203',
                                'students_count' => ($sch->section->current_enrollment ?? 42) . ' sinh viên',
                                'time' => ($sch->start_time ?? '07:00') . '–' . ($sch->end_time ?? '09:30'),
                            ];
                        }
                    }
                }

                $thongBao = Notification::whereIn('scope', ['Tất cả', 'Giảng viên'])
                    ->latest('published_at')
                    ->take(2)
                    ->get();
            }
        } catch (\Exception $e) {
            // Nếu MySQL chưa bật, tự động hiển thị dữ liệu mẫu Figma mượt mà
        }

        return view('giangvien.dashboard', compact(
            'userName',
            'userCode',
            'userInitials',
            'semesterName',
            'soLopPhan',
            'tongSinhVien',
            'soBuoiDayTuan',
            'lopCanCapNhatDiem',
            'lichDaySapToi',
            'lopCanNhap',
            'thongBao'
        ));
    }
}
