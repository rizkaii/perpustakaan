@extends('layouts.app')

@section('title', 'Kategori Buku')
@section('page-title', 'Kategori Buku')
@section('page-subtitle', 'Kelola data kategori buku perpustakaan')

@section('content')
<div class="space-y-4">

    {{-- Header Card --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h2 class="text-base font-semibold text-slate-800">Daftar Kategori</h2>
            <p class="text-sm text-slate-500 mt-0.5">Total {{ $categories->count() }} kategori terdaftar</p>
        </div>
        <a href="{{ route('categories.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kategori
        </a>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="p-5 overflow-x-auto">
            <table id="categoriesTable" class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600 w-12">#</th>
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600">Nama Kategori</th>
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600">Deskripsi</th>
                        <th class="text-center pb-3 px-2 font-semibold text-slate-600">Jumlah Buku</th>
                        <th class="text-center pb-3 px-2 font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                        <td class="py-3 px-2 text-slate-500">{{ $loop->iteration }}</td>
                        <td class="py-3 px-2">
                            <span class="inline-flex items-center gap-1.5 font-medium text-slate-800">
                                <span class="w-2 h-2 rounded-full bg-indigo-500 flex-shrink-0"></span>
                                {{ $category->nama_kategori }}
                            </span>
                        </td>
                        <td class="py-3 px-2 text-slate-500 max-w-xs">
                            {{ $category->deskripsi ? Str::limit($category->deskripsi, 80) : '-' }}
                        </td>
                        <td class="py-3 px-2 text-center">
                            <span class="inline-flex items-center justify-center bg-indigo-50 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                                {{ $category->books_count }} buku
                            </span>
                        </td>
                        <td class="py-3 px-2">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('categories.edit', $category) }}"
                                   class="inline-flex items-center gap-1 text-xs font-medium bg-amber-50 text-amber-700 hover:bg-amber-100 px-2.5 py-1.5 rounded-md transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <button type="button"
                                    onclick="confirmDelete('{{ route('categories.destroy', $category) }}', '{{ addslashes($category->nama_kategori) }}')"
                                    class="inline-flex items-center gap-1 text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 px-2.5 py-1.5 rounded-md transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="font-medium">Belum ada kategori</p>
                            <p class="text-sm mt-1">Mulai dengan menambah kategori pertama.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    $('#categoriesTable').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json'
        },
        order: [[1, 'asc']],
        columnDefs: [{ orderable: false, targets: [4] }],
    });
</script>
@endpush
