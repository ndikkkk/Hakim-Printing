<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http; // Untuk panggilan API eksternal (RajaOngkir)
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

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
        ]);

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

        // Tembak API Komerce untuk hitung ongkir (Kita gunakan kurir JNE sebagai default)
        $response = Http::withoutVerifying()
            ->withHeaders(['key' => env('RAJAONGKIR_API_KEY')])
            ->asForm()
            ->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                'origin' => $originCityId,
                'destination' => $customer['city_id'],
                'weight' => $weight,
                'courier' => 'jne'
            ]);

        // Ambil daftar layanan ongkir dari response
        $costs = $response['data'] ?? [];

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

        // 2. Setting Midtrans
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
                $order->update(['payment_status' => 'success']);
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

        return redirect()->back()->with('success', 'Nomor resi berhasil disimpan. Pesanan akan segera dikirim.');
    }

    public function confirmReceived($id)
{
    $order = \App\Models\Order::where('id', $id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->firstOrFail();

    $order->update(['is_received' => true]);

    return redirect()->route('user.history')->with('success', 'Pesanan dikonfirmasi sudah diterima!');
}
}