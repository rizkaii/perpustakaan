<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Perpustakaan') — SiManPus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.tailwindcss.min.css">
    @stack('styles')
</head>
<body class="text-slate-800 min-h-screen flex" style="background:#f1f3f9; font-family:'Inter',sans-serif;">

    {{-- ========== SIDEBAR ========== --}}
    <aside id="sidebar" class="w-60 min-h-screen flex-shrink-0 flex" style="background:#0d0d1f;">
        <div id="sidebar-inner" class="flex flex-col w-60 min-w-60">

            {{-- Brand --}}
            <div class="flex items-center gap-3 px-5 py-5" style="border-bottom:1px solid rgba(255,255,255,0.06);">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                     style="background:linear-gradient(135deg,#7c3aed,#4f46e5);">
                    <span class="text-white font-black text-base leading-none select-none">✱</span>
                </div>
                <div class="overflow-hidden">
                    <p class="text-white font-bold text-sm leading-tight">SiManPus</p>
                    <p class="text-xs" style="color:#64748b;">Manajemen Perpustakaan</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-3 py-4 space-y-0.5">
                <p class="text-xs font-semibold uppercase tracking-wider px-3 mb-3" style="color:#334155;">Menu Utama</p>

                <a href="{{ route('books.index') }}"
                   class="sidebar-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>Data Buku</span>
                </a>

                <a href="{{ route('categories.index') }}"
                   class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span>Kategori Buku</span>
                </a>

                <a href="{{ route('members.index') }}"
                   class="sidebar-link {{ request()->routeIs('members.*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Data Anggota</span>
                </a>
            </nav>

            {{-- User & Logout --}}
            <div class="px-3 py-3" style="border-top:1px solid rgba(255,255,255,0.06);">
                <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl mb-1" style="background:rgba(255,255,255,0.04);">
                    <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0"
                         style="background:linear-gradient(135deg,#7c3aed,#4f46e5);">
                        <span class="text-white text-xs font-bold">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                    </div>
                    <div class="overflow-hidden flex-1 min-w-0">
                        <p class="text-white text-xs font-semibold truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-xs truncate" style="color:#64748b;">Administrator</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="sidebar-link w-full text-left"
                        style="color:#f87171;"
                        onmouseover="this.style.background='rgba(239,68,68,0.1)';this.style.color='#fca5a5';"
                        onmouseout="this.style.background='';this.style.color='#f87171';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>

                <p class="text-xs text-center mt-2" style="color:#334155;">&copy; {{ date('Y') }} SiManPus</p>
            </div>

        </div>
    </aside>

    {{-- ========== MAIN CONTENT ========== --}}
    <div id="main-content" class="flex-1 flex flex-col min-h-screen overflow-x-hidden">

        {{-- Top Bar --}}
        <header class="bg-white px-5 py-3.5 flex items-center gap-4 sticky top-0 z-10"
                style="border-bottom:1px solid #e8eaf0; box-shadow:0 1px 4px rgba(0,0,0,0.04);">

            {{-- Toggle Button --}}
            <button id="toggle-sidebar" type="button" aria-label="Toggle sidebar"
                class="w-8 h-8 flex items-center justify-center rounded-lg border transition-colors flex-shrink-0"
                style="border-color:#e2e8f0; color:#64748b;"
                onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background=''">
                <svg class="icon-collapse w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg class="icon-expand w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h10M4 18h16" />
                </svg>
            </button>

            {{-- Breadcrumb / Title --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-1.5 text-xs" style="color:#94a3b8;">
                    <span>Dashboard</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-slate-700 font-medium">@yield('page-title', 'Dashboard')</span>
                </div>
            </div>

            {{-- Right: Date --}}
            <div class="flex items-center gap-2 text-xs flex-shrink-0" style="color:#94a3b8;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="hidden sm:inline">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</span>
            </div>

            {{-- User avatar (mini) --}}
            <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0"
                 style="background:linear-gradient(135deg,#7c3aed,#4f46e5);">
                <span class="text-white text-xs font-bold">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
            </div>
        </header>

        {{-- Flash Messages --}}
        <div class="px-6 pt-5">
            @if(session('success'))
                <div id="flash-success" class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 mb-0" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                    <button onclick="document.getElementById('flash-success').remove()" class="ml-auto text-green-500 hover:text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div id="flash-error" class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 mb-0" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                    <button onclick="document.getElementById('flash-error').remove()" class="ml-auto text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        {{-- Page Content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>

    {{-- ========== DELETE CONFIRM MODAL ========== --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
        <div class="relative flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-11 h-11 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Konfirmasi Hapus</h3>
                        <p id="deleteModalText" class="text-sm text-slate-500 mt-0.5">Data ini akan dihapus secara permanen.</p>
                    </div>
                </div>
                <div class="flex gap-3 justify-end mt-6">
                    <button id="cancelDelete" type="button"
                        class="px-4 py-2 text-sm font-medium rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium rounded-xl bg-red-600 text-white hover:bg-red-700 transition-colors">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- jQuery + DataTables --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.tailwindcss.min.js"></script>

    <script>
        // ── Sidebar toggle ──────────────────────────────────────────────
        const sidebar     = document.getElementById('sidebar');
        const toggleBtn   = document.getElementById('toggle-sidebar');
        const STORAGE_KEY = 'sidebar_collapsed';

        function setSidebar(collapsed, animate) {
            if (!animate) sidebar.style.transition = 'none';
            if (collapsed) {
                sidebar.classList.add('collapsed');
                document.body.classList.add('sidebar-collapsed');
            } else {
                sidebar.classList.remove('collapsed');
                document.body.classList.remove('sidebar-collapsed');
            }
            if (!animate) {
                sidebar.offsetHeight;
                sidebar.style.transition = '';
            }
            localStorage.setItem(STORAGE_KEY, collapsed ? '1' : '0');
        }

        setSidebar(localStorage.getItem(STORAGE_KEY) === '1', false);

        toggleBtn.addEventListener('click', () => {
            setSidebar(!sidebar.classList.contains('collapsed'), true);
        });

        // ── Delete modal ────────────────────────────────────────────────
        function confirmDelete(url, itemName) {
            const modal = document.getElementById('deleteModal');
            const form  = document.getElementById('deleteForm');
            const text  = document.getElementById('deleteModalText');
            form.action = url;
            text.textContent = 'Anda akan menghapus "' + itemName + '". Tindakan ini tidak dapat dibatalkan.';
            modal.classList.remove('hidden');
        }

        document.getElementById('cancelDelete').addEventListener('click', () => {
            document.getElementById('deleteModal').classList.add('hidden');
        });
        document.getElementById('deleteModal').addEventListener('click', function (e) {
            if (e.target === this) this.classList.add('hidden');
        });

        // ── Auto-hide flash ─────────────────────────────────────────────
        setTimeout(() => {
            ['flash-success', 'flash-error'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.remove();
            });
        }, 4000);
    </script>
    @stack('scripts')
</body>
</html>
