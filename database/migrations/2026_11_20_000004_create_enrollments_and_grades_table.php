<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('section_id')->constrained('course_sections')->onDelete('cascade');
            $table->foreignId('registration_period_id')->nullable()->constrained('registration_periods')->onDelete('set null');
            $table->string('status')->default('Đã đăng ký'); // 'Đã đăng ký', 'Đã hủy'
            $table->timestamp('registered_at')->useCurrent();
            $table->timestamp('canceled_at')->nullable();
            $table->unique(['student_id', 'section_id']);
            $table->timestamps();
        });

        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('section_id')->constrained('course_sections')->onDelete('cascade');
            $table->decimal('attendance_score', 4, 2)->nullable(); // Điểm chuyên cần (hệ 10)
            $table->decimal('midterm_score', 4, 2)->nullable(); // Điểm giữa kỳ (hệ 10)
            $table->decimal('final_exam_score', 4, 2)->nullable(); // Điểm thi cuối kỳ (hệ 10)
            $table->decimal('final_score', 4, 2)->nullable(); // Điểm tổng kết (hệ 10) = CC*0.1 + GK*0.3 + CK*0.6
            $table->decimal('gpa_score', 3, 2)->nullable(); // Thang điểm 4 (4.0, 3.5, 3.0, 2.5, 2.0, 1.5, 1.0, 0.0)
            $table->string('letter_grade', 4)->nullable(); // A, B+, B, C+, C, D+, D, F
            $table->string('status')->default('Chưa công bố'); // 'Đạt', 'Không đạt', 'Chưa công bố'
            $table->boolean('is_locked')->default(false); // Đã khóa điểm hay chưa
            $table->foreignId('entered_by_lecturer_id')->nullable()->constrained('lecturers')->onDelete('set null');
            $table->unique(['student_id', 'section_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
        Schema::dropIfExists('enrollments');
    }
};
