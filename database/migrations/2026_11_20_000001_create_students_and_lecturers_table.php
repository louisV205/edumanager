<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('student_code')->unique(); // e.g. 22A10001
            $table->string('fullname');
            $table->date('dob')->nullable();
            $table->string('gender', 10)->default('Nam');
            $table->string('pob')->nullable(); // Nơi sinh (Hà Nội, ...)
            $table->string('classname')->default('22A'); // Lớp sinh hoạt
            $table->string('major')->default('Công nghệ thông tin'); // Ngành học
            $table->string('education_level')->default('Đại học'); // Bậc đào tạo
            $table->string('training_type')->default('Chính quy'); // Loại hình đào tạo
            $table->string('academic_year')->default('2022–2026'); // Khóa học
            $table->integer('accumulated_credits')->default(0); // Tín chỉ tích lũy (ví dụ 78 / 130)
            $table->integer('total_program_credits')->default(130);
            $table->decimal('cpa', 3, 2)->default(0.00); // Điểm tích lũy CPA hệ 4
            $table->decimal('gpa', 3, 2)->default(0.00); // Điểm trung bình học kỳ GPA hệ 4
            $table->string('status')->default('Đang theo học'); // 'Đang theo học', 'Bảo lưu', 'Đã tốt nghiệp'
            $table->timestamps();
        });

        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('lecturer_code')->unique(); // e.g. GV00128
            $table->string('fullname');
            $table->date('dob')->nullable();
            $table->string('gender', 10)->default('Nam');
            $table->string('pob')->nullable();
            $table->string('academic_title')->default('Thạc sĩ'); // Học vị
            $table->string('position')->default('Giảng viên'); // Chức danh
            $table->string('department')->default('Khoa Công nghệ thông tin'); // Đơn vị
            $table->string('specialization')->default('Công nghệ phần mềm'); // Bộ môn / Chuyên môn
            $table->string('office')->nullable()->default('Nhà B · Phòng 402'); // Phòng làm việc
            $table->date('start_working_date')->nullable();
            $table->string('status')->default('Đang công tác'); // 'Đang công tác', 'Nghỉ phép', 'Ngừng công tác'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturers');
        Schema::dropIfExists('students');
    }
};
