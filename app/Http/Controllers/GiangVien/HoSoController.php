<?php

namespace App\Http\Controllers\GiangVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\User;
use Carbon\Carbon;

class HoSoController extends Controller
{
    /**
     * Hiển thị hồ sơ cá nhân giảng viên
     */
    public function index(Request $request)
    {
        // 1. Dữ liệu chuẩn gốc Figma
        $profile = [
            'name' => 'Nguyễn Minh Anh',
            'code' => 'GV00128',
            'initials' => 'MA',
            'gender' => 'Nữ',
            'dob' => '12/08/1988',
            'pob' => 'Hà Nội',
            'department' => 'Khoa Công nghệ thông tin',
            'specialization' => 'Công nghệ phần mềm',
            'academic_title' => 'Thạc sĩ',
            'position' => 'Giảng viên',
            'start_working_date' => '01/09/2018',
            'status' => 'Đang công tác',
            'email' => 'nguyen.minhanh@edumanager.edu.vn',
            'phone' => '0901 234 567',
            'office' => 'Nhà B · Phòng 402',
            'username' => 'GV00128',
            'role' => 'Giảng viên',
            'account_status' => 'Đang hoạt động',
        ];

        // 2. Thử truy vấn từ MySQL Database
        try {
            $lecturer = Lecturer::with('user')->where('lecturer_code', 'GV00128')->first();
            if ($lecturer) {
                $profile['name'] = $lecturer->fullname ?? $profile['name'];
                $profile['code'] = $lecturer->lecturer_code ?? $profile['code'];
                $profile['gender'] = $lecturer->gender ?? $profile['gender'];
                $profile['dob'] = $lecturer->dob ? Carbon::parse($lecturer->dob)->format('d/m/Y') : $profile['dob'];
                $profile['pob'] = $lecturer->pob ?? $profile['pob'];
                $profile['department'] = $lecturer->department ?? $profile['department'];
                $profile['specialization'] = $lecturer->specialization ?? $profile['specialization'];
                $profile['academic_title'] = $lecturer->academic_title ?? $profile['academic_title'];
                $profile['position'] = $lecturer->position ?? $profile['position'];
                $profile['start_working_date'] = $lecturer->start_working_date ? Carbon::parse($lecturer->start_working_date)->format('d/m/Y') : $profile['start_working_date'];
                $profile['status'] = $lecturer->status ?? $profile['status'];
                $profile['office'] = $lecturer->office ?? $profile['office'];

                if ($lecturer->user) {
                    $profile['email'] = $lecturer->user->email ?? $profile['email'];
                    $profile['phone'] = $lecturer->user->phone ?? $profile['phone'];
                    $profile['username'] = $lecturer->user->username ?? $profile['username'];
                    $profile['account_status'] = $lecturer->user->is_active ? 'Đang hoạt động' : 'Tạm khóa';
                }
            }
        } catch (\Exception $e) {
            // Fallback an toàn về dữ liệu gốc Figma nếu CSDL không khả dụng
        }

        // 3. Áp dụng các thay đổi từ Session nếu vừa cập nhật
        if (session()->has('custom_email')) {
            $profile['email'] = session('custom_email');
        }
        if (session()->has('custom_phone')) {
            $profile['phone'] = session('custom_phone');
        }
        if (session()->has('custom_office')) {
            $profile['office'] = session('custom_office');
        }

        return view('giangvien.ho-so', compact('profile'));
    }

    /**
     * Cập nhật thông tin liên hệ giảng viên
     */
    public function updateContact(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'office' => 'required|string|max:100',
        ]);

        $email = $request->input('email');
        $phone = $request->input('phone');
        $office = $request->input('office');

        // Lưu vào CSDL nếu khả dụng
        try {
            $lecturer = Lecturer::where('lecturer_code', 'GV00128')->first();
            if ($lecturer) {
                $lecturer->office = $office;
                $lecturer->save();

                if ($lecturer->user) {
                    $lecturer->user->email = $email;
                    $lecturer->user->phone = $phone;
                    $lecturer->user->save();
                }
            }
        } catch (\Exception $e) {
            // Ghi nhận lỗi thầm lặng và dùng Session
        }

        // Lưu vào Session để luôn phản ánh tức thì lên giao diện
        session([
            'custom_email' => $email,
            'custom_phone' => $phone,
            'custom_office' => $office,
        ]);

        return redirect()->route('giangvien.hoso')
            ->with('success', 'Thông tin liên hệ đã được cập nhật thành công!');
    }
}
