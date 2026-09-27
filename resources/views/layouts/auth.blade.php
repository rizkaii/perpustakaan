<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SiManPus') — Sistem Manajemen Perpustakaan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen" style="background:#f0f0fa; font-family:'Inter',sans-serif;">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-4xl bg-white rounded-3xl shadow-2xl overflow-hidden flex" style="min-height:560px;">

            {{-- ── LEFT PANEL: Gradient Blob ───────────────────────────── --}}
            <div class="hidden lg:flex lg:w-96 flex-shrink-0 relative overflow-hidden flex-col justify-between p-10"
                 style="background: linear-gradient(145deg, #1a1a6e 0%, #3b1fa8 40%, #7c3aed 75%, #a78bfa 100%);">

                {{-- Blobs --}}
                <div class="blob-1 absolute rounded-full opacity-40"
                     style="width:320px;height:320px;top:-60px;left:-60px;
                            background:radial-gradient(circle, #818cf8 0%, #4f46e5 60%, transparent 100%);
                            filter:blur(40px);"></div>
                <div class="blob-2 absolute rounded-full opacity-30"
                     style="width:280px;height:280px;bottom:-40px;right:-40px;
                            background:radial-gradient(circle, #c4b5fd 0%, #7c3aed 60%, transparent 100%);
                            filter:blur(50px);"></div>

                {{-- Top asterisk brand --}}
                <div class="relative z-10">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <span class="text-white font-black text-3xl leading-none select-none">✱</span>
                    </div>
                </div>

                {{-- Bottom tagline --}}
                <div class="relative z-10">
                    <p class="text-violet-200 text-xs font-medium mb-2 tracking-wide uppercase">Mudah diakses</p>
                    <h2 class="text-white font-bold text-2xl leading-snug">
                        Kelola perpustakaan<br>Anda dengan mudah<br>dan efisien
                    </h2>
                </div>
            </div>

            {{-- ── RIGHT PANEL: Form ──────────────────────────────────── --}}
            <div class="flex-1 flex items-center justify-center p-8 lg:p-12">
                <div class="w-full max-w-sm">

                    {{-- Mobile brand --}}
                    <div class="lg:hidden flex items-center gap-2 mb-8">
                        <span class="text-indigo-600 font-black text-3xl leading-none">✱</span>
                        <span class="text-slate-800 font-bold text-lg">SiManPus</span>
                    </div>

                    {{-- Desktop asterisk icon --}}
                    <div class="hidden lg:flex items-center mb-4">
                        <span class="text-indigo-600 font-black text-3xl leading-none">✱</span>
                    </div>

                    @yield('content')
                </div>
            </div>

        </div>
    </div>

    @stack('scripts')
</body>
</html>
