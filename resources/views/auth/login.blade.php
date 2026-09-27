@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')

    <div class="mb-7">
        <h2 class="text-2xl font-bold text-slate-800 mb-1">Masuk ke Akun</h2>
        <p class="text-sm text-slate-500">Selamat datang kembali! Silakan masuk untuk melanjutkan.</p>
    </div>

    {{-- Error global --}}
    @if($errors->any())
        <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 mb-5 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4" novalidate>
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                autofocus
                placeholder="nama@email.com"
                class="w-full px-4 py-2.5 rounded-xl border text-sm text-slate-800 placeholder-slate-400 transition-all focus:outline-none
                    {{ $errors->has('email') ? 'border-red-300 bg-red-50' : 'border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-3 focus:ring-indigo-100' }}">
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
            <div class="relative">
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••••"
                    class="w-full px-4 pr-12 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder-slate-400
                        focus:outline-none focus:ring-3 focus:border-indigo-500 focus:ring-indigo-100 focus:bg-white transition-all">
                <button type="button" onclick="togglePasswordVisibility('password', 'eyeIconLogin')" tabindex="-1"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                    <svg id="eyeIconLogin" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Remember --}}
        <div class="flex items-center">
            <input id="remember" type="checkbox" name="remember"
                class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0">
            <label for="remember" class="ml-2 text-sm text-slate-600">Ingat saya</label>
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full font-semibold py-2.5 px-4 rounded-xl text-sm text-white transition-all flex items-center justify-center gap-2 mt-2"
            style="background: linear-gradient(135deg, #4f46e5, #7c3aed); box-shadow: 0 4px 14px rgba(124,58,237,0.4);"
            onmouseover="this.style.opacity='0.92'" onmouseout="this.style.opacity='1'">
            Masuk
        </button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm text-slate-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">
                Daftar sekarang
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
