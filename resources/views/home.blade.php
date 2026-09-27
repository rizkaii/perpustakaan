<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Beranda — SiManPus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background:#f1f3f9; font-family:'Inter',sans-serif;" class="text-slate-800 min-h-screen">

    {{-- ── NAVBAR ────────────────────────────────────────────────────────── --}}
    <header class="bg-white sticky top-0 z-30" style="border-bottom:1px solid #e8eaf0; box-shadow:0 1px 4px rgba(0,0,0,0.05);">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-14 flex items-center justify-between">

            {{-- Brand --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center"
                     style="background:linear-gradient(135deg,#7c3aed,#4f46e5);">
                    <span class="text-white font-black text-sm leading-none">✱</span>
                </div>
                <span class="font-bold text-slate-800 text-sm">SiManPus</span>
            </a>

            {{-- User menu --}}
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-2 text-sm text-slate-600">
                    <div class="w-7 h-7 rounded-full flex items-center justify-center"
                         style="background:linear-gradient(135deg,#7c3aed,#4f46e5);">
                        <span class="text-white font-bold text-xs">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    </div>
                    <span class="font-medium text-slate-700">{{ auth()->user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors border border-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="hidden sm:inline">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- ── FLASH ─────────────────────────────────────────────────────────── --}}
    @if(session('success'))
    <div class="max-w-6xl mx-auto px-4 sm:px-6 pt-4">
        <div id="flash-success" class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
            <button onclick="document.getElementById('flash-success').remove()" class="ml-auto text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    </div>
    @endif

    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-7 space-y-8">

        {{-- ── HERO ──────────────────────────────────────────────────────── --}}
        <section class="relative rounded-2xl overflow-hidden p-8 sm:p-10 text-white"
                 style="background:linear-gradient(135deg, #0d0d1f 0%, #1e1254 50%, #4c1d95 100%);">
            {{-- Subtle blob decoration --}}
            <div class="absolute top-0 right-0 w-64 h-64 rounded-full opacity-20"
                 style="background:radial-gradient(circle, #7c3aed 0%, transparent 70%); transform:translate(30%,-30%); filter:blur(30px);"></div>

            <p class="text-violet-300 text-sm font-medium mb-1">Halo, {{ auth()->user()->name }} 👋</p>
            <h2 class="text-2xl sm:text-3xl font-bold mb-3 leading-tight">Jelajahi Koleksi<br>Perpustakaan Kami</h2>
            <p class="text-slate-300 text-sm leading-relaxed max-w-lg">
                Temukan ribuan judul buku dari berbagai kategori. Perluas pengetahuan dan wawasan Anda bersama SiManPus.
            </p>
            <div class="mt-6 flex flex-wrap gap-3">
                <div class="rounded-xl px-5 py-3" style="background:rgba(255,255,255,0.08); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.1);">
                    <p class="text-2xl font-bold">{{ $totalBooks }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">Total Buku</p>
                </div>
                <div class="rounded-xl px-5 py-3" style="background:rgba(255,255,255,0.08); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.1);">
                    <p class="text-2xl font-bold">{{ $categories->count() }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">Kategori</p>
                </div>
            </div>
        </section>

        {{-- ── CATEGORIES ───────────────────────────────────────────────── --}}
        @if($categories->count())
        <section>
            <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-4">Kategori Buku</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                @foreach($categories as $cat)
                <div class="bg-white rounded-2xl p-4 text-center hover:shadow-md transition-all cursor-default group"
                     style="border:1px solid #eef0f6;">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mx-auto mb-2.5 transition-colors"
                         style="background:rgba(124,58,237,0.1);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="color:#7c3aed;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-700 truncate">{{ $cat->nama_kategori }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $cat->books_count }} buku</p>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- ── LATEST BOOKS ─────────────────────────────────────────────── --}}
        <section>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Buku Terbaru</h3>
                <span class="text-xs text-slate-400 bg-white px-2.5 py-1 rounded-full border border-slate-100">
                    {{ $books->count() }} judul
                </span>
            </div>

            @if($books->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($books as $book)
                <div class="bg-white rounded-2xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-200 group"
                     style="border:1px solid #eef0f6;">
                    {{-- Cover --}}
                    <div class="aspect-[3/4] relative overflow-hidden" style="background:#f8f9fc;">
                        @if($book->cover)
                            <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->judul }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" style="color:#c4b5fd;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        @endif
                        {{-- Stock badge --}}
                        <span class="absolute top-2 right-2 text-xs font-bold px-2 py-0.5 rounded-full"
                              style="{{ $book->stok > 0 ? 'background:#22c55e;color:#fff;' : 'background:#ef4444;color:#fff;' }}">
                            {{ $book->stok > 0 ? 'Tersedia' : 'Habis' }}
                        </span>
                    </div>
                    {{-- Info --}}
                    <div class="p-3">
                        <span class="inline-block text-xs font-semibold px-2 py-0.5 rounded-full mb-1.5"
                              style="background:rgba(124,58,237,0.1); color:#7c3aed;">
                            {{ $book->category->nama_kategori ?? '-' }}
                        </span>
                        <h4 class="text-sm font-bold text-slate-800 leading-snug line-clamp-2">{{ $book->judul }}</h4>
                        <p class="text-xs text-slate-400 mt-1">{{ $book->pengarang }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white rounded-2xl py-16 text-center" style="border:1px solid #eef0f6;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-3" style="color:#c4b5fd;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <p class="font-semibold text-slate-500">Belum ada buku</p>
                <p class="text-sm text-slate-400 mt-1">Koleksi akan segera tersedia.</p>
            </div>
            @endif
        </section>

    </main>

    {{-- Footer --}}
    <footer class="mt-10 py-5 text-center text-xs text-slate-400" style="border-top:1px solid #eef0f6;">
        &copy; {{ date('Y') }} SiManPus — Sistem Manajemen Perpustakaan
    </footer>

    <script>
        setTimeout(() => {
            const el = document.getElementById('flash-success');
            if (el) el.remove();
        }, 4000);
    </script>

</body>
</html>
