@extends('layout.admin', ['title' => 'Tambah Kategori'])

@section('content')
<header class="mb-10">
    <h1 class="text-3xl font-black">Tambah Kategori</h1>
    <p class="text-slate-500 font-medium">Buat kategori event baru.</p>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 p-10 shadow-sm max-w-2xl">
    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Kategori</label>
            <input type="text" name="name" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none" required>
        </div>
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 font-bold text-slate-400">Batal</a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection
