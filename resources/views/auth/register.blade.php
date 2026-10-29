@php($isLogin = ($mode ?? 'register') === 'login')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f3f5f2">
    <title>{{ $isLogin ? 'Masuk' : 'Daftar' }} | Portal Akademik</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            color-scheme: light;
            font-family: 'DM Sans', sans-serif;
        }

        .auth-shell {
            min-height: 100svh;
            margin: 0;
            padding: 24px;
            color: #172a25;
            background-color: #f3f5f2;
            background-image: radial-gradient(#173c32 0.7px, transparent 0.7px);
            background-size: 19px 19px;
        }

        .auth-main {
            display: grid;
            grid-template-columns: 1.02fr 0.98fr;
            width: 100%;
            max-width: 1440px;
            min-height: min(820px, calc(100svh - 48px));
            margin: 0 auto;
            overflow: hidden;
            border-radius: 28px;
            background: #fff;
            box-shadow: 0 24px 80px -32px rgb(20 48 39 / 28%);
        }

        .auth-panel {
            position: relative;
            display: flex;
            min-height: 100%;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px 56px;
        }

        .auth-content {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 56px;
        }

        .auth-content-inner {
            width: 100%;
            max-width: 420px;
        }

        .auth-content-inner h2 {
            margin: 0;
            color: #183a30;
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 40px;
            font-weight: 400;
            line-height: 1.15;
        }

        .auth-content-inner form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 30px;
        }

        .auth-content-inner form > div > label,
        .auth-content-inner form > div > div > label {
            display: block;
            margin-bottom: 8px;
            color: #263b34;
            font-size: 14px;
            font-weight: 600;
        }

        .auth-content-inner input[type='email'],
        .auth-content-inner input[type='password'],
        .auth-content-inner input[type='text'] {
            box-sizing: border-box;
            width: 100%;
            min-height: 50px;
            border: 1px solid #d6dfd9;
            border-radius: 8px;
            background: #fbfcfa;
            padding: 13px 15px;
            color: #183a30;
            font: inherit;
            font-size: 14px;
            outline: none;
        }

        .auth-content-inner input[type='email']:focus,
        .auth-content-inner input[type='password']:focus,
        .auth-content-inner input[type='text']:focus {
            border-color: #3e715c;
            box-shadow: 0 0 0 4px rgb(62 113 92 / 10%);
        }

        .auth-content-inner input::placeholder { color: #9aa8a0; }
        .auth-content-inner form > div > div { position: relative; }
        .auth-content-inner form > div > div > input { padding-right: 52px; }

        .auth-content-inner form > div > div > button {
            position: absolute;
            top: 0;
            right: 0;
            display: grid;
            width: 48px;
            height: 50px;
            place-items: center;
            border: 0;
            background: transparent;
            color: #71847a;
            cursor: pointer;
        }

        .auth-content-inner form > label {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #5e7067;
            font-size: 14px;
        }

        .auth-content-inner input[type='checkbox'] {
            width: 16px;
            height: 16px;
            accent-color: #285b48;
        }

        .auth-content-inner form > button[type='submit'] {
            display: flex;
            min-height: 50px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 0;
            border-radius: 8px;
            background: #1d493a;
            color: #fff;
            font: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 8px 18px -8px rgb(29 73 58 / 65%);
        }

        .auth-content-inner form > button[type='submit']:hover { background: #15392f; }
        .auth-content-inner form > button[type='submit'] svg { width: 16px; height: 16px; flex: none; }

        .campus-panel {
            background-image:
                linear-gradient(180deg, rgb(13 35 31 / 18%) 0%, rgb(13 35 31 / 40%) 45%, rgb(13 35 31 / 92%) 100%),
                url('https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1400&q=85');
            background-position: center;
            background-size: cover;
        }

        .auth-enter {
            animation: auth-enter 650ms cubic-bezier(.2, .7, .2, 1) both;
        }

        @keyframes auth-enter {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (prefers-reduced-motion: reduce) {
            .auth-enter { animation: none; }
        }

        @media (max-width: 767px) {
            .auth-shell { padding: 12px; }
            .auth-main { grid-template-columns: 1fr; min-height: calc(100svh - 24px); border-radius: 20px; }
            .auth-panel { min-height: 300px; padding: 26px 24px; }
            .auth-content { padding: 40px 24px; }
            .auth-content-inner h2 { font-size: 34px; }
        }
    </style>
</head>
<body class="auth-shell min-h-screen bg-[#f3f5f2] p-3 text-[#172a25] sm:p-5 lg:p-8">
    <main class="auth-main mx-auto grid min-h-[calc(100svh-1.5rem)] max-w-[1440px] overflow-hidden rounded-[1.25rem] bg-white shadow-[0_24px_80px_-32px_rgba(20,48,39,0.28)] sm:min-h-[calc(100svh-2.5rem)] lg:grid-cols-[1.02fr_0.98fr] lg:rounded-[1.75rem] lg:min-h-[min(820px,calc(100svh-4rem))]">
        <section class="auth-panel campus-panel relative flex min-h-[300px] flex-col justify-between overflow-hidden px-6 py-7 text-white sm:px-10 sm:py-9 lg:min-h-full lg:px-14 lg:py-12" aria-label="Portal Akademik">
            <div class="absolute inset-0 bg-[#15392f]/10" aria-hidden="true"></div>
            <a href="/" class="auth-enter relative z-10 inline-flex w-fit items-center gap-3 rounded-sm text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-[#d7f078] focus-visible:ring-offset-4 focus-visible:ring-offset-[#15392f]">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#d7f078] text-lg font-bold text-[#183a30]">P</span>
                <span>
                    <span class="block text-sm font-bold tracking-[0.04em]">PORTAL AKADEMIK</span>
                    <span class="mt-0.5 block text-xs text-white/70">Ruang tumbuh dan berprestasi</span>
                </span>
            </a>

            <div class="auth-enter relative z-10 max-w-xl py-10" style="animation-delay: 100ms">
                <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-3 py-1.5 text-[10px] font-bold tracking-[0.16em] text-white/90 backdrop-blur-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#d7f078]"></span>
                    AKSES MAHASISWA
                </span>
                <h1 class="max-w-lg font-[DM_Serif_Display] text-4xl leading-[1.1] sm:text-5xl lg:text-[3.5rem]">
                    @if ($isLogin)
                        Langkah kecil hari ini, <span class="text-[#d7f078]">masa depan</span> yang lebih luas.
                    @else
                        Mulai perjalanan akademik dengan <span class="text-[#d7f078]">akun kampus</span> Anda.
                    @endif
                </h1>
                <p class="mt-5 max-w-md text-sm leading-7 text-white/75 sm:text-base">
                    @if ($isLogin)
                        Masuk untuk mengelola perjalanan akademik dan tetap terhubung dengan aktivitas kampus.
                    @else
                        Buat akun baru untuk mulai mengelola perjalanan akademik Anda.
                    @endif
                </p>
            </div>

            <div class="relative z-10 flex items-end justify-between border-t border-white/20 pt-5 text-[10px] font-semibold tracking-[0.14em] text-white/65 sm:text-xs">
                <span>BELAJAR · BERTUMBUH · BERDAMPAK</span>
                <span class="hidden sm:block">TAHUN AKADEMIK 2026</span>
            </div>
        </section>

        <section class="auth-content flex items-center justify-center px-6 py-10 sm:px-12 lg:px-14 xl:px-20">
            <div class="auth-content-inner auth-enter w-full max-w-[420px]" style="animation-delay: 180ms">
                <div class="mb-8 lg:mb-10">
                    <p class="mb-3 text-xs font-bold tracking-[0.18em] text-[#527267]">{{ $isLogin ? 'SELAMAT DATANG KEMBALI' : 'PENDAFTARAN AKUN' }}</p>
                    <h2 class="font-[DM_Serif_Display] text-3xl leading-tight text-[#183a30] sm:text-4xl">{{ $isLogin ? 'Masuk ke akun Anda' : 'Buat akun mahasiswa' }}</h2>
                    <p class="mt-3 text-sm leading-6 text-[#687870]">
                        {{ $isLogin ? 'Gunakan NIM dan kata sandi untuk melanjutkan.' : 'Lengkapi data diri untuk membuat akun Portal Akademik.' }}
                    </p>
                </div>

                @if (session('success'))
                    <div class="mb-5 rounded-lg border border-[#c9e2d4] bg-[#f0f8f2] px-4 py-3 text-sm text-[#285c43]" role="status">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-5 rounded-lg border border-[#f0c8bd] bg-[#fff5f1] px-4 py-3 text-sm text-[#9d3e2d]" role="alert">
                        <p class="font-semibold">{{ $isLogin ? 'Login belum berhasil.' : 'Pendaftaran belum berhasil.' }}</p>
                        <ul class="mt-1 list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ $isLogin ? url('/login') : url('/register') }}" method="POST" class="auth-form space-y-5">
                    @csrf
                    @unless ($isLogin)
                        <div>
                            <label for="nama" class="mb-2 block text-sm font-semibold text-[#263b34]">Nama lengkap</label>
                            <input
                                id="nama"
                                name="nama"
                                type="text"
                                value="{{ old('nama') }}"
                                autocomplete="name"
                                placeholder="Masukkan nama lengkap"
                                required
                                autofocus
                                class="w-full rounded-lg border border-[#d6dfd9] bg-[#fbfcfa] px-4 py-3.5 text-sm text-[#183a30] outline-none transition placeholder:text-[#9aa8a0] hover:border-[#9db6a9] focus:border-[#3e715c] focus:ring-4 focus:ring-[#3e715c]/10"
                            >
                        </div>
                    @endunless
                    <div>
                        <label for="nim" class="mb-2 block text-sm font-semibold text-[#263b34]">NIM</label>
                        <input
                            id="nim"
                            name="nim"
                            type="text"
                            value="{{ old('nim') }}"
                            autocomplete="nim"
                            placeholder="Masukkan NIM Anda"
                            required
                            @if ($isLogin) autofocus @endif
                            class="w-full rounded-lg border border-[#d6dfd9] bg-[#fbfcfa] px-4 py-3.5 text-sm text-[#183a30] outline-none transition placeholder:text-[#9aa8a0] hover:border-[#9db6a9] focus:border-[#3e715c] focus:ring-4 focus:ring-[#3e715c]/10"
                        >
                    </div>

                    @unless ($isLogin)
                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-[#263b34]">Alamat email</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                placeholder="nama@kampus.ac.id"
                                required
                                class="w-full rounded-lg border border-[#d6dfd9] bg-[#fbfcfa] px-4 py-3.5 text-sm text-[#183a30] outline-none transition placeholder:text-[#9aa8a0] hover:border-[#9db6a9] focus:border-[#3e715c] focus:ring-4 focus:ring-[#3e715c]/10"
                            >
                        </div>
                    @endunless

                    <div>
                        <div class="mb-2 flex items-center justify-between gap-3">
                            <label for="password" class="block text-sm font-semibold text-[#263b34]">Kata sandi</label>
                        </div>
                        <div class="relative">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="{{ $isLogin ? 'current-password' : 'new-password' }}"
                                placeholder="Masukkan kata sandi"
                                @unless ($isLogin) minlength="8" @endunless
                                required
                                class="w-full rounded-lg border border-[#d6dfd9] bg-[#fbfcfa] px-4 py-3.5 pr-14 text-sm text-[#183a30] outline-none transition placeholder:text-[#9aa8a0] hover:border-[#9db6a9] focus:border-[#3e715c] focus:ring-4 focus:ring-[#3e715c]/10"
                            >
                            <button
                                type="button"
                                id="toggle-password"
                                class="absolute inset-y-0 right-0 inline-flex w-12 items-center justify-center text-[#71847a] transition hover:text-[#183a30] focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-[#3e715c]"
                                aria-label="Tampilkan kata sandi"
                                aria-pressed="false"
                            >
                                <svg id="eye-icon" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    @unless ($isLogin)
                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-[#263b34]">Konfirmasi kata sandi</label>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                autocomplete="new-password"
                                placeholder="Ulangi kata sandi"
                                minlength="8"
                                required
                                class="w-full rounded-lg border border-[#d6dfd9] bg-[#fbfcfa] px-4 py-3.5 text-sm text-[#183a30] outline-none transition placeholder:text-[#9aa8a0] hover:border-[#9db6a9] focus:border-[#3e715c] focus:ring-4 focus:ring-[#3e715c]/10"
                            >
                        </div>
                    @endunless

                    <button type="submit" class="group inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#1d493a] px-5 py-3.5 text-sm font-bold text-white shadow-[0_8px_18px_-8px_rgba(29,73,58,0.65)] transition hover:bg-[#15392f] focus:outline-none focus-visible:ring-4 focus-visible:ring-[#3e715c]/25 active:translate-y-px">
                        {{ $isLogin ? 'Masuk ke portal' : 'Daftarkan akun' }}
                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </button>
                </form>

                <p class="mt-8 border-t border-[#e7ece8] pt-5 text-center text-sm leading-6 text-[#829087]">
                    {{ $isLogin ? 'Belum punya akun?' : 'Sudah punya akun?' }}
                    <a href="{{ $isLogin ? url('/register') : url('/login') }}" class="font-bold text-[#285b48] underline decoration-[#9db6a9] underline-offset-4 hover:text-[#15392f]">
                        {{ $isLogin ? 'Daftar di sini' : 'Masuk di sini' }}
                    </a>
                </p>
            </div>
        </section>
    </main>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('toggle-password');

        togglePassword.addEventListener('click', () => {
            const isVisible = passwordInput.type === 'text';
            passwordInput.type = isVisible ? 'password' : 'text';
            togglePassword.setAttribute('aria-pressed', String(!isVisible));
            togglePassword.setAttribute('aria-label', isVisible ? 'Tampilkan kata sandi' : 'Sembunyikan kata sandi');
        });
    </script>
</body>
</html>