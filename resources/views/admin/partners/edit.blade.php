@extends('layout.admin', ['title' => 'Edit Partner'])

@section('content')
<header class="mb-10">
    <h1 class="text-3xl font-black">Edit Partner</h1>
    <p class="text-slate-500 font-medium">Perbarui data partner.</p>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 p-10 shadow-sm max-w-3xl">
    <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Partner</label>
                <input type="text" name="name" value="{{ old('name', $partner->name) }}" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Tipe</label>
                <input type="text" name="type" value="{{ old('type', $partner->type) }}" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Website</label>
                <input type="url" name="website" value="{{ old('website', $partner->website) }}" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Status</label>
                <select name="status" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="active" {{ $partner->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="draft" {{ $partner->status === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-2">Logo</label>
                <div class="flex items-start gap-6 p-4 border border-dashed border-slate-200 rounded-2xl bg-slate-50/50">
                    <div class="shrink-0 text-center">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Logo Saat Ini</p>
                        <img src="{{ $partner->logo_path ? asset('storage/' . $partner->logo_path) : 'https://placehold.co/160x160' }}" class="w-24 h-24 rounded-xl object-cover shadow-md border-2 border-white">
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-slate-500 mb-3 leading-relaxed">Upload file baru jika ingin mengganti logo.</p>
                        <input type="file" name="logo" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.partners.index') }}" class="px-6 py-3 font-bold text-slate-400">Batal</a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
