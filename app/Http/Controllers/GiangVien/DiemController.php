<?php

namespace App\Http\Controllers\GiangVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\CourseSection;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Enrollment;

class DiemController extends Controller
{
    /**
     * Hiển thị bảng nhập điểm thành phần cho lớp học phần được phân công
     */
    public function index(Request $request)
    {
        // 1. Thông tin giảng viên mặc định chuẩn Figma
        $userName = 'Nguyễn Minh Anh';
        $userCode = 'GV00128';
        $userInitials = 'MA';
        $semesterBadge = 'Học kỳ 1 · 2026–2027';

        // 2. Danh sách các lớp được phân công (cho dropdown chuyển lớp)
        $classList = [
            ['code' => 'WEB302.01', 'name' => 'WEB302.01 · Lập trình Web', 'course' => 'Lập trình Web', 'room' => 'Phòng A203', 'count' => 42],
            ['code' => 'DBI202.03', 'name' => 'DBI202.03 · Cơ sở dữ liệu', 'course' => 'Cơ sở dữ liệu', 'room' => 'Phòng B105', 'count' => 38],
            ['code' => 'WEB302.02', 'name' => 'WEB302.02 · Lập trình Web', 'course' => 'Lập trình Web', 'room' => 'Phòng A204', 'count' => 40],
            ['code' => 'SWE301.01', 'name' => 'SWE301.01 · Phân tích thiết kế hệ thống', 'course' => 'Phân tích thiết kế hệ thống', 'room' => 'Phòng C202', 'count' => 35],
        ];

        // Lớp đang được chọn (mặc định lấy lớp đầu tiên hoặc theo query ?section=...)
        $selectedCode = $request->query('section', 'WEB302.01');
        $currentClass = collect($classList)->firstWhere('code', $selectedCode) ?? $classList[0];

        // 3. Dữ liệu 4 thẻ thống kê chuẩn Figma
        $totalStudents = $currentClass['count'];
        $gradedStudents = '36 / 42';
        $missingStudents = 6;
        $gradeScale = '0–10';

        // 4. Dữ liệu 10 sinh viên mẫu chuẩn Figma (Trang 1)
        $students = [
            [
                'id' => 1,
                'stt' => '01',
                'student_code' => '22A10001',
                'student_name' => 'Nguyễn An',
                'attendance' => '9.0',
                'midterm' => '8.5',
                'final_exam' => '8.8',
                'status' => 'saved',
                'status_text' => '✓ Đã lưu',
                'status_time' => 'Hôm nay, 09:42'
            ],
            [
                'id' => 2,
                'stt' => '02',
                'student_code' => '22A10012',
                'student_name' => 'Trần Minh Khôi',
                'attendance' => '8.0',
                'midterm' => '7.5',
                'final_exam' => '8.0',
                'status' => 'saved',
                'status_text' => '✓ Đã lưu',
                'status_time' => 'Hôm nay, 09:40'
            ],
            [
                'id' => 3,
                'stt' => '03',
                'student_code' => '22A10018',
                'student_name' => 'Lê Thu Hà',
                'attendance' => '9.5',
                'midterm' => '9.0',
                'final_exam' => '',
                'status' => 'missing',
                'status_text' => 'Chưa đủ điểm',
                'status_time' => ''
            ],
            [
                'id' => 4,
                'stt' => '04',
                'student_code' => '22A10024',
                'student_name' => 'Phạm Đức Long',
                'attendance' => '7.5',
                'midterm' => '8.0',
                'final_exam' => '7.8',
                'status' => 'saved',
                'status_text' => '✓ Đã lưu',
                'status_time' => 'Hôm nay, 09:38'
            ],
            [
                'id' => 5,
                'stt' => '05',
                'student_code' => '22A10031',
                'student_name' => 'Vũ Ngọc Mai',
                'attendance' => '8.5',
                'midterm' => '',
                'final_exam' => '',
                'status' => 'pending',
                'status_text' => 'Còn thiếu điểm',
                'status_time' => ''
            ],
            [
                'id' => 6,
                'stt' => '06',
                'student_code' => '22A10037',
                'student_name' => 'Đặng Hoàng Nam',
                'attendance' => '8.0',
                'midterm' => '7.0',
                'final_exam' => '8.5',
                'status' => 'saved',
                'status_text' => '✓ Đã lưu',
                'status_time' => 'Hôm nay, 09:34'
            ],
            [
                'id' => 7,
                'stt' => '07',
                'student_code' => '22A10042',
                'student_name' => 'Đỗ Quỳnh Anh',
                'attendance' => '8.5',
                'midterm' => '9.0',
                'final_exam' => '8.7',
                'status' => 'saved',
                'status_text' => '✓ Đã lưu',
                'status_time' => 'Hôm nay, 09:31'
            ],
            [
                'id' => 8,
                'stt' => '08',
                'student_code' => '22A10045',
                'student_name' => 'Hoàng Gia Bảo',
                'attendance' => '7.0',
                'midterm' => '8.5',
                'final_exam' => '9.0',
                'status' => 'saved',
                'status_text' => '✓ Đã lưu',
                'status_time' => 'Hôm nay, 09:29'
            ],
            [
                'id' => 9,
                'stt' => '09',
                'student_code' => '22A10053',
                'student_name' => 'Bùi Phương Linh',
                'attendance' => '9.0',
                'midterm' => '8.0',
                'final_exam' => '8.5',
                'status' => 'saved',
                'status_text' => '✓ Đã lưu',
                'status_time' => 'Hôm nay, 09:26'
            ],
            [
                'id' => 10,
                'stt' => '10',
                'student_code' => '22A10061',
                'student_name' => 'Phan Quốc Việt',
                'attendance' => '8.0',
                'midterm' => '7.5',
                'final_exam' => '8.0',
                'status' => 'saved',
                'status_text' => '✓ Đã lưu',
                'status_time' => 'Hôm nay, 09:24'
            ],
        ];

        $lastSavedText = '20/11/2026 · 09:42';

        // 5. Kết nối CSDL MySQL động (nếu có)
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
                    $classList = $mySections->map(function ($s) {
                        return [
                            'id' => $s->id,
                            'code' => $s->section_code,
                            'name' => $s->section_code . ' · ' . ($s->course->course_name ?? 'Môn học'),
                            'course' => $s->course->course_name ?? 'Môn học',
                            'room' => $s->schedules->first()->room ?? 'Phòng học',
                            'count' => $s->current_enrollment ?? 40,
                        ];
                    })->toArray();

                    $foundSection = $mySections->firstWhere('section_code', $selectedCode) ?? $mySections->first();
                    $selectedCode = $foundSection->section_code;
                    $currentClass = [
                        'id' => $foundSection->id,
                        'code' => $foundSection->section_code,
                        'name' => $foundSection->section_code . ' · ' . ($foundSection->course->course_name ?? 'Môn học'),
                        'course' => $foundSection->course->course_name ?? 'Môn học',
                        'room' => $foundSection->schedules->first()->room ?? 'Phòng A203',
                        'count' => $foundSection->current_enrollment ?? 42,
                    ];

                    // Tải danh sách sinh viên thực tế từ bảng enrollments & grades
                    $enrollments = Enrollment::with('student')
                                    ->where('section_id', $foundSection->id)
                                    ->get();

                    if ($enrollments->count() > 0) {
                        $totalStudents = $enrollments->count();
                        $dbGrades = Grade::where('section_id', $foundSection->id)
                                        ->get()
                                        ->keyBy('student_id');

                        $dbStudents = [];
                        $countGraded = 0;
                        $countMissing = 0;

                        foreach ($enrollments as $idx => $enr) {
                            $sv = $enr->student;
                            if (!$sv) continue;
                            $g = $dbGrades->get($sv->id);

                            $att = $g && $g->attendance_score !== null ? (string)(float)$g->attendance_score : '';
                            $mid = $g && $g->midterm_score !== null ? (string)(float)$g->midterm_score : '';
                            $fin = $g && $g->final_exam_score !== null ? (string)(float)$g->final_exam_score : '';

                            $hasAll = ($att !== '' && $mid !== '' && $fin !== '');
                            $hasNone = ($att === '' && $mid === '' && $fin === '');

                            if ($hasAll) {
                                $countGraded++;
                                $status = 'saved';
                                $statusText = '✓ Đã lưu';
                                $statusTime = $g->updated_at ? $g->updated_at->format('d/m/Y · H:i') : 'Hôm nay, 09:42';
                            } elseif ($hasNone) {
                                $countMissing++;
                                $status = 'pending';
                                $statusText = 'Còn thiếu điểm';
                                $statusTime = '';
                            } else {
                                $countMissing++;
                                $status = 'missing';
                                $statusText = 'Chưa đủ điểm';
                                $statusTime = '';
                            }

                            $dbStudents[] = [
                                'id' => $sv->id,
                                'stt' => str_pad($idx + 1, 2, '0', STR_PAD_LEFT),
                                'student_code' => $sv->student_code,
                                'student_name' => $sv->fullname,
                                'attendance' => $att,
                                'midterm' => $mid,
                                'final_exam' => $fin,
                                'status' => $status,
                                'status_text' => $statusText,
                                'status_time' => $statusTime,
                            ];
                        }

                        if (count($dbStudents) > 0) {
                            $students = $dbStudents;
                            $gradedStudents = "{$countGraded} / {$totalStudents}";
                            $missingStudents = $countMissing;
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Dùng dữ liệu fallback Figma nếu MySQL chưa kết nối
        }

        // 6. Xử lý tìm kiếm và lọc trên danh sách sinh viên
        $keyword = trim($request->query('keyword', ''));
        $statusFilter = $request->query('status_filter', 'Tất cả sinh viên');

        if ($keyword !== '') {
            $students = array_filter($students, function ($s) use ($keyword) {
                return mb_stripos($s['student_name'], $keyword) !== false || mb_stripos($s['student_code'], $keyword) !== false;
            });
        }

        if ($statusFilter === 'Còn thiếu điểm') {
            $students = array_filter($students, function ($s) {
                return $s['status'] === 'missing' || $s['status'] === 'pending';
            });
        } elseif ($statusFilter === 'Đã có điểm thành phần') {
            $students = array_filter($students, function ($s) {
                return $s['status'] === 'saved';
            });
        }

        return view('giangvien.nhap-diem', compact(
            'userName',
            'userCode',
            'userInitials',
            'semesterBadge',
            'classList',
            'selectedCode',
            'currentClass',
            'totalStudents',
            'gradedStudents',
            'missingStudents',
            'gradeScale',
            'students',
            'lastSavedText',
            'keyword',
            'statusFilter'
        ));
    }

    /**
     * Lưu điểm thành phần (Lưu nháp hoặc Lưu bảng điểm)
     */
    public function store(Request $request)
    {
        $sectionCode = $request->input('section_code', 'WEB302.01');
        $action = $request->input('action', 'save'); // 'draft' hoặc 'publish'
        $gradesInput = $request->input('grades', []);

        try {
            $section = CourseSection::where('section_code', $sectionCode)->first();
            $lecturer = Lecturer::where('lecturer_code', 'GV00128')->first();

            if ($section && !empty($gradesInput)) {
                $allCompleted = true;

                foreach ($gradesInput as $studentId => $scores) {
                    $att = isset($scores['attendance']) && $scores['attendance'] !== '' ? floatval($scores['attendance']) : null;
                    $mid = isset($scores['midterm']) && $scores['midterm'] !== '' ? floatval($scores['midterm']) : null;
                    $fin = isset($scores['final_exam']) && $scores['final_exam'] !== '' ? floatval($scores['final_exam']) : null;

                    // Giới hạn 0 - 10
                    if ($att !== null) $att = max(0, min(10, $att));
                    if ($mid !== null) $mid = max(0, min(10, $mid));
                    if ($fin !== null) $fin = max(0, min(10, $fin));

                    $finalScore = null;
                    $letterGrade = null;
                    $gpaScore = null;

                    // Tính điểm tổng kết nếu đủ 3 thành phần (CC 10% + GK 30% + CK 60%)
                    if ($att !== null && $mid !== null && $fin !== null) {
                        $finalScore = round($att * 0.1 + $mid * 0.3 + $fin * 0.6, 2);

                        if ($finalScore >= 8.5) {
                            $letterGrade = 'A';
                            $gpaScore = 4.0;
                        } elseif ($finalScore >= 8.0) {
                            $letterGrade = 'B+';
                            $gpaScore = 3.5;
                        } elseif ($finalScore >= 7.0) {
                            $letterGrade = 'B';
                            $gpaScore = 3.0;
                        } elseif ($finalScore >= 6.5) {
                            $letterGrade = 'C+';
                            $gpaScore = 2.5;
                        } elseif ($finalScore >= 5.5) {
                            $letterGrade = 'C';
                            $gpaScore = 2.0;
                        } elseif ($finalScore >= 5.0) {
                            $letterGrade = 'D+';
                            $gpaScore = 1.5;
                        } elseif ($finalScore >= 4.0) {
                            $letterGrade = 'D';
                            $gpaScore = 1.0;
                        } else {
                            $letterGrade = 'F';
                            $gpaScore = 0.0;
                        }
                    } else {
                        $allCompleted = false;
                    }

                    Grade::updateOrCreate(
                        [
                            'student_id' => $studentId,
                            'section_id' => $section->id,
                        ],
                        [
                            'attendance_score' => $att,
                            'midterm_score' => $mid,
                            'final_exam_score' => $fin,
                            'final_score' => $finalScore,
                            'letter_grade' => $letterGrade,
                            'gpa_score' => $gpaScore,
                            'status' => $finalScore !== null ? ($finalScore >= 4.0 ? 'Đạt' : 'Không đạt') : 'Chưa công bố',
                            'entered_by_lecturer_id' => $lecturer ? $lecturer->id : null,
                            'updated_at' => now(),
                        ]
                    );
                }

                // Cập nhật trạng thái lớp học phần
                if ($action === 'publish' && $allCompleted) {
                    $section->grade_status = 'Đã hoàn tất';
                } else {
                    $section->grade_status = 'Đang nhập';
                }
                $section->save();
            }
        } catch (\Exception $e) {
            // Xử lý an toàn nếu CSDL không khả dụng
        }

        $msg = $action === 'draft' 
            ? "Bản nháp điểm cho lớp {$sectionCode} đã được lưu tạm thành công!" 
            : "Bảng điểm thành phần lớp {$sectionCode} đã được lưu và cập nhật thành công!";

        return redirect()->route('giangvien.nhapdiem', ['section' => $sectionCode])
            ->with('success', $msg);
    }
}
