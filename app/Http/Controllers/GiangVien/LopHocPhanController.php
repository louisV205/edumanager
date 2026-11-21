<?php

namespace App\Http\Controllers\GiangVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\CourseSection;
use App\Models\Semester;

class LopHocPhanController extends Controller
{
    /**
     * Hiển thị danh sách lớp học phần được phân công cho giảng viên
     */
    public function index(Request $request)
    {
        // 1. Dữ liệu mặc định chuẩn Figma (Dùng khi chưa bật MySQL hoặc dữ liệu rỗng)
        $userName = 'Nguyễn Minh Anh';
        $userCode = 'GV00128';
        $userInitials = 'MA';
        $semesterName = 'Học kỳ 1';
        $academicYear = '2026–2027';

        $tongSoLop = 4;
        $lopCanCapNhatDiem = 2;

        $danhSachLop = [
            [
                'id' => 1,
                'class_code' => 'WEB302.01',
                'course_name' => 'Lập trình Web',
                'teacher' => 'Giảng viên: Nguyễn Minh Anh',
                'term' => 'Học kỳ 1',
                'year' => '2026–2027',
                'schedule_day' => 'Thứ Ba · 07:00–09:30',
                'room' => 'Phòng A203',
                'current_enrollment' => 42,
                'capacity' => 45,
                'grade_status' => 'Đang nhập',
                'status_class' => '',
                'grade_text' => '32 / 42 SV',
                'progress_percent' => 76,
            ],
            [
                'id' => 2,
                'class_code' => 'DBI202.03',
                'course_name' => 'Cơ sở dữ liệu',
                'teacher' => 'Giảng viên: Nguyễn Minh Anh',
                'term' => 'Học kỳ 1',
                'year' => '2026–2027',
                'schedule_day' => 'Thứ Tư · 09:45–12:15',
                'room' => 'Phòng B105',
                'current_enrollment' => 38,
                'capacity' => 40,
                'grade_status' => 'Đang nhập',
                'status_class' => '',
                'grade_text' => '24 / 38 SV',
                'progress_percent' => 63,
            ],
            [
                'id' => 3,
                'class_code' => 'WEB302.02',
                'course_name' => 'Lập trình Web',
                'teacher' => 'Giảng viên: Nguyễn Minh Anh',
                'term' => 'Học kỳ 1',
                'year' => '2026–2027',
                'schedule_day' => 'Thứ Năm · 13:00–15:30',
                'room' => 'Phòng A204',
                'current_enrollment' => 26,
                'capacity' => 35,
                'grade_status' => 'Chưa nhập',
                'status_class' => 'pending',
                'grade_text' => 'Chưa có dữ liệu',
                'progress_percent' => 0,
            ],
            [
                'id' => 4,
                'class_code' => 'SWE301.01',
                'course_name' => 'Phân tích thiết kế hệ thống',
                'teacher' => 'Giảng viên: Nguyễn Minh Anh',
                'term' => 'Học kỳ 1',
                'year' => '2026–2027',
                'schedule_day' => 'Thứ Sáu · 09:45–12:15',
                'room' => 'Phòng C202',
                'current_enrollment' => 20,
                'capacity' => 25,
                'grade_status' => 'Đã hoàn tất',
                'status_class' => 'done',
                'grade_text' => '20 / 20 SV',
                'progress_percent' => 100,
            ],
        ];

        // 2. Kết nối và lấy dữ liệu thật từ MySQL (nếu có)
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
                    $semesterName = $currentSemester->semester_name;
                    $academicYear = $currentSemester->academic_year;
                }

                // Query danh sách lớp từ CSDL
                $query = CourseSection::with(['course', 'semester', 'schedules', 'grades'])
                            ->where('lecturer_id', $lecturer->id);

                // Lọc tìm kiếm nếu có
                if ($request->filled('keyword')) {
                    $kw = $request->keyword;
                    $query->where(function ($q) use ($kw) {
                        $q->where('section_code', 'like', "%{$kw}%")
                          ->orWhereHas('course', function ($sub) use ($kw) {
                              $sub->where('course_name', 'like', "%{$kw}%");
                          });
                    });
                }

                // Lọc tình trạng điểm nếu có
                if ($request->filled('status') && $request->status !== 'Tất cả tình trạng') {
                    $query->where('grade_status', $request->status);
                }

                $sections = $query->get();

                if ($sections->count() > 0) {
                    $tongSoLop = $sections->count();
                    $lopCanCapNhatDiem = $sections->whereIn('grade_status', ['Chưa nhập', 'Đang nhập'])->count();
                    
                    $danhSachLop = [];
                    foreach ($sections as $sec) {
                        $sch = $sec->schedules->first();
                        $scheduleDay = $sch ? ($sch->day_of_week_text . ' · ' . $sch->start_time . '–' . $sch->end_time) : 'Chưa xếp lịch';
                        $room = $sch ? $sch->room : 'Chưa có phòng';

                        $enteredCount = $sec->grades->whereNotNull('midterm_score')->count();
                        $totalStudents = $sec->current_enrollment ?: 1;
                        $percent = round(($enteredCount / $totalStudents) * 100);

                        $statusClass = '';
                        if ($sec->grade_status === 'Chưa nhập') $statusClass = 'pending';
                        if ($sec->grade_status === 'Đã hoàn tất') $statusClass = 'done';

                        $gradeText = $enteredCount > 0 ? "{$enteredCount} / {$totalStudents} SV" : 'Chưa có dữ liệu';

                        $danhSachLop[] = [
                            'id' => $sec->id,
                            'class_code' => $sec->section_code,
                            'course_name' => $sec->course->course_name ?? 'Học phần',
                            'teacher' => 'Giảng viên: ' . $lecturer->fullname,
                            'term' => $sec->semester->semester_name ?? $semesterName,
                            'year' => $sec->semester->academic_year ?? $academicYear,
                            'schedule_day' => $scheduleDay,
                            'room' => $room,
                            'current_enrollment' => $sec->current_enrollment,
                            'capacity' => $sec->capacity,
                            'grade_status' => $sec->grade_status ?? 'Đang nhập',
                            'status_class' => $statusClass,
                            'grade_text' => $gradeText,
                            'progress_percent' => $percent,
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            // Fallback sang dữ liệu mẫu Figma nếu lỗi kết nối
        }

        return view('giangvien.lop-hoc-phan', compact(
            'userName',
            'userCode',
            'userInitials',
            'semesterName',
            'academicYear',
            'tongSoLop',
            'lopCanCapNhatDiem',
            'danhSachLop'
        ));
    }
}
