@extends ('layout.app')

@section('content')
<!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1 space-y-8">
            <span
                class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">#1
                Event Platform</span>
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
            </h1>
            <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan
                Midtrans.
            </p>
            <div class="flex gap-4">
                <a href="#events"
                    class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
                    Mulai Jelajah
                </a>
                <a href="#how-it-works"
                    class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                    Cara Pesan
                </a>
            </div>
        </div>
        <div class="flex-1 relative">
            <div
                class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>
            <img src="assets/concert.png" alt="Concert"
                class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

            <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                        <p class="font-bold">Pembayaran Aman via Midtrans</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
 

    <!-- Events Grid -->
    <section id="events" class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
                <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('catalog') }}" class="p-3 border rounded-xl hover:bg-white hover:shadow-md transition">Semua Kategori</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="relative overflow-hidden aspect-[3/4]">
                    <img src="assets/concert.png" alt="Jazz Night" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">Musik</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">Jazz Night 2024</h3>
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                        <span>16 November 2024, 19:30</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t">
                        <span class="text-2xl font-black text-indigo-600">Rp 150rb</span>
                        <a href="{{ route('event.show', 1) }}" class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="relative overflow-hidden aspect-[3/4]">
                    <img src="assets/workshop.png" alt="AI & Future" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">Technology</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">AI & Future</h3>
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                        <span>26 October 2024, 09:00</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t">
                        <span class="text-2xl font-black text-indigo-600">Rp 50rb</span>
                        <a href="{{ route('event.show', 2) }}" class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="relative overflow-hidden aspect-[3/4]">
                    <img src="assets/hackathon.png" alt="Hackathon" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">Coding</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">Hackathon 2024</h3>
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                        <span>18-20 October 2024</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t">
                        <span class="text-2xl font-black text-indigo-600">Gratis</span>
                        <a href="{{ route('event.show', 3) }}" class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="max-w-7xl mx-auto px-6 pb-20">
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-10 md:p-12">
            <div class="max-w-2xl mb-10">
                <h2 class="text-3xl font-extrabold mb-2">Cara Pesan</h2>
                <p class="text-slate-500 font-medium">Tiga langkah sederhana untuk memesan tiket event.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-3xl bg-slate-50 border border-slate-100">
                    <p class="text-sm font-black uppercase tracking-widest text-indigo-600 mb-3">01</p>
                    <h3 class="text-xl font-bold mb-2">Pilih Event</h3>
                    <p class="text-slate-500">Buka detail event yang kamu mau, lalu lihat informasi lengkapnya.</p>
                </div>
                <div class="p-6 rounded-3xl bg-slate-50 border border-slate-100">
                    <p class="text-sm font-black uppercase tracking-widest text-indigo-600 mb-3">02</p>
                    <h3 class="text-xl font-bold mb-2">Isi Data</h3>
                    <p class="text-slate-500">Masukkan nama, email, dan WhatsApp agar tiket terkirim dengan benar.</p>
                </div>
                <div class="p-6 rounded-3xl bg-slate-50 border border-slate-100">
                    <p class="text-sm font-black uppercase tracking-widest text-indigo-600 mb-3">03</p>
                    <h3 class="text-xl font-bold mb-2">Bayar Aman</h3>
                    <p class="text-slate-500">Lanjutkan ke pembayaran dan selesaikan transaksi lewat Midtrans.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="max-w-7xl mx-auto px-6 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div class="bg-indigo-600 text-white rounded-[2.5rem] p-10 shadow-xl shadow-indigo-100">
                <h2 class="text-3xl font-extrabold mb-4">Platform event untuk kampus dan komunitas.</h2>
                <p class="text-indigo-100 leading-relaxed">AmikomEventHub membantu pengguna menemukan event, membeli tiket, dan mengelola pengalaman hadir dengan lebih cepat dan aman.</p>
            </div>
            <div class="bg-white rounded-[2.5rem] border border-slate-100 p-10 shadow-sm">
                <h3 class="text-2xl font-bold mb-4">Butuh tiket sekarang?</h3>
                <p class="text-slate-500 mb-6">Langsung lihat event terdekat dan buka detailnya untuk melanjutkan pemesanan.</p>
                <a href="#events" class="inline-block px-6 py-3 bg-slate-900 text-white rounded-2xl font-bold hover:bg-indigo-600 transition">Lihat Event</a>
            </div>
        </div>
    </section>
@endsection