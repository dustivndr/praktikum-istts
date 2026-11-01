<?php

namespace Tests\Feature;

use Tests\TestCase;

class MovieTest extends TestCase
{
    /**
     * Test halaman utama daftar film berhasil diakses
     */
    public function test_movies_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Daftar Film');
        $response->assertSee('M-TIX');
        $response->assertSee('Info Film');
        $response->assertSee('Agak Laen 2');
    }

    /**
     * Test halaman info film berhasil diakses
     */
    public function test_movie_info_page_loads_successfully(): void
    {
        $response = $this->get('/movies/1');
        $response->assertStatus(200);
        $response->assertSee('Sinopsis Film');
        $response->assertSee('Agak Laen 2');
        $response->assertSee('Muhadkly Acho');
    }

    /**
     * Test film ID yang tidak ada mengembalikan 404
     */
    public function test_invalid_movie_id_returns_404(): void
    {
        $response = $this->get('/movies/999');
        $response->assertStatus(404);
    }
}
