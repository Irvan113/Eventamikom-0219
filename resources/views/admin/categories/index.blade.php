@extends('layout.admin', ['title' => 'Kelola Kategori'])

@section('content')
<header class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-3xl font-black">Kelola Kategori</h1>
        <p class="text-slate-500 font-medium">Atur kategori event untuk kebutuhan publik dan admin.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg hover:bg-indigo-700 transition">
        + Tambah Kategori
    </a>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
            <tr>
                <th class="px-8 py-4">No</th>
                <th class="px-8 py-4">Nama</th>
                <th class="px-8 py-4">Slug</th>
                <th class="px-8 py-4">Event</th>
                <th class="px-8 py-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y border-t">
            @forelse($categories as $index => $category)
            <tr class="hover:bg-slate-50/50 transition">
                <td class="px-8 py-6 font-bold text-slate-400">{{ $index + 1 }}</td>
                <td class="px-8 py-6 font-black text-slate-800">{{ $category->name }}</td>
                <td class="px-8 py-6 text-sm text-slate-500">{{ $category->slug }}</td>
                <td class="px-8 py-6 text-sm text-slate-500">{{ $category->events_count }} event</td>
                <td class="px-8 py-6 flex justify-end gap-2">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-600 rounded-xl font-bold hover:bg-rose-600 hover:text-white transition">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-8 py-10 text-center text-slate-500">Belum ada kategori</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection