@extends('layouts.app')

@section('title', 'Data Buku')
@section('page-title', 'Data Buku')
@section('page-subtitle', 'Kelola koleksi buku perpustakaan')

@section('content')
<div class="space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h2 class="text-base font-semibold text-slate-800">Koleksi Buku</h2>
            <p class="text-sm text-slate-500 mt-0.5">Total {{ $books->count() }} judul buku tersedia</p>
        </div>
        <a href="{{ route('books.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Buku
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="p-5 overflow-x-auto">
            <table id="booksTable" class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600 w-12">#</th>
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600 w-16">Cover</th>
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600">Judul / Pengarang</th>
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600">ISBN</th>
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600">Kategori</th>
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600">Penerbit</th>
                        <th class="text-center pb-3 px-2 font-semibold text-slate-600">Tahun</th>
                        <th class="text-center pb-3 px-2 font-semibold text-slate-600">Stok</th>
                        <th class="text-center pb-3 px-2 font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                        <td class="py-3 px-2 text-slate-400">{{ $loop->iteration }}</td>
                        <td class="py-3 px-2">
                            @if($book->cover)
                                <img src="{{ Storage::url($book->cover) }}" alt="Cover"
                                     class="w-10 h-14 object-cover rounded-md border border-slate-200">
                            @else
                                <div class="w-10 h-14 bg-slate-100 rounded-md border border-slate-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="py-3 px-2">
                            <p class="font-medium text-slate-800">{{ $book->judul }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $book->pengarang }}</p>
                        </td>
                        <td class="py-3 px-2 text-slate-600 font-mono text-xs">{{ $book->isbn }}</td>
                        <td class="py-3 px-2">
                            <span class="inline-flex items-center bg-violet-50 text-violet-700 text-xs font-medium px-2.5 py-1 rounded-full">
                                {{ $book->category->nama_kategori ?? '-' }}
                            </span>
                        </td>
                        <td class="py-3 px-2 text-slate-600">{{ $book->penerbit }}</td>
                        <td class="py-3 px-2 text-center text-slate-600">{{ $book->tahun_terbit }}</td>
                        <td class="py-3 px-2 text-center">
                            <span class="inline-flex items-center justify-center min-w-8 px-2 py-1 rounded-full text-xs font-semibold
                                {{ $book->stok > 0 ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                {{ $book->stok }}
                            </span>
                        </td>
                        <td class="py-3 px-2">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('books.edit', $book) }}"
                                   class="inline-flex items-center gap-1 text-xs font-medium bg-amber-50 text-amber-700 hover:bg-amber-100 px-2.5 py-1.5 rounded-md transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <button type="button"
                                    onclick="confirmDelete('{{ route('books.destroy', $book) }}', '{{ addslashes($book->judul) }}')"
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
                        <td colspan="9" class="py-12 text-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <p class="font-medium">Belum ada buku</p>
                            <p class="text-sm mt-1">Mulai tambahkan koleksi buku pertama.</p>
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
    $('#booksTable').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json'
        },
        order: [[2, 'asc']],
        columnDefs: [
            { orderable: false, targets: [1, 8] },
        ],
    });
</script>
@endpush
