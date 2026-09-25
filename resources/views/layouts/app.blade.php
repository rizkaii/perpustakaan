<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Perpustakaan') — Sistem Manajemen Perpustakaan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.tailwindcss.min.css">
    <style>
        /* Sidebar links */
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 1rem;
            border-radius: 0.5rem;
            color: #cbd5e1;
            transition: background-color 0.15s, color 0.15s;
            white-space: nowrap;
            overflow: hidden;
        }
        .sidebar-link:hover  { background-color: #334155; color: #fff; }
        .sidebar-link.active { background-color: #4f46e5; color: #fff; }

        /* Sidebar slide animation */
        #sidebar {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        min-width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }
        #sidebar.collapsed {
            width: 0 !important;
            min-width: 0 !important;
        }

        /* Sidebar inner — prevent wrapping during animation */
        #sidebar-inner {
            width: 16rem; /* 256px = w-64 */
            min-width: 16rem;
        }

        /* Main content transition */
        #main-content {
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Toggle button icon swap */
        #toggle-sidebar .icon-collapse { display: block; }
        #toggle-sidebar .icon-expand   { display: none;  }
        body.sidebar-collapsed #toggle-sidebar .icon-collapse { display: none;  }
        body.sidebar-collapsed #toggle-sidebar .icon-expand   { display: block; }

        /* DataTables input override */
        div.dataTables_wrapper div.dataTables_length select,
        div.dataTables_wrapper div.dataTables_filter input {
            border: 1px solid #cbd5e1;
            border-radius: 0.375rem;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            outline: none;
        }
        div.dataTables_wrapper div.dataTables_length select:focus,
        div.dataTables_wrapper div.dataTables_filter input:focus {
            ring: 2px solid #818cf8;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex">

    {{-- ========== SIDEBAR ========== --}}
    <aside id="sidebar" class="w-64 min-h-screen bg-slate-800 flex-shrink-0 flex">
        <div id="sidebar-inner" class="flex flex-col">

            {{-- Brand --}}
            <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-700">
                <div class="w-9 h-9 bg-indigo-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                    </svg>
                </div>
                <div class="overflow-hidden">
                    <p class="text-white font-semibold text-sm leading-tight">SiManPus</p>
                    <p class="text-slate-400 text-xs">Manajemen Perpustakaan</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-3 py-4 space-y-1">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-4 mb-2 whitespace-nowrap">Menu Utama</p>

                <a href="{{ route('books.index') }}"
                   class="sidebar-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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

            {{-- Footer --}}
            <div class="px-4 py-4 border-t border-slate-700">
                <p class="text-slate-500 text-xs text-center whitespace-nowrap">&copy; {{ date('Y') }} SiManPus</p>
            </div>

        </div>
    </aside>

    {{-- ========== MAIN CONTENT ========== --}}
    <div id="main-content" class="flex-1 flex flex-col min-h-screen overflow-x-hidden">

        {{-- Top Bar --}}
        <header class="bg-white border-b border-slate-200 px-4 py-4 flex items-center gap-4 sticky top-0 z-10">

            {{-- Toggle Button --}}
            <button id="toggle-sidebar" type="button"
                aria-label="Toggle sidebar"
                class="w-9 h-9 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition-colors flex-shrink-0">
                {{-- Collapse icon (hamburger) --}}
                <svg class="icon-collapse w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                {{-- Expand icon (menu open) --}}
                <svg class="icon-expand w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h10M4 18h16" />
                </svg>
            </button>

            <div class="flex-1 min-w-0">
                <h1 class="text-lg font-semibold text-slate-800 truncate">@yield('page-title', 'Dashboard')</h1>
                <p class="text-xs text-slate-500 truncate">@yield('page-subtitle', 'Sistem Manajemen Perpustakaan')</p>
            </div>

            <div class="flex items-center gap-2 text-sm text-slate-500 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="hidden sm:inline">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</span>
            </div>
        </header>

        {{-- Flash Messages --}}
        <div class="px-6 pt-5">
            @if(session('success'))
                <div id="flash-success" class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 mb-0" role="alert">
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
                <div id="flash-error" class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 mb-0" role="alert">
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
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Konfirmasi Hapus</h3>
                        <p id="deleteModalText" class="text-sm text-slate-500 mt-0.5">Data ini akan dihapus secara permanen.</p>
                    </div>
                </div>
                <div class="flex gap-3 justify-end mt-6">
                    <button id="cancelDelete" type="button"
                        class="px-4 py-2 text-sm font-medium rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50 transition-colors">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors">
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
        const sidebar       = document.getElementById('sidebar');
        const toggleBtn     = document.getElementById('toggle-sidebar');
        const STORAGE_KEY   = 'sidebar_collapsed';

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
                // Force reflow, then re-enable transition
                sidebar.offsetHeight;
                sidebar.style.transition = '';
            }
            localStorage.setItem(STORAGE_KEY, collapsed ? '1' : '0');
        }

        // Restore state on load (no animation to avoid flash)
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
