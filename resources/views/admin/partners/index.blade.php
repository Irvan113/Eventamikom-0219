@extends('layout.admin', ['title' => 'Kelola Partner'])

@section('content')
<header class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-3xl font-black">Kelola Partner</h1>
        <p class="text-slate-500 font-medium">Atur partner sponsor, media partner, dan kolaborator.</p>
    </div>
    <a href="{{ route('admin.partners.create') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg hover:bg-indigo-700 transition">
        + Tambah Partner
    </a>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
            <tr>
                <th class="px-8 py-4">No</th>
                <th class="px-8 py-4">Nama</th>
                <th class="px-8 py-4">Tipe</th>
                <th class="px-8 py-4">Website</th>
                <th class="px-8 py-4">Status</th>
                <th class="px-8 py-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y border-t">
            @forelse($partners as $index => $partner)
            <tr class="hover:bg-slate-50/50 transition">
                <td class="px-8 py-6 font-bold text-slate-400">{{ $index + 1 }}</td>
                <td class="px-8 py-6 font-black text-slate-800">{{ $partner->name }}</td>
                <td class="px-8 py-6 text-slate-600">{{ $partner->type }}</td>
                <td class="px-8 py-6 text-slate-500">{{ $partner->website ?? '-' }}</td>
                <td class="px-8 py-6">
                    <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $partner->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                        {{ ucfirst($partner->status) }}
                    </span>
                </td>
                <td class="px-8 py-6 flex justify-end gap-2">
                    <a href="{{ route('admin.partners.edit', $partner->id) }}" class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">Edit</a>
                    <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" onsubmit="return confirm('Hapus partner ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-600 rounded-xl font-bold hover:bg-rose-600 hover:text-white transition">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-8 py-10 text-center text-slate-500">Belum ada partner</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
