@extends('layout.admin') 

@section('content')
<div class="p-8 bg-slate-50 min-h-screen">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Manajemen Kategori</h2>
            <p class="text-slate-500 mt-1">Atur kategori event untuk memudahkan pencarian pengguna.</p>
        </div>
        <button class="flex items-center justify-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kategori
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-200">
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 w-20">No</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Nama Kategori</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @php 
                    $categories = [
                        ['id' => 1, 'nama' => 'Seminar', 'color' => 'bg-blue-100 text-blue-700'],
                        ['id' => 2, 'nama' => 'Konser', 'color' => 'bg-purple-100 text-purple-700'],
                        ['id' => 3, 'nama' => 'Workshop', 'color' => 'bg-emerald-100 text-emerald-700']
                    ]; 
                @endphp
                
                @foreach($categories as $cat)
                <tr class="group hover:bg-slate-50/80 transition-colors duration-150">
                    <td class="px-6 py-5 text-sm font-medium text-slate-400">#{{ $cat['id'] }}</td>
                    <td class="px-6 py-5">
                        <span class="px-3 py-1.5 rounded-lg font-bold text-sm {{ $cat['color'] }}">
                            {{ $cat['nama'] }}
                        </span>
                    </td>
                    <td class="px-6 py-5 text-right">
                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <button class="p-2 text-amber-600 bg-amber-50 rounded-lg hover:bg-amber-600 hover:text-white transition-all shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button class="p-2 text-rose-600 bg-rose-50 rounded-lg hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection