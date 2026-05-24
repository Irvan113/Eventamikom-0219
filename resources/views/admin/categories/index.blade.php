@extends('layout.admin')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header & Breadcrumb -->
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Kelola Kategori</h1>
            <p class="text-slate-500 mt-1">Atur dan kelola kategori event sistem Anda.</p>
        </div>
        <button onclick="document.getElementById('createModal').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-semibold transition shadow-sm">
            + Tambah Kategori
        </button>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="bg-emerald-100 text-emerald-800 p-4 rounded-xl mb-6 font-medium border border-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- Toolbar: Search (Soal 3) -->
    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 mb-6 flex justify-between items-center">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="flex w-full max-w-md">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kategori..." class="w-full border border-slate-200 rounded-l-xl px-4 py-2 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
            <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-r-xl font-medium transition">Cari</button>
        </form>
    </div>

    <!-- Table Kategori -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold border-b border-slate-100">ID</th>
                    <th class="p-4 font-semibold border-b border-slate-100">Nama Kategori</th>
                    <th class="p-4 font-semibold border-b border-slate-100">Dibuat Pada</th>
                    <th class="p-4 font-semibold border-b border-slate-100">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-slate-700 divide-y divide-slate-100">
                @forelse($categories as $category)
                <tr class="hover:bg-slate-50 transition">
                    <td class="p-4">{{ $category->id }}</td>
                    <td class="p-4 font-medium text-slate-900">{{ $category->name }}</td>
                    <td class="p-4 text-sm text-slate-500">{{ $category->created_at->format('d M Y') }}</td>
                    <td class="p-4 flex gap-2">
                        <!-- Tombol Edit -->
                        <button onclick="document.getElementById('editModal-{{ $category->id }}').classList.remove('hidden')" class="text-indigo-600 hover:text-indigo-800 font-medium px-3 py-1 bg-indigo-50 rounded-lg transition">Edit</button>
                        
                        <!-- Form Hapus -->
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-600 hover:text-rose-800 font-medium px-3 py-1 bg-rose-50 rounded-lg transition">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit Kategori (Satu untuk tiap baris) -->
                <div id="editModal-{{ $category->id }}" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center z-50">
                    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                        <h2 class="text-xl font-bold mb-4 text-slate-900">Edit Kategori</h2>
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Kategori</label>
                                <input type="text" name="name" value="{{ $category->name }}" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition">
                            </div>
                            <div class="flex justify-end gap-3 mt-6">
                                <button type="button" onclick="document.getElementById('editModal-{{ $category->id }}').classList.add('hidden')" class="px-5 py-2.5 rounded-xl font-medium text-slate-600 hover:bg-slate-100 transition">Batal</button>
                                <button type="submit" class="px-5 py-2.5 rounded-xl font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-slate-500">Tidak ada data kategori ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>

<!-- Modal Create Kategori -->
<div id="createModal" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <h2 class="text-xl font-bold mb-4 text-slate-900">Tambah Kategori Baru</h2>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Kategori</label>
                <input type="text" name="name" required placeholder="Contoh: Teknologi" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition">
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="document.getElementById('createModal').classList.add('hidden')" class="px-5 py-2.5 rounded-xl font-medium text-slate-600 hover:bg-slate-100 transition">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection