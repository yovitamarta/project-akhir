<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEALYUNG - Dashboard Pengguna</title>
    <!-- TailwindCSS & Font Awesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="//unpkg.com/alpinejs"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
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
            background-color: #ef4444;
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
        
        /* Notification bell animation */
        @keyframes ring {
            0% { transform: rotate(0deg); }
            10% { transform: rotate(15deg); }
            20% { transform: rotate(-15deg); }
            30% { transform: rotate(15deg); }
            40% { transform: rotate(-15deg); }
            50% { transform: rotate(0deg); }
            100% { transform: rotate(0deg); }
        }
        
        .bell-ring {
            animation: ring 1s ease-in-out;
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
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        /* Cart item animation */
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        .slide-in {
            animation: slideIn 0.3s ease-out forwards;
        }
        
        /* Order status badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .status-preparing {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .status-ready {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .status-delivered {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        /* Toast notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 16px;
            display: flex;
            align-items: center;
            z-index: 1000;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }
        
        .toast.success {
            border-left: 4px solid #10b981;
        }
        
        .toast.error {
            border-left: 4px solid #ef4444;
        }
        
        .toast.info {
            border-left: 4px solid #3b82f6;
        }
        
        /* Modal styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        
        .modal-content {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .dark .modal-content {
            background: #1f2937;
        }
        
        /* Prevent flash of unstyled content */
        [x-cloak] { display: none !important; }
        
        /* Loading screen */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(239, 68, 68, 0.2);
            border-radius: 50%;
            border-top-color: #ef4444;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Toggle switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }
        
        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .toggle-slider {
            background-color: #ef4444;
        }
        
        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }
        
        /* User type badge */
        .user-type-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .user-type-student {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .user-type-teacher {
            background-color: #dcfce7;
            color: #166534;
        }
    </style>
</head>
<body class="min-h-screen selection:bg-red-500 selection:text-white">
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen" x-cloak>
        <div class="loading-spinner"></div>
    </div>
    
    <!-- Main App Container -->
    <div :class="darkMode ? 'dark' : ''" class="flex h-screen" x-data="{ 
        open: true, 
        darkMode: false, 
        userMenu: false,
        notifCount: 3,
        loading: true,
        activeTab: 'home',
        showCart: false,
        cart: [
        ],
        orders: [
        ],
        notifications: [
        ],
        showNotifications: false,
        addresses: [
        ],
        paymentMethods: [
        ],
        // Profile data
        profile: {
            firstName: 'Pengguna',
            lastName: 'Nama',
            email: 'pengguna@example.com',
            phone: '+62 812 3456 7890',
            dateOfBirth: '1990-01-01',
            profileImage: 'https://i.pravatar.cc/150',
            userType: 'student', // 'student' or 'teacher'
            nip: '', // For teachers
            nis: '123456', // For students
            className: 'XII RPL 1' // For students
        },
        // Settings data
        settings: {
            emailNotifications: true,
            pushNotifications: true,
            darkMode: false,
            language: 'id',
            currency: 'IDR'
        },
        // Toast notification
        toast: {
            show: false,
            message: '',
            type: 'success',
            timeout: null
        },
        // Modals
        showOrderDetailModal: false,
        showAddressModal: false,
        showPaymentModal: false,
        showLogoutModal: false,
        showUserTypeModal: false,
        selectedOrder: null,
        newAddress: {
            name: '',
            address: '',
            isDefault: false
        },
        newPayment: {
            name: '',
            type: 'visa',
            last4: '',
            isDefault: false
        },
        addToCart(item) {
            const existingItem = this.cart.find(cartItem => cartItem.id === item.id);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                this.cart.push({...item, quantity: 1});
            }
            this.showCart = true;
            this.showToast('Item ditambahkan ke keranjang', 'success');
        },
        removeFromCart(index) {
            this.cart.splice(index, 1);
            this.showToast('Item dihapus dari keranjang', 'info');
        },
        markNotificationAsRead(id) {
            const notification = this.notifications.find(n => n.id === id);
            if (notification) {
                notification.read = true;
            }
        },
        markAllNotificationsAsRead() {
            this.notifications.forEach(notification => {
                notification.read = true;
            });
            this.notifCount = 0;
            this.showToast('Semua notifikasi ditandai sebagai sudah dibaca', 'info');
        },
        updateProfile() {
            // Simulate API call to update profile
            setTimeout(() => {
                this.showToast('Profil berhasil diperbarui!', 'success');
            }, 500);
        },
        updateSettings() {
            // Update dark mode setting
            this.darkMode = this.settings.darkMode;
            
            // Simulate API call to update settings
            setTimeout(() => {
                this.showToast('Pengaturan berhasil diperbarui!', 'success');
            }, 500);
        },
        logout() {
            // Simulate logout process
            setTimeout(() => {
                this.showToast('Keluar...', 'info');
                setTimeout(() => {
                    // In a real app, this would redirect to login page
                    alert('Anda telah berhasil keluar!');
                    // window.location.href = '/login';
                }, 1000);
            }, 500);
        },
        showToast(message, type = 'success') {
            // Clear any existing timeout
            if (this.toast.timeout) {
                clearTimeout(this.toast.timeout);
            }
            
            // Set toast message and type
            this.toast.message = message;
            this.toast.type = type;
            this.toast.show = true;
            
            // Hide toast after 3 seconds
            this.toast.timeout = setTimeout(() => {
                this.toast.show = false;
            }, 3000);
        },
        viewOrderDetail(order) {
            this.selectedOrder = order;
            this.showOrderDetailModal = true;
        },
        confirmOrder(orderId) {
            const order = this.orders.find(o => o.id === orderId);
            if (order) {
                order.status = 'delivered';
                this.showToast('Pesanan berhasil dikonfirmasi!', 'success');
            }
        },
        reorder(order) {
            // Add all items from the order to cart
            order.itemsList.forEach(item => {
                this.addToCart({
                    id: Math.floor(Math.random() * 1000),
                    name: item.name,
                    price: item.price,
                    image: 'https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg'
                });
            });
            this.showToast('Item ditambahkan ke keranjang', 'success');
            this.showCart = true;
        },
        openAddAddressModal() {
            this.newAddress = {
                name: '',
                address: '',
                isDefault: false
            };
            this.showAddressModal = true;
        },
        saveAddress() {
            if (this.newAddress.name && this.newAddress.address) {
                // If this is set as default, remove default from other addresses
                if (this.newAddress.isDefault) {
                    this.addresses.forEach(addr => addr.isDefault = false);
                }
                
                // Add new address
                this.addresses.push({
                    id: this.addresses.length + 1,
                    name: this.newAddress.name,
                    address: this.newAddress.address,
                    isDefault: this.newAddress.isDefault
                });
                
                this.showAddressModal = false;
                this.showToast('Alamat berhasil ditambahkan!', 'success');
            } else {
                this.showToast('Harap isi semua field', 'error');
            }
        },
        deleteAddress(id) {
            const index = this.addresses.findIndex(addr => addr.id === id);
            if (index !== -1) {
                const address = this.addresses[index];
                
                // If this is the default address, set another as default
                if (address.isDefault && this.addresses.length > 1) {
                    this.addresses[(index + 1) % this.addresses.length].isDefault = true;
                }
                
                this.addresses.splice(index, 1);
                this.showToast('Alamat berhasil dihapus!', 'success');
            }
        },
        setDefaultAddress(id) {
            this.addresses.forEach(addr => {
                addr.isDefault = addr.id === id;
            });
            this.showToast('Alamat utama diperbarui!', 'success');
        },
        openAddPaymentModal() {
            this.newPayment = {
                name: '',
                type: 'visa',
                last4: '',
                isDefault: false
            };
            this.showPaymentModal = true;
        },
        savePayment() {
            if (this.newPayment.name && this.newPayment.last4) {
                // If this is set as default, remove default from other payment methods
                if (this.newPayment.isDefault) {
                    this.paymentMethods.forEach(pm => pm.isDefault = false);
                }
                
                // Add new payment method
                this.paymentMethods.push({
                    id: this.paymentMethods.length + 1,
                    name: this.newPayment.name,
                    type: this.newPayment.type,
                    last4: this.newPayment.last4,
                    isDefault: this.newPayment.isDefault
                });
                
                this.showPaymentModal = false;
                this.showToast('Metode pembayaran berhasil ditambahkan!', 'success');
            } else {
                this.showToast('Harap isi semua field', 'error');
            }
        },
        deletePayment(id) {
            const index = this.paymentMethods.findIndex(pm => pm.id === id);
            if (index !== -1) {
                const payment = this.paymentMethods[index];
                
                // If this is the default payment method, set another as default
                if (payment.isDefault && this.paymentMethods.length > 1) {
                    this.paymentMethods[(index + 1) % this.paymentMethods.length].isDefault = true;
                }
                
                this.paymentMethods.splice(index, 1);
                this.showToast('Metode pembayaran berhasil dihapus!', 'success');
            }
        },
        setDefaultPayment(id) {
            this.paymentMethods.forEach(pm => {
                pm.isDefault = pm.id === id;
            });
            this.showToast('Metode pembayaran utama diperbarui!', 'success');
        },
        openLogoutModal() {
            this.showLogoutModal = true;
        },
        openUserTypeModal() {
            this.showUserTypeModal = true;
        },
        changeUserType(type) {
            this.profile.userType = type;
            this.showUserTypeModal = false;
            this.showToast(`Tipe pengguna diubah menjadi ${type === 'student' ? 'Siswa' : 'Guru'}`, 'success');
        }
            
    }" x-init="
        loading = false; 
        setInterval(() => { notifCount++; }, 15000);
        // Hide loading screen when Alpine is ready
        setTimeout(() => {
            document.getElementById('loading-screen').style.display = 'none';
        }, 500);
    " x-cloak>
        
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
            
            <!-- Nav -->
            <nav class="flex-1 px-4 py-6 space-y-2 text-gray-700 dark:text-gray-300 font-medium">
                <a @click="activeTab = 'home'" :class="{'bg-red-600 text-white': activeTab === 'home'}" class="flex items-center space-x-4 p-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-home text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="transition-opacity select-none" x-show="open">Beranda</span>
                </a>
                <a @click="activeTab = 'menu'" :class="{'bg-red-600 text-white': activeTab === 'menu'}" class="flex items-center space-x-4 p-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-utensils text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="transition-opacity select-none" x-show="open">Menu</span>
                </a>
                <a @click="activeTab = 'orders'" :class="{'bg-red-600 text-white': activeTab === 'orders'}" class="flex items-center space-x-4 p-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-receipt text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="transition-opacity select-none" x-show="open">Pesanan Saya</span>
                </a>
                <a @click="activeTab = 'profile'" :class="{'bg-red-600 text-white': activeTab === 'profile'}" class="flex items-center space-x-4 p-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-user text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="transition-opacity select-none" x-show="open">Profil</span>
                </a>
                <a @click="activeTab = 'settings'" :class="{'bg-red-600 text-white': activeTab === 'settings'}" class="flex items-center space-x-4 p-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-cog text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="transition-opacity select-none" x-show="open">Pengaturan</span>
                </a>
                <a @click="activeTab = 'payments'" :class="{'bg-red-600 text-white': activeTab === 'payments'}" class="flex items-center space-x-4 p-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-credit-card text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="transition-opacity select-none" x-show="open">Pembayaran</span>
                </a>
            </nav>
            
            <!-- Footer -->
            <div class="border-t border-gray-200 dark:border-gray-700 p-5 space-y-4">
                <div class="relative" @click.away="userMenu = false">
                    <button @click="userMenu = !userMenu" class="w-full flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                        <img :src="profile.profileImage" class="w-9 h-9 rounded-full border-2 border-gray-300 dark:border-gray-600"/>
                        <div x-show="open" class="text-left">
                            <p class="text-gray-800 dark:text-gray-200 font-medium" x-text="profile.firstName + ' ' + profile.lastName"></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400" x-text="profile.userType === 'student' ? 'Siswa' : 'Guru'"></p>
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
                        <a @click="activeTab = 'profile'; userMenu = false" class="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition cursor-pointer">
                            <i class="fas fa-user-circle mr-2"></i> Profil
                        </a>
                        <a @click="activeTab = 'settings'; userMenu = false" class="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition cursor-pointer">
                            <i class="fas fa-cog mr-2"></i> Pengaturan
                        </a>
                        <a @click="openUserTypeModal(); userMenu = false" class="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition cursor-pointer">
                            <i class="fas fa-exchange-alt mr-2"></i> Ganti Tipe
                        </a>
                        <hr class="my-2 border-gray-200 dark:border-gray-700">
                        <form method="POST" action="{{ route('logout') }}">
                     @csrf
                    <button type="submit" class="block px-4 py-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition cursor-pointer">
                         <i class="fas fa-sign-out-alt mr-2"></i> Log out
                    </button>
                    </form>
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
                        <span class="text-gray-500 dark:text-gray-400 text-sm">Selamat datang kembali,</span>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight select-none">
                            <span x-show="!loading" x-text="profile.firstName + ' ' + profile.lastName"></span>
                            <span x-show="loading" class="skeleton h-6 w-32 rounded inline-block"></span>
                        </h2>
                        <span class="user-type-badge" :class="profile.userType === 'student' ? 'user-type-student' : 'user-type-teacher'" x-text="profile.userType === 'student' ? 'Siswa' : 'Guru'"></span>
                    </div>
                    
                    <div class="flex items-center space-x-5">
                        <div class="relative">
                            <input class="w-64 max-w-xs px-4 py-3 rounded-xl border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 shadow-sm" placeholder="Cari menu..." type="text"/>
                            <i class="fas fa-search absolute top-3.5 right-4 text-gray-400 pointer-events-none"></i>
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
                                <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Notifikasi</h3>
                                    <button @click="markAllNotificationsAsRead()" class="text-sm text-red-600 dark:text-red-400 hover:underline">Tandai semua dibaca</button>
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    <template x-for="notification in notifications" :key="notification.id">
                                        <div @click="markNotificationAsRead(notification.id)" class="p-4 border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer" :class="{'bg-blue-50 dark:bg-blue-900/20': !notification.read}">
                                            <div class="flex justify-between">
                                                <h4 class="font-medium text-gray-900 dark:text-white" x-text="notification.title"></h4>
                                                <span class="text-xs text-gray-500 dark:text-gray-400" x-text="notification.time"></span>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1" x-text="notification.message"></p>
                                            <div class="flex items-center mt-2">
                                                <span x-show="!notification.read" class="inline-block w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                                <span class="text-xs text-blue-600 dark:text-blue-400" x-show="!notification.read">Baru</span>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div class="p-3 bg-gray-50 dark:bg-gray-800 text-center">
                                    <a href="#" class="text-sm text-red-600 dark:text-red-400 hover:underline">Lihat Semua Notifikasi</a>
                                </div>
                            </div>
                        </div>
                        
                        <button @click="showCart = !showCart" class="relative p-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-full hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-lg">
                            <i class="fas fa-shopping-cart text-lg"></i>
                            <span x-show="cart.length > 0" x-text="cart.reduce((total, item) => total + item.quantity, 0)" class="absolute -top-1 -right-1 bg-yellow-400 text-xs font-bold rounded-full px-1.5 py-0.5 select-none animate-pulse"></span>
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-6 space-y-8">
                <!-- Home Tab -->
                <div x-show="activeTab === 'home'" class="space-y-8">
                    <!-- Welcome Section -->
                    <div class="glass rounded-2xl p-6 shadow-lg animate-fadeIn">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                                    Selamat Datang di MEALYUNG
                                </h1>
                                <p class="text-gray-600 dark:text-gray-400 max-w-2xl">
                                    Pesan makanan favorit Anda hanya dengan beberapa klik. Segar, lezat, dan diantarkan ke pintu Anda.
                                </p>
                            </div>
                            <div class="flex space-x-3">
                                <button @click="activeTab = 'menu'" class="px-5 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                    <i class="fas fa-utensils mr-2"></i> Pesan Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Promo Banner -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gradient-to-r from-red-500 to-red-600 text-white p-6 rounded-2xl shadow-xl card-hover animate-fadeIn" style="animation-delay: 0.1s">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-percentage text-3xl mr-3"></i>
                                <h3 class="text-xl font-bold">DISKON 20%</h3>
                            </div>
                            <p class="mb-4">Untuk semua minuman hari ini saja</p>
                            <button @click="activeTab = 'menu'" class="text-white font-medium hover:underline">Pesan Sekarang →</button>
                        </div>
                        
                        <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-6 rounded-2xl shadow-xl card-hover animate-fadeIn" style="animation-delay: 0.2s">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-shipping-fast text-3xl mr-3"></i>
                                <h3 class="text-xl font-bold">Pengiriman Gratis</h3>
                            </div>
                            <p class="mb-4">Untuk pesanan di atas Rp100.000</p>
                            <button @click="activeTab = 'menu'" class="text-white font-medium hover:underline">Pelajari Lebih Lanjut →</button>
                        </div>
                        
                        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-6 rounded-2xl shadow-xl card-hover animate-fadeIn" style="animation-delay: 0.3s">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-star text-3xl mr-3"></i>
                                <h3 class="text-xl font-bold">Poin Loyalitas</h3>
                            </div>
                            <p class="mb-4">Dapatkan poin dengan setiap pesanan</p>
                            <button @click="activeTab = 'orders'" class="text-white font-medium hover:underline">Cek Poin →</button>
                        </div>
                    </div>
                    
                    <!-- Popular Items -->
                    <section class="animate-fadeIn" style="animation-delay: 0.4s">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-fire mr-3 text-red-500"></i>
                                Item Populer
                            </h2>
                            <a @click="activeTab = 'menu'" class="text-red-600 hover:text-red-700 transition-colors cursor-pointer">Lihat Semua</a>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                                <div class="relative">
                                    <img alt="Nasi Goreng Spesial" class="w-full h-48 object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/48ca648d-fdda-4a9b-e384-f1587742b1a8.jpg" width="400"/>
                                    <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                        Terlaris
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
                                        <span class="font-extrabold text-red-600 text-xl">Rp7.000</span>
                                        <button @click="addToCart({ id: 1, name: 'Nasi Goreng Spesial', price: 7000, image: 'https://storage.googleapis.com/a1aa/image/48ca648d-fdda-4a9b-e384-f1587742b1a8.jpg' })" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                                <div class="relative">
                                    <img alt="Bakso Jumbo" class="w-full h-48 object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/3ce3758f-a369-46ef-36a1-3188ffd683de.jpg" width="400"/>
                                    <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                        Baru
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
                                        <span class="font-extrabold text-red-600 text-xl">Rp10.000</span>
                                        <button @click="addToCart({ id: 2, name: 'Bakso Jumbo', price: 10000, image: 'https://storage.googleapis.com/a1aa/image/3ce3758f-a369-46ef-36a1-3188ffd683de.jpg' })" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                            <i class="fas fa-plus"></i>
                                        </button>
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
                                        <span class="font-extrabold text-red-600 text-xl">Rp10.000</span>
                                        <button @click="addToCart({ id: 3, name: 'Mie Ayam', price: 10000, image: 'https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg' })" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                                <img alt="Sate Ayam" class="w-full h-48 object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg" width="400"/>
                                <div class="p-5">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Sate Ayam</h3>
                                        <div class="flex items-center text-yellow-400">
                                            <i class="fas fa-star"></i>
                                            <span class="ml-1 text-gray-700 dark:text-gray-300">4.9</span>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 mb-4">Sate ayam dengan bumbu kacang dan lontong.</p>
                                    <div class="flex justify-between items-center">
                                        <span class="font-extrabold text-red-600 text-xl">Rp8.000</span>
                                        <button @click="addToCart({ id: 4, name: 'Sate Ayam', price: 8000, image: 'https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg' })" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Recent Orders -->
                    <section class="glass rounded-2xl p-6 shadow-xl animate-fadeIn" style="animation-delay: 0.5s">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-history mr-3 text-red-500"></i>
                                Pesanan Terbaru
                            </h2>
                            <a @click="activeTab = 'orders'" class="text-red-600 hover:text-red-700 transition-colors cursor-pointer">Lihat Semua</a>
                        </div>
                        
                        <div class="space-y-4">
                            <template x-for="order in orders.slice(0, 3)" :key="order.id">
                                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow cursor-pointer" @click="viewOrderDetail(order)">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h3 class="font-bold text-gray-900 dark:text-white" x-text="order.id"></h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400" x-text="order.date + ' • ' + order.items + ' item'"></p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-gray-900 dark:text-white">Rp<span x-text="order.total.toLocaleString('id-ID')"></span></p>
                                            <span class="status-badge" :class="'status-' + order.status" x-text="order.status.charAt(0).toUpperCase() + order.status.slice(1)"></span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </section>
                </div>
                
                <!-- Menu Tab -->
                <div x-show="activeTab === 'menu'" class="animate-fadeIn">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <i class="fas fa-utensils mr-3 text-red-500"></i>
                            Menu Kami
                        </h2>
                        <div class="flex space-x-3">
                            <select class="px-4 py-2 border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                                <option>Semua Kategori</option>
                                <option>Makanan</option>
                                <option>Minuman</option>
                                <option>Dessert</option>
                            </select>
                            <input type="text" placeholder="Cari menu..." class="px-4 py-2 border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                            <div class="relative">
                                <img alt="Nasi Goreng Spesial" class="w-full h-48 object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/48ca648d-fdda-4a9b-e384-f1587742b1a8.jpg" width="400"/>
                                <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    Terlaris
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
                                    <span class="font-extrabold text-red-600 text-xl">Rp7.000</span>
                                    <button @click="addToCart({ id: 1, name: 'Nasi Goreng Spesial', price: 7000, image: 'https://storage.googleapis.com/a1aa/image/48ca648d-fdda-4a9b-e384-f1587742b1a8.jpg' })" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                            <div class="relative">
                                <img alt="Bakso Jumbo" class="w-full h-48 object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/3ce3758f-a369-46ef-36a1-3188ffd683de.jpg" width="400"/>
                                <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    Baru
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
                                    <span class="font-extrabold text-red-600 text-xl">Rp10.000</span>
                                    <button @click="addToCart({ id: 2, name: 'Bakso Jumbo', price: 10000, image: 'https://storage.googleapis.com/a1aa/image/3ce3758f-a369-46ef-36a1-3188ffd683de.jpg' })" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                        <i class="fas fa-plus"></i>
                                    </button>
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
                                    <span class="font-extrabold text-red-600 text-xl">Rp10.000</span>
                                    <button @click="addToCart({ id: 3, name: 'Mie Ayam', price: 10000, image: 'https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg' })" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                            <img alt="Sate Ayam" class="w-full h-48 object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg" width="400"/>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Sate Ayam</h3>
                                    <div class="flex items-center text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <span class="ml-1 text-gray-700 dark:text-gray-300">4.9</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Sate ayam dengan bumbu kacang dan lontong.</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-extrabold text-red-600 text-xl">Rp8.000</span>
                                    <button @click="addToCart({ id: 4, name: 'Sate Ayam', price: 6000, image: 'https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg' })" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                            <img alt="Sate Ayam" class="w-full h-48 object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg" width="400"/>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Ayam geprek</h3>
                                    <div class="flex items-center text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <span class="ml-1 text-gray-700 dark:text-gray-300">5.0</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Ayam geprek dengan sambel pedas.</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-extrabold text-red-600 text-xl">Rp6.000</span>
                                    <button @click="addToCart({ id: 4, name: 'Ayam geprek', price: 6000, image: 'https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg' })" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                            <img alt="Gado-Gado" class="w-full h-48 object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg" width="400"/>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Gado-Gado</h3>
                                    <div class="flex items-center text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <span class="ml-1 text-gray-700 dark:text-gray-300">4.5</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Sayuran segar dengan bumbu kacang dan kerupuk.</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-extrabold text-red-600 text-xl">Rp8.000</span>
                                    <button @click="addToCart({ id: 5, name: 'Gado-Gado', price: 8000, image: 'https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg' })" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                            <img alt="Rendang" class="w-full h-48 object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg" width="400"/>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Rendang</h3>
                                    <div class="flex items-center text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <span class="ml-1 text-gray-700 dark:text-gray-300">5.0</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Daging sapi dengan bumbu rendang khas Padang.</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-extrabold text-red-600 text-xl">Rp7.000</span>
                                    <button @click="addToCart({ id: 6, name: 'Rendang', price: 7000, image: 'https://storage.googleapis.com/a1aa/image/84d5a062-ecf6-41de-a74e-0b8e05387402.jpg' })" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Orders Tab -->
                <div x-show="activeTab === 'orders'" class="animate-fadeIn">
                    <div class="glass rounded-2xl p-6 shadow-xl">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-receipt mr-3 text-red-500"></i>
                                Pesanan Saya
                            </h2>
                            <div class="flex space-x-3">
                                <select class="px-4 py-2 border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                                    <option>Semua Status</option>
                                    <option>Diproses</option>
                                    <option>Siap</option>
                                    <option>Dikirim</option>
                                    <option>Dibatalkan</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <template x-for="order in orders" :key="order.id">
                                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow cursor-pointer" @click="viewOrderDetail(order)">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h3 class="font-bold text-gray-900 dark:text-white" x-text="order.id"></h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400" x-text="order.date + ' • ' + order.items + ' item'"></p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-gray-900 dark:text-white">Rp<span x-text="order.total.toLocaleString('id-ID')"></span></p>
                                            <span class="status-badge" :class="'status-' + order.status" x-text="order.status.charAt(0).toUpperCase() + order.status.slice(1)"></span>
                                        </div>
                                    </div>
                                    <div class="flex justify-end mt-4 space-x-2">
                                        <button @click.stop="viewOrderDetail(order)" class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                            <i class="fas fa-eye mr-1"></i> Lihat
                                        </button>
                                        <button x-show="order.status === 'ready'" @click.stop="confirmOrder(order.id)" class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg hover:bg-green-200 dark:hover:bg-green-800 transition">
                                            <i class="fas fa-check mr-1"></i> Konfirmasi
                                        </button>
                                        <button x-show="order.status === 'delivered'" @click.stop="reorder(order)" class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-800 transition">
                                            <i class="fas fa-redo mr-1"></i> Pesan Lagi
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Tab -->
                <div x-show="activeTab === 'profile'" class="animate-fadeIn">
                    <div class="glass rounded-2xl p-6 shadow-xl">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center mb-6">
                            <i class="fas fa-user mr-3 text-red-500"></i>
                            Profil Saya
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-1">
                                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg text-center">
                                    <img :src="profile.profileImage" class="w-32 h-32 rounded-full mx-auto mb-4 border-4 border-red-500">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white" x-text="profile.firstName + ' ' + profile.lastName"></h3>
                                    <div class="flex justify-center items-center mb-2">
                                        <span class="user-type-badge" :class="profile.userType === 'student' ? 'user-type-student' : 'user-type-teacher'" x-text="profile.userType === 'student' ? 'Siswa' : 'Guru'"></span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 mb-4" x-text="profile.email"></p>
                                    <div class="space-y-2">
                                        <button @click="openUserTypeModal()" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md w-full">
                                            <i class="fas fa-exchange-alt mr-2"></i> Ganti Tipe
                                        </button>
                                        <button class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md w-full">
                                            <i class="fas fa-camera mr-2"></i> Ganti Foto
                                        </button>
                                        <button @click="activeTab = 'settings'" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition w-full">
                                            <i class="fas fa-cog mr-2"></i> Pengaturan Akun
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="md:col-span-2">
                                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Pribadi</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Depan</label>
                                            <input type="text" x-model="profile.firstName" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Belakang</label>
                                            <input type="text" x-model="profile.lastName" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                            <input type="email" x-model="profile.email" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Telepon</label>
                                            <input type="tel" x-model="profile.phone" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Lahir</label>
                                            <input type="date" x-model="profile.dateOfBirth" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        
                                        <!-- Student specific fields -->
                                        <div x-show="profile.userType === 'student'">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIS</label>
                                            <input type="text" x-model="profile.nis" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        <div x-show="profile.userType === 'student'">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kelas</label>
                                            <input type="text" x-model="profile.className" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        
                                        <!-- Teacher specific fields -->
                                        <div x-show="profile.userType === 'teacher'">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIP</label>
                                            <input type="text" x-model="profile.nip" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Keamanan</h3>
                                        <div class="space-y-3">
                                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                                <div>
                                                    <p class="font-medium text-gray-900 dark:text-white">Kata Sandi</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">Terakhir diubah 3 bulan yang lalu</p>
                                                </div>
                                                <button class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                                    Ubah
                                                </button>
                                            </div>
                                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                                <div>
                                                    <p class="font-medium text-gray-900 dark:text-white">Autentikasi Dua Faktor</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">Tambahkan lapisan keamanan ekstra</p>
                                                </div>
                                                <label class="toggle-switch">
                                                    <input type="checkbox">
                                                    <span class="toggle-slider"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 flex justify-end">
                                        <button @click="updateProfile()" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Settings Tab -->
                <div x-show="activeTab === 'settings'" class="animate-fadeIn">
                    <div class="glass rounded-2xl p-6 shadow-xl">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center mb-6">
                            <i class="fas fa-cog mr-3 text-red-500"></i>
                            Pengaturan
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Pengaturan Umum</h3>
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Mode Gelap</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Beralih ke tema gelap</p>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" x-model="settings.darkMode" @change="updateSettings()">
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Bahasa</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Bahasa tampilan aplikasi</p>
                                        </div>
                                        <select x-model="settings.language" @change="updateSettings()" class="px-3 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                            <option value="en">English</option>
                                            <option value="id">Bahasa Indonesia</option>
                                        </select>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Mata Uang</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Tampilkan mata uang</p>
                                        </div>
                                        <select x-model="settings.currency" @change="updateSettings()" class="px-3 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                            <option value="USD">USD ($)</option>
                                            <option value="IDR">IDR (Rp)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Pengaturan Notifikasi</h3>
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Notifikasi Email</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Terima pembaruan melalui email</p>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" x-model="settings.emailNotifications" @change="updateSettings()">
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Notifikasi Push</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Terima notifikasi push</p>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" x-model="settings.pushNotifications" @change="updateSettings()">
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Pembaruan Pesanan</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Dapatkan notifikasi tentang status pesanan</p>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" checked>
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Promosi</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Terima penawaran promosi</p>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" checked>
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Tindakan Akun</h3>
                            <div class="flex flex-wrap gap-3">
                                <button @click="activeTab = 'profile'" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                    <i class="fas fa-user mr-2"></i> Edit Profil
                                </button>
                                <button @click="activeTab = 'payments'" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                    <i class="fas fa-credit-card mr-2"></i> Metode Pembayaran
                                </button>
                                <button @click="openUserTypeModal()" class="px-4 py-2 bg-blue-200 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-lg hover:bg-blue-300 dark:hover:bg-blue-800 transition">
                                    <i class="fas fa-exchange-alt mr-2"></i> Ganti Tipe
                                </button>
                                <button @click="openLogoutModal()" class="px-4 py-2 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-lg hover:bg-red-200 dark:hover:bg-red-800 transition">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                                </button>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <button @click="updateSettings()" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                Simpan Pengaturan
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Payments Tab -->
                <div x-show="activeTab === 'payments'" class="animate-fadeIn">
                    <div class="glass rounded-2xl p-6 shadow-xl">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-credit-card mr-3 text-red-500"></i>
                                Metode Pembayaran
                            </h2>
                            <button @click="openAddPaymentModal()" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                <i class="fas fa-plus mr-2"></i> Tambah Pembayaran
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <template x-for="payment in paymentMethods" :key="payment.id">
                                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white" x-text="payment.name"></h3>
                                            <p class="text-gray-600 dark:text-gray-400">
                                                <span x-show="payment.type === 'visa'">Visa berakhiran </span>
                                                <span x-show="payment.type === 'gopay'">GoPay berakhiran </span>
                                                <span x-text="'****' + payment.last4"></span>
                                            </p>
                                        </div>
                                        <span x-show="payment.isDefault" class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded-full">Utama</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button x-show="!payment.isDefault" @click="setDefaultPayment(payment.id)" class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-800 transition">
                                            <i class="fas fa-check mr-1"></i> Jadikan Utama
                                        </button>
                                        <button @click="deletePayment(payment.id)" class="px-3 py-1 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-lg hover:bg-red-200 dark:hover:bg-red-800 transition">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </main>
            
            <!-- Footer -->
            <footer class="glass py-4 text-center text-sm text-gray-600 dark:text-gray-400">
                <div class="flex flex-col md:flex-row justify-between items-center px-6">
                    <p>© 2024 MEALYUNG. Hak cipta dilindungi.</p>
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
        
        <!-- Shopping Cart Sidebar -->
        <div x-show="showCart" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-full"
             class="fixed inset-y-0 right-0 w-96 bg-white dark:bg-gray-900 shadow-2xl z-50 flex flex-col">
            
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Keranjang Anda</h3>
                    <button @click="showCart = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <div class="flex-1 overflow-y-auto p-6">
                <div x-show="cart.length === 0" class="text-center py-12">
                    <i class="fas fa-shopping-cart text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                    <p class="text-gray-500 dark:text-gray-400">Keranjang Anda kosong</p>
                    <button @click="showCart = false; activeTab = 'menu'" class="mt-4 px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                        Lihat Menu
                    </button>
                </div>
                
                <div x-show="cart.length > 0" class="space-y-4">
                    <template x-for="(item, index) in cart" :key="item.id">
                        <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-xl slide-in">
                            <img :src="item.image" :alt="item.name" class="w-16 h-16 rounded-lg object-cover">
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900 dark:text-white" x-text="item.name"></h4>
                                <p class="text-gray-600 dark:text-gray-400">Rp<span x-text="item.price.toLocaleString('id-ID')"></span></p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button @click="item.quantity > 1 ? item.quantity-- : removeFromCart(index)" class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <span class="w-8 text-center font-medium text-gray-900 dark:text-white" x-text="item.quantity"></span>
                                <button @click="item.quantity++" class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-white hover:bg-red-600 transition">
                                    <i class="fas fa-plus text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            
            <div x-show="cart.length > 0" class="p-6 border-t border-gray-200 dark:border-gray-700">
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-gray-600 dark:text-gray-400">
                        <span>Subtotal</span>
                        <span>Rp<span x-text="cart.reduce((total, item) => total + (item.price * item.quantity), 0).toLocaleString('id-ID')"></span></span>
                    </div>
                    <div class="flex justify-between font-bold text-lg text-gray-900 dark:text-white pt-3 border-t border-gray-200 dark:border-gray-700">
                        <span>Total</span>
                        <span>Rp<span x-text="(cart.reduce((total, item) => total + (item.price * item.quantity), 0) + (cart.reduce((total, item) => total, 0) * 0.1)).toLocaleString('id-ID')"></span></span>
                    </div>
                </div>
                
                <button @click="showCart = false; showToast('Pesanan berhasil dibuat!', 'success')" class="w-full py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                    Lanjut ke Pembayaran
                </button>
            </div>
        </div>
        
        <!-- Order Detail Modal -->
        <div x-show="showOrderDetailModal" class="modal" @click.self="showOrderDetailModal = false">
            <div class="modal-content p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Detail Pesanan</h3>
                    <button @click="showOrderDetailModal = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div x-show="selectedOrder" class="space-y-4">
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="font-bold text-gray-900 dark:text-white" x-text="selectedOrder.id"></h4>
                            <span class="status-badge" :class="'status-' + selectedOrder.status" x-text="selectedOrder.status.charAt(0).toUpperCase() + selectedOrder.status.slice(1)"></span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400" x-text="selectedOrder.date"></p>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Item Pesanan</h4>
                        <div class="space-y-2">
                            <template x-for="item in selectedOrder.itemsList" :key="item.name">
                                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white" x-text="item.name"></p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Jml: <span x-text="item.quantity"></span></p>
                                    </div>
                                    <p class="font-medium text-gray-900 dark:text-white">Rp<span x-text="(item.price * item.quantity).toLocaleString('id-ID')"></span></p>
                                </div>
                            </template>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                        <span class="font-bold text-gray-900 dark:text-white">Total</span>
                        <span class="font-bold text-gray-900 dark:text-white">Rp<span x-text="selectedOrder.total.toLocaleString('id-ID')"></span></span>
                    </div>
                    
                    <div class="flex justify-end space-x-2 pt-4">
                        <button x-show="selectedOrder.status === 'ready'" @click="confirmOrder(selectedOrder.id); showOrderDetailModal = false;" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                            <i class="fas fa-check mr-2"></i> Konfirmasi Pesanan
                        </button>
                        <button x-show="selectedOrder.status === 'delivered'" @click="reorder(selectedOrder); showOrderDetailModal = false;" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                            <i class="fas fa-redo mr-2"></i> Pesan Lagi
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Add Payment Modal -->
        <div x-show="showPaymentModal" class="modal" @click.self="showPaymentModal = false">
            <div class="modal-content p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Tambah Metode Pembayaran</h3>
                    <button @click="showPaymentModal = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Metode Pembayaran</label>
                        <input type="text" x-model="newPayment.name" placeholder="Kartu Kredit, E-Wallet, dll." class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Pembayaran</label>
                        <select x-model="newPayment.type" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="visa">Visa</option>
                            <option value="mastercard">Mastercard</option>
                            <option value="gopay">GoPay</option>
                            <option value="ovo">OVO</option>
                            <option value="dana">DANA</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">4 Digit Terakhir</label>
                        <input type="text" x-model="newPayment.last4" maxlength="4" placeholder="1234" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="isDefaultPayment" x-model="newPayment.isDefault" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                        <label for="isDefaultPayment" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Tetapkan sebagai metode pembayaran utama</label>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button @click="showPaymentModal = false" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Batal
                        </button>
                        <button @click="savePayment()" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                            Simpan Metode Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- User Type Modal -->
        <div x-show="showUserTypeModal" class="modal" @click.self="showUserTypeModal = false">
            <div class="modal-content p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Pilih Tipe Pengguna</h3>
                    <button @click="showUserTypeModal = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <p class="text-gray-600 dark:text-gray-400">Silakan pilih tipe pengguna yang sesuai dengan status Anda:</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div @click="changeUserType('student')" class="bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 rounded-xl p-6 cursor-pointer hover:border-blue-500 transition-colors">
                            <div class="flex flex-col items-center text-center">
                                <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-user-graduate text-blue-600 dark:text-blue-300 text-2xl"></i>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Siswa</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Untuk siswa SMK N 1 Sayung</p>
                            </div>
                        </div>
                        
                        <div @click="changeUserType('teacher')" class="bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 rounded-xl p-6 cursor-pointer hover:border-green-500 transition-colors">
                            <div class="flex flex-col items-center text-center">
                                <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-chalkboard-teacher text-green-600 dark:text-green-300 text-2xl"></i>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Guru</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Untuk guru SMK N 1 Sayung</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button @click="showUserTypeModal = false" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Logout Confirmation Modal -->
        <div x-show="showLogoutModal" class="modal" @click.self="showLogoutModal = false">
            <div class="modal-content p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Konfirmasi Keluar</h3>
                    <button @click="showLogoutModal = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div class="text-center py-4">
                        <i class="fas fa-sign-out-alt text-5xl text-red-500 mb-4"></i>
                        <p class="text-gray-700 dark:text-gray-300">Apakah Anda yakin ingin keluar?</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Anda perlu login lagi untuk mengakses akun Anda.</p>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button @click="showLogoutModal = false" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Batal
                        </button>
                        <button @click="logout(); showLogoutModal = false;" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                            <i class="fas fa-sign-out-alt mr-2"></i> Log out
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Toast Notification -->
        <div class="toast" :class="toast.show ? 'show' : '', toast.type">
            <div class="flex items-center">
                <i class="fas" :class="{
                    'fa-check-circle text-green-500': toast.type === 'success',
                    'fa-exclamation-circle text-red-500': toast.type === 'error',
                    'fa-info-circle text-blue-500': toast.type === 'info'
                }"></i>
                <span class="ml-3 text-gray-800" x-text="toast.message"></span>
            </div>
        </div>
    </div>
</body>
</html>