<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Đăng nhập');
    }

    public function test_student_login_redirects_to_student_dashboard(): void
    {
        $response = $this->post('/login', [
            'login' => '22A10001',
            'password' => 'password',
        ]);

        $response->assertRedirect('/sinhvien/dashboard');
    }

    public function test_lecturer_login_redirects_to_lecturer_dashboard(): void
    {
        $response = $this->post('/login', [
            'login' => 'GV00128',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('giangvien.dashboard'));
    }

    public function test_invalid_login_fails(): void
    {
        $response = $this->post('/login', [
            'login' => 'WRONG_USER',
            'password' => 'wrong_password',
        ]);

        $response->assertSessionHasErrors('login');
    }
}
