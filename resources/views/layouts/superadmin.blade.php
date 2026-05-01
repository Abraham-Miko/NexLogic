<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexLogic | Superadmin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Orbitron:wght@400;500;700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- STYLING RUNNING TEXT --}}
    <style>
    /* Animasi untuk efek running text (ticker) */
    @keyframes ticker {
        0% { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }
    .animate-ticker {
        display: inline-flex;
        animation: ticker 25s linear infinite; /* Angka 25s mengatur kecepatan */
    }
    .animate-ticker:hover {
        animation-play-state: paused;
    }
</style>
</head>
<body class="bg-[#111827] text-gray-300 font-sans">
    <div class="min-h-screen flex">

        <!-- Panggil file Sidebar di sini -->
        @include('layouts.sidebar-admin')

        <!-- Area Konten Utama -->
        <main class="flex-1 flex flex-col max-h-screen overflow-y-auto">

            <!-- Tempat disuntikkannya konten dari halaman lain -->
            @yield('content')

        </main>
    </div>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
