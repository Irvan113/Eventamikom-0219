<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function create(Event $event)
    {
        // Mengambil daftar kategori untuk keperluan menu footer
        $categories = \App\Models\Category::all();

        return view('checkout.create', compact('event', 'categories'));
    }

    public function store(Request $request, Event $event)
    {
        // 1. Validasi Input Kredensial Pelanggan
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        // 2. Cegah Check-out Jika Tiket Habis
        if ($event->stock <= 0) {
            return back()->with('error', 'Mohon maaf, tiket untuk acara ini sudah habis.');
        }

        // 3. Generate Kode TRX (Unik)
        $orderId = 'TRX-' . time() . '-' . Str::random(5);
        $totalPrice = $event->price + 5000; // Menambahkan biaya admin (dummy)

        // 4. Merekam Transaksi ke Database
        // --- INTEGRASI SNAP MIDTRANS --- 

        $transaction = Transaction::create([
            'order_id'       => $orderId,
            'event_id'       => $event->id,
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price'    => $totalPrice,
            'status'         => 'pending', 
        ]);

        // Konfigurasi Kredensial Midtrans dari config, bukan env langsung.
        $serverKey = config('midtrans.server_key');

        if (blank($serverKey)) {
            return back()->with('error', 'MIDTRANS_SERVER_KEY belum diatur di Laravel Cloud.');
        }

        \Midtrans\Config::$serverKey = $serverKey;

        \Midtrans\Config::$isProduction = (bool) config('midtrans.is_production', false); // Mode sandbox jika false

        \Midtrans\Config::$isSanitized = true;

        \Midtrans\Config::$is3ds = true;



        // Susun Paket Array Data Transaksi 

        $params = [

            'transaction_details' => [

                'order_id' => $orderId,

                'gross_amount' => $totalPrice,

            ],

            'customer_details' => [

                'first_name' => $request->customer_name,

                'email' => $request->customer_email,
                'phone' => $request->customer_phone,

            ],

        ];



        try {

            // Perintah Tembak Generate Snap Token 

            $snapToken = \Midtrans\Snap::getSnapToken($params);



            // Update rekaman kita bahwa transaksi terkait sudah memiliki id token pelunasan 

            $transaction->update(['snap_token' => $snapToken]);



            // Redirect ke halaman antarmuka pembayaran final pelanggan 

            return redirect()->route('checkout.payment', $transaction->order_id);



        } catch (\Exception $e) {

            return back()->with('error', 'Gagal memproses pembayaran jaringan: ' . $e->getMessage());

        }

        // 5. Arahkan ke rute dummy halaman sukses sementara
        // (Akan kita ubah di Pertemuan selanjutnya menuju Midtrans)
        return redirect('/');
    } // <-- Kurung penutup method store dipindahkan ke sini

    public function payment($orderId)
    {

        // Mengambil daftar kategori untuk keperluan menu footer 
        $categories = \App\Models\Category::all();



        $transaction = Transaction::with('event')->whereRaw('order_id = ?', [$orderId])->firstOrFail();

        return view('checkout.payment', compact('transaction', 'categories'));

    }

    public function success($orderId) 

    { 

        // Mengambil daftar kategori untuk keperluan menu footer 

         $categories = \App\Models\Category::all(); 

 

         $transaction = Transaction::whereRaw('order_id = ?', [$orderId])->firstOrFail(); 

          

         // Validasi status pembayaran asli dari Midtrans (Mencegah manipulasi URL) 

         $serverKey = config('midtrans.server_key');

         if (blank($serverKey)) {
             return redirect()->route('home')->with('error', 'MIDTRANS_SERVER_KEY belum diatur di Laravel Cloud.');
         }

         \Midtrans\Config::$serverKey = $serverKey; 

         \Midtrans\Config::$isProduction = (bool) config('midtrans.is_production', false); 

          

         try { 

             $midtransStatus = \Midtrans\Transaction::status($orderId); 

              

             // Hanya ubah status menjadi sukses jika Midtrans mengonfirmasi pembayaran lunas 

             if (in_array(data_get($midtransStatus, 'transaction_status'), ['capture', 'settlement'])) { 

                 $transaction->update(['status' => 'success']); 

             } 

         } catch (\Exception $e) { 

             // Jika error (transaksi tidak ada di Midtrans, koneksi terputus), kembalikan ke beranda 

             return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan atau gagal diproses oleh sistem pembayaran.'); 

         } 

 

         return view('checkout.success', compact('transaction','categories')); 

    } 
}