<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EnsureAuthUsersSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password'); // Mật khẩu mặc định: password

        // Đảm bảo roles
        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id') ?? 1;
        $lecturerRoleId = DB::table('roles')->where('name', 'giang_vien')->value('id') ?? 2;
        $studentRoleId = DB::table('roles')->where('name', 'sinh_vien')->value('id') ?? 3;

        // 1. Tài khoản Giảng viên: GV00128
        DB::table('users')->updateOrInsert(
            ['username' => 'GV00128'],
            [
                'role_id' => $lecturerRoleId,
                'name' => 'Nguyễn Minh Anh',
                'email' => 'nguyen.minhanh@edumanager.edu.vn',
                'password' => $password,
                'role' => 'giang_vien',
                'phone' => '0901 234 567',
                'address' => 'Hà Nội',
                'is_active' => true,
                'updated_at' => now(),
            ]
        );

        // 2. Tài khoản Sinh viên: 22A10001
        DB::table('users')->updateOrInsert(
            ['username' => '22A10001'],
            [
                'role_id' => $studentRoleId,
                'name' => 'Nguyễn An',
                'email' => 'nguyen.an@student.edumanager.edu.vn',
                'password' => $password,
                'role' => 'sinh_vien',
                'phone' => '0901 234 567',
                'address' => 'Quận Cầu Giấy, Hà Nội',
                'is_active' => true,
                'updated_at' => now(),
            ]
        );

        // 3. Tài khoản Admin: ADM0001
        DB::table('users')->updateOrInsert(
            ['username' => 'ADM0001'],
            [
                'role_id' => $adminRoleId,
                'name' => 'Trần Thu Hà',
                'email' => 'tran.ha@edumanager.edu.vn',
                'password' => $password,
                'role' => 'admin',
                'phone' => '0901 000 001',
                'address' => 'Phòng Đào tạo, Tòa nhà A1',
                'is_active' => true,
                'updated_at' => now(),
            ]
        );

        echo "Auth users seeded successfully.\n";
    }
}
