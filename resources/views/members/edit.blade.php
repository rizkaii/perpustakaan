@extends('layouts.app')

@section('title', 'Edit Anggota')
@section('page-title', 'Edit Anggota')
@section('page-subtitle', 'Ubah data anggota perpustakaan')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">

        {{-- Card Header --}}
        <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
            <a href="{{ route('members.index') }}"
               class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-sm font-semibold text-slate-700">Edit Anggota</h2>
                <p class="text-xs text-slate-400">{{ $member->nama }} — {{ $member->no_anggota }}</p>
            </div>
        </div>

        <form action="{{ route('members.update', $member) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- Foto --}}
            <div class="flex items-center gap-5">
                <div class="relative w-20 h-20">
                    <div class="w-20 h-20 rounded-full border-2 border-slate-200 overflow-hidden bg-slate-100 flex items-center justify-center">
                        @if($member->foto)
                            <img id="fotoPreview" src="{{ Storage::url($member->foto) }}" alt="Foto"
                                 class="w-full h-full object-cover">
                        @else
                            <img id="fotoPreview" src="#" alt="Preview" class="w-full h-full object-cover hidden">
                            <div id="fotoPlaceholder" class="w-full h-full flex items-center justify-center bg-indigo-100 rounded-full">
                                <span class="text-indigo-600 font-bold text-2xl">
                                    {{ strtoupper(substr($member->nama, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
                <div>
                    <label for="foto" class="inline-flex items-center gap-2 cursor-pointer bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01" />
                        </svg>
                        Ganti Foto
                        <input id="foto" name="foto" type="file" accept="image/*" class="hidden"
                               onchange="previewFoto(this)">
                    </label>
                    <p class="text-xs text-slate-400 mt-1.5">Kosongkan jika tidak ingin mengubah foto</p>
                    @error('foto')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Nama & No Anggota --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="nama" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama" name="nama"
                        value="{{ old('nama', $member->nama) }}" placeholder="Nama lengkap anggota..."
                        class="w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition {{ $errors->has('nama') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                    @error('nama')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="no_anggota" class="block text-sm font-medium text-slate-700 mb-1.5">
                        No. Anggota <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="no_anggota" name="no_anggota"
                        value="{{ old('no_anggota', $member->no_anggota) }}" placeholder="Contoh: AGT-0001"
                        class="w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition font-mono {{ $errors->has('no_anggota') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                    @error('no_anggota')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Email & No Telp --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email"
                        value="{{ old('email', $member->email) }}" placeholder="email@example.com"
                        class="w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="no_telp" class="block text-sm font-medium text-slate-700 mb-1.5">
                        No. Telepon <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <input type="text" id="no_telp" name="no_telp"
                        value="{{ old('no_telp', $member->no_telp) }}" placeholder="08xxxxxxxxxx"
                        class="w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition {{ $errors->has('no_telp') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                    @error('no_telp')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Alamat --}}
            <div>
                <label for="alamat" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Alamat <span class="text-slate-400 font-normal">(opsional)</span>
                </label>
                <textarea id="alamat" name="alamat" rows="3"
                    placeholder="Alamat lengkap anggota..."
                    class="w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition resize-none {{ $errors->has('alamat') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">{{ old('alamat', $member->alamat) }}</textarea>
                @error('alamat')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Perbarui Anggota
                </button>
                <a href="{{ route('members.index') }}"
                   class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewFoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('fotoPreview');
                const placeholder = document.getElementById('fotoPlaceholder');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
