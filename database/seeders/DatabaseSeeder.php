<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. ROLES
        $adminRoleId = DB::table('roles')->insertGetId([
            'name' => 'admin',
            'display_name' => 'Quản trị viên / Phòng Đào tạo',
            'description' => 'Quản lý toàn bộ hệ thống đào tạo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lecturerRoleId = DB::table('roles')->insertGetId([
            'name' => 'giang_vien',
            'display_name' => 'Giảng viên',
            'description' => 'Cán bộ trực tiếp giảng dạy và đánh giá điểm số',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $studentRoleId = DB::table('roles')->insertGetId([
            'name' => 'sinh_vien',
            'display_name' => 'Sinh viên',
            'description' => 'Người học tham gia đào tạo tại trường',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $password = Hash::make('password'); // mật khẩu mặc định: password (hoặc 123456)

        // 2. USERS
        // Admin
        $adminUserId = DB::table('users')->insertGetId([
            'role_id' => $adminRoleId,
            'username' => 'ADM0001',
            'name' => 'Trần Thu Hà',
            'email' => 'tran.ha@edumanager.edu.vn',
            'password' => $password,
            'role' => 'admin',
            'phone' => '0901 000 001',
            'address' => 'Phòng Đào tạo, Tòa nhà A1',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Giảng viên 1 (Nguyễn Minh Anh)
        $gv1UserId = DB::table('users')->insertGetId([
            'role_id' => $lecturerRoleId,
            'username' => 'GV00128',
            'name' => 'Nguyễn Minh Anh',
            'email' => 'nguyen.minhanh@edumanager.edu.vn',
            'password' => $password,
            'role' => 'giang_vien',
            'phone' => '0901 234 568',
            'address' => 'Hà Nội',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Giảng viên 2 (Nguyễn Hoàng Long)
        $gv2UserId = DB::table('users')->insertGetId([
            'role_id' => $lecturerRoleId,
            'username' => 'GV00131',
            'name' => 'Nguyễn Hoàng Long',
            'email' => 'nguyen.long@edumanager.edu.vn',
            'password' => $password,
            'role' => 'giang_vien',
            'phone' => '0903 456 789',
            'address' => 'Hà Nội',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sinh viên 1 (Nguyễn An - nhân vật chính trong Figma)
        $sv1UserId = DB::table('users')->insertGetId([
            'role_id' => $studentRoleId,
            'username' => '22A10001',
            'name' => 'Nguyễn An',
            'email' => 'nguyen.an@student.edumanager.edu.vn',
            'password' => $password,
            'role' => 'sinh_vien',
            'phone' => '0901 234 567',
            'address' => 'Quận Cầu Giấy, Hà Nội',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sinh viên 2 (Lê Minh Tú)
        $sv2UserId = DB::table('users')->insertGetId([
            'role_id' => $studentRoleId,
            'username' => '22A10002',
            'name' => 'Lê Minh Tú',
            'email' => '22a10002@student.edu.vn',
            'password' => $password,
            'role' => 'sinh_vien',
            'phone' => '0902 345 678',
            'address' => 'Hà Nội',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. LECTURERS PROFILE
        $gv1Id = DB::table('lecturers')->insertGetId([
            'user_id' => $gv1UserId,
            'lecturer_code' => 'GV00128',
            'fullname' => 'Nguyễn Minh Anh',
            'dob' => '1988-08-12',
            'gender' => 'Nam',
            'pob' => 'Hà Nội',
            'academic_title' => 'Thạc sĩ',
            'position' => 'Giảng viên',
            'department' => 'Khoa Công nghệ thông tin',
            'specialization' => 'Công nghệ phần mềm',
            'office' => 'Nhà B · Phòng 402',
            'start_working_date' => '2018-09-01',
            'status' => 'Đang công tác',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $gv2Id = DB::table('lecturers')->insertGetId([
            'user_id' => $gv2UserId,
            'lecturer_code' => 'GV00131',
            'fullname' => 'Nguyễn Hoàng Long',
            'dob' => '1985-05-20',
            'gender' => 'Nam',
            'pob' => 'Hà Nội',
            'academic_title' => 'Tiến sĩ',
            'position' => 'Giảng viên chính',
            'department' => 'Khoa Công nghệ thông tin',
            'specialization' => 'Hệ thống thông tin',
            'office' => 'Nhà B · Phòng 405',
            'start_working_date' => '2015-09-01',
            'status' => 'Đang công tác',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. STUDENTS PROFILE
        $sv1Id = DB::table('students')->insertGetId([
            'user_id' => $sv1UserId,
            'student_code' => '22A10001',
            'fullname' => 'Nguyễn An',
            'dob' => '2004-09-18',
            'gender' => 'Nam',
            'pob' => 'Hà Nội',
            'classname' => '22A',
            'major' => 'Công nghệ thông tin',
            'education_level' => 'Đại học',
            'training_type' => 'Chính quy',
            'academic_year' => '2022–2026',
            'accumulated_credits' => 78,
            'total_program_credits' => 130,
            'cpa' => 3.42,
            'gpa' => 3.45,
            'status' => 'Đang theo học',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $sv2Id = DB::table('students')->insertGetId([
            'user_id' => $sv2UserId,
            'student_code' => '22A10002',
            'fullname' => 'Lê Minh Tú',
            'dob' => '2004-11-05',
            'gender' => 'Nam',
            'pob' => 'Hà Nội',
            'classname' => '22A',
            'major' => 'Công nghệ thông tin',
            'education_level' => 'Đại học',
            'training_type' => 'Chính quy',
            'academic_year' => '2022–2026',
            'accumulated_credits' => 75,
            'total_program_credits' => 130,
            'cpa' => 3.20,
            'gpa' => 3.10,
            'status' => 'Đang theo học',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 5. SEMESTERS
        $sem1Id = DB::table('semesters')->insertGetId([
            'semester_code' => 'HK1-2026-2027',
            'semester_name' => 'Học kỳ 1',
            'academic_year' => '2026–2027',
            'start_date' => '2026-09-01',
            'end_date' => '2027-01-15',
            'status' => 'Đang diễn ra',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $sem2Id = DB::table('semesters')->insertGetId([
            'semester_code' => 'HK2-2026-2027',
            'semester_name' => 'Học kỳ 2',
            'academic_year' => '2026–2027',
            'start_date' => '2027-02-01',
            'end_date' => '2027-06-30',
            'status' => 'Sắp diễn ra',
            'is_active' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 6. COURSES
        $cWeb = DB::table('courses')->insertGetId([
            'course_code' => 'WEB302',
            'course_name' => 'Lập trình Web',
            'credits' => 3,
            'course_type' => 'Học phần chuyên ngành',
            'department' => 'Khoa Công nghệ thông tin',
            'description' => 'Lập trình web hiện đại với PHP, Laravel Framework và Frontend',
            'status' => 'Đang sử dụng',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $cDb = DB::table('courses')->insertGetId([
            'course_code' => 'DBI202',
            'course_name' => 'Cơ sở dữ liệu',
            'credits' => 3,
            'course_type' => 'Học phần cơ sở ngành',
            'department' => 'Khoa Công nghệ thông tin',
            'description' => 'Thiết kế CSDL quan hệ, SQL, chuẩn hóa dữ liệu',
            'status' => 'Đang sử dụng',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $cUxd = DB::table('courses')->insertGetId([
            'course_code' => 'UXD201',
            'course_name' => 'Thiết kế giao diện',
            'credits' => 3,
            'course_type' => 'Học phần tự chọn',
            'department' => 'Khoa Công nghệ thông tin',
            'description' => 'Nguyên lý UI/UX, Wireframe, Figma và Design System',
            'status' => 'Đang sử dụng',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $cEng = DB::table('courses')->insertGetId([
            'course_code' => 'ENG301',
            'course_name' => 'Tiếng Anh chuyên ngành',
            'credits' => 2,
            'course_type' => 'Học phần bắt buộc',
            'department' => 'Khoa Công nghệ thông tin',
            'description' => 'Tiếng Anh kỹ thuật ngành Công nghệ thông tin',
            'status' => 'Đang sử dụng',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $cMat = DB::table('courses')->insertGetId([
            'course_code' => 'MAT101',
            'course_name' => 'Toán cao cấp 1',
            'credits' => 3,
            'course_type' => 'Học phần đại cương',
            'department' => 'Khoa Công nghệ thông tin',
            'description' => 'Giải tích và đại số tuyến tính',
            'status' => 'Đang sử dụng',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 7. REGISTRATION PERIOD
        $regPeriodId = DB::table('registration_periods')->insertGetId([
            'semester_id' => $sem1Id,
            'period_name' => 'Đợt đăng ký học phần học kỳ 1 năm học 2026–2027',
            'start_date' => '2026-11-18 08:00:00',
            'end_date' => '2026-11-25 23:59:00',
            'min_credits' => 12,
            'max_credits' => 30,
            'status' => 'ĐANG MỞ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 8. COURSE SECTIONS (Lớp học phần)
        // WEB302.01
        $secWebId = DB::table('course_sections')->insertGetId([
            'course_id' => $cWeb,
            'semester_id' => $sem1Id,
            'lecturer_id' => $gv1Id,
            'section_code' => 'WEB302.01',
            'capacity' => 40,
            'current_enrollment' => 18,
            'status' => 'Đang mở',
            'grade_status' => 'Đang nhập',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // DBI202.02
        $secDbId = DB::table('course_sections')->insertGetId([
            'course_id' => $cDb,
            'semester_id' => $sem1Id,
            'lecturer_id' => $gv2Id,
            'section_code' => 'DBI202.02',
            'capacity' => 35,
            'current_enrollment' => 9,
            'status' => 'Đang mở',
            'grade_status' => 'Đang nhập',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // UXD201.01
        $secUxdId = DB::table('course_sections')->insertGetId([
            'course_id' => $cUxd,
            'semester_id' => $sem1Id,
            'lecturer_id' => $gv1Id,
            'section_code' => 'UXD201.01',
            'capacity' => 30,
            'current_enrollment' => 4,
            'status' => 'Đang mở',
            'grade_status' => 'Chưa nhập',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ENG301.03
        $secEngId = DB::table('course_sections')->insertGetId([
            'course_id' => $cEng,
            'semester_id' => $sem1Id,
            'lecturer_id' => $gv2Id,
            'section_code' => 'ENG301.03',
            'capacity' => 35,
            'current_enrollment' => 22,
            'status' => 'Đang mở',
            'grade_status' => 'Đã hoàn tất',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 9. SECTION SCHEDULES
        // Thứ Ba 07:00 - 09:30 (Phòng A203)
        DB::table('section_schedules')->insert([
            'section_id' => $secWebId,
            'day_of_week' => 3,
            'day_of_week_text' => 'Thứ Ba',
            'start_period' => 1,
            'end_period' => 3,
            'start_time' => '07:00',
            'end_time' => '09:30',
            'room' => 'Phòng A203',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Thứ Tư 09:45 - 12:15 (Phòng B105)
        DB::table('section_schedules')->insert([
            'section_id' => $secDbId,
            'day_of_week' => 4,
            'day_of_week_text' => 'Thứ Tư',
            'start_period' => 4,
            'end_period' => 6,
            'start_time' => '09:45',
            'end_time' => '12:15',
            'room' => 'Phòng B105',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Thứ Năm 13:00 - 15:30 (Phòng C302)
        DB::table('section_schedules')->insert([
            'section_id' => $secUxdId,
            'day_of_week' => 5,
            'day_of_week_text' => 'Thứ Năm',
            'start_period' => 7,
            'end_period' => 9,
            'start_time' => '13:00',
            'end_time' => '15:30',
            'room' => 'Phòng C302',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Thứ Sáu 07:00 - 09:30 (Phòng A104)
        DB::table('section_schedules')->insert([
            'section_id' => $secEngId,
            'day_of_week' => 6,
            'day_of_week_text' => 'Thứ Sáu',
            'start_period' => 1,
            'end_period' => 3,
            'start_time' => '07:00',
            'end_time' => '09:30',
            'room' => 'Phòng A104',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 10. ENROLLMENTS (Nguyễn An đăng ký 4 môn)
        DB::table('enrollments')->insert([
            ['student_id' => $sv1Id, 'section_id' => $secWebId, 'registration_period_id' => $regPeriodId, 'status' => 'Đã đăng ký', 'registered_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['student_id' => $sv1Id, 'section_id' => $secDbId,  'registration_period_id' => $regPeriodId, 'status' => 'Đã đăng ký', 'registered_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['student_id' => $sv1Id, 'section_id' => $secUxdId, 'registration_period_id' => $regPeriodId, 'status' => 'Đã đăng ký', 'registered_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['student_id' => $sv1Id, 'section_id' => $secEngId, 'registration_period_id' => $regPeriodId, 'status' => 'Đã đăng ký', 'registered_at' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 11. GRADES (Khớp 100% màn Kết quả học tập trong Figma)
        // Lập trình Web: CC 9.0, GK 8.5, CK 8.8 -> Tổng kết 8.7 -> 4.0 -> A -> Đạt
        DB::table('grades')->insert([
            'student_id' => $sv1Id,
            'section_id' => $secWebId,
            'attendance_score' => 9.0,
            'midterm_score' => 8.5,
            'final_exam_score' => 8.8,
            'final_score' => 8.7,
            'gpa_score' => 4.0,
            'letter_grade' => 'A',
            'status' => 'Đạt',
            'is_locked' => false,
            'entered_by_lecturer_id' => $gv1Id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Cơ sở dữ liệu: CC 8.5, GK 8.0, CK 8.2 -> Tổng kết 8.2 -> 3.5 -> B+ -> Đạt
        DB::table('grades')->insert([
            'student_id' => $sv1Id,
            'section_id' => $secDbId,
            'attendance_score' => 8.5,
            'midterm_score' => 8.0,
            'final_exam_score' => 8.2,
            'final_score' => 8.2,
            'gpa_score' => 3.5,
            'letter_grade' => 'B+',
            'status' => 'Đạt',
            'is_locked' => false,
            'entered_by_lecturer_id' => $gv2Id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Thiết kế giao diện: CC 9.5, GK 9.0, CK Chưa công bố
        DB::table('grades')->insert([
            'student_id' => $sv1Id,
            'section_id' => $secUxdId,
            'attendance_score' => 9.5,
            'midterm_score' => 9.0,
            'final_exam_score' => null,
            'final_score' => null,
            'gpa_score' => null,
            'letter_grade' => null,
            'status' => 'Chưa công bố',
            'is_locked' => false,
            'entered_by_lecturer_id' => $gv1Id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tiếng Anh chuyên ngành: CC 8.0, GK 7.5, CK 8.0 -> Tổng kết 7.8 -> 3.0 -> B -> Đạt
        DB::table('grades')->insert([
            'student_id' => $sv1Id,
            'section_id' => $secEngId,
            'attendance_score' => 8.0,
            'midterm_score' => 7.5,
            'final_exam_score' => 8.0,
            'final_score' => 7.8,
            'gpa_score' => 3.0,
            'letter_grade' => 'B',
            'status' => 'Đạt',
            'is_locked' => true,
            'entered_by_lecturer_id' => $gv2Id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 12. NOTIFICATIONS (Khớp Figma)
        $notif1Id = DB::table('notifications')->insertGetId([
            'created_by_user_id' => $adminUserId,
            'title' => 'Mở đợt đăng ký học phần học kỳ 1 năm học 2026–2027',
            'content' => 'Phòng Đào tạo thông báo mở đợt đăng ký học phần học kỳ 1 năm học 2026–2027 từ 08:00 ngày 18/11/2026 đến 23:59 ngày 25/11/2026. Sinh viên chủ động tra cứu chương trình đào tạo và đăng ký đúng hạn.',
            'scope' => 'Sinh viên',
            'status' => 'Đã đăng',
            'published_at' => '2026-11-20 08:30:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notif2Id = DB::table('notifications')->insertGetId([
            'created_by_user_id' => $adminUserId,
            'title' => 'Lịch thi giữa kỳ đã được cập nhật trên cổng sinh viên',
            'content' => 'Khoa Công nghệ thông tin đã cập nhật lịch thi và phòng thi giữa kỳ các học phần. Sinh viên truy cập mục Lịch thi / Thông báo để kiểm tra.',
            'scope' => 'Khoa Công nghệ thông tin',
            'status' => 'Đã đăng',
            'published_at' => '2026-11-19 14:15:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notif3Id = DB::table('notifications')->insertGetId([
            'created_by_user_id' => $adminUserId,
            'title' => 'Nhắc nhở hoàn thành học phí trước thời hạn quy định',
            'content' => 'Phòng Tài chính – Kế toán nhắc nhở sinh viên hoàn tất học phí học kỳ hiện tại theo thông báo để đủ điều kiện thi kết thúc học phần.',
            'scope' => 'Sinh viên',
            'status' => 'Đã đăng',
            'published_at' => '2026-11-16 10:42:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Notification recipients for Nguyễn An
        DB::table('notification_recipients')->insert([
            ['notification_id' => $notif1Id, 'user_id' => $sv1UserId, 'is_read' => false, 'read_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['notification_id' => $notif2Id, 'user_id' => $sv1UserId, 'is_read' => false, 'read_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['notification_id' => $notif3Id, 'user_id' => $sv1UserId, 'is_read' => true,  'read_at' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
