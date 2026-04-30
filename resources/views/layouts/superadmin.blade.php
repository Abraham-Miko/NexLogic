<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexLogic | Superadmin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
