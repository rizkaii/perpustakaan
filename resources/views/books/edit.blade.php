@extends('layouts.app')

@section('title', 'Edit Buku')
@section('page-title', 'Edit Buku')
@section('page-subtitle', 'Ubah data buku dalam koleksi')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">

        {{-- Card Header --}}
        <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
            <a href="{{ route('books.index') }}"
               class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-sm font-semibold text-slate-700">Edit Buku</h2>
                <p class="text-xs text-slate-400">{{ $book->judul }}</p>
            </div>
        </div>

        <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            <div>
                <label for="judul" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Judul Buku <span class="text-red-500">*</span>
                </label>
                <input type="text" id="judul" name="judul"
                    value="{{ old('judul', $book->judul) }}" placeholder="Masukkan judul buku..."
                    class="w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition {{ $errors->has('judul') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                @error('judul')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pengarang & Penerbit --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="pengarang" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Pengarang <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="pengarang" name="pengarang"
                        value="{{ old('pengarang', $book->pengarang) }}" placeholder="Nama pengarang..."
                        class="w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition {{ $errors->has('pengarang') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                    @error('pengarang')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="penerbit" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Penerbit <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="penerbit" name="penerbit"
                        value="{{ old('penerbit', $book->penerbit) }}" placeholder="Nama penerbit..."
                        class="w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition {{ $errors->has('penerbit') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                    @error('penerbit')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Kategori & Tahun --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-2">
                        <select id="category_id" name="category_id"
                            class="flex-1 border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition {{ $errors->has('category_id') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id', $book->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" onclick="toggleNewCategory()"
                            title="Tambah kategori baru"
                            class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-lg border border-indigo-300 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-colors">
                            <svg id="btnPlusIcon" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            <svg id="btnMinusIcon" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                            </svg>
                        </button>
                    </div>

                    {{-- Panel tambah kategori baru --}}
                    <div id="newCategoryPanel" class="hidden mt-2 p-3 bg-indigo-50 border border-indigo-200 rounded-lg space-y-2">
                        <p class="text-xs font-semibold text-indigo-700">Tambah Kategori Baru</p>
                        <input type="text" id="new_category_name" placeholder="Nama kategori baru..."
                            class="w-full border border-indigo-300 rounded-md px-3 py-2 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white">
                        <input type="text" id="new_category_desc" placeholder="Deskripsi (opsional)..."
                            class="w-full border border-indigo-300 rounded-md px-3 py-2 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white">
                        <button type="button" onclick="submitNewCategory()"
                            class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium px-3 py-1.5 rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan & Pilih
                        </button>
                        <p id="newCategoryMsg" class="text-xs hidden"></p>
                    </div>

                    @error('category_id')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tahun_terbit" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Tahun Terbit <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="tahun_terbit" name="tahun_terbit"
                        value="{{ old('tahun_terbit', $book->tahun_terbit) }}"
                        min="1000" max="{{ date('Y') }}"
                        class="w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition {{ $errors->has('tahun_terbit') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                    @error('tahun_terbit')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- ISBN & Stok --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="isbn" class="block text-sm font-medium text-slate-700 mb-1.5">
                        ISBN <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="isbn" name="isbn"
                        value="{{ old('isbn', $book->isbn) }}" placeholder="978-xxx-xxx-xxx-x"
                        class="w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition font-mono {{ $errors->has('isbn') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                    @error('isbn')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="stok" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Stok <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="stok" name="stok"
                        value="{{ old('stok', $book->stok) }}" min="0"
                        class="w-full border rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition {{ $errors->has('stok') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                    @error('stok')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Cover --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">
                    Cover Buku <span class="text-slate-400 font-normal">(kosongkan jika tidak ingin mengubah)</span>
                </label>
                <div class="flex items-start gap-4">
                    {{-- Existing cover preview --}}
                    <div class="w-20 h-28 rounded-lg border border-slate-200 overflow-hidden flex-shrink-0 bg-slate-50">
                        @if($book->cover)
                            <img id="coverPreview" src="{{ Storage::url($book->cover) }}" alt="Cover"
                                 class="w-full h-full object-cover">
                        @else
                            <img id="coverPreview" src="#" alt="Preview"
                                 class="w-full h-full object-cover hidden">
                            <div id="coverPlaceholder" class="w-full h-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <label for="cover"
                            class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed rounded-lg cursor-pointer hover:bg-slate-50 transition {{ $errors->has('cover') ? 'border-red-400' : 'border-slate-300' }}">
                            <div class="flex flex-col items-center justify-center gap-1.5 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-xs">Klik untuk ganti cover</p>
                                <p class="text-xs text-slate-300">JPG, PNG, WebP — maks. 2MB</p>
                            </div>
                            <input id="cover" name="cover" type="file" accept="image/*" class="hidden"
                                   onchange="previewEditImage(this)">
                        </label>
                    </div>
                </div>
                @error('cover')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex gap-3 pt-2 border-t border-slate-100">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Perbarui Buku
                </button>
                <a href="{{ route('books.index') }}"
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
    function previewEditImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('coverPreview');
                const placeholder = document.getElementById('coverPlaceholder');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function toggleNewCategory() {
        const panel     = document.getElementById('newCategoryPanel');
        const plusIcon  = document.getElementById('btnPlusIcon');
        const minusIcon = document.getElementById('btnMinusIcon');
        const isHidden  = panel.classList.contains('hidden');

        panel.classList.toggle('hidden', !isHidden);
        plusIcon.classList.toggle('hidden', isHidden);
        minusIcon.classList.toggle('hidden', !isHidden);

        if (isHidden) document.getElementById('new_category_name').focus();
    }

    function submitNewCategory() {
        const name = document.getElementById('new_category_name').value.trim();
        const desc = document.getElementById('new_category_desc').value.trim();
        const msg  = document.getElementById('newCategoryMsg');

        if (!name) {
            msg.textContent = 'Nama kategori tidak boleh kosong.';
            msg.className = 'text-xs text-red-600';
            msg.classList.remove('hidden');
            return;
        }

        const btn = event.currentTarget;
        btn.disabled = true;
        btn.textContent = 'Menyimpan...';

        fetch('{{ route("categories.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: JSON.stringify({ nama_kategori: name, deskripsi: desc })
        })
        .then(res => res.json())
        .then(data => {
            if (data.id) {
                const select = document.getElementById('category_id');
                const option = new Option(data.nama_kategori, data.id, true, true);
                select.appendChild(option);
                select.value = data.id;

                document.getElementById('new_category_name').value = '';
                document.getElementById('new_category_desc').value = '';
                msg.textContent = 'Kategori "' + data.nama_kategori + '" berhasil ditambahkan.';
                msg.className = 'text-xs text-green-600';
                msg.classList.remove('hidden');

                setTimeout(() => {
                    toggleNewCategory();
                    msg.classList.add('hidden');
                }, 1500);
            } else {
                const errors = data.errors;
                const firstError = errors ? Object.values(errors)[0][0] : 'Terjadi kesalahan.';
                msg.textContent = firstError;
                msg.className = 'text-xs text-red-600';
                msg.classList.remove('hidden');
            }
        })
        .catch(() => {
            msg.textContent = 'Gagal menghubungi server.';
            msg.className = 'text-xs text-red-600';
            msg.classList.remove('hidden');
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg> Simpan & Pilih';
        });
    }
</script>
@endpush
