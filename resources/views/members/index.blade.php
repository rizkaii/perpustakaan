@extends('layouts.app')

@section('title', 'Data Anggota')
@section('page-title', 'Data Anggota')
@section('page-subtitle', 'Kelola data anggota perpustakaan')

@section('content')
<div class="space-y-4">

    {{-- Header --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h2 class="text-base font-semibold text-slate-800">Daftar Anggota</h2>
            <p class="text-sm text-slate-500 mt-0.5">Total {{ $members->count() }} anggota terdaftar</p>
        </div>
        <a href="{{ route('members.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Anggota
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="p-5 overflow-x-auto">
            <table id="membersTable" class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600 w-12">#</th>
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600 w-14">Foto</th>
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600">Nama Anggota</th>
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600">No. Anggota</th>
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600">Email</th>
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600">No. Telepon</th>
                        <th class="text-left pb-3 px-2 font-semibold text-slate-600">Alamat</th>
                        <th class="text-center pb-3 px-2 font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                        <td class="py-3 px-2 text-slate-400">{{ $loop->iteration }}</td>
                        <td class="py-3 px-2">
                            @if($member->foto)
                                <img src="{{ Storage::url($member->foto) }}" alt="Foto"
                                     class="w-9 h-9 rounded-full object-cover border-2 border-slate-200">
                            @else
                                <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center border-2 border-slate-200">
                                    <span class="text-indigo-600 font-semibold text-sm">
                                        {{ strtoupper(substr($member->nama, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </td>
                        <td class="py-3 px-2">
                            <p class="font-medium text-slate-800">{{ $member->nama }}</p>
                        </td>
                        <td class="py-3 px-2">
                            <span class="inline-flex items-center bg-slate-100 text-slate-700 text-xs font-mono font-medium px-2 py-1 rounded">
                                {{ $member->no_anggota }}
                            </span>
                        </td>
                        <td class="py-3 px-2 text-slate-600">{{ $member->email }}</td>
                        <td class="py-3 px-2 text-slate-600">{{ $member->no_telp ?? '-' }}</td>
                        <td class="py-3 px-2 text-slate-500 max-w-xs">
                            {{ $member->alamat ? Str::limit($member->alamat, 50) : '-' }}
                        </td>
                        <td class="py-3 px-2">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('members.edit', $member) }}"
                                   class="inline-flex items-center gap-1 text-xs font-medium bg-amber-50 text-amber-700 hover:bg-amber-100 px-2.5 py-1.5 rounded-md transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <button type="button"
                                    onclick="confirmDelete('{{ route('members.destroy', $member) }}', '{{ addslashes($member->nama) }}')"
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
                        <td colspan="8" class="py-12 text-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="font-medium">Belum ada anggota</p>
                            <p class="text-sm mt-1">Mulai dengan mendaftarkan anggota pertama.</p>
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
    $('#membersTable').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json'
        },
        order: [[2, 'asc']],
        columnDefs: [
            { orderable: false, targets: [1, 7] },
        ],
    });
</script>
@endpush
