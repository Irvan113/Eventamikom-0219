<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $query = Partner::query();

        // Fitur Pencarian (Soal 3)
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // withQueryString() agar parameter pencarian tidak hilang saat pindah halaman
        $partners = $query->latest()->paginate(10)->withQueryString();
        return view('admin.partner.index', compact('partners'));
    }

    public function store(Request $request)
    {
        // Validasi: nama dan logo wajib diisi
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Maks 2MB
        ]);

        // Simpan file ke direktori storage/app/public/partners
        $path = $request->file('logo')->store('partners', 'public');

        Partner::create([
            'name' => $request->name,
            'logo_url' => $path,
        ]);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner baru berhasil ditambahkan!');
    }

    public function update(Request $request, Partner $partner)
    {
        // Validasi: logo bersikap 'nullable' (opsional saat edit)
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Siapkan array data yang pasti akan di-update (nama)
        $data = ['name' => $request->name];

        // Cek apakah admin mengunggah file logo baru
        if ($request->hasFile('logo')) {
            
            // 1. Hapus logo lama dari server untuk menghemat ruang
            if (Storage::disk('public')->exists($partner->logo_url)) {
                Storage::disk('public')->delete($partner->logo_url);
            }

            // 2. Upload logo baru
            $path = $request->file('logo')->store('partners', 'public');
            
            // 3. Tambahkan path baru ke array data update
            $data['logo_url'] = $path;
        }

        // Eksekusi update ke database
        $partner->update($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Data partner berhasil diperbarui!');
    }

    public function destroy(Partner $partner)
    {
        // Cegah penumpukan file: Hapus logo fisik sebelum menghapus data di database
        if (Storage::disk('public')->exists($partner->logo_url)) {
            Storage::disk('public')->delete($partner->logo_url);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner beserta logonya berhasil dihapus!');
    }
}
