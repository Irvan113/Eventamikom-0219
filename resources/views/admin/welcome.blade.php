<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmikomEventHub - Portal Event Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-900 selection:bg-indigo-100 selection:text-indigo-900 antialiased">

    <!-- Navbar Sederhana -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">AH</div>
                <span class="text-xl font-bold tracking-tight text-slate-900">AmikomEventHub</span>
            </div>
            <div>
                <a href="{{ route('admin.categories.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">Login Admin &rarr;</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-indigo-900 py-20 px-6 text-center text-white">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold tracking-tight mb-6">Temukan Event Menarik di Seputar Kampus</h1>
            <p class="text-indigo-200 text-lg md:text-xl leading-relaxed">Platform terpusat untuk eksplorasi seminar, workshop, dan kompetisi yang didukung oleh berbagai partner industri kami.</p>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6 py-16 space-y-24">
        
        <!-- Section Kategori (Soal 4) -->
        <section>
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900">Eksplorasi Kategori</h2>
                <p class="text-slate-500 mt-2">Pilih event berdasarkan minat dan keahlian Anda.</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @forelse($categories as $category)
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 text-center hover:shadow-lg hover:border-indigo-300 transition duration-300 cursor-pointer group">
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl mx-auto flex items-center justify-center mb-4 group-hover:scale-110 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-slate-800">{{ $category->name }}</h3>
                    </div>
                @empty
                    <div class="col-span-full text-center p-8 bg-slate-100 rounded-2xl text-slate-500">
                        Belum ada kategori yang ditambahkan.
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Section Partner (Soal 4) -->
        <section>
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900">Didukung Oleh</h2>
                <p class="text-slate-500 mt-2">Mitra industri dan komunitas yang mendukung kegiatan kami.</p>
            </div>

            <div class="flex flex-wrap justify-center gap-8 items-center">
                @forelse($partners as $partner)
                    <div class="group flex flex-col items-center">
                        <div class="w-32 h-32 md:w-40 md:h-40 bg-white border border-slate-200 rounded-2xl p-4 flex items-center justify-center shadow-sm hover:shadow-md transition grayscale hover:grayscale-0">
                            <!-- Render Logo Partner -->
                            <img src="{{ asset('storage/' . $partner->logo_url) }}" alt="Logo {{ $partner->name }}" class="max-w-full max-h-full object-contain">
                        </div>
                        <span class="mt-3 text-sm font-semibold text-slate-600 opacity-0 group-hover:opacity-100 transition">{{ $partner->name }}</span>
                    </div>
                @empty
                    <div class="w-full text-center p-8 border border-dashed border-slate-300 rounded-2xl text-slate-500">
                        Belum ada partner yang ditambahkan.
                    </div>
                @endforelse
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 py-8 text-center text-slate-400 text-sm">
        <p>&copy; {{ date('Y') }} AmikomEventHub. Universitas Amikom Yogyakarta.</p>
    </footer>

</body>
</html>