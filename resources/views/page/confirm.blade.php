<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Konfirmasi</title>

    <link rel="stylesheet" href="{{ asset('css/style-confirm.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>

<body>
    <nav class="navbar" style="position: absolute; width: 100%; top: 0; padding: 20px 40px; display: flex; justify-content: flex-end; z-index: 10;">
        <form action="{{ route('logoutuserpage') }}" method="POST">
            @csrf
            <button type="submit" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.4); padding: 10px 20px; border-radius: 30px; color: #fff; font-family: 'Poppins', sans-serif; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: 0.3s;">
                <img src="{{ asset('images/logout.png') }}" style="width: 20px; filter: brightness(0) invert(1);">
                Sign Out
            </button>
        </form>
    </nav>

    <section style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: url('{{ asset('images/img2.jpeg') }}') no-repeat center center/cover; position: relative;">
        <!-- Overlay -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(0,0,0,0.6), rgba(0,0,0,0.2));"></div>

        <div style="position: relative; z-index: 2; background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 24px; padding: 60px 50px; text-align: center; max-width: 500px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); color: #fff; transform: translateY(0); animation: floatUp 0.8s ease-out forwards;">
            <div style="width: 80px; height: 80px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#b6895b" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            
            <h2 style="font-family: 'Poppins', sans-serif; font-size: 2.5rem; font-weight: 600; margin-bottom: 15px; color: #fff; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">Terima Kasih!</h2>

            <p style="font-family: 'Poppins', sans-serif; font-size: 1.1rem; line-height: 1.6; margin-bottom: 5px; text-shadow: 0 1px 3px rgba(0,0,0,0.3);">Pesanan Anda telah berhasil diterima.</p>
            <p style="font-family: 'Poppins', sans-serif; font-size: 1rem; line-height: 1.6; margin-bottom: 30px; opacity: 0.9;">Kami akan segera memprosesnya sesuai antrian :)</p>

            <a href="{{ route('page.user') }}" style="display: inline-block; background: #b6895b; color: #fff; padding: 15px 35px; border-radius: 30px; font-family: 'Poppins', sans-serif; font-weight: 600; text-decoration: none; box-shadow: 0 10px 20px rgba(182, 137, 91, 0.3); transition: all 0.3s ease; text-shadow: none;">
                Lihat Status Pesanan
            </a>
        </div>
    </section>

    <style>
        @keyframes floatUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        a:hover {
            transform: translateY(-3px);
            background: #a37a51 !important;
            box-shadow: 0 15px 25px rgba(182, 137, 91, 0.4) !important;
        }
        button:hover {
            background: rgba(255, 255, 255, 0.3) !important;
            transform: translateY(-2px);
        }
    </style>

    @php
        session()->forget(['invitation_data', 'order_customer_data', 'selected_product']);
    @endphp
</body>

</html>
