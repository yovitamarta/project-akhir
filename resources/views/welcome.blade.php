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
        
        /* Info box */
        .info-box {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #ef4444;
            margin-bottom: 2rem;
        }
        
        .dark .info-box {
            background: #1f2937;
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
        
        /* Menu item card */
        .menu-item-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .dark .menu-item-card {
            background: #1f2937;
        }
        
        .menu-item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .menu-item-image {
            height: 200px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .menu-item-card:hover .menu-item-image {
            transform: scale(1.05);
        }
        
        .menu-item-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
            z-index: 10;
        }
        
        /* Order button */
        .order-button {
            background: linear-gradient(135deg, #ef4444, #f97316);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .order-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.3);
        }
        
        .order-button:active {
            transform: translateY(0);
        }
        
        /* Search bar */
        .search-bar {
            position: relative;
        }
        
        .search-bar input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border-radius: 50px;
            border: 1px solid #e5e7eb;
            background: white;
            color: #1f2937;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        
        .dark .search-bar input {
            background: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }
        
        .search-bar input:focus {
            outline: none;
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        .search-bar i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }
        
        .dark .search-bar i {
            color: #9ca3af;
        }
        
        /* Notification */
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            border-radius: 10px;
            padding: 15px 20px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 1000;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }
        
        .dark .notification {
            background: #1f2937;
            color: #f9fafb;
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification i {
            font-size: 1.2rem;
        }
        
        .notification.success i {
            color: #10b981;
        }
        
        .notification.error i {
            color: #ef4444;
        }
        
        /* Modal */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .modal.show {
            opacity: 1;
            visibility: visible;
        }
        
        .modal-content {
            background: white;
            border-radius: 1rem;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }
        
        .modal.show .modal-content {
            transform: scale(1);
        }
        
        .dark .modal-content {
            background: #1f2937;
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .dark .modal-header {
            border-color: #374151;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        
        .dark .modal-footer {
            border-color: #374151;
        }
        
        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
        }
        
        .dark .modal-close {
            color: #9ca3af;
        }
        
        .modal-close:hover {
            color: #1f2937;
        }
        
        .dark .modal-close:hover {
            color: #f9fafb;
        }
        
        /* Form */
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        
        .dark .form-label {
            color: #f9fafb;
        }
        
        .form-control {
            width: 100%;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: white;
            color: #1f2937;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .dark .form-control {
            background: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .form-check-input {
            margin-right: 0.5rem;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #ef4444, #f97316);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.3);
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid #e5e7eb;
            color: #374151;
        }
        
        .dark .btn-outline {
            border-color: #4b5563;
            color: #f9fafb;
        }
        
        .btn-outline:hover {
            background: #f3f4f6;
        }
        
        .dark .btn-outline:hover {
            background: #374151;
        }
    </style>
</head>
<body class="min-h-screen selection:bg-red-500 selection:text-white">
    <div x-data="{ 
        darkMode: false,
        open: true,
        searchQuery: '',
        showAuthModal: false,
        authMode: 'login',
        notification: {
            show: false,
            message: '',
            type: 'success'
        },
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
        showNotification(message, type = 'success') {
            this.notification.message = message;
            this.notification.type = type;
            this.notification.show = true;
            
            setTimeout(() => {
                this.notification.show = false;
            }, 3000);
        },
        menuItems: [
            {
                id: 1,
                name: 'Nasi Goreng Spesial',
                description: 'Nasi goreng dengan telur, ayam, dan sosis.',
                price: 4000,
                rating: 4.8,
                image: 'https://i.pinimg.com/1200x/94/82/ab/9482ab2e248d249e7daa7fd6924c8d3b.jpg',
                badge: 'Menu Terlaris',
                badgeColor: 'bg-red-500'
            },
            {
                id: 2,
                name: 'Bakso Jumbo',
                description: 'Bakso sapi dengan kuah segar dan sambal.',
                price: 5000,
                rating: 4.6,
                image: 'https://i.pinimg.com/736x/80/81/50/80815088a9ead2ca5491f55f8620712f.jpg',
                badge: 'Terfavorit',
                badgeColor: 'bg-blue-500'
            },
            {
                id: 3,
                name: 'Mie Ayam',
                description: 'Mie ayam dengan kuah kaldu dan sayuran segar.',
                price: 6000,
                rating: 4.7,
                image: 'https://i.pinimg.com/736x/12/e3/42/12e3428d9e726a3a8cac72cdc4c28297.jpg',
                badge: null,
                badgeColor: null
            },
            {
                id: 4,
                name: 'Sate Ayam',
                description: 'Sate ayam dengan bumbu kacang dan lontong.',
                price: 6000,
                rating: 4.9,
                image: 'https://i.pinimg.com/736x/6b/0e/49/6b0e4913e0ad120776bb65757180ad84.jpg',
                badge: 'Baru',
                badgeColor: 'bg-green-500'
            },
            {
                id: 5,
                name: 'Gado-Gado',
                description: 'Sayuran segar dengan bumbu kacang dan kerupuk.',
                price: 7000,
                rating: 4.5,
                image: 'https://i.pinimg.com/1200x/1f/fc/95/1ffc950aead4fae6360fcd7c518355de.jpg',
                badge: null,
                badgeColor: null,
            },
            {
                id: 6,
                name: 'Es Teh Manis',
                description: 'Teh manis dingin dengan es batu.',
                price: 3000,
                rating: 4.7,
                image: 'https://i.pinimg.com/736x/63/30/04/633004a76c6f03ab9665d8cce7dade47.jpg',
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
            this.showNotification(`${item.name} berhasil dipesan! Silakan ambil di kasir.`);
        },
        openAuthModal(mode) {
            this.authMode = mode;
            this.showAuthModal = true;
        },
        closeAuthModal() {
            this.showAuthModal = false;
        },
        login() {
            // Simulasi login
            this.closeAuthModal();
            this.showNotification('Login berhasil! Selamat datang di E-Kantin MEALYUNG.');
        },
        register() {
            // Simulasi register
            this.closeAuthModal();
            this.showNotification('Registrasi berhasil! Silakan login dengan akun Anda.');
        }
    }" :class="{ 'dark': darkMode }" class="flex h-screen">
        
        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="glass shadow-md px-8 py-4 sticky top-0 z-30 transition-all duration-300">
                <div class="flex justify-between items-center">
                <div class="relative">
                    <img alt="MEALYUNG logo" class="h-10 w-10 rounded-lg shadow-md animate-pulse" height="40" src="https://i.pinimg.com/736x/a9/cc/21/a9cc213037bdb11d68a54ca73a80ed54.jpg" width="40"/>
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                </div>
                    <div class="flex items-center space-x-4">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white tracking-tight">
                           MEALYUNG - SMK N 1 SAYUNG
                        </h2>
                    </div>
                        
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
            </header>
            
            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-6 space-y-8">
                <!-- Welcome Section -->
                <section class="welcome-section animate-fadeIn">
                    <div class="welcome-content flex flex-col items-center justify-center text-center min-h-[300px]">
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-5 leading-tight">Selamat Datang di E-Kantin MEALYUNG</h1>
                        <p class="text-2xl md:text-2xl mb-10 max-w-2xl mx-auto leading-relaxed">Pesan makanan favoritmu dengan mudah dan cepat tanpa antri!</p>
                        <a href="#menu" class="bg-white text-red-500 font-semibold py-4 px-8 rounded-full shadow-lg hover:bg-gray-100 transition-all duration-300 inline-flex items-center text-lg">
                            <i class="fas fa-arrow-down-circle mr-3 text-xl"></i>
                            <span class="text-xl">Menu Terlaris</span>
                        </a>
                    </div>
                </section>
                
                <!-- Visi & Misi -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 animate-fadeIn" style="animation-delay: 0.3s">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                        <i class="fas fa-bullseye text-red-500 mr-3"></i>
                        Visi & Misi
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Visi</h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                Menjadi sistem kantin digital terdepan yang memberikan kemudahan, kenyamanan, dan pengalaman terbaik bagi seluruh warga sekolah SMK N 1 SAYUNG dalam memenuhi kebutuhan kuliner sehari-hari.
                            </p>
                        </div>
                        
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Misi</h3>
                            <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                    <span>Menyediakan sistem pemesanan makanan yang cepat, mudah, dan efisien</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                    <span>Mengurangi waktu antri dan meningkatkan efektivitas jam istirahat</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                    <span>Memberikan pelayanan prima dengan menu berkualitas dan harga terjangkau</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                    <span>Mengintegrasikan teknologi digital dalam operasional kantin sekolah</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                  <!-- Cara Menggunakan Aplikasi -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 animate-fadeIn" style="animation-delay: 0.6s">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                        <i class="fas fa-list-ol text-red-500 mr-3"></i>
                        Cara Menggunakan Aplikasi E-Kantin MEALYUNG
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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
                    
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
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
                
                <!-- Keunggulan E-Kantin MEALYUNG -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 animate-fadeIn" style="animation-delay: 0.4s">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                        <i class="fas fa-star text-yellow-500 mr-3"></i>
                        Keunggulan E-Kantin MEALYUNG
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="feature-card">
                            <div class="feature-icon bg-red-100 text-red-600">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Akses Mudah</h3>
                            <p class="text-gray-600 dark:text-gray-400 flex-grow">Aplikasi dapat diakses kapan saja dan di mana saja melalui perangkat smartphone atau komputer dengan antarmuka yang user-friendly.</p>
                        </div>
                        
                        <div class="feature-card">
                            <div class="feature-icon bg-blue-100 text-blue-600">
                                <i class="fas fa-qrcode"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Pembayaran Digital</h3>
                            <p class="text-gray-600 dark:text-gray-400 flex-grow">Sistem pembayaran yang praktis dengan berbagai metode digital seperti e-wallet dan transfer bank, mengurangi kebutuhan membawa uang tunai.</p>
                        </div>
                        
                        <div class="feature-card">
                            <div class="feature-icon bg-green-100 text-green-600">
                                <i class="fas fa-history"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Riwayat Transaksi</h3>
                            <p class="text-gray-600 dark:text-gray-400 flex-grow">Lacak semua riwayat pembelian Anda dengan mudah dan transparan untuk kontrol pengeluaran yang lebih baik.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Section -->
                <div id="menu" class="animate-fadeIn" style="animation-delay: 0.8s">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <i class="fas fa-utensils mr-3 text-red-500"></i>
                            Menu Terlaris di E-Kantin MEALYUNG
                        </h2>
                        <div class="search-bar w-full md:w-64">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Cari menu..." x-model="searchQuery">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <template x-for="item in filteredMenuItems" :key="item.id">
                            <div class="menu-item-card">
                                <div class="relative">
                                    <img :alt="item.name" class="menu-item-image" :src="item.image"/>
                                    <div x-show="item.badge" :class="item.badgeColor" class="menu-item-badge">
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
        
        <!-- Auth Modal -->
        <div class="modal" :class="{ 'show': showAuthModal }">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white" x-text="authMode === 'login' ? 'Login ke Akun Anda' : 'Daftar Akun Baru'"></h3>
                    <button @click="closeAuthModal" class="modal-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Login Form -->
                    <form x-show="authMode === 'login'" @submit.prevent="login()">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="nama@email.com" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Ingat saya</label>
                        </div>
                    </form>
                    
                    <!-- Register Form -->
                    <form x-show="authMode === 'register'" @submit.prevent="register()">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Nama lengkap" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="nama@email.com" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" placeholder="Konfirmasi password" required>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">Saya setuju dengan syarat dan ketentuan</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button @click="closeAuthModal" class="btn btn-outline">Batal</button>
                    <button @click="authMode === 'login' ? login() : register()" class="btn btn-primary" x-text="authMode === 'login' ? 'Login' : 'Daftar'"></button>
                </div>
            </div>
        </div>
        
        <!-- Notification -->
        <div class="notification" :class="{ 'show': notification.show, 'success': notification.type === 'success', 'error': notification.type === 'error' }">
            <i :class="notification.type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle'"></i>
            <span x-text="notification.message"></span>
        </div>
    </div>
</body>
</html>