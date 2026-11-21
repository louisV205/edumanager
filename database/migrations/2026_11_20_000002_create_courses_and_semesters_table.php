<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->string('semester_code')->unique(); // 'HK1-2026-2027'
            $table->string('semester_name'); // 'Học kỳ 1'
            $table->string('academic_year'); // '2026–2027'
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('Đang diễn ra'); // 'Đang diễn ra', 'Sắp diễn ra', 'Đã kết thúc'
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code')->unique(); // 'WEB302', 'DBI202'
            $table->string('course_name'); // 'Lập trình Web'
            $table->integer('credits')->default(3);
            $table->string('course_type')->default('Học phần chuyên ngành'); // 'Học phần chuyên ngành', 'Học phần cơ sở ngành', 'Học phần đại cương'
            $table->string('department')->default('Khoa Công nghệ thông tin');
            $table->text('description')->nullable();
            $table->string('status')->default('Đang sử dụng'); // 'Đang sử dụng', 'Ngừng sử dụng'
            $table->timestamps();
        });

        Schema::create('course_prerequisites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('prerequisite_course_id')->constrained('courses')->onDelete('cascade');
            $table->unique(['course_id', 'prerequisite_course_id']);
            $table->timestamps();
        });

        Schema::create('registration_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade');
            $table->string('period_name'); // 'Đợt đăng ký học phần học kỳ 1 năm học 2026–2027'
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('min_credits')->default(12);
            $table->integer('max_credits')->default(30);
            $table->string('status')->default('Đang mở'); // 'Chưa mở', 'Đang mở', 'Đã đóng'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_periods');
        Schema::dropIfExists('course_prerequisites');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('semesters');
    }
};
