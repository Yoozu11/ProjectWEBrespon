<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_new_student_can_register_and_log_in(): void
    {
        $this->post('/register', [
            'nama' => 'Aisyah Putri',
            'nim' => '20260001',
            'email' => 'aisyah@example.com',
            'password' => 'secure-pass-123',
            'password_confirmation' => 'secure-pass-123',
        ])->assertRedirect(route('login'));

        $this->assertDatabaseHas('mahasiswas', [
            'nama' => 'Aisyah Putri',
            'nim' => '20260001',
            'email' => 'aisyah@example.com',
        ]);

        $mahasiswa = Mahasiswa::where('nim', '20260001')->firstOrFail();
        $this->assertTrue(Hash::check('secure-pass-123', $mahasiswa->password));

        $this->post('/login', [
            'nim' => '20260001',
            'password' => 'secure-pass-123',
        ])->assertRedirect('/mahasiswa');

        $this->assertAuthenticatedAs($mahasiswa);
    }

    public function test_registration_rejects_an_existing_nim_or_email(): void
    {
        Mahasiswa::create([
            'nama' => 'Existing Student',
            'nim' => '20260002',
            'email' => 'existing@example.com',
        ]);

        $this->post('/register', [
            'nama' => 'Another Student',
            'nim' => '20260002',
            'email' => 'another@example.com',
            'password' => 'secure-pass-123',
            'password_confirmation' => 'secure-pass-123',
        ])->assertSessionHasErrors('nim');
    }
}