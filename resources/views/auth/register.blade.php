@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')

    <div class="mb-7">
        <h2 class="text-2xl font-bold text-slate-800 mb-1">Buat Akun Baru</h2>
        <p class="text-sm text-slate-500">Daftar untuk mulai mengakses sistem perpustakaan.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4" novalidate>
        @csrf

        {{-- Name --}}
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
            <input
                id="name" type="text" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus
                placeholder="Nama lengkap Anda"
                class="w-full px-4 py-2.5 rounded-xl border text-sm text-slate-800 placeholder-slate-400 transition-all focus:outline-none
                    {{ $errors->has('name') ? 'border-red-300 bg-red-50' : 'border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-3 focus:ring-indigo-100' }}">
            @error('name')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
            <input
                id="email" type="email" name="email"
                value="{{ old('email') }}" required autocomplete="email"
                placeholder="nama@email.com"
                class="w-full px-4 py-2.5 rounded-xl border text-sm text-slate-800 placeholder-slate-400 transition-all focus:outline-none
                    {{ $errors->has('email') ? 'border-red-300 bg-red-50' : 'border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-3 focus:ring-indigo-100' }}">
            @error('email')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
            <div class="relative">
                <input
                    id="password" type="password" name="password"
                    required autocomplete="new-password"
                    placeholder="Minimal 8 karakter"
                    class="w-full px-4 pr-12 py-2.5 rounded-xl border text-sm text-slate-800 placeholder-slate-400 transition-all focus:outline-none
                        {{ $errors->has('password') ? 'border-red-300 bg-red-50' : 'border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-3 focus:ring-indigo-100' }}">
                <button type="button" onclick="togglePasswordVisibility('password', 'eyeIcon1')" tabindex="-1"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                    <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password</label>
            <div class="relative">
                <input
                    id="password_confirmation" type="password" name="password_confirmation"
                    required autocomplete="new-password"
                    placeholder="Ulangi password"
                    class="w-full px-4 pr-12 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400
                        focus:outline-none focus:ring-3 focus:border-indigo-500 focus:ring-indigo-100 focus:bg-white transition-all">
                <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'eyeIcon2')" tabindex="-1"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                    <svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full font-semibold py-2.5 px-4 rounded-xl text-sm text-white transition-all flex items-center justify-center gap-2 mt-2"
            style="background: linear-gradient(135deg, #4f46e5, #7c3aed); box-shadow: 0 4px 14px rgba(124,58,237,0.4);"
            onmouseover="this.style.opacity='0.92'" onmouseout="this.style.opacity='1'">
            Buat Akun
        </button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm text-slate-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">
                Masuk
            </a>
        </p>
    </div>

@endsection

@push('scripts')
<script>
    function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        icon.innerHTML = isPassword
            ? `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`
            : `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
    }
</script>
@endpush
