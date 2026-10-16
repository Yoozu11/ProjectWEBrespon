<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MahasiswaSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_filters_mahasiswa_by_name_nim_or_email(): void
    {
        Mahasiswa::create([
            'nama' => 'Aisyah Putri',
            'nim' => '20240001',
            'email' => 'aisyah@kampus.ac.id',
        ]);
        Mahasiswa::create([
            'nama' => 'Budi Santoso',
            'nim' => '20240002',
            'email' => 'budi@kampus.ac.id',
        ]);

        $response = $this->get('/mahasiswa?search=20240001');

        $response->assertOk()
            ->assertSee('Aisyah Putri')
            ->assertDontSee('Budi Santoso');

        $this->get('/mahasiswa?search=Aisyah')
            ->assertOk()
            ->assertSee('Aisyah Putri')
            ->assertDontSee('Budi Santoso');

        $this->get('/mahasiswa?search=aisyah%40kampus.ac.id')
            ->assertOk()
            ->assertSee('Aisyah Putri')
            ->assertDontSee('Budi Santoso');
    }
}
