@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')
@section('page-subtitle', 'Formulir penambahan kategori buku baru')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">

        {{-- Card Header --}}
        <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
            <a href="{{ route('categories.index') }}"
               class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-sm font-semibold text-slate-700">Form Tambah Kategori</h2>
        </div>

        {{-- Form --}}
        <form action="{{ route('categories.store') }}" method="POST" class="p-6 space-y-5">
            @csrf

            {{-- Nama Kategori --}}
            <div>
                <label for="nama_kategori" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nama_kategori" name="nama_kategori"
                    value="{{ old('nama_kategori') }}"
                    placeholder="Contoh: Fiksi, Ilmu Pengetahuan, Sejarah..."
                    class="w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition {{ $errors->has('nama_kategori') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                @error('nama_kategori')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Deskripsi
                    <span class="text-slate-400 font-normal">(opsional)</span>
                </label>
                <textarea id="deskripsi" name="deskripsi" rows="4"
                    placeholder="Deskripsi singkat tentang kategori ini..."
                    class="w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition resize-none {{ $errors->has('deskripsi') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Kategori
                </button>
                <a href="{{ route('categories.index') }}"
                   class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
