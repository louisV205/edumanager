<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade');
            $table->foreignId('lecturer_id')->nullable()->constrained('lecturers')->onDelete('set null');
            $table->string('section_code')->unique(); // 'WEB302.01'
            $table->integer('capacity')->default(40); // Sĩ số tối đa
            $table->integer('current_enrollment')->default(0); // Sĩ số hiện tại
            $table->string('status')->default('Đang mở'); // 'Đang mở', 'Sắp mở', 'Đã kết thúc', 'Đã hủy'
            $table->string('grade_status')->default('Chưa nhập'); // 'Chưa nhập', 'Đang nhập', 'Đã hoàn tất', 'Đã khóa', 'Đã công bố'
            $table->timestamps();
        });

        Schema::create('section_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('course_sections')->onDelete('cascade');
            $table->integer('day_of_week'); // 2 = Thứ Hai, 3 = Thứ Ba, 4 = Thứ Tư, 5 = Thứ Năm, 6 = Thứ Sáu, 7 = Thứ Bảy, 8 = Chủ Nhật
            $table->string('day_of_week_text', 20)->default('Thứ Hai'); // 'Thứ Hai', 'Thứ Ba', ...
            $table->integer('start_period')->default(1); // Tiết bắt đầu (1, 4, 7, ...)
            $table->integer('end_period')->default(3); // Tiết kết thúc (3, 6, 9, ...)
            $table->string('start_time', 10)->default('07:00'); // '07:00'
            $table->string('end_time', 10)->default('09:30'); // '09:30'
            $table->string('room', 50)->default('Phòng A203'); // 'Phòng A203'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_schedules');
        Schema::dropIfExists('course_sections');
    }
};
