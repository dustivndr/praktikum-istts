<?php

namespace Tests\Feature;

use Tests\TestCase;

class AbsensiFeatureTest extends TestCase
{
    public function test_login_and_registration_pages_follow_the_new_specification(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('Login BEM ABSENSI')
            ->assertSee('Register mahasiswa');

        $this->get('/register')
            ->assertOk()
            ->assertSee('Register Mahasiswa')
            ->assertSee('Konfirmasi Password');
    }

    public function test_users_are_redirected_to_their_role_dashboard_after_login(): void
    {
        $this->post('/login', ['username' => 'admin', 'password' => 'admin123'])
            ->assertRedirectToRoute('dashboard');

        $this->get('/dashboard')->assertRedirectToRoute('admin.dashboard');

        $this->post('/logout');
        $this->post('/login', ['username' => 'budi', 'password' => 'budi123'])
            ->assertRedirectToRoute('dashboard');

        $this->get('/dashboard')->assertRedirectToRoute('student.dashboard');
        $this->get('/mahasiswa/dashboard')->assertOk()->assertSee('Dashboard Mahasiswa');
    }

    public function test_invalid_credentials_and_role_restrictions_are_enforced(): void
    {
        $this->from('/login')
            ->post('/login', ['username' => 'admin', 'password' => 'wrong-password'])
            ->assertRedirect('/login')
            ->assertSessionHasErrors('username');

        $this->post('/login', ['username' => 'rina', 'password' => 'rina123']);
        $this->get('/admin/dashboard')->assertForbidden();
        $this->get('/ketua/dashboard')->assertForbidden();
    }

    public function test_student_can_send_only_one_join_request_and_chairman_can_see_it(): void
    {
        $this->post('/login', ['username' => 'budi', 'password' => 'budi123']);
        $this->get('/mahasiswa/explore')->assertSee('UKM Musik');

        $this->post('/mahasiswa/organizations/2/join')->assertSessionHas('success');
        $this->post('/mahasiswa/organizations/2/join')->assertSessionHas('error');

        $this->post('/logout');
        $this->post('/login', ['username' => 'ketua_musik', 'password' => 'ketua123']);

        $this->get('/ketua/dashboard')
            ->assertOk()
            ->assertSee('Budi Santoso')
            ->assertSee('222117002');
    }

    public function test_admin_can_add_members_and_create_schedules(): void
    {
        $this->post('/login', ['username' => 'admin', 'password' => 'admin123']);

        $this->post('/admin/organizations/2/members', ['user_id' => 3])
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->post('/admin/schedules', [
            'organization_id' => 2,
            'title' => 'Latihan Musik',
            'date' => '2026-11-15',
            'start_time' => '15:00',
            'end_time' => '17:00',
            'location' => 'Ruang Musik',
            'description' => 'Latihan rutin organisasi.',
        ])->assertRedirectToRoute('admin.schedules');

        $this->get('/admin/schedules')
            ->assertOk()
            ->assertSee('Latihan Musik')
            ->assertSee('UKM Musik');
    }

    public function test_register_creates_a_student_account(): void
    {
        $this->post('/register', [
            'nama' => 'Mahasiswa Baru',
            'nrp' => '222117099',
            'username' => 'mahasiswa_baru',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ])->assertRedirectToRoute('login');

        $this->post('/login', ['username' => 'mahasiswa_baru', 'password' => 'rahasia123'])
            ->assertRedirectToRoute('dashboard');
    }
}
