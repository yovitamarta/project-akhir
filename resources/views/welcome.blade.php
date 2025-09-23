<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kantin MEALYUNG - Dashboard</title>
    <!-- TailwindCSS & Font Awesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script defer src="//unpkg.com/alpinejs"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        /* ===== BASE STYLES ===== */
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            background-attachment: fixed;
        }
        
        /* Dark mode body background */
        body.dark {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }
        
        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        
        ::-webkit-scrollbar-thumb {
            background-color: #ef4444;
            border-radius: 10px;
            border: 2px solid transparent;
            background-clip: content-box;
        }
        
        /* ===== ANIMATIONS ===== */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        
        @keyframes ring {
            0% { transform: rotate(0deg); }
            10% { transform: rotate(15deg); }
            20% { transform: rotate(-15deg); }
            30% { transform: rotate(15deg); }
            40% { transform: rotate(-15deg); }
            50% { transform: rotate(0deg); }
            100% { transform: rotate(0deg); }
        }
        
        @keyframes countUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        /* ===== ANIMATION CLASSES ===== */
        .animate-fadeIn {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-slideIn {
            animation: slideIn 0.3s ease-out forwards;
        }
        
        .animate-countUp {
            animation: countUp 0.8s ease-out forwards;
        }
        
        .bell-ring {
            animation: ring 1s ease-in-out;
        }
        
        /* ===== COMPONENTS ===== */
        /* Glassmorphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        /* Dark mode glass */
        .dark .glass {
            background: rgba(30, 41, 59, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Card hover effects */
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(90deg, #ef4444, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        /* Navigation active state */
        .nav-item {
            position: relative;
            overflow: hidden;
        }
        
        .nav-item:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: #ef4444;
            transform: scaleY(0);
            transition: transform 0.2s ease;
        }
        
        .nav-item.active:before {
            transform: scaleY(1);
        }
        
        /* Welcome section */
        .welcome-section {
            background: linear-gradient(135deg, #ef4444 0%, #f97316 100%);
            border-radius: 1rem;
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .welcome-section:before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            z-index: 1;
        }
        
        .welcome-content {
            position: relative;
            z-index: 2;
        }
        
        /* Stats card */
        .stats-card {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            padding: 1.5rem;
            color: white;
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-card-icon {
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
            font-size: 2.5rem;
            opacity: 0.3;
        }
        
        /* Feature card */
        .feature-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .dark .feature-card {
            background: #1f2937;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        /* Info box */
        .info-box {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #ef4444;
        }
        
        .dark .info-box {
            background: #1f2937;
        }
        
        /* Progress bar */
        .progress-bar {
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.3);
            margin-top: 1rem;
        }
        
        .progress-bar-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s ease;
        }
        
        /* Step card */
        .step-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            position: relative;
        }
        
        .dark .step-card {
            background: #1f2937;
        }
        
        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .step-number {
            position: absolute;
            top: -15px;
            left: -15px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ef4444, #f97316);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="min-h-screen selection:bg-red-500 selection:text-white">
    <div x-data="{ 
        activeSection: 'dashboard',
        darkMode: false,
        open: true,
        totalStudents: 1250,
        totalMenus: 25,
        todayOrders: 45,
        todayRevenue: 1250000,
        searchQuery: '',
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
                document.body.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
                document.body.classList.remove('dark');
            }
        },
        menuItems: [
            {
                id: 1,
                name: 'Nasi Goreng Spesial',
                description: 'Nasi goreng dengan telur, ayam, dan sosis.',
                price: 20000,
                rating: 4.8,
                image: 'https://storage.googleapis.com/a1aa/image/48ca648d-fdda-4a9b-e384-f1587742b1a8.jpg',
                badge: 'Bestseller',
                badgeColor: 'bg-red-500'
            },
            {
                id: 2,
                name: 'Bakso Jumbo',
                description: 'Bakso sapi dengan kuah segar dan sambal.',
                price: 18000,
                rating: 4.6,
                image: 'https://storage.googleapis.com/a1aa/image/3ce3758f-a369-46ef-36a1-3188ffd683de.jpg',
                badge: 'New',
                badgeColor: 'bg-green-500'
            },
            {
                id: 3,
                name: 'Mie Ayam',
                description: 'Mie ayam dengan kuah kaldu dan sayuran segar.',
                price: 15000,
                rating: 4.7,
                image: 'https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg',
                badge: null,
                badgeColor: null
            },
            {
                id: 4,
                name: 'Sate Ayam',
                description: 'Sate ayam dengan bumbu kacang dan lontong.',
                price: 22000,
                rating: 4.9,
                image: 'https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg',
                badge: 'Popular',
                badgeColor: 'bg-blue-500'
            },
            {
                id: 5,
                name: 'Gado-Gado',
                description: 'Sayuran segar dengan bumbu kacang dan kerupuk.',
                price: 17000,
                rating: 4.5,
                image: 'https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg',
                badge: null,
                badgeColor: null
            },
            {
                id: 6,
                name: 'Es Teh Manis',
                description: 'Teh manis dingin dengan es batu.',
                price: 5000,
                rating: 4.7,
                image: 'https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg',
                badge: null,
                badgeColor: null
            }
        ],
        get filteredMenuItems() {
            if (!this.searchQuery) {
                return this.menuItems;
            }
            return this.menuItems.filter(item => 
                item.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                item.description.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        },
        orderItem(item) {
            alert(`Pesanan ${item.name} telah ditambahkan ke keranjang!`);
        }
    }" :class="{ 'dark': darkMode }" class="flex h-screen">
        <!-- ===== SIDEBAR ===== -->
        <aside :class="open ? 'w-64' : 'w-20'" class="bg-white dark:bg-gray-900 shadow-xl flex flex-col transition-all duration-500 border-r border-gray-200 dark:border-gray-700 z-40">
            <!-- Logo -->
            <div class="flex items-center space-x-3 p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="relative">
                    <img alt="MEALYUNG logo" class="h-10 w-10 rounded-lg shadow-md animate-pulse" height="40" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQskzxiLLwDiBYMcHA1j0eecWkN7c334SWs_Q&s" width="40"/>
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                </div>
                <h1 class="text-2xl font-extrabold gradient-text transition-opacity select-none" x-show="open">
                    MEALYUNG
                </h1>
            </div>
            
            <!-- Nav -->
            <nav class="flex-1 px-4 py-6 space-y-2 text-gray-700 dark:text-gray-300 font-medium">
                <a @click="activeSection = 'dashboard'" :class="{'bg-red-600 text-white': activeSection === 'dashboard'}" class="flex items-center space-x-4 p-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-home text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="transition-opacity select-none" x-show="open">Dashboard</span>
                </a>
                <a @click="activeSection = 'menu'" :class="{'bg-red-600 text-white': activeSection === 'menu'}" class="flex items-center space-x-4 p-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-utensils text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="transition-opacity select-none" x-show="open">Menu</span>
                </a>
                <a @click="activeSection = 'reports'" :class="{'bg-red-600 text-white': activeSection === 'reports'}" class="flex items-center space-x-4 p-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-chart-line text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="transition-opacity select-none" x-show="open">Reports</span>
                </a>
            </nav>
            
            <!-- Footer -->
            <div class="border-t border-gray-200 dark:border-gray-700 p-5 space-y-4">
                <div class="text-center">
                    <p class="text-sm text-gray-500 dark:text-gray-400" x-show="open">MEALYUNG Kantin SMK N 1 SAYUNG</p>
                </div>
            </div>
        </aside>
        
        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="glass shadow-md px-8 py-4 sticky top-0 z-30 transition-all duration-300">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <button @click="open = !open" class="p-3 rounded-xl bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300 shadow-md">
                            <i class="fas fa-bars text-gray-800 dark:text-gray-200 text-xl"></i>
                        </button>
                        <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white tracking-tight">
                            E-Kantin MEALYUNG - SMK N 1 SAYUNG
                        </h2>
                    </div>
                    
                    <div class="flex items-center space-x-5">
                       <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="group relative px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl transition-all duration-300 shadow-lg hover:shadow-red-500/40">
                                <span class="flex items-center relative z-10">
                                    <i class="fas fa-user-circle mr-2"></i>
                                    <span class="font-semibold">Akun</span>
                                    <i class="fas fa-chevron-down ml-2 text-xs"></i>
                                </span>
                                <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-red-600 to-red-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="absolute -inset-1 bg-gradient-to-r from-red-400 to-red-600 rounded-xl opacity-0 blur-md group-hover:opacity-40 transition-opacity duration-300"></div>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-56 rounded-xl shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                                <div class="py-1">
                                    <a href="{{ route('login') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                        <i class="fas fa-sign-in-alt mr-3"></i>
                                        <span>Login</span>
                                    </a>
                                    <a href="{{ route('register') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                        <i class="fas fa-user-plus mr-3"></i>
                                        <span>Register</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-6 space-y-8">
                <!-- Dashboard Section -->
                <div x-show="activeSection === 'dashboard'" class="space-y-8">
                    <!-- Welcome Section -->
                    <div class="welcome-section shadow-xl animate-fadeIn">
                        <div class="welcome-content">
                            <h1 class="text-3xl md:text-4xl font-bold mb-2">
                                Selamat Datang di E-Kantin MEALYUNG
                            </h1>
                            <p class="text-lg opacity-90 max-w-2xl">
                                Sistem kantin digital modern untuk SMK N 1 SAYUNG
                            </p>
                        </div>
                    </div>
                    
                    <!-- Pengertian E-Kantin MEALYUNG -->
                    <div class="info-box animate-fadeIn" style="animation-delay: 0.4s">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                            <i class="fas fa-info-circle text-red-500 mr-3"></i>
                            Pengertian E-Kantin MEALYUNG
                        </h2>
                        <div class="space-y-4 text-gray-700 dark:text-gray-300">
                            <p>
                              Solusi kantin digital yang memudahkan Anda dalam memesan makanan dan minuman favorit. Dengan tampilan sederhana dan praktis, semua kebutuhan kantin kini bisa diakses hanya dalam beberapa klik, tanpa harus antre panjang.  </p>
                        </div>
                        </div>
                    
                    <!-- Cara Menggunakan Aplikasi -->
                    <div class="info-box animate-fadeIn" style="animation-delay: 0.8s">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                            <i class="fas fa-list-ol text-red-500 mr-3"></i>
                            Cara Menggunakan Aplikasi E-Kantin MEALYUNG
                        </h2>
                        <div class="space-y-4 text-gray-700 dark:text-gray-300">
                            <p>
                                Berikut adalah langkah-langkah mudah untuk menggunakan aplikasi E-Kantin MEALYUNG:
                            </p>
                        </div>
                        
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div class="step-card">
                                <div class="step-number">1</div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 mt-2">Registrasi Akun</h3>
                                <p class="text-gray-600 dark:text-gray-400">Daftar akun dengan mengisi formulir pendaftaran menggunakan email aktif dan nomor telepon yang valid.</p>
                            </div>
                            
                            <div class="step-card">
                                <div class="step-number">2</div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 mt-2">Login ke Aplikasi</h3>
                                <p class="text-gray-600 dark:text-gray-400">Masuk ke aplikasi menggunakan email dan password yang telah didaftarkan sebelumnya.</p>
                            </div>
                            
                            <div class="step-card">
                                <div class="step-number">3</div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 mt-2">Pilih Menu</h3>
                                <p class="text-gray-600 dark:text-gray-400">Jelajahi berbagai menu makanan dan minuman yang tersedia, lalu pilih yang diinginkan.</p>
                            </div>
                            
                            <div class="step-card">
                                <div class="step-number">4</div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 mt-2">Lakukan Pembayaran</h3>
                                <p class="text-gray-600 dark:text-gray-400">Proses pembayaran dapat dilakukan melalui berbagai metode yang tersedia seperti e-wallet atau transfer bank.</p>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Tips Menggunakan E-Kantin MEALYUNG</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-start space-x-3">
                                    <div class="mt-1 w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center">
                                        <i class="fas fa-lightbulb text-yellow-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">Pesan Sebelum Jam Istirahat</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Hindari antrian dengan memesan 15-30 menit sebelum jam istirahat</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="mt-1 w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-star text-green-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">Berikan Rating</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Beri rating dan ulasan untuk membantu meningkatkan kualitas layanan</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="mt-1 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-bookmark text-blue-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">Simpan Menu Favorit</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Gunakan fitur favorit untuk menyimpan menu yang sering dipesan</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="mt-1 w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                        <i class="fas fa-bell text-red-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">Aktifkan Notifikasi</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Nyalakan notifikasi untuk mendapatkan informasi promo dan menu baru</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Feature Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate-fadeIn" style="animation-delay: 1s">
                        <div class="feature-card">
                            <div class="feature-icon bg-red-100 text-red-600">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Akses Mudah</h3>
                            <p class="text-gray-600 dark:text-gray-400 flex-grow">Aplikasi dapat diakses kapan saja dan di mana saja melalui perangkat smartphone atau komputer.</p>
                        </div>
                        
                        <div class="feature-card">
                            <div class="feature-icon bg-blue-100 text-blue-600">
                                <i class="fas fa-qrcode"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Pembayaran Digital</h3>
                            <p class="text-gray-600 dark:text-gray-400 flex-grow">Sistem pembayaran yang praktis dengan berbagai metode digital seperti e-wallet dan transfer bank.</p>
                        </div>
                        
                        <div class="feature-card">
                            <div class="feature-icon bg-green-100 text-green-600">
                                <i class="fas fa-history"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Riwayat Transaksi</h3>
                            <p class="text-gray-600 dark:text-gray-400 flex-grow">Lacak semua riwayat pembelian Anda dengan mudah dan transparan.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Section -->
                <div x-show="activeSection === 'menu'" class="animate-fadeIn">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <i class="fas fa-utensils mr-3 text-red-500"></i>
                            Menu Terlaris di E-Kantin MEALYUNG
                        </h2>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            <span x-show="searchQuery" x-text="`Menampilkan ${filteredMenuItems.length} dari ${menuItems.length} menu`"></span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <template x-for="item in filteredMenuItems" :key="item.id">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                                <div class="relative">
                                    <img :alt="item.name" class="w-full h-48 object-cover" height="250" :src="item.image" width="400"/>
                                    <div x-show="item.badge" :class="item.badgeColor" class="absolute top-3 right-3 text-white text-xs font-bold px-2 py-1 rounded-full">
                                        <span x-text="item.badge"></span>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white" x-text="item.name"></h3>
                                        <div class="flex items-center text-yellow-400">
                                            <i class="fas fa-star"></i>
                                            <span class="ml-1 text-gray-700 dark:text-gray-300" x-text="item.rating"></span>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 mb-4" x-text="item.description"></p>
                                    <div class="flex justify-between items-center">
                                        <span class="font-extrabold text-red-600 text-xl">Rp <span x-text="item.price.toLocaleString('id-ID')"></span></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                
                <!-- Reports Section -->
                <div x-show="activeSection === 'reports'" class="animate-fadeIn">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <i class="fas fa-chart-line mr-3 text-red-500"></i>
                            Laporan E-Kantin MEALYUNG
                        </h2>
                        <div class="flex space-x-3">
                            <button class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-md">
                                <i class="fas fa-file-pdf mr-2"></i> Export PDF
                            </button>
                            <button class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md">
                                <i class="fas fa-file-excel mr-2"></i> Export Excel
                            </button>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg">
                            <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">Statistik Penjualan</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Total Pesanan Hari Ini</span>
                                    <span class="font-bold text-gray-900 dark:text-white" x-text="todayOrders"></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Total Pendapatan Hari Ini</span>
                                    <span class="font-bold text-green-600">Rp <span x-text="todayRevenue.toLocaleString('id-ID')"></span></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Rata-rata Pesanan</span>
                                    <span class="font-bold text-gray-900 dark:text-white">Rp <span x-text="Math.round(todayRevenue / todayOrders).toLocaleString('id-ID')"></span></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Menu Terlaris</span>
                                    <span class="font-bold text-red-600">Nasi Goreng Spesial</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg">
                            <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">Performa Bulanan</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-gray-600 dark:text-gray-400">Target Penjualan</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">75%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-gray-600 dark:text-gray-400">Kepuasan Pelanggan</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">92%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: 92%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-gray-600 dark:text-gray-400">Efisiensi Waktu</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">88%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 88%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg">
                        <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">Manfaat E-Kantin MEALYUNG</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                <h4 class="font-medium text-red-800 dark:text-red-300 mb-2">Bagi Siswa/Guru</h4>
                                <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                    <li>• Hemat waktu dengan pemesanan online</li>
                                    <li>• Tidak perlu antri di kantin</li>
                                    <li>• Pembayaran yang aman dan praktis</li>
                                </ul>
                            </div>
                            <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                <h4 class="font-medium text-blue-800 dark:text-blue-300 mb-2">Bagi Pengelola Kantin</h4>
                                <ul class="text-sm text-blue-600 dark:text-blue-400 space-y-1">
                                    <li>• Manajemen pesanan yang lebih teratur</li>
                                    <li>• Laporan penjualan real-time</li>
                                    <li>• Pengelolaan stok yang lebih efisien</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
            <!-- Footer -->
            <footer class="glass py-4 text-center text-sm text-gray-600 dark:text-gray-400">
                <div class="flex flex-col md:flex-row justify-between items-center px-6">
                    <p>© 2024 E-Kantin MEALYUNG. All rights reserved.</p>
                    <div class="flex space-x-4 mt-2 md:mt-0">
                        <a href="https://www.facebook.com/share/17JJoMfepa/" class="text-gray-500 hover:text-red-500 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/smkn1sayungdemak?igsh=ajBrc3RwdG1scGt4" class="text-gray-500 hover:text-red-500 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>