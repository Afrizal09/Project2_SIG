<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chroropleth-map</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

        body {
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
               }
        footer {
            margin-top: auto; 
        }
    </style>
</head>
<body class="bg-[#f3f3f3] text-black font-sans">
    <!-- Navbar -->
    <nav class="flex justify-between items-center p-4 border-b-4 border-black bg-[#ffd700]">
        <div class="text-xl font-extrabold uppercase tracking-widest text-black drop-shadow-md">chroropleth-map</div>
        <ul class="flex space-x-6">
            <li><a href="/" class="text-black font-bold hover:text-[#ff6347]">Home</a></li>
            <li><a href="/jumlah_penduduk" class="text-black font-bold hover:text-[#ff6347]">Peta</a></li>
            <li><a href="/jumlah_penduduk" class="text-black font-bold hover:text-[#ff6347]">Data Populasi</a></li>
            <li><a href="/jumlah_penduduk" class="text-black font-bold hover:text-[#ff6347]">Jumlah Penduduk</a></li>
            <li><a href="/jumlah_penduduk" class="text-black font-bold hover:text-[#ff6347]">Kepadatan Penduduk</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto py-16 text-center">
        <h1 class="text-5xl font-extrabold uppercase tracking-wide text-black mb-6">
            Sistem Informasi Geografis
        </h1>
        <p class="text-xl font-medium text-black mb-10 drop-shadow-md">
           Peta tematik persebaran populasi penduduk Di provinsi Kalimantan Barat
        </p>
        <a href="/jumlah_penduduk" class="inline-block px-8 py-4 border-4 border-black bg-[#ff4500] text-white text-lg font-extrabold uppercase shadow-[4px_4px_0px_0px_black] hover:bg-[#e63e00]">
            Lihat Peta
        </a>
    </div>

    <!-- Team Members Section -->
    <div class="container mx-auto py-12">
        <h2 class="text-3xl font-extrabold uppercase tracking-wide text-black mb-8 text-center">
            Anggota Kelompok
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <img src="assets\images\ijey2.jpg" alt="Anggota 1" class="w-40 h-40 mx-auto ">
                <p class="mt-4 text-lg font-bold">Muhammad Afrizal</p>
                <p class="text-sm font-medium text-gray-700">Project Manager</p>
            </div>
            <div class="text-center">
                <img src="assets\images\Faiz.jpg" alt="Anggota 2" class="w-40 h-40 mx-auto ">
                <p class="mt-4 text-lg font-bold">Faiz Dziaulhaq</p>
                <p class="text-sm font-medium text-gray-700">Developer</p>
            </div>
            <div class="text-center">
                <img src="assets\images\nenden.jpg" alt="Anggota 3" class="w-40 h-40 mx-auto ">
                <p class="mt-4 text-lg font-bold">Nenden Nur Himami</p>
                <p class="text-sm font-medium text-gray-700">UI UX Design</p>
            </div>
            <div class="text-center">
                <img src="assets\images\gilang.jpg" alt="Anggota 3" class="w-40 h-40 mx-auto  border-black">
                <p class="mt-4 text-lg font-bold">Muhammad Gilang Al Wafi</p>
                <p class="text-sm font-medium text-gray-700">Developer</p>
            </div>
            
        </div>
    </div>
    <!-- Footer -->
    <footer class="border-t-4 border-black py-6 bg-[#ffd700] text-center">
        <b class="text-sm font-bold text-black drop-shadow-md">
            &copy; 2025 chroropleth-map.  All rights reserved.
        </b>
        <a class="text-sm font-bold text-black drop-shadow-md hover:text-gray-500 transition duration-300" href="https://www.instagram.com/_al.faqih__/">
            Developer
        </a>
    </footer>
</body>
</html>
