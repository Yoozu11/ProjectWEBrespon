<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() {
    return view('auth.register');

    }

    public function showLogin() {
    return view('auth.login');

    }

    public function register (Request $request) {
    $data = $request->validate([
    'nama' => ['required', 'string', 'max:255'],
    'nim' => ['required', 'string', 'max:255', 'unique:mahasiswas,nim'],
    'email' => ['required', 'email', 'max:255', 'unique:mahasiswas,email'],
    'password' => [
    'required', 'string', 'min:8', 'confirmed'
            ],
        ]);

    $mahasiswa = Mahasiswa::create([
        'nama' => $data['nama'],
        'nim' => $data['nim'],
        'email' => $data['email'],
    ]);
    $mahasiswa->password = Hash::make($data['password']);
    $mahasiswa->save();
    return redirect()->route('login')
        ->with('success', 'Akun berhasil dibuat. Silakan login.');

    }

    public function login(Request $request) {
    $credentials = $request->validate([
    'nim' => ['required', 'string'],
    'password' => ['required', 'string'],
    ]);
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/mahasiswa');
    }
    return back()->withErrors([
        'nim' => 'NIM atau password salah.',
    ])->onlyInput('nim');
    }
}