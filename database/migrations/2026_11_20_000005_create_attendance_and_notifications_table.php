<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('section_id')->constrained('course_sections')->onDelete('cascade');
            $table->foreignId('recorded_by_lecturer_id')->nullable()->constrained('lecturers')->onDelete('set null');
            $table->date('session_date');
            $table->integer('session_number')->default(1);
            $table->string('status')->default('Có mặt'); // 'Có mặt', 'Vắng có phép', 'Vắng không phép', 'Đi trễ'
            $table->string('note')->nullable();
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->text('content');
            $table->string('scope')->default('Tất cả'); // 'Tất cả', 'Sinh viên', 'Giảng viên', 'Khoa Công nghệ thông tin'
            $table->foreignId('section_id')->nullable()->constrained('course_sections')->onDelete('set null');
            $table->string('status')->default('Đã đăng'); // 'Đã đăng', 'Bản nháp', 'Đã lên lịch'
            $table->timestamp('published_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('notification_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')->constrained('notifications')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_recipients');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('attendance_records');
    }
};
