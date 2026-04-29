<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http; // Untuk panggilan API eksternal (RajaOngkir)

class OrderController extends Controller
{
    // Menampilkan Form Info Invitation
    public function showInfoForm(Request $request)
    {
        // Tangkap product_id dari URL
        $productId = $request->query('product_id');

        // Jika tidak ada product_id, kembalikan ke home
        if (!$productId) {
            return redirect()->route('home')->with('error', 'Silakan pilih produk terlebih dahulu.');
        }

        $product = Product::findOrFail($productId);

        // Cek jika sudah ada data di session
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

        return redirect()->route('order.shipping');
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
}
