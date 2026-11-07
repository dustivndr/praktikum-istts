<?php

namespace Tests\Feature;

use Tests\TestCase;

class AbsensiFeatureTest extends TestCase
{
    public function test_home_displays_controller_derived_statistics(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Total UKM')
            ->assertSee('>4<', false)
            ->assertSee('>2<', false)
            ->assertSee('>23<', false)
            ->assertSee('>3<', false);
    }

    public function test_organization_lists_are_filtered_by_type(): void
    {
        $this->get('/ukm')
            ->assertOk()
            ->assertSee('UKM Basket')
            ->assertSee('4 Organisasi')
            ->assertSee('/organizations/1', false)
            ->assertDontSee('UKK Kerohanian Kristen');

        $this->get('/ukk')
            ->assertOk()
            ->assertSee('UKK Kerohanian Kristen')
            ->assertSee('2 Organisasi')
            ->assertDontSee('UKM Basket');
    }

    public function test_pages_use_the_master_layout_titles(): void
    {
        $this->get('/')
            ->assertSee('<title>BEM ABSENSI</title>', false)
            ->assertSee('Dashboard Overview');

        $this->get('/ukm')
            ->assertSee('<title>Daftar UKM</title>', false)
            ->assertSee('Daftar UKM');
    }

    public function test_organization_detail_displays_members_and_attendance(): void
    {
        $this->get('/organizations/1')
            ->assertOk()
            ->assertSee('UKM Basket')
            ->assertSee('5 Members')
            ->assertSee('4 Records')
            ->assertSee('Belum Check-out')
            ->assertSee('Kembali ke Daftar UKM');
    }

    public function test_unknown_organization_returns_not_found(): void
    {
        $this->get('/organizations/999')->assertNotFound();
    }
}
