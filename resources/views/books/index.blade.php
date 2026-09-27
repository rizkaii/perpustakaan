@extends('layouts.app')

@section('title', 'Data Buku')
@section('page-title', 'Data Buku')
@section('page-subtitle', 'Kelola koleksi buku perpustakaan')

@section('content')
<div class="space-y-5">

    {{-- Header Card --}}
    <div class="bg-white rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4"
         style="border:1px solid #eef0f6; box-shadow:0 1px 4px rgba(0,0,0,0.04);">
        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                 style="background:rgba(124,58,237,0.1);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="color:#7c3aed;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-800">Koleksi Buku</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total
                    <span class="font-semibold" style="color:#7c3aed;">{{ $books->count() }}</span>
                    judul buku tersedia
                </p>
            </div>
        </div>
        <a href="{{ route('books.create') }}"
           class="inline-flex items-center gap-2 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-all flex-shrink-0"
           style="background:linear-gradient(135deg,#7c3aed,#4f46e5); box-shadow:0 4px 12px rgba(124,58,237,0.3);"
           onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Buku
        </a>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-2xl overflow-hidden" style="border:1px solid #eef0f6; box-shadow:0 1px 4px rgba(0,0,0,0.04);">
        <div class="p-5 overflow-x-auto">
            <table id="booksTable" class="w-full text-sm">
                <thead>
                    <tr style="border-bottom:2px solid #f1f3f9;">
                        <th class="text-left pb-3 px-3 font-semibold text-xs uppercase tracking-wider" style="color:#94a3b8; width:3rem;">#</th>
                        <th class="text-left pb-3 px-3 font-semibold text-xs uppercase tracking-wider" style="color:#94a3b8; width:4rem;">Cover</th>
                        <th class="text-left pb-3 px-3 font-semibold text-xs uppercase tracking-wider" style="color:#94a3b8;">Judul / Pengarang</th>
                        <th class="text-left pb-3 px-3 font-semibold text-xs uppercase tracking-wider" style="color:#94a3b8;">ISBN</th>
                        <th class="text-left pb-3 px-3 font-semibold text-xs uppercase tracking-wider" style="color:#94a3b8;">Kategori</th>
                        <th class="text-left pb-3 px-3 font-semibold text-xs uppercase tracking-wider" style="color:#94a3b8;">Penerbit</th>
                        <th class="text-center pb-3 px-3 font-semibold text-xs uppercase tracking-wider" style="color:#94a3b8;">Tahun</th>
                        <th class="text-center pb-3 px-3 font-semibold text-xs uppercase tracking-wider" style="color:#94a3b8;">Stok</th>
                        <th class="text-center pb-3 px-3 font-semibold text-xs uppercase tracking-wider" style="color:#94a3b8;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr class="group transition-colors" style="border-bottom:1px solid #f8f9fc;"
                        onmouseover="this.style.background='#fafbff'" onmouseout="this.style.background=''">
                        <td class="py-3.5 px-3 text-xs" style="color:#cbd5e1;">{{ $loop->iteration }}</td>
                        <td class="py-3.5 px-3">
                            @if($book->cover)
                                <img src="{{ Storage::url($book->cover) }}" alt="Cover"
                                     class="w-9 h-13 rounded-lg object-cover" style="border:1px solid #eef0f6;">
                            @else
                                <div class="w-9 h-13 rounded-lg flex items-center justify-center" style="background:#f8f9fc; border:1px solid #eef0f6; width:2.25rem; height:3.25rem;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color:#c4b5fd;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="py-3.5 px-3">
                            <p class="font-semibold text-slate-800 text-sm">{{ $book->judul }}</p>
                            <p class="text-xs mt-0.5" style="color:#94a3b8;">{{ $book->pengarang }}</p>
                        </td>
                        <td class="py-3.5 px-3 font-mono text-xs" style="color:#64748b;">{{ $book->isbn }}</td>
                        <td class="py-3.5 px-3">
                            <span class="inline-flex items-center text-xs font-semibold px-2.5 py-1 rounded-full"
                                  style="background:rgba(124,58,237,0.1); color:#7c3aed;">
                                {{ $book->category->nama_kategori ?? '-' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-3 text-sm" style="color:#475569;">{{ $book->penerbit }}</td>
                        <td class="py-3.5 px-3 text-center text-sm" style="color:#475569;">{{ $book->tahun_terbit }}</td>
                        <td class="py-3.5 px-3 text-center">
                            <span class="inline-flex items-center justify-center min-w-8 px-2 py-1 rounded-full text-xs font-bold"
                                  style="{{ $book->stok > 0 ? 'background:#dcfce7;color:#16a34a;' : 'background:#fee2e2;color:#dc2626;' }}">
                                {{ $book->stok }}
                            </span>
                        </td>
                        <td class="py-3.5 px-3">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('books.edit', $book) }}"
                                   class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1.5 rounded-lg transition-colors"
                                   style="background:#fef3c7; color:#d97706;"
                                   onmouseover="this.style.background='#fde68a'" onmouseout="this.style.background='#fef3c7'">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <button type="button"
                                    onclick="confirmDelete('{{ route('books.destroy', $book) }}', '{{ addslashes($book->judul) }}')"
                                    class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1.5 rounded-lg transition-colors"
                                    style="background:#fee2e2; color:#dc2626;"
                                    onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fee2e2'">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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
            emptyTable:   "Belum ada data buku",
            zeroRecords:  "Buku tidak ditemukan",
            info:         "Menampilkan _START_ - _END_ dari _TOTAL_ buku",
            infoEmpty:    "Menampilkan 0 buku",
            infoFiltered: "(difilter dari _MAX_ total)",
            search:       "Cari:",
            lengthMenu:   "Tampilkan _MENU_ data",
            paginate: { first:"Pertama", last:"Terakhir", next:"›", previous:"‹" }
        },
        order: [[2, 'asc']],
        columnDefs: [{ orderable: false, targets: [1, 8] }],
    });
</script>
@endpush
