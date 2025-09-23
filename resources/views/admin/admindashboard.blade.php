<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEALYUNG Admin Dashboard</title>
    
    <!-- External Libraries -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="//unpkg.com/alpinejs"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* CSS Variables for consistent theming */
        :root {
            --primary: #ef4444;
            --primary-hover: #dc2626;
            --secondary: #f97316;
            --text-dark: #111827;
            --text-light: #6b7280;
            --bg-light: #f5f7fa;
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.18);
            --dark-glass-bg: rgba(30, 41, 59, 0.25);
            --dark-glass-border: rgba(255, 255, 255, 0.1);
        }
        
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--bg-light) 0%, #c3cfe2 100%);
            background-attachment: fixed;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background-color: var(--primary);
            border-radius: 10px;
            border: 2px solid transparent;
            background-clip: content-box;
        }
        
        /* Animations */
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
        
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
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
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        /* Utility Classes */
        .animate-fadeIn {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite;
        }
        
        .bell-ring {
            animation: ring 1s ease-in-out;
        }
        
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        /* Glassmorphism effect */
        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
        }
        
        /* Dark mode glass */
        .dark .glass {
            background: var(--dark-glass-bg);
            border: 1px solid var(--dark-glass-border);
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
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Custom toggle */
        .toggle-checkbox:checked {
            right: 0;
            border-color: var(--primary);
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: var(--primary);
        }
        
        /* Modal styles */
        .modal {
            transition: opacity 0.3s ease;
        }
        
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }
    </style>
</head>
<body class="min-h-screen selection:bg-red-500 selection:text-white">
    <div :class="darkMode ? 'dark' : ''" class="flex h-screen" x-data="{ 
        open: true, 
        darkMode: false, 
        userMenu: false,
        notifCount: 5,
        loading: true,
        activeTab: 'dashboard',
        notifications: [
        ],
        showNotifications: false,
        stats: {
            orders: 1245,
            revenue: 24560,
            pending: 8,
            customers: 1032
        },
        profile: {
            name: 'Admin User',
            email: 'admin@mealyung.com',
            phone: '+62 812 3456 7890',
            bio: 'Restaurant Administrator',
            avatar: 'https://i.pravatar.cc/150'
        },
        searchQuery: '',
        searchResults: [],
        showProfileModal: false,
        showOrderModal: false,
        selectedOrder: null,
        init() {
            this.loading = false;
            setInterval(() => { 
                if (this.notifCount < 99) this.notifCount++; 
            }, 15000);
        },
        logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'welcome.bade.php';
            }
        },
        updateProfile() {
            // Simulate profile update
            alert('Profile updated successfully!');
            this.showProfileModal = false;
        },
        performSearch() {
            if (this.searchQuery.trim() === '') {
                this.searchResults = [];
                return;
            }
            
            // Simulate search results
            this.searchResults = [
                { type: 'order', id: '#ORD-001', title: 'Order by Ahmad Fauzi', description: 'Nasi Goreng, Teh Manis' },
                { type: 'customer', id: '#001', title: 'Ahmad Fauzi', description: 'ahmad@example.com' },
                { type: 'menu', id: '#M001', title: 'Nasi Goreng Spesial', description: '$3.50' }
            ];
        },
        viewOrder(orderId) {
            // Simulate fetching order details
            this.selectedOrder = {
                id: orderId,
                customer: 'Ahmad Fauzi',
                items: 'Nasi Goreng, Teh Manis',
                total: '$5.50',
                status: 'Completed',
                date: '2024-06-01',
                address: 'Jl. Sudirman No. 123',
                phone: '+62 812 3456 7890'
            };
            this.showOrderModal = true;
        },
        updateOrderStatus(status) {
            if (this.selectedOrder) {
                this.selectedOrder.status = status;
                alert(`Order status updated to ${status}`);
                this.showOrderModal = false;
            }
        }
    }">
        
        <!-- ===== SIDEBAR ===== -->
        <aside :class="open ? 'w-64' : 'w-20'" class="bg-white dark:bg-gray-900 shadow-xl flex flex-col transition-all duration-500 border-r border-gray-200 dark:border-gray-700 z-40">
            <!-- Logo -->
            <div class="flex items-center space-x-3 p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="relative">
                    <img alt="MEALYUNG logo" class="h-10 w-10 rounded-lg shadow-md animate-pulse" height="40" src="c:\Users\Dell\Downloads\WhatsApp Image 2025-09-23 at 9.04.09 AM (1).jpeg" width="40"/>
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                </div>
                <h1 class="text-2xl font-extrabold gradient-text transition-opacity select-none" x-show="open">
                    MEALYUNG
                </h1>
            </div>
            
            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 text-gray-700 dark:text-gray-300 font-medium">
                <template x-for="item in [
                    {id: 'dashboard', icon: 'fa-home', label: 'Dashboard'},
                    {id: 'orders', icon: 'fa-shopping-cart', label: 'Orders'},
                    {id: 'menu', icon: 'fa-utensils', label: 'Menu'},
                    {id: 'reports', icon: 'fa-chart-line', label: 'Reports'},
                    {id: 'settings', icon: 'fa-cog', label: 'Settings'},
                    {id: 'profile', icon: 'fa-user-circle', label: 'Profile'}
                ]" :key="item.id">
                    <a @click="activeTab = item.id" 
                       :class="{'bg-red-600 text-white': activeTab === item.id}" 
                       class="flex items-center space-x-4 p-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 group cursor-pointer">
                        <i :class="`fas ${item.icon} text-lg group-hover:scale-110 transition-transform`"></i>
                        <span class="transition-opacity select-none" x-show="open" x-text="item.label"></span>
                    </a>
                </template>
            </nav>
            
            <!-- User Menu -->
            <div class="border-t border-gray-200 dark:border-gray-700 p-5 space-y-4">
                <div class="relative" @mouseenter="userMenu = true" @mouseleave="userMenu = false">
                    <button class="w-full flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                        <img src="https://i.pravatar.cc/40" class="w-9 h-9 rounded-full border-2 border-gray-300 dark:border-gray-600"/>
                        <div x-show="open" class="text-left">
                            <p class="text-gray-800 dark:text-gray-200 font-medium">Admin User</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Administrator</p>
                        </div>
                        <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400 ml-auto transition-transform" :class="userMenu ? 'rotate-180' : ''" x-show="open"></i>
                    </button>
                    <div x-show="userMenu" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="absolute left-0 bottom-14 w-56 glass rounded-xl py-2 z-50 shadow-xl">
                        <a @click="activeTab = 'profile'; userMenu = false" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg mx-1 my-1 transition-colors">
                            <i class="fas fa-user-circle mr-2"></i> Profile
                        </a>
                        <a @click="activeTab = 'settings'; userMenu = false" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg mx-1 my-1 transition-colors">
                            <i class="fas fa-cog mr-2"></i> Settings
                        </a>
                       <button type="submit" class="block px-4 py-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition cursor-pointer">
                         <i class="fas fa-sign-out-alt mr-2"></i> Log out
                    </button>
                    </div>
                </div>
            </div>
        </aside>
        
        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="glass shadow-md px-8 py-4 sticky top-0 z-30 transition-all duration-300">
                <div class="flex justify-between items-center">
                    <button @click="open = !open" class="p-3 rounded-xl bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300 shadow-md">
                        <i class="fas fa-bars text-gray-800 dark:text-gray-200 text-xl"></i>
                    </button>
                    
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-500 dark:text-gray-400 text-sm">Welcome back,</span>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight select-none">
                            <span x-show="!loading">Admin User</span>
                            <span x-show="loading" class="skeleton h-6 w-32 rounded inline-block"></span>
                        </h2>
                    </div>
                    
                    <div class="flex items-center space-x-5">
                        <div class="relative">
                            
                            <!-- Search Results Dropdown -->
                            <div x-show="searchResults.length > 0" 
                                 @click.away="searchResults = []"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="absolute right-0 mt-2 w-80 glass rounded-2xl shadow-xl z-50 overflow-hidden max-h-96">
                                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Search Results</h3>
                                </div>
                                <div class="max-h-80 overflow-y-auto">
                                    <template x-for="result in searchResults" :key="result.id">
                                        <div class="p-4 border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer" @click="searchResults = []">
                                            <div class="flex justify-between">
                                                <h4 class="font-medium text-gray-900 dark:text-white" x-text="result.title"></h4>
                                                <span class="text-xs px-2 py-1 rounded-full" 
                                                      :class="{
                                                        'bg-blue-100 text-blue-800': result.type === 'order',
                                                        'bg-green-100 text-green-800': result.type === 'customer',
                                                        'bg-yellow-100 text-yellow-800': result.type === 'menu'
                                                      }" 
                                                      x-text="result.type"></span>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1" x-text="result.description"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <button @click="showNotifications = !showNotifications; $el.classList.add('bell-ring'); setTimeout(() => $el.classList.remove('bell-ring'), 1000)" 
                                    aria-label="Notifications" 
                                    class="relative p-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-full hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-lg">
                                <i class="fas fa-bell text-lg"></i>
                                <span x-show="notifCount > 0" x-text="notifCount" class="absolute -top-1 -right-1 bg-yellow-400 text-xs font-bold rounded-full px-1.5 py-0.5 select-none animate-pulse"></span>
                            </button>
                            
                            <!-- Notifications Dropdown -->
                            <div x-show="showNotifications" 
                                 @click.away="showNotifications = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="absolute right-0 mt-2 w-80 glass rounded-2xl shadow-xl z-50 overflow-hidden">
                                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Notifications</h3>
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    <template x-for="notification in notifications" :key="notification.id">
                                        <div class="p-4 border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer" :class="{'bg-blue-50 dark:bg-blue-900/20': !notification.read}">
                                            <div class="flex justify-between">
                                                <h4 class="font-medium text-gray-900 dark:text-white" x-text="notification.title"></h4>
                                                <span class="text-xs text-gray-500 dark:text-gray-400" x-text="notification.time"></span>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1" x-text="notification.message"></p>
                                            <div class="flex items-center mt-2">
                                                <span x-show="!notification.read" class="inline-block w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                                <span class="text-xs text-blue-600 dark:text-blue-400" x-show="!notification.read">New</span>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div class="p-3 bg-gray-50 dark:bg-gray-800 text-center">
                                    <a href="#" class="text-sm text-red-600 dark:text-red-400 hover:underline">View All Notifications</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-6 space-y-8">
                <!-- Dashboard Tab -->
                <div x-show="activeTab === 'dashboard'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="space-y-8">
                    <!-- Welcome Section -->
                    <div class="glass rounded-2xl p-6 shadow-lg animate-fadeIn">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                                    Admin Dashboard
                                </h1>
                                <p class="text-gray-600 dark:text-gray-400 max-w-2xl">
                                    Monitor and manage your restaurant operations from one central location.
                                </p>
                            </div>
                            <div class="flex space-x-3">
                                <button @click="alert('Exporting data...')" class="px-5 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md">
                                    <i class="fas fa-download mr-2"></i> Export Data
                                </button>
                                <button @click="alert('Add new item form will open')" class="px-5 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-md">
                                    <i class="fas fa-plus mr-2"></i> Add New
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Overview Cards -->
                    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Total Orders -->
                        <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white p-6 rounded-2xl shadow-xl card-hover animate-fadeIn" style="animation-delay: 0.1s">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm uppercase opacity-90 tracking-wider font-semibold">Total Orders</h3>
                                    <p class="text-4xl font-extrabold mt-2 drop-shadow-lg" x-text="stats.orders.toLocaleString()"></p>
                                    <div class="flex items-center mt-3 text-xs">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        <span>12.5% from last month</span>
                                    </div>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl shadow-lg animate-float">
                                    <i class="fas fa-box text-2xl"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Revenue -->
                        <div class="bg-gradient-to-br from-amber-500 to-orange-600 text-white p-6 rounded-2xl shadow-xl card-hover animate-fadeIn" style="animation-delay: 0.2s">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm uppercase opacity-90 tracking-wider font-semibold">Revenue</h3>
                                    <p class="text-4xl font-extrabold mt-2 drop-shadow-lg">$<span x-text="stats.revenue.toLocaleString()"></span></p>
                                    <div class="flex items-center mt-3 text-xs">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        <span>8.2% from last month</span>
                                    </div>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl shadow-lg animate-float" style="animation-delay: 0.5s">
                                    <i class="fas fa-dollar-sign text-2xl"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pending Orders -->
                        <div class="bg-gradient-to-br from-red-500 to-rose-600 text-white p-6 rounded-2xl shadow-xl card-hover animate-fadeIn" style="animation-delay: 0.3s">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm uppercase opacity-90 tracking-wider font-semibold">Pending Orders</h3>
                                    <p class="text-4xl font-extrabold mt-2 drop-shadow-lg" x-text="stats.pending"></p>
                                    <div class="flex items-center mt-3 text-xs">
                                        <i class="fas fa-arrow-down mr-1"></i>
                                        <span>3.1% from last month</span>
                                    </div>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl shadow-lg animate-float" style="animation-delay: 1s">
                                    <i class="fas fa-hourglass-half text-2xl"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Customers -->
                        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 text-white p-6 rounded-2xl shadow-xl card-hover animate-fadeIn" style="animation-delay: 0.4s">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm uppercase opacity-90 tracking-wider font-semibold">Customers</h3>
                                    <p class="text-4xl font-extrabold mt-2 drop-shadow-lg" x-text="stats.customers.toLocaleString()"></p>
                                    <div class="flex items-center mt-3 text-xs">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        <span>5.7% from last month</span>
                                    </div>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl shadow-lg animate-float" style="animation-delay: 1.5s">
                                    <i class="fas fa-users text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Charts Section -->
                    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Revenue Chart -->
                        <div class="glass rounded-2xl p-6 shadow-xl animate-fadeIn" style="animation-delay: 0.5s">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Revenue Trend</h3>
                            <div class="h-64">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                        
                        <!-- Orders Chart -->
                        <div class="glass rounded-2xl p-6 shadow-xl animate-fadeIn" style="animation-delay: 0.6s">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Orders by Category</h3>
                            <div class="h-64">
                                <canvas id="ordersChart"></canvas>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Recent Orders -->
                    <section class="glass rounded-2xl p-6 shadow-xl animate-fadeIn" style="animation-delay: 0.7s">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-shopping-cart mr-3 text-red-500"></i>
                                Recent Orders
                            </h2>
                            <a @click="activeTab = 'orders'" href="#" class="text-red-600 hover:text-red-700 transition-colors">View All</a>
                        </div>
                        
                        <div class="overflow-x-auto rounded-xl">
                            <table class="min-w-full bg-white dark:bg-gray-800 rounded-xl overflow-hidden">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="py-3 px-4 text-left font-semibold text-gray-700 dark:text-gray-300">Order ID</th>
                                        <th class="py-3 px-4 text-left font-semibold text-gray-700 dark:text-gray-300">Customer</th>
                                        <th class="py-3 px-4 text-left font-semibold text-gray-700 dark:text-gray-300">Items</th>
                                        <th class="py-3 px-4 text-left font-semibold text-gray-700 dark:text-gray-300">Total</th>
                                        <th class="py-3 px-4 text-left font-semibold text-gray-700 dark:text-gray-300">Status</th>
                                        <th class="py-3 px-4 text-left font-semibold text-gray-700 dark:text-gray-300">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                                        <td class="py-3 px-4 font-mono text-gray-900 dark:text-white">#ORD-001</td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">
                                            <div class="flex items-center">
                                                <img src="https://i.pravatar.cc/30" class="w-8 h-8 rounded-full mr-2">
                                                Ahmad Fauzi
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">Nasi Goreng, Teh Manis</td>
                                        <td class="py-3 px-4 font-semibold text-gray-900 dark:text-white">$5.50</td>
                                        <td class="py-3 px-4">
                                            <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Completed</span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">2024-06-01</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                                        <td class="py-3 px-4 font-mono text-gray-900 dark:text-white">#ORD-002</td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">
                                            <div class="flex items-center">
                                                <img src="https://i.pravatar.cc/30?u=2" class="w-8 h-8 rounded-full mr-2">
                                                Siti Nurhaliza
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">Bakso, Es Jeruk</td>
                                        <td class="py-3 px-4 font-semibold text-gray-900 dark:text-white">$4.00</td>
                                        <td class="py-3 px-4">
                                            <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">2024-06-02</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                                        <td class="py-3 px-4 font-mono text-gray-900 dark:text-white">#ORD-003</td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">
                                            <div class="flex items-center">
                                                <img src="https://i.pravatar.cc/30?u=3" class="w-8 h-8 rounded-full mr-2">
                                                Budi Santoso
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">Mie Ayam, Es Teh</td>
                                        <td class="py-3 px-4 font-semibold text-gray-900 dark:text-white">$6.25</td>
                                        <td class="py-3 px-4">
                                            <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">Cancelled</span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">2024-06-03</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
                
                <!-- Orders Tab -->
                <div x-show="activeTab === 'orders'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="animate-fadeIn">
                    <div class="glass rounded-2xl p-6 shadow-xl">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-shopping-cart mr-3 text-red-500"></i>
                                Orders Management
                            </h2>
                            <div class="flex space-x-3">
                                <select class="px-4 py-2 border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                                    <option>All Status</option>
                                    <option>Completed</option>
                                    <option>Pending</option>
                                    <option>Cancelled</option>
                                </select>
                                <button @click="alert('Filter applied')" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                    <i class="fas fa-filter mr-2"></i> Filter
                                </button>
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto rounded-xl">
                            <table class="min-w-full bg-white dark:bg-gray-800 rounded-xl overflow-hidden">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="py-3 px-4 text-left font-semibold text-gray-700 dark:text-gray-300">Order ID</th>
                                        <th class="py-3 px-4 text-left font-semibold text-gray-700 dark:text-gray-300">Customer</th>
                                        <th class="py-3 px-4 text-left font-semibold text-gray-700 dark:text-gray-300">Items</th>
                                        <th class="py-3 px-4 text-left font-semibold text-gray-700 dark:text-gray-300">Total</th>
                                        <th class="py-3 px-4 text-left font-semibold text-gray-700 dark:text-gray-300">Status</th>
                                        <th class="py-3 px-4 text-left font-semibold text-gray-700 dark:text-gray-300">Date</th>
                                        <th class="py-3 px-4 text-left font-semibold text-gray-700 dark:text-gray-300">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                                        <td class="py-3 px-4 font-mono text-gray-900 dark:text-white">#ORD-001</td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">
                                            <div class="flex items-center">
                                                <img src="https://i.pravatar.cc/30" class="w-8 h-8 rounded-full mr-2">
                                                Ahmad Fauzi
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">Nasi Goreng, Teh Manis</td>
                                        <td class="py-3 px-4 font-semibold text-gray-900 dark:text-white">$5.50</td>
                                        <td class="py-3 px-4">
                                            <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Completed</span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">2024-06-01</td>
                                        <td class="py-3 px-4">
                                            <div class="flex space-x-2">
                                                <button @click="viewOrder('#ORD-001')" class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button @click="alert('Edit order form will open')" class="text-green-600 hover:text-green-800">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button @click="alert('Order deleted')" class="text-red-600 hover:text-red-800">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                                        <td class="py-3 px-4 font-mono text-gray-900 dark:text-white">#ORD-002</td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">
                                            <div class="flex items-center">
                                                <img src="https://i.pravatar.cc/30?u=2" class="w-8 h-8 rounded-full mr-2">
                                                Siti Nurhaliza
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">Bakso, Es Jeruk</td>
                                        <td class="py-3 px-4 font-semibold text-gray-900 dark:text-white">$4.00</td>
                                        <td class="py-3 px-4">
                                            <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">2024-06-02</td>
                                        <td class="py-3 px-4">
                                            <div class="flex space-x-2">
                                                <button @click="viewOrder('#ORD-002')" class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button @click="alert('Edit order form will open')" class="text-green-600 hover:text-green-800">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button @click="alert('Order deleted')" class="text-red-600 hover:text-red-800">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                                        <td class="py-3 px-4 font-mono text-gray-900 dark:text-white">#ORD-003</td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">
                                            <div class="flex items-center">
                                                <img src="https://i.pravatar.cc/30?u=3" class="w-8 h-8 rounded-full mr-2">
                                                Budi Santoso
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">Mie Ayam, Es Teh</td>
                                        <td class="py-3 px-4 font-semibold text-gray-900 dark:text-white">$6.25</td>
                                        <td class="py-3 px-4">
                                            <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">Cancelled</span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-300">2024-06-03</td>
                                        <td class="py-3 px-4">
                                            <div class="flex space-x-2">
                                                <button @click="viewOrder('#ORD-003')" class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button @click="alert('Edit order form will open')" class="text-green-600 hover:text-green-800">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button @click="alert('Order deleted')" class="text-red-600 hover:text-red-800">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4 flex justify-between items-center">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Showing 3 of 1,245 orders</p>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">1</button>
                                <button class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">2</button>
                                <button class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">3</button>
                                <button class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Tab -->
                <div x-show="activeTab === 'menu'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="animate-fadeIn">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <i class="fas fa-utensils mr-3 text-red-500"></i>
                            Menu Management
                        </h2>
                        <button @click="alert('Add menu item form will open')" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                            <i class="fas fa-plus mr-2"></i> Add Menu Item
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                            <div class="relative">
                                <img alt="Nasi Goreng Spesial" class="w-full h-48 object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/48ca648d-fdda-4a9b-e384-f1587742b1a8.jpg" width="400"/>
                                <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    Bestseller
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Nasi Goreng Spesial</h3>
                                    <div class="flex items-center text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <span class="ml-1 text-gray-700 dark:text-gray-300">4.8</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Nasi goreng dengan telur, ayam, dan sosis.</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-extrabold text-red-600 text-xl">$3.50</span>
                                    <div class="flex space-x-2">
                                        <button @click="alert('Edit menu item form will open')" class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button @click="alert('Menu item deleted')" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                            <div class="relative">
                                <img alt="Bakso Jumbo" class="w-full h-48 object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/3ce3758f-a369-46ef-36a1-3188ffd683de.jpg" width="400"/>
                                <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    New
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Bakso Jumbo</h3>
                                    <div class="flex items-center text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <span class="ml-1 text-gray-700 dark:text-gray-300">4.6</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Bakso sapi dengan kuah segar dan sambal.</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-extrabold text-red-600 text-xl">$2.80</span>
                                    <div class="flex space-x-2">
                                        <button @click="alert('Edit menu item form will open')" class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button @click="alert('Menu item deleted')" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                            <img alt="Mie Ayam" class="w-full h-48 object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg" width="400"/>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Mie Ayam</h3>
                                    <div class="flex items-center text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <span class="ml-1 text-gray-700 dark:text-gray-300">4.7</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Mie ayam dengan kuah kaldu dan sayuran segar.</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-extrabold text-red-600 text-xl">$3.00</span>
                                    <div class="flex space-x-2">
                                        <button @click="alert('Edit menu item form will open')" class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button @click="alert('Menu item deleted')" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Reports Tab -->
                <div x-show="activeTab === 'reports'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="animate-fadeIn">
                    <div class="glass rounded-2xl p-6 shadow-xl">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-chart-line mr-3 text-red-500"></i>
                                Business Reports
                            </h2>
                            <div class="flex space-x-3">
                                <select class="px-4 py-2 border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                                    <option>Last 7 Days</option>
                                    <option>Last 30 Days</option>
                                    <option>Last 90 Days</option>
                                    <option>Last Year</option>
                                </select>
                                <button @click="alert('Exporting CSV...')" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md">
                                    <i class="fas fa-file-csv mr-2"></i> Export CSV
                                </button>
                                <button @click="alert('Exporting PDF...')" class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-md">
                                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                                </button>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg">
                                <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">Revenue Trend</h3>
                                <div class="h-64">
                                    <canvas id="revenueReportChart"></canvas>
                                </div>
                            </div>
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg">
                                <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">Order Status Distribution</h3>
                                <div class="h-64">
                                    <canvas id="orderStatusChart"></canvas>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg">
                                <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">Top Selling Items</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                                <i class="fas fa-utensils text-red-500"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">Nasi Goreng</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">245 orders</p>
                                            </div>
                                        </div>
                                        <span class="font-semibold text-gray-900 dark:text-white">$857.50</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                                <i class="fas fa-drumstick-bite text-orange-500"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">Bakso</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">189 orders</p>
                                            </div>
                                        </div>
                                        <span class="font-semibold text-gray-900 dark:text-white">$529.20</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                                <i class="fas fa-seedling text-yellow-500"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">Mie Ayam</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">156 orders</p>
                                            </div>
                                        </div>
                                        <span class="font-semibold text-gray-900 dark:text-white">$468.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg">
                                <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">Customer Activity</h3>
                                <div class="h-64">
                                    <canvas id="customerActivityChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Settings Tab -->
                <div x-show="activeTab === 'settings'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="animate-fadeIn">
                    <div class="glass rounded-2xl p-6 shadow-xl">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center mb-6">
                            <i class="fas fa-cog mr-3 text-red-500"></i>
                            System Settings
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Restaurant Information</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Restaurant Name</label>
                                        <input type="text" value="MEALYUNG Restaurant" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Address</label>
                                        <textarea class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" rows="3">Jl. Sudirman No. 123, Jakarta</textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                                        <input type="text" value="+62 21 1234 5678" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                        <input type="email" value="info@mealyung.com" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">System Configuration</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Dark Mode</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Enable dark mode for the dashboard</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" :checked="darkMode" @change="darkMode = !darkMode" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Email Notifications</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Receive email notifications for new orders</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Auto Backup</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Automatically backup data daily</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Maintenance Mode</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Put the system in maintenance mode</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <button @click="alert('Settings saved successfully!')" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Tab -->
                <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="animate-fadeIn">
                    <div class="glass rounded-2xl p-6 shadow-xl">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center mb-6">
                            <i class="fas fa-user-circle mr-3 text-red-500"></i>
                            Profile Settings
                        </h2>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div class="lg:col-span-1">
                                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                                    <div class="flex flex-col items-center">
                                        <div class="relative mb-4">
                                            <img :src="profile.avatar" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                                            <button @click="document.getElementById('avatarUpload').click()" class="absolute bottom-0 right-0 bg-red-500 text-white p-2 rounded-full shadow-lg hover:bg-red-600 transition">
                                                <i class="fas fa-camera"></i>
                                            </button>
                                            <input type="file" id="avatarUpload" class="hidden" accept="image/*">
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white" x-text="profile.name"></h3>
                                        <p class="text-gray-600 dark:text-gray-400" x-text="profile.bio"></p>
                                        <div class="mt-4 w-full">
                                            <button @click="showProfileModal = true" class="w-full px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                                <i class="fas fa-edit mr-2"></i> Edit Profile
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="lg:col-span-2">
                                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Account Information</h3>
                                    <div class="space-y-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                                                <input type="text" x-model="profile.name" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                                <input type="email" x-model="profile.email" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone</label>
                                                <input type="text" x-model="profile.phone" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bio</label>
                                                <input type="text" x-model="profile.bio" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Change Password</label>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <input type="password" placeholder="New Password" class="px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                                <input type="password" placeholder="Confirm Password" class="px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 flex justify-end">
                                        <button @click="updateProfile" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                            Save Changes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
            <!-- Footer -->
            <footer class="glass py-4 text-center text-sm text-gray-600 dark:text-gray-400">
                <div class="flex flex-col md:flex-row justify-between items-center px-6">
                    <p>© 2024 MEALYUNG. All rights reserved.</p>
                    <div class="flex space-x-4 mt-2 md:mt-0">
                        <a href="#" class="text-gray-500 hover:text-red-500 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-red-500 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-red-500 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-red-500 transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </footer>
        </div>
        
        <!-- Profile Modal -->
        <div x-show="showProfileModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 modal">
            <div class="absolute inset-0 modal-backdrop" @click="showProfileModal = false"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-md w-full p-6 transform transition-all">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Edit Profile</h3>
                    <button @click="showProfileModal = false" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                        <input type="text" x-model="profile.name" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" x-model="profile.email" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone</label>
                        <input type="text" x-model="profile.phone" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bio</label>
                        <textarea x-model="profile.bio" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" rows="3"></textarea>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button @click="showProfileModal = false" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Cancel
                    </button>
                    <button @click="updateProfile" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Order Detail Modal -->
        <div x-show="showOrderModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 modal">
            <div class="absolute inset-0 modal-backdrop" @click="showOrderModal = false"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-md w-full p-6 transform transition-all">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Order Details</h3>
                    <button @click="showOrderModal = false" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div x-show="selectedOrder" class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Order ID</p>
                        <p class="font-medium text-gray-900 dark:text-white" x-text="selectedOrder.id"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Customer</p>
                        <p class="font-medium text-gray-900 dark:text-white" x-text="selectedOrder.customer"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Items</p>
                        <p class="font-medium text-gray-900 dark:text-white" x-text="selectedOrder.items"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total</p>
                        <p class="font-medium text-gray-900 dark:text-white" x-text="selectedOrder.total"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold" 
                              :class="{
                                'bg-green-100 text-green-800': selectedOrder.status === 'Completed',
                                'bg-yellow-100 text-yellow-800': selectedOrder.status === 'Pending',
                                'bg-red-100 text-red-800': selectedOrder.status === 'Cancelled'
                              }" 
                              x-text="selectedOrder.status"></span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Date</p>
                        <p class="font-medium text-gray-900 dark:text-white" x-text="selectedOrder.date"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Address</p>
                        <p class="font-medium text-gray-900 dark:text-white" x-text="selectedOrder.address"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Phone</p>
                        <p class="font-medium text-gray-900 dark:text-white" x-text="selectedOrder.phone"></p>
                    </div>
                </div>
                <div class="mt-6 flex justify-between">
                    <div class="flex space-x-2">
                        <button @click="updateOrderStatus('Completed')" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                            Complete
                        </button>
                        <button @click="updateOrderStatus('Pending')" class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                            Pending
                        </button>
                        <button @click="updateOrderStatus('Cancelled')" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                            Cancel
                        </button>
                    </div>
                    <button @click="showOrderModal = false" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script>
        // Initialize charts when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Revenue Chart
            const revenueCtx = document.getElementById("revenueChart");
            if (revenueCtx) {
                new Chart(revenueCtx.getContext('2d'), {
                    type: "line",
                    data: { 
                        labels: ["Jan","Feb","Mar","Apr","May"], 
                        datasets: [{ 
                            label:"Revenue ($)", 
                            data:[10000,15000,12000,18000,24560], 
                            borderColor: "rgb(239, 68, 68)",
                            backgroundColor: "rgba(239, 68, 68, 0.1)",
                            tension: 0.4,
                            fill: true,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            borderWidth: 3
                        }] 
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    color: '#ef4444',
                                    font: { weight: 'bold' }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    color: '#ef4444',
                                    font: { weight: 'bold' }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#ef4444',
                                    font: { weight: 'bold' }
                                }
                            }
                        }
                    }
                });
            }
            
            // Orders Chart
            const ordersCtx = document.getElementById("ordersChart");
            if (ordersCtx) {
                new Chart(ordersCtx.getContext('2d'), {
                    type: "doughnut",
                    data: { 
                        labels: ["Food", "Drinks", "Desserts"], 
                        datasets: [{ 
                            data: [65, 25, 10], 
                            backgroundColor: [
                                'rgb(239, 68, 68)',
                                'rgb(249, 115, 22)',
                                'rgb(245, 158, 11)'
                            ],
                            borderWidth: 0
                        }] 
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: '#ef4444',
                                    font: { weight: 'bold' },
                                    padding: 20
                                }
                            }
                        }
                    }
                });
            }
            
            // Revenue Report Chart
            const revenueReportCtx = document.getElementById("revenueReportChart");
            if (revenueReportCtx) {
                new Chart(revenueReportCtx.getContext('2d'), {
                    type: "bar",
                    data: { 
                        labels: ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"], 
                        datasets: [{ 
                            label:"Revenue ($)", 
                            data:[3200,4100,3800,5100,4900,6200,5800], 
                            backgroundColor: "rgb(239, 68, 68)",
                            borderRadius: 6,
                            borderSkipped: false
                        }] 
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    color: '#ef4444',
                                    font: { weight: 'bold' }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#ef4444',
                                    font: { weight: 'bold' }
                                }
                            }
                        }
                    }
                });
            }
            
            // Order Status Chart
            const orderStatusCtx = document.getElementById("orderStatusChart");
            if (orderStatusCtx) {
                new Chart(orderStatusCtx.getContext('2d'), {
                    type: "pie",
                    data: { 
                        labels: ["Completed", "Pending", "Cancelled"], 
                        datasets: [{ 
                            data: [75, 20, 5], 
                            backgroundColor: [
                                'rgb(34, 197, 94)',
                                'rgb(245, 158, 11)',
                                'rgb(239, 68, 68)'
                            ],
                            borderWidth: 0
                        }] 
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: '#ef4444',
                                    font: { weight: 'bold' },
                                    padding: 20
                                }
                            }
                        }
                    }
                });
            }
            
            // Customer Activity Chart
            const customerActivityCtx = document.getElementById("customerActivityChart");
            if (customerActivityCtx) {
                new Chart(customerActivityCtx.getContext('2d'), {
                    type: "line",
                    data: { 
                        labels: ["9AM","10AM","11AM","12PM","1PM","2PM","3PM","4PM","5PM","6PM","7PM","8PM"], 
                        datasets: [{ 
                            label:"Customers", 
                            data:[5,12,18,25,30,28,22,35,40,38,32,15], 
                            borderColor: "rgb(59, 130, 246)",
                            backgroundColor: "rgba(59, 130, 246, 0.1)",
                            tension: 0.4,
                            fill: true,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            borderWidth: 3
                        }] 
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    color: '#3b82f6',
                                    font: { weight: 'bold' }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#3b82f6',
                                    font: { weight: 'bold' }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>