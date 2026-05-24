@extends('layout.admin')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Kelola Partner</h1>
            <p class="text-slate-500 mt-1">Daftar partner pendukung platform AmikomEventHub.</p>
        </div>
        <button onclick="document.getElementById('createPartnerModal').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-semibold transition shadow-sm">
            + Tambah Partner
        </button>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="bg-emerald-100 text-emerald-800 p-4 rounded-xl mb-6 font-medium border border-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- Alert Error (Jika validasi upload gagal) -->
    @if($errors->any())
        <div class="bg-rose-100 text-rose-800 p-4 rounded-xl mb-6 border border-rose-200">
            <ul class="list-disc ml-5 text-sm font-medium">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Toolbar: Search (Soal 3) -->
    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 mb-6 flex justify-between items-center">
        <form action="{{ route('admin.partners.index') }}" method="GET" class="flex w-full max-w-md">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama partner..." class="w-full border border-slate-200 rounded-l-xl px-4 py-2 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
            <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-r-xl font-medium transition">Cari</button>
        </form>
    </div>

    <!-- Table Partner -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold border-b border-slate-100 w-20">Logo</th>
                    <th class="p-4 font-semibold border-b border-slate-100">Nama Partner</th>
                    <th class="p-4 font-semibold border-b border-slate-100">Dibuat Pada</th>
                    <th class="p-4 font-semibold border-b border-slate-100">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-slate-700 divide-y divide-slate-100">
                @forelse($partners as $partner)
                <tr class="hover:bg-slate-50 transition items-center">
                    <td class="p-4">
                        <div class="w-12 h-12 rounded-xl border border-slate-200 bg-white p-1 flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('storage/' . $partner->logo_url) }}" alt="{{ $partner->name }}" class="object-contain w-full h-full">
                        </div>
                    </td>
                    <td class="p-4 font-medium text-slate-900">{{ $partner->name }}</td>
                    <td class="p-4 text-sm text-slate-500">{{ $partner->created_at->format('d M Y') }}</td>
                    <td class="p-4 flex gap-2 mt-2">
                        <!-- Tombol Edit -->
                        <button onclick="document.getElementById('editPartnerModal-{{ $partner->id }}').classList.remove('hidden')" class="text-indigo-600 hover:text-indigo-800 font-medium px-3 py-1 bg-indigo-50 rounded-lg transition">Edit</button>
                        
                        <!-- Form Hapus -->
                        <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" onsubmit="return confirm('Hapus partner ini beserta logonya?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-600 hover:text-rose-800 font-medium px-3 py-1 bg-rose-50 rounded-lg transition">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit Partner -->
                <div id="editPartnerModal-{{ $partner->id }}" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center z-50">
                    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                        <h2 class="text-xl font-bold mb-4 text-slate-900">Edit Partner</h2>
                        <!-- WAJIB enctype untuk upload file -->
                        <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Partner</label>
                                <input type="text" name="name" value="{{ $partner->name }}" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Update Logo (Opsional)</label>
                                <input type="file" name="logo" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                <p class="text-xs text-slate-400 mt-2">Biarkan kosong jika tidak ingin mengubah logo.</p>
                            </div>
                            <div class="flex justify-end gap-3 mt-6">
                                <button type="button" onclick="document.getElementById('editPartnerModal-{{ $partner->id }}').classList.add('hidden')" class="px-5 py-2.5 rounded-xl font-medium text-slate-600 hover:bg-slate-100 transition">Batal</button>
                                <button type="submit" class="px-5 py-2.5 rounded-xl font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-slate-500">Tidak ada data partner ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="mt-6">
        {{ $partners->links() }}
    </div>
</div>

<!-- Modal Create Partner -->
<div id="createPartnerModal" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <h2 class="text-xl font-bold mb-4 text-slate-900">Tambah Partner Baru</h2>
        <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Partner</label>
                <input type="text" name="name" required placeholder="Contoh: Gojek" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Logo</label>
                <!-- Input File -->
                <input type="file" name="logo" accept="image/*" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-xs text-slate-400 mt-2">Maks. 2MB. Format: JPG, PNG, WEBP.</p>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="document.getElementById('createPartnerModal').classList.add('hidden')" class="px-5 py-2.5 rounded-xl font-medium text-slate-600 hover:bg-slate-100 transition">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection