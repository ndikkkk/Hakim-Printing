<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http; // Untuk panggilan API eksternal (RajaOngkir)
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\InvitationData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderNotification;

class OrderController extends Controller
{
    // Menampilkan Form Info Invitation
    public function showInfoForm(Request $request)
{
    // 1. Tangkap product_id dari URL (?product_id=X)
    $productId = $request->query('product_id');

    if (!$productId) {
        return redirect()->route('home')->with('error', 'Silakan pilih produk terlebih dahulu.');
    }

    // 2. Cari produknya
    $product = Product::findOrFail($productId);

    // 3. SIMPAN KE SESSION (Penting agar Checkout bisa panggil data ini)
    Session::put('selected_product', [
        'id'    => $product->id,
        'name'  => $product->name,
        'price' => $product->price,
        'image' => $product->image // Pastikan field di DB namanya 'image'
    ]);

    // 4. Ambil data lama jika user klik 'back' biar form tidak kosong
    $invitationData = Session::get('invitation_data', []);

    return view('page.info-invitation', compact('product', 'invitationData'));
}

    // Memproses dan Memvalidasi Form Info Invitation
    public function processInfoForm(Request $request)
    {
        // Validasi ketat (Backend Validation)
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'groom_name' => 'required|string|max:255',
            'groom_father' => 'required|string|max:255',
            'groom_mother' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
            'bride_father' => 'required|string|max:255',
            'bride_mother' => 'required|string|max:255',
            'akad_date' => 'required|date',
            'akad_time' => 'required|string',
            'akad_location' => 'required|url', // Memastikan format link URL
            'event_date' => 'required|date',
            'event_time' => 'required|string',
            'location_maps' => 'required|url', // Memastikan format link URL
            'quotes' => 'nullable|string', // Opsional
            'design_image' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        if ($request->hasFile('design_image')) {
            $path = $request->file('design_image')->store('invitation_designs', 'public');
            $validatedData['design_image'] = $path;
        }

        // Simpan data ke Session sementara
        Session::put('invitation_data', $validatedData);

        // Lanjut ke halaman Order Data
        return redirect()->route('order.data');
    }

    // Menampilkan Form Data Pemesan
    public function showDataForm()
    {
        // Pastikan user sudah isi data undangan dulu, kalau belum balikkan ke form awal
        if (!Session::has('invitation_data')) {
            return redirect()->route('order.info')->with('error', 'Isi data undangan dulu ya.');
        }

        $orderData = Session::get('order_customer_data', []);
        // Tembak API RajaOngkir untuk ambil semua Provinsi
        $response = Http::withoutVerifying()
                        ->withHeaders(['key' => env('RAJAONGKIR_API_KEY')])
                        ->get('https://rajaongkir.komerce.id/api/v1/destination/province');

        $provinces = $response['data'] ?? [];
        usort($provinces, fn($a, $b) => strcmp($a['name'], $b['name']));

        return view('page.order-data', compact('orderData', 'provinces'));
    }

    // Memproses Data Pemesan
    public function processDataForm(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|numeric',
            'customer_address' => 'required|string',
            'quantity' => 'required|integer|min:10',
            'city_id' => 'required', // Nanti dipakai untuk RajaOngkir
            'province_id' => 'required',
        ]);

        // Simpan ke session
        Session::put('order_customer_data', $validated);

        return redirect()->route('order.checkout');
    }

    // Tambahkan method baru ini untuk merespons AJAX pilihan kota:
    public function getCities($province_id)
    {
        // Kita tembak menggunakan garis miring sesuai standar API Komerce
        $response = Http::withoutVerifying()
                        ->withHeaders(['key' => env('RAJAONGKIR_API_KEY')])
                        ->get('https://rajaongkir.komerce.id/api/v1/destination/city/' . $province_id);

        // Jaga-jaga kalau Komerce nge-blank (bukan JSON)
        if (!$response->json()) {
            return response()->json([
                'meta' => ['status' => 'error', 'message' => 'Format URL Komerce salah. Status: ' . $response->status()]
            ]);
        }

        // JANGAN DI-FILTER! Lempar SEMUA isi respons Komerce ke frontend
        return response()->json($response->json());
    }

    public function showCheckoutForm()
    {
        $invitation = Session::get('invitation_data');
        $customer = Session::get('order_customer_data');

        // Cegah user yang iseng langsung ngetik URL /checkout tanpa isi form
        if (!$invitation || !$customer) {
            return redirect()->route('home')->with('error', 'Silakan isi data pesanan terlebih dahulu.');
        }

        // Asumsi berat 1 buah undangan = 15 gram
        $weight = $customer['quantity'] * 15;

        // ID Kota asal pengiriman (Sleman = 419)
        $originCityId = 419;

        // Tembak API Komerce untuk hitung ongkir (JNE, TIKI, POS, JNT)
        $couriers = ['jne', 'tiki', 'pos', 'jnt'];
        $costs = [];

        foreach ($couriers as $courier) {
            try {
                $response = Http::withoutVerifying()
                    ->withHeaders(['key' => env('RAJAONGKIR_API_KEY')])
                    ->asForm()
                    ->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                        'origin' => $originCityId,
                        'destination' => $customer['city_id'],
                        'weight' => $weight,
                        'courier' => $courier
                    ]);

                $data = $response['data'] ?? [];
                foreach ($data as $item) {
                    $costs[] = $item;
                }
            } catch (\Exception $e) {
                // Skip jika salah satu kurir gagal
                continue;
            }
        }

        return view('page.checkout', compact('invitation', 'customer', 'costs', 'weight'));
    }

    public function processCheckout(Request $request)
    {
        $invitation = Session::get('invitation_data');
        $customer = Session::get('order_customer_data');
        $product = Session::get('selected_product');

        if (!$invitation || !$customer || !$product) {
            return redirect()->route('home')->with('error', 'Data tidak lengkap.');
        }

        // Hapus order pending lama milik user ini (jika payment dibatalkan lalu coba lagi)
        \App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->where('product_id', $product['id'])
            ->where('payment_status', 'pending')
            ->delete();

        // 1. Simpan Pesanan (KINI SUDAH DISESUAIKAN DENGAN MIGRATION MAS)
        $order = \App\Models\Order::create([
            'order_number'   => 'INV-' . strtoupper(uniqid()),
            'user_id'        => \Illuminate\Support\Facades\Auth::id(), // Mengambil ID user yang login
            'product_id'     => $product['id'],
            'quantity'       => $customer['quantity'],
            'total_weight'   => $customer['quantity'] * 15,
            'shipping_cost'  => $request->shipping_cost, // Dari form pilihan kurir
            'total_price'    => $request->grand_total,   // Dari input hidden grand_total
            'payment_status' => 'pending',
        ]);

        // 2. Simpan data undangan ke tabel invitation_data
        InvitationData::create([
            'order_id'      => $order->id,
            'groom_name'    => $invitation['groom_name'],
            'groom_father'  => $invitation['groom_father'],
            'groom_mother'  => $invitation['groom_mother'],
            'bride_name'    => $invitation['bride_name'],
            'bride_father'  => $invitation['bride_father'],
            'bride_mother'  => $invitation['bride_mother'],
            'akad_date'     => $invitation['akad_date'],
            'akad_time'     => $invitation['akad_time'],
            'akad_location' => $invitation['akad_location'],
            'event_date'    => $invitation['event_date'],
            'event_time'    => $invitation['event_time'],
            'location_maps' => $invitation['location_maps'],
            'quotes'        => $invitation['quotes'] ?? null,
            'design_image'  => $invitation['design_image'] ?? null,
        ]);

        // 3. Setting Midtrans
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $customer['customer_name'],
                'email' => \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->email : 'guest@example.com',
                'phone' => $customer['customer_phone'],
            ],
        ];

        // 3. Ambil Token Midtrans
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $order->update(['snap_token' => $snapToken]);

        return response()->json(['snap_token' => $snapToken]);
    }

    public function callback(Request $request)
{
    $serverKey = config('services.midtrans.server_key');

    // 1. Verifikasi keamanan (Signature Key) dari Midtrans
    $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

    if ($hashed == $request->signature_key) {
        // 2. Cari order berdasarkan order_number (bukan ID biasa)
        $order = \App\Models\Order::where('order_number', $request->order_id)->first();

        if ($order) {
            // 3. Cek status transaksi dari Midtrans dan update database
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                if ($order->payment_status !== 'success') {
                    $order->update(['payment_status' => 'success']);
                    try {
                        // Email ke Customer
                        Mail::to($order->user->email)->send(new OrderNotification($order, 'Pembayaran untuk pesanan Anda telah berhasil dikonfirmasi. Pesanan Anda akan segera kami proses untuk dicetak.'));
                        
                        // Email ke Admin
                        $admin = \App\Models\User::where('role', 'admin')->first();
                        if ($admin) {
                            Mail::to($admin->email)->send(new OrderNotification($order, 'PESANAN BARU! Pelanggan telah berhasil melakukan pembayaran. Segera cek dasbor admin untuk memproses pesanan ini.'));
                        }
                    } catch (\Exception $e) {
                        \Illuminate\Support\Facades\Log::error('Mail Error: ' . $e->getMessage());
                    }
                }
            } elseif (in_array($request->transaction_status, ['cancel', 'deny', 'expire'])) {
                $order->update(['payment_status' => 'failed']);
            } elseif ($request->transaction_status == 'pending') {
                $order->update(['payment_status' => 'pending']);
            }
        }
    }

    // 4. Balas Midtrans dengan response 200 OK agar mereka tahu data sudah kita terima
    return response()->json(['message' => 'Callback diproses']);
}

// Fungsi alternatif untuk localhost tanpa ngrok
public function manualSuccess($order_number)
{
    $order = \App\Models\Order::where('order_number', $order_number)->first();
    if ($order && $order->payment_status !== 'success') {
        $order->update(['payment_status' => 'success']);
        try {
            // Email ke Customer
            Mail::to($order->user->email)->send(new OrderNotification($order, 'Pembayaran untuk pesanan Anda telah berhasil dikonfirmasi. Pesanan Anda akan segera kami proses untuk dicetak.'));
            
            // Email ke Admin
            $admin = \App\Models\User::where('role', 'admin')->first();
            if ($admin) {
                Mail::to($admin->email)->send(new OrderNotification($order, 'PESANAN BARU! Pelanggan telah berhasil melakukan pembayaran. Segera cek dasbor admin untuk memproses pesanan ini.'));
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Mail Error: ' . $e->getMessage());
        }
    }
    return redirect()->route('order.confirm');
}
// Menyimpan nomor resi yang diinput admin
    public function inputResi(Request $request, $id)
    {
        $request->validate([
            'resi' => 'required|string|max:255'
        ]);

        $order = \App\Models\Order::findOrFail($id);

        // Simpan resi ke database
        // Pastikan di tabel 'orders' mas sudah ada kolom 'resi' ya! (Tipe VARCHAR/String)
        $order->update([
            'resi' => $request->resi,
            'payment_status' => 'success' // Pastikan statusnya sudah success sebelum input resi
        ]);

        try {
            Mail::to($order->user->email)->send(new OrderNotification($order, 'Pesanan Anda telah dikirim! Nomor resi Anda adalah: ' . $request->resi . '. Paket Anda akan segera tiba di alamat tujuan.'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Mail Error: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Nomor resi berhasil disimpan. Pesanan akan segera dikirim.');
    }

    public function confirmReceived($id)
    {
        $order = \App\Models\Order::where('id', $id)
                    ->where('user_id', \Illuminate\Support\Facades\Auth::id())
                    ->firstOrFail();

        $order->update(['is_received' => true, 'shipping_status' => 'delivered']);

        return redirect()->route('user.history')->with('success', 'Pesanan dikonfirmasi sudah diterima!');
    }

    public function updateShippingStatus(Request $request, $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->update(['shipping_status' => 'in_transit']);

        return redirect()->back()->with('success', 'Status diperbarui: paket menuju alamat penerima.');
    }
}