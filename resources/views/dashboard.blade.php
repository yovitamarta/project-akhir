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
        
        /* Dark mode body background */
        body.dark {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
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
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
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
        
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 3s ease infinite;
        }
        
        .animate-slideUp {
            animation: slideUp 0.5s ease-out forwards;
        }
        
        .slide-in {
            animation: slideIn 0.3s ease-out forwards;
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
        
        .status-paid {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .status-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .status-completed {
            background-color: #d1fae5;
            color: #065f46;
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
        
        .toast.warning {
            border-left: 4px solid #f59e0b;
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
        
        .dark .loading-screen {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
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
        
        /* Profile image upload */
        .profile-image-container {
            position: relative;
            display: inline-block;
        }
        
        .profile-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.3s;
            cursor: pointer;
        }
        
        .profile-image-container:hover .profile-image-overlay {
            opacity: 1;
        }
        
        #profile-image-input {
            display: none;
        }
        
        /* Button animations */
        .btn-animate {
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .btn-animate:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-animate:hover:before {
            left: 100%;
        }
        
        /* Enhanced welcome section */
        .welcome-gradient {
            background: linear-gradient(135deg, #ef4444 0%, #f97316 100%);
            position: relative;
            overflow: hidden;
        }
        
        .welcome-gradient:before {
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
        
        /* Floating action button */
        .fab {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ef4444, #f97316);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 100;
        }
        
        .fab:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
        
        /* Category pills */
        .category-pill {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .category-pill.active {
            background: linear-gradient(135deg, #ef4444, #f97316);
            color: white;
        }
        
        .category-pill:not(.active) {
            background-color: #f3f4f6;
            color: #4b5563;
        }
        
        .dark .category-pill:not(.active) {
            background-color: #374151;
            color: #d1d5db;
        }
        
        /* Enhanced menu cards */
        .menu-card {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .menu-card-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            color: white;
            z-index: 10;
        }
        
        .menu-badge-popular {
            background-color: #ef4444;
        }
        
        .menu-badge-new {
            background-color: #10b981;
        }
        
        .menu-badge-discount {
            background-color: #8b5cf6;
        }
        
        .menu-image {
            height: 180px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .menu-card:hover .menu-image {
            transform: scale(1.05);
        }
        
        .menu-content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .menu-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #1f2937;
        }
        
        .dark .menu-title {
            color: #f9fafb;
        }
        
        .menu-description {
            color: #6b7280;
            margin-bottom: 1rem;
            flex-grow: 1;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        
        .dark .menu-description {
            color: #9ca3af;
        }
        
        .menu-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }
        
        .menu-price {
            font-weight: 800;
            font-size: 1.25rem;
            color: #ef4444;
        }
        
        .menu-rating {
            display: flex;
            align-items: center;
            color: #f59e0b;
        }
        
        .menu-add-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ef4444, #f97316);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .menu-add-btn:hover {
            transform: scale(1.1);
        }
        
        /* Payment method card */
        .payment-method-card {
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .payment-method-card:hover {
            border-color: #ef4444;
            background-color: #fef2f2;
        }
        
        .payment-method-card.selected {
            border-color: #ef4444;
            background-color: #fef2f2;
        }
        
        .dark .payment-method-card {
            border-color: #4b5563;
            background-color: #1f2937;
        }
        
        .dark .payment-method-card:hover {
            border-color: #ef4444;
            background-color: #422010;
        }
        
        .dark .payment-method-card.selected {
            border-color: #ef4444;
            background-color: #422010;
        }
        
        /* Payment note section */
        .payment-note {
            background-color: #f9fafb;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-top: 1rem;
        }
        
        .dark .payment-note {
            background-color: #1f2937;
        }
        
        /* Notification card */
        .notification-card {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .notification-card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .notification-card.unread {
            border-left: 4px solid #3b82f6;
        }
        
        .notification-card.order {
            border-left: 4px solid #10b981;
        }
        
        .notification-card.admin {
            border-left: 4px solid #f59e0b;
        }
        
        .dark .notification-card {
            background-color: #1f2937;
        }
        
        /* Order timeline */
        .order-timeline {
            position: relative;
            padding-left: 2rem;
            margin-top: 1rem;
        }
        
        .order-timeline::before {
            content: "";
            position: absolute;
            left: 0.5rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #e5e7eb;
        }
        
        .dark .order-timeline::before {
            background-color: #374151;
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
        }
        
        .timeline-item:last-child {
            padding-bottom: 0;
        }
        
        .timeline-dot {
            position: absolute;
            left: -1.75rem;
            top: 0.25rem;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            background-color: #ef4444;
            border: 2px solid white;
        }
        
        .dark .timeline-dot {
            border-color: #1f2937;
        }
        
        .timeline-content {
            background: white;
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        
        .dark .timeline-content {
            background: #1f2937;
        }
        
        /* Nutrition info */
        .nutrition-info {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        
        .nutrition-item {
            display: flex;
            align-items: center;
            font-size: 0.75rem;
            color: #6b7280;
        }
        
        .dark .nutrition-item {
            color: #9ca3af;
        }
        
        .nutrition-icon {
            margin-right: 0.25rem;
        }
        
        /* Accessibility improvements */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }
        
        /* Focus styles */
        button:focus,
        a:focus,
        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid #ef4444;
            outline-offset: 2px;
        }
        
        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .welcome-gradient {
                background: #000;
                color: #fff;
            }
            
            .gradient-text {
                background: #000;
                -webkit-background-clip: text;
                -webkit-text-fill-color: #fff;
                background-clip: text;
            }
        }
        
        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        
        /* Responsive improvements */
        @media (max-width: 640px) {
            .modal-content {
                width: 95%;
                max-height: 95vh;
            }
            
            .toast {
                left: 20px;
                right: 20px;
                bottom: 20px;
            }
        }
        
        /* New feature: Promo banner */
        .promo-banner {
            background: linear-gradient(90deg, #8b5cf6, #ec4899);
            color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
        }
        
        .promo-banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjEpIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI3BhdHRlcm4pIi8+PC9zdmc+');
            opacity: 0.1;
            z-index: 1;
        }
        
        .promo-content {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* New feature: Quick actions */
        .quick-actions {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        
        .quick-action-btn {
            flex: 1;
            min-width: 120px;
            padding: 1rem;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .dark .quick-action-btn {
            background: #1f2937;
        }
        
        .quick-action-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .quick-action-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            font-size: 1.25rem;
        }
        
        .quick-action-text {
            font-weight: 600;
            text-align: center;
        }
        
        /* New feature: Special offers section */
        .special-offers {
            background: linear-gradient(135deg, #f97316, #ef4444);
            border-radius: 1rem;
            padding: 1.5rem;
            color: white;
            position: relative;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .special-offers::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            z-index: 1;
        }
        
        .offers-content {
            position: relative;
            z-index: 2;
        }
        
        .offers-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .offers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .offer-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 0.75rem;
            padding: 1rem;
            transition: all 0.3s ease;
        }
        
        .offer-card:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.3);
        }
        
        .offer-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .offer-description {
            font-size: 0.875rem;
            opacity: 0.9;
        }
        
        /* New feature: Language selector */
        .language-selector {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .language-flag {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        /* New feature: Accessibility toolbar */
        .accessibility-toolbar {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 0.75rem;
            display: flex;
            gap: 0.5rem;
            z-index: 100;
        }
        
        .dark .accessibility-toolbar {
            background: #1f2937;
        }
        
        .accessibility-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f3f4f6;
            color: #4b5563;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .dark .accessibility-btn {
            background: #374151;
            color: #d1d5db;
        }
        
        .accessibility-btn:hover {
            background: #e5e7eb;
        }
        
        .dark .accessibility-btn:hover {
            background: #4b5563;
        }
        
        .accessibility-btn.active {
            background: #ef4444;
            color: white;
        }
    </style>
</head>
<body class="min-h-screen selection:bg-red-500 selection:text-white">
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen" x-cloak>
        <div class="loading-spinner"></div>
    </div>

    <div x-data="{ 
            activeTab: 'home',
            open: true,
            loading: true,
            searchTerm: '',
            selectedCategory: 'Semua Kategori',
            selectedOrderStatus: 'Semua Status',
            showNotifications: false,
            showCart: false,
            showOrderDetailModal: false,
            showPaymentModal: false,
            showUserTypeModal: false,
            showLogoutModal: false,
            showCheckoutModal: false,
            userMenu: false,
            notifCount: 5,
            selectedPaymentMethod: null,
            checkoutNote: '',
            
            // Toast notification
            toast: {
                show: false,
                message: '',
                type: 'success'
            },
            
            // Profile data
            profile: {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                dateOfBirth: '',
                userType: 'student',
                nis: '',
                className: '',
                nip: '',
                profileImage: 'https://i.pinimg.com/736x/a9/cc/21/a9cc213037bdb11d68a54ca73a80ed54.jpg'
            },
            
            // Settings
            settings: {
                emailNotifications: true,
                pushNotifications: true,
                fontSize: 'medium',
                highContrast: false,
                reducedMotion: false,
                darkMode: false
            },
            
            // Menu items
            menuItems: [
                { 
                    id: 1, 
                    name: 'Nasi Rames', 
                    price: 5000, 
                    image: 'https://i.pinimg.com/1200x/3c/96/ce/3c96ce61c5dffafbb0f0ebaf01c93fc6.jpg', 
                    category: 'Makanan', 
                    rating: 4.8,
                    description: 'Nasi hangat dengan lauk lengkap seperti tempe, sambal, dan sayur khas kantin rumahan.',
                    nutrition: { calories: 450, protein: 12, carbs: 65, fat: 15 }
                },
                { 
                    id: 2, 
                    name: 'Nasi Goreng Spesial', 
                    price: 4000, 
                    image: 'https://i.pinimg.com/1200x/94/82/ab/9482ab2e248d249e7daa7fd6924c8d3b.jpg', 
                    category: 'Makanan', 
                    rating: 4.8,
                    description: 'Nasi goreng dengan telur, ayam, dan sosis.',
                    nutrition: { calories: 520, protein: 18, carbs: 70, fat: 18 },
                    badge: 'Terlaris',
                    badgeColor: 'menu-badge-popular'
                },
                { 
                    id: 3, 
                    name: 'Bakso Jumbo', 
                    price: 5000, 
                    image: 'https://i.pinimg.com/736x/80/81/50/80815088a9ead2ca5491f55f8620712f.jpg', 
                    category: 'Makanan', 
                    rating: 4.6,
                    description: 'Bakso sapi dengan kuah segar dan sambal.',
                    nutrition: { calories: 380, protein: 22, carbs: 45, fat: 12 },
                    badge: 'Baru',
                    badgeColor: 'menu-badge-new'
                },
                { 
                    id: 4, 
                    name: 'Mie Ayam', 
                    price: 6000, 
                    image: 'https://i.pinimg.com/736x/12/e3/42/12e3428d9e726a3a8cac72cdc4c28297.jpg', 
                    category: 'Makanan', 
                    rating: 4.7,
                    description: 'Mie ayam dengan kuah kaldu dan sayuran segar.',
                    nutrition: { calories: 420, protein: 16, carbs: 60, fat: 10 }
                },
                { 
                    id: 5, 
                    name: 'Sate Ayam', 
                    price: 6000, 
                    image: 'https://i.pinimg.com/736x/6b/0e/49/6b0e4913e0ad120776bb65757180ad84.jpg', 
                    category: 'Makanan', 
                    rating: 4.9,
                    description: 'Sate ayam dengan bumbu kacang dan lontong.',
                    nutrition: { calories: 480, protein: 24, carbs: 40, fat: 22 }
                },
                { 
                    id: 6, 
                    name: 'Ayam Geprek', 
                    price: 6000, 
                    image: 'https://i.pinimg.com/736x/1a/d0/88/1ad088f355917fffdd20a800878ebdf9.jpg', 
                    category: 'Makanan', 
                    rating: 5.0,
                    description: 'Ayam goreng tepung yang digeprek dengan sambal pedas nikmat.',
                    nutrition: { calories: 550, protein: 26, carbs: 45, fat: 25 }
                },
                { 
                    id: 7, 
                    name: 'Gado-Gado', 
                    price: 7000, 
                    image: 'https://i.pinimg.com/1200x/1f/fc/95/1ffc950aead4fae6360fcd7c518355de.jpg', 
                    category: 'Makanan', 
                    rating: 4.5,
                    description: 'Sayuran segar dengan bumbu kacang dan kerupuk.',
                    nutrition: { calories: 320, protein: 8, carbs: 35, fat: 16 }
                },
                { 
                    id: 8, 
                    name: 'Mie Goreng', 
                    price: 4000, 
                    image: 'https://i.pinimg.com/1200x/03/fb/3a/03fb3aa82f646ca4b25174f1530fd3a5.jpg', 
                    category: 'Makanan', 
                    rating: 4.8,
                    description: 'Mie goreng kecap dengan sayur dan potongan ayam, cocok untuk makan siang cepat.',
                    nutrition: { calories: 480, protein: 14, carbs: 65, fat: 16 }
                },
                { 
                    id: 9, 
                    name: 'Soto', 
                    price: 5000, 
                    image: 'https://i.pinimg.com/736x/49/d5/22/49d52256580a6123f99c55f18347c17f.jpg', 
                    category: 'Makanan', 
                    rating: 5.0,
                    description: 'Soto ayam bening dengan suwiran ayam, bihun, dan perasan jeruk nipis.',
                    nutrition: { calories: 350, protein: 18, carbs: 35, fat: 14 }
                },
                { 
                    id: 10, 
                    name: 'Mie Rebus', 
                    price: 4000, 
                    image: 'https://i.pinimg.com/736x/fe/e6/5c/fee65c63a04342a12f8c65ff7c28b66c.jpg', 
                    category: 'Makanan', 
                    rating: 4.8,
                    description: 'Mie rebus hangat dengan kuah gurih dan telur rebus, cocok di hari hujan.',
                    nutrition: { calories: 380, protein: 12, carbs: 55, fat: 10 }
                },
                { 
                    id: 11, 
                    name: 'Es Teh', 
                    price: 3000, 
                    image: 'https://i.pinimg.com/736x/63/30/04/633004a76c6f03ab9665d8cce7dade47.jpg', 
                    category: 'Minuman', 
                    rating: 4.9,
                    description: 'Teh manis dingin dengan es batu.',
                    nutrition: { calories: 80, protein: 0, carbs: 20, fat: 0 },
                    badge: 'Diskon 10%',
                    badgeColor: 'menu-badge-discount'
                },
                { 
                    id: 12, 
                    name: 'Es Kopi', 
                    price: 3000, 
                    image: 'https://i.pinimg.com/1200x/20/a7/db/20a7db0c104f9b10b9eaf85adabc138a.jpg', 
                    category: 'Minuman', 
                    rating: 4.9,
                    description: 'Kopi dingin dengan cita rasa manis dan pahit yang pas.',
                    nutrition: { calories: 60, protein: 1, carbs: 12, fat: 1 }
                },
                { 
                    id: 13, 
                    name: 'Es Jeruk', 
                    price: 4000, 
                    image: 'https://i.pinimg.com/1200x/59/bb/fd/59bbfd2e5107ecc820fc0a8f39e1620f.jpg', 
                    category: 'Minuman', 
                    rating: 4.8,
                    description: 'Jeruk peras segar, dengan es batu.',
                    nutrition: { calories: 90, protein: 1, carbs: 22, fat: 0 }
                },
                { 
                    id: 14, 
                    name: 'Es Susu', 
                    price: 3000, 
                    image: 'https://i.pinimg.com/1200x/b0/c5/fc/b0c5fc211162f84bfcf38da6694b2eac.jpg', 
                    category: 'Minuman', 
                    rating: 4.7,
                    description: 'Susu dingin manis gurih yang menenangkan tenggorokan.',
                    nutrition: { calories: 120, protein: 6, carbs: 15, fat: 4 }
                },
                { 
                    id: 15, 
                    name: 'Es Sirup', 
                    price: 3000, 
                    image: 'https://i.pinimg.com/1200x/85/f7/52/85f752b3c7c31a4e13d11dc167091833.jpg', 
                    category: 'Minuman', 
                    rating: 4.6,
                    description: 'Sirup manis dingin dengan warna cerah dan rasa nostalgia khas kantin.',
                    nutrition: { calories: 100, protein: 0, carbs: 25, fat: 0 }
                },
                { 
                    id: 16, 
                    name: 'Air Mineral', 
                    price: 3000, 
                    image: 'https://i.pinimg.com/736x/52/c7/9d/52c79dee506694318cad896e0873548b.jpg', 
                    category: 'Minuman', 
                    rating: 4.6,
                    description: 'Air mineral murni untuk menjaga hidrasi tubuhmu setiap saat.',
                    nutrition: { calories: 0, protein: 0, carbs: 0, fat: 0 }
                },
                { 
                    id: 17, 
                    name: 'Es Cokelat', 
                    price: 4000, 
                    image: 'https://i.pinimg.com/1200x/84/01/1c/84011cb95f0d7df4fe0896488cce15d0.jpg', 
                    category: 'Minuman', 
                    rating: 4.8,
                    description: 'Minuman cokelat dingin yang lembut dan manis, favorit semua kalangan.',
                    nutrition: { calories: 150, protein: 3, carbs: 30, fat: 3 },
                    badge: 'Diskon 15%',
                    badgeColor: 'menu-badge-discount'
                },
                { 
                    id: 18, 
                    name: 'Puding', 
                    price: 3000, 
                    image: 'https://i.pinimg.com/736x/a2/49/1f/a2491fdedeec9a6fccb5e70d9a77a488.jpg', 
                    category: 'Dessert', 
                    rating: 4.8,
                    description: 'Puding lembut dengan rasa manis ringan, cocok untuk pencuci mulut.',
                    nutrition: { calories: 120, protein: 2, carbs: 25, fat: 2 }
                },
                { 
                    id: 19, 
                    name: 'Cokies', 
                    price: 3000, 
                    image: 'https://i.pinimg.com/736x/ca/bb/ba/cabbba6c25a5b544951e97a33f796435.jpg', 
                    category: 'Dessert', 
                    rating: 4.8,
                    description: 'Kue kering renyah dengan aroma cokelat dan butter yang menggoda.',
                    nutrition: { calories: 140, protein: 2, carbs: 20, fat: 6 }
                },
                { 
                    id: 20, 
                    name: 'Brownies', 
                    price: 3000, 
                    image: 'https://i.pinimg.com/1200x/6a/ed/44/6aed44243d963e6b8c39fc733a68e38f.jpg', 
                    category: 'Dessert', 
                    rating: 4.8,
                    description: 'Brownies lembut dan legit dengan rasa cokelat pekat yang memanjakan lidah.',
                    nutrition: { calories: 180, protein: 3, carbs: 25, fat: 8 }
                },
                { 
                    id: 21, 
                    name: 'Donat', 
                    price: 3000, 
                    image: 'https://i.pinimg.com/1200x/8a/b6/c1/8ab6c1af43e27c25d9171b75299193bd.jpg', 
                    category: 'Dessert', 
                    rating: 4.7,
                    description: 'Donat empuk dengan taburan gula halus, cocok untuk camilan sore.',
                    nutrition: { calories: 200, protein: 4, carbs: 25, fat: 9 }
                },
                { 
                    id: 22, 
                    name: 'Pie Susu', 
                    price: 3000, 
                    image: 'https://i.pinimg.com/736x/7d/f5/7d/7df57d868281331a5ff5b1b7fe87a8d8.jpg', 
                    category: 'Dessert', 
                    rating: 4.7,
                    description: 'Kue pie mini dengan isian susu manis lembut yang lumer di mulut.',
                    nutrition: { calories: 160, protein: 4, carbs: 20, fat: 7 }
                },
                { 
                    id: 23, 
                    name: 'Tahu Isi', 
                    price: 1000, 
                    image: 'https://i.pinimg.com/1200x/ec/1c/b9/ec1cb9e48dc608582e9f1d7eb2ee7a5f.jpg', 
                    category: 'Gorengan', 
                    rating: 4.4,
                    description: 'Tahu goreng isi sayuran gurih dan renyah, teman setia saat istirahat.',
                    nutrition: { calories: 120, protein: 5, carbs: 10, fat: 7 }
                },
                { 
                    id: 24, 
                    name: 'Bakwan', 
                    price: 1000, 
                    image: 'https://i.pinimg.com/736x/35/50/23/3550237dc9215939473f105a2f44c2b8.jpg', 
                    category: 'Gorengan', 
                    rating: 4.4,
                    description: 'Campuran sayur dan adonan tepung yang digoreng garing keemasan.',
                    nutrition: { calories: 100, protein: 2, carbs: 12, fat: 5 }
                },
                { 
                    id: 25, 
                    name: 'Mendowan', 
                    price: 1000, 
                    image: 'https://i.pinimg.com/736x/ee/d6/06/eed606cad5f6195b8e4c695874fc4259.jpg', 
                    category: 'Gorengan', 
                    rating: 4.4,
                    description: 'Tempe goreng setengah matang dengan rasa gurih lembut khas Banyumas.',
                    nutrition: { calories: 140, protein: 8, carbs: 8, fat: 8 }
                },
                { 
                    id: 26, 
                    name: 'Risol', 
                    price: 2000, 
                    image: 'https://i.pinimg.com/736x/19/5e/b6/195eb68fb5fe5ce8b34397cd23ddad62.jpg', 
                    category: 'Gorengan', 
                    rating: 4.7,
                    description: 'Risol isi bihun dan sayur dibalut kulit renyah keemasan.',
                    nutrition: { calories: 180, protein: 4, carbs: 20, fat: 9 }
                },
                { 
                    id: 27, 
                    name: 'Pisang Goreng', 
                    price: 1000, 
                    image: 'https://i.pinimg.com/1200x/0a/e3/db/0ae3dbdb6e3fc8fbefb807dc534633af.jpg', 
                    category: 'Gorengan', 
                    rating: 4.8,
                    description: 'Pisang raja dengan tempung premium.',
                    nutrition: { calories: 160, protein: 1, carbs: 20, fat: 8 }
                }
            ],
            
            // Cart
            cart: [],
            
            // Orders
            orders: [],
            
            // Notifications
            notifications: [
                {
                    id: 1,
                    title: 'Pesanan Anda sedang diproses',
                    message: 'Pesanan #ORD-003 sedang disiapkan oleh tim kami.',
                    time: '5 menit yang lalu',
                    read: false,
                    type: 'order',
                    icon: 'fa-receipt',
                    color: 'text-green-500'
                },
                {
                    id: 2,
                    title: 'Promo Spesial Hari Ini',
                    message: 'Dapatkan diskon 10% untuk semua minuman hari ini!',
                    time: '1 jam yang lalu',
                    read: false,
                    type: 'promo',
                    icon: 'fa-tag',
                    color: 'text-purple-500'
                },
                {
                    id: 3,
                    title: 'Menu Baru Tersedia',
                    message: 'Coba menu baru kami: Pisang Goreng dengan taburan keju.',
                    time: '2 jam yang lalu',
                    read: true,
                    type: 'menu',
                    icon: 'fa-utensils',
                    color: 'text-blue-500'
                },
                {
                    id: 4,
                    title: 'Pengumuman dari Admin',
                    message: 'Kantin akan tutup lebih awal hari Jumat pada pukul 14:00 untuk maintenance.',
                    time: '3 jam yang lalu',
                    read: true,
                    type: 'admin',
                    icon: 'fa-bullhorn',
                    color: 'text-yellow-500'
                },
                {
                    id: 5,
                    title: 'Pesanan Siap Diambil',
                    message: 'Pesanan #ORD-003 sudah siap diambil di kasir.',
                    time: 'Baru saja',
                    read: false,
                    type: 'order',
                    icon: 'fa-check-circle',
                    color: 'text-green-500'
                }
            ],
            
            // Payment methods
            paymentMethods: [],
            
            // New payment form
            newPayment: {
                name: '',
                type: 'Dana',
                last4: '',
                isDefault: false
            },
            
            // Selected order for detail view
            selectedOrder: null,
            
            // Computed properties
            get filteredMenuItems() {
                let result = this.menuItems;
                
                // Filter by search term
                if (this.searchTerm) {
                    const term = this.searchTerm.toLowerCase();
                    result = result.filter(item => 
                        item.name.toLowerCase().includes(term) || 
                        item.description.toLowerCase().includes(term)
                    );
                }
                
                // Filter by category
                if (this.selectedCategory !== 'Semua Kategori') {
                    result = result.filter(item => item.category === this.selectedCategory);
                }
                
                return result;
            },
            
            get filteredOrders() {
                if (this.selectedOrderStatus === 'Semua Status') {
                    return this.orders;
                }
                return this.orders.filter(order => order.status === this.selectedOrderStatus);
            },
            
            get unreadNotifications() {
                return this.notifications.filter(notif => !notif.read);
            },
            
            get orderNotifications() {
                return this.notifications.filter(notif => notif.type === 'order');
            },
            
            get adminNotifications() {
                return this.notifications.filter(notif => notif.type === 'admin');
            },
            
            // Methods
            init() {
                // Load data from localStorage
                this.loadProfileFromStorage();
                this.loadSettingsFromStorage();
                this.loadOrdersFromStorage();
                this.loadPaymentMethodsFromStorage();
                this.loadCartFromStorage();
                
                // Apply settings
                this.applySettings();
                
                // Simulate loading
                setTimeout(() => {
                    this.loading = false;
                }, 1000);
                
                // Initialize default payment method
                if (this.paymentMethods.length > 0) {
                    const defaultPayment = this.paymentMethods.find(p => p.isDefault);
                    this.selectedPaymentMethod = defaultPayment ? defaultPayment.id : this.paymentMethods[0].id;
                }
                
                // Simulate real-time notifications
                this.simulateRealTimeNotifications();
            },
            
            // Load data from localStorage
            loadProfileFromStorage() {
                const savedProfile = localStorage.getItem('mealyungProfile');
                if (savedProfile) {
                    this.profile = JSON.parse(savedProfile);
                } else {
                    // Set default profile for Adi Saputra
                    this.profile = {
                        firstName: 'Adi',
                        lastName: 'Saputra',
                        email: 'adi.saputra@example.com',
                        phone: '081234567890',
                        dateOfBirth: '2000-01-01',
                        userType: 'student',
                        nis: '12345',
                        className: 'XII RPL 1',
                        nip: '',
                        profileImage: 'https://i.pinimg.com/736x/a9/cc/21/a9cc213037bdb11d68a54ca73a80ed54.jpg'
                    };
                    this.saveProfileToStorage();
                }
            },
            
            saveProfileToStorage() {
                localStorage.setItem('mealyungProfile', JSON.stringify(this.profile));
            },
            
            loadSettingsFromStorage() {
                const savedSettings = localStorage.getItem('mealyungSettings');
                if (savedSettings) {
                    this.settings = JSON.parse(savedSettings);
                }
            },
            
            saveSettingsToStorage() {
                localStorage.setItem('mealyungSettings', JSON.stringify(this.settings));
            },
            
            loadOrdersFromStorage() {
                const savedOrders = localStorage.getItem('mealyungOrders');
                if (savedOrders) {
                    this.orders = JSON.parse(savedOrders);
                } else {
                    // Initialize with sample orders
                    this.orders = [
                        {
                            id: '#ORD-003',
                            date: '15 Mei 2023, 10:30',
                            items: 3,
                            total: 18000,
                            status: 'Delivered',
                            itemsList: [
                                { name: 'Nasi Goreng Spesial', price: 7000, quantity: 1 },
                                { name: 'Es Teh Manis', price: 3000, quantity: 2 }
                            ],
                            paymentNote: 'Pembayaran dengan GoPay sebesar Rp18.000 pada 15 Mei 2023 pukul 10:35 WIB',
                            timeline: [
                                { time: '10:30', status: 'Pesanan dibuat', description: 'Pesanan Anda telah diterima' },
                                { time: '10:32', status: 'Pembayaran berhasil', description: 'Pembayaran dengan GoPay berhasil' },
                                { time: '10:35', status: 'Sedang diproses', description: 'Pesanan sedang disiapkan' },
                                { time: '10:45', status: 'Siap diambil', description: 'Pesanan siap diambil di kasir' },
                                { time: '10:50', status: 'Selesai', description: 'Pesanan telah selesai' }
                            ]
                        },
                        {
                            id: '#ORD-002',
                            date: '16 Mei 2023, 12:15',
                            items: 2,
                            total: 11000,
                            status: 'Delivered',
                            itemsList: [
                                { name: 'Bakso Jumbo', price: 5000, quantity: 1 },
                                { name: 'Es Teh Manis', price: 3000, quantity: 2 }
                            ],
                            paymentNote: 'Pembayaran tunai di kasir sebesar Rp11.000 pada 16 Mei 2023 pukul 12:20 WIB',
                            timeline: [
                                { time: '12:15', status: 'Pesanan dibuat', description: 'Pesanan Anda telah diterima' },
                                { time: '12:18', status: 'Pembayaran berhasil', description: 'Pembayaran tunai berhasil' },
                                { time: '12:20', status: 'Sedang diproses', description: 'Pesanan sedang disiapkan' },
                                { time: '12:30', status: 'Siap diambil', description: 'Pesanan siap diambil di kasir' },
                                { time: '12:35', status: 'Selesai', description: 'Pesanan telah selesai' }
                            ]
                        },
                        {
                            id: '#ORD-001',
                            date: '17 Mei 2023, 09:45',
                            items: 4,
                            total: 25000,
                            status: 'Preparing',
                            itemsList: [
                                { name: 'Sate Ayam', price: 6000, quantity: 2 },
                                { name: 'Mie Ayam', price: 6000, quantity: 1 },
                                { name: 'Jus Alpukat', price: 7000, quantity: 1 }
                            ],
                            paymentNote: 'Pembayaran dengan DANA sebesar Rp25.000 pada 17 Mei 2023 pukul 09:50 WIB',
                            timeline: [
                                { time: '09:45', status: 'Pesanan dibuat', description: 'Pesanan Anda telah diterima' },
                                { time: '09:48', status: 'Pembayaran berhasil', description: 'Pembayaran dengan DANA berhasil' },
                                { time: '09:50', status: 'Sedang diproses', description: 'Pesanan sedang disiapkan' }
                            ]
                        }
                    ];
                    this.saveOrdersToStorage();
                }
            },
            
            saveOrdersToStorage() {
                localStorage.setItem('mealyungOrders', JSON.stringify(this.orders));
            },
            
            loadPaymentMethodsFromStorage() {
                const savedPayments = localStorage.getItem('mealyungPayments');
                if (savedPayments) {
                    this.paymentMethods = JSON.parse(savedPayments);
                } else {
                    // Initialize with sample payment methods
                    this.paymentMethods = [
                        {
                            id: 1,
                            name: 'GoPay',
                            type: 'gopay',
                            last4: '5678',
                            isDefault: false
                        },
                        {
                            id: 2,
                            name: 'DANA',
                            type: 'dana',
                            last4: '9012',
                            isDefault: false
                        },
                        {
                            id: 3,
                            name: 'OVO',
                            type: 'ovo',
                            last4: '3456',
                            isDefault: false
                        }
                    ];
                    this.savePaymentMethodsToStorage();
                }
            },
            
            savePaymentMethodsToStorage() {
                localStorage.setItem('mealyungPayments', JSON.stringify(this.paymentMethods));
            },
            
            loadCartFromStorage() {
                const savedCart = localStorage.getItem('mealyungCart');
                if (savedCart) {
                    this.cart = JSON.parse(savedCart);
                }
            },
            
            saveCartToStorage() {
                localStorage.setItem('mealyungCart', JSON.stringify(this.cart));
            },
            
            applySettings() {
                // Apply dark mode
                if (this.settings.darkMode) {
                    document.documentElement.classList.add('dark');
                    document.body.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.body.classList.remove('dark');
                }
                
                // Apply font size
                document.body.classList.remove('text-sm', 'text-base', 'text-lg');
                if (this.settings.fontSize === 'small') {
                    document.body.classList.add('text-sm');
                } else if (this.settings.fontSize === 'medium') {
                    document.body.classList.add('text-base');
                } else if (this.settings.fontSize === 'large') {
                    document.body.classList.add('text-lg');
                }
                
                // Apply high contrast
                if (this.settings.highContrast) {
                    document.body.classList.add('high-contrast');
                } else {
                    document.body.classList.remove('high-contrast');
                }
                
                // Apply reduced motion
                if (this.settings.reducedMotion) {
                    document.body.classList.add('reduce-motion');
                } else {
                    document.body.classList.remove('reduce-motion');
                }
            },
            
            // Simulate real-time notifications
            simulateRealTimeNotifications() {
                setInterval(() => {
                    // Random chance to receive a notification
                    if (Math.random() > 0.8) {
                        const notifTypes = ['order', 'admin', 'promo'];
                        const type = notifTypes[Math.floor(Math.random() * notifTypes.length)];
                        
                        let title, message, icon, color;
                        
                        switch(type) {
                            case 'order':
                                title = 'Update Pesanan';
                                message = 'Status pesanan Anda telah diperbarui';
                                icon = 'fa-receipt';
                                color = 'text-green-500';
                                break;
                            case 'admin':
                                title = 'Pengumuman Kantin';
                                message = 'Ada pengumuman penting dari admin kantin';
                                icon = 'fa-bullhorn';
                                color = 'text-yellow-500';
                                break;
                            case 'promo':
                                title = 'Promo Menarik';
                                message = 'Jangan lewatkan promo spesial minggu ini';
                                icon = 'fa-tag';
                                color = 'text-purple-500';
                                break;
                        }
                        
                        const newNotif = {
                            id: this.notifications.length + 1,
                            title,
                            message,
                            time: 'Baru saja',
                            read: false,
                            type,
                            icon,
                            color
                        };
                        
                        this.notifications.unshift(newNotif);
                        this.notifCount++;
                        
                        // Show toast notification
                        this.showToast(`${title}: ${message}`, 'info');
                    }
                }, 30000); // Check every 30 seconds
            },
            
            // Menu methods
            addToCart(item) {
                // Check if item already in cart
                const existingItem = this.cart.find(cartItem => cartItem.id === item.id);
                
                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    this.cart.push({
                        ...item,
                        quantity: 1
                    });
                }
                
                this.saveCartToStorage();
                this.showToast(`${item.name} ditambahkan ke keranjang`, 'success');
                
                // Show cart
                this.showCart = true;
            },
            
            removeFromCart(index) {
                const item = this.cart[index];
                this.cart.splice(index, 1);
                this.saveCartToStorage();
                this.showToast(`${item.name} dihapus dari keranjang`, 'info');
            },
            
            updateCartItemQuantity(index, change) {
                const item = this.cart[index];
                item.quantity += change;
                
                if (item.quantity <= 0) {
                    this.removeFromCart(index);
                } else {
                    this.saveCartToStorage();
                }
            },
            
            createOrder() {
                if (this.cart.length === 0) {
                    this.showToast('Keranjang Anda kosong', 'error');
                    return;
                }
                
                // Create a new order
                const newOrder = {
                    id: '#ORD-' + String(this.orders.length + 1).padStart(3, '0'),
                    date: new Date().toLocaleDateString('id-ID', { 
                        day: 'numeric', 
                        month: 'long', 
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    }),
                    items: this.cart.reduce((total, item) => total + item.quantity, 0),
                    total: this.cart.reduce((total, item) => total + (item.price * item.quantity), 0),
                    status: 'processing',
                    itemsList: this.cart.map(item => ({
                        name: item.name,
                        price: item.price,
                        quantity: item.quantity
                    })),
                    paymentNote: 'Menunggu pembayaran',
                    timeline: [
                        { 
                            time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }), 
                            status: 'Pesanan dibuat', 
                            description: 'Pesanan Anda telah diterima' 
                        }
                    ]
                };
                
                // Add to orders
                this.orders.unshift(newOrder);
                this.saveOrdersToStorage();
                
                // Send order to admin dashboard
                this.sendOrderToAdmin(newOrder);
                
                // Create order notification
                const orderNotif = {
                    id: this.notifications.length + 1,
                    title: 'Pesanan Dibuat',
                    message: `Pesanan ${newOrder.id} telah berhasil dibuat dan sedang diproses.`,
                    time: 'Baru saja',
                    read: false,
                    type: 'order',
                    icon: 'fa-receipt',
                    color: 'text-green-500'
                };
                
                this.notifications.unshift(orderNotif);
                this.notifCount++;
                
                // Clear cart
                this.cart = [];
                this.saveCartToStorage();
                
                // Close cart
                this.showCart = false;
                
                // Show notification
                this.showToast('Pesanan berhasil dibuat!', 'success');
                
                // Switch to orders tab
                this.activeTab = 'orders';
            },
            
            // Send order to admin dashboard
            sendOrderToAdmin(order) {
                // In a real application, this would send the order to a server
                // For this demo, we'll store it in localStorage for the admin dashboard
                const adminOrders = JSON.parse(localStorage.getItem('adminOrders') || '[]');
                adminOrders.push({
                    ...order,
                    customer: this.profile.firstName + ' ' + this.profile.lastName,
                    customerType: this.profile.userType,
                    timestamp: new Date().toISOString()
                });
                localStorage.setItem('adminOrders', JSON.stringify(adminOrders));
            },
            
            // Order methods
            viewOrderDetail(order) {
                this.selectedOrder = order;
                this.showOrderDetailModal = true;
            },
            
            confirmOrder(orderId) {
                const order = this.orders.find(o => o.id === orderId);
                if (order) {
                    order.status = 'completed';
                    
                    // Add timeline entry
                    order.timeline.push({
                        time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }),
                        status: 'Selesai',
                        description: 'Pesanan telah selesai'
                    });
                    
                    this.saveOrdersToStorage();
                    
                    // Create notification
                    const notif = {
                        id: this.notifications.length + 1,
                        title: 'Pesanan Selesai',
                        message: `Pesanan ${order.id} telah selesai. Terima kasih!`,
                        time: 'Baru saja',
                        read: false,
                        type: 'order',
                        icon: 'fa-check-circle',
                        color: 'text-green-500'
                    };
                    
                    this.notifications.unshift(notif);
                    this.notifCount++;
                    
                    this.showToast('Pesanan telah dikonfirmasi!', 'success');
                }
            },
            
            reorder(order) {
                // Add items from order to cart
                order.itemsList.forEach(item => {
                    const existingItem = this.cart.find(c => c.name === item.name);
                    if (existingItem) {
                        existingItem.quantity += item.quantity;
                    } else {
                        const menuItem = this.menuItems.find(m => m.name === item.name);
                        if (menuItem) {
                            this.cart.push({
                                ...menuItem,
                                quantity: item.quantity
                            });
                        }
                    }
                });
                
                this.saveCartToStorage();
                
                // Show cart
                this.showCart = true;
                
                // Show notification
                this.showToast('Item telah ditambahkan ke keranjang', 'success');
            },
            
            // Payment methods
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
                if (!this.newPayment.name || !this.newPayment.last4) {
                    this.showToast('Harap lengkapi semua field', 'error');
                    return;
                }
                
                // If this is set as default, unset other defaults
                if (this.newPayment.isDefault) {
                    this.paymentMethods.forEach(method => {
                        method.isDefault = false;
                    });
                }
                
                // Add new payment method
                this.paymentMethods.push({
                    id: this.paymentMethods.length + 1,
                    ...this.newPayment
                });
                
                this.savePaymentMethodsToStorage();
                
                // Close modal
                this.showPaymentModal = false;
                
                // Show notification
                this.showToast('Metode pembayaran berhasil ditambahkan', 'success');
            },
            
            setDefaultPayment(id) {
                // Unset all defaults
                this.paymentMethods.forEach(method => {
                    method.isDefault = false;
                });
                
                // Set new default
                const payment = this.paymentMethods.find(method => method.id === id);
                if (payment) {
                    payment.isDefault = true;
                    this.savePaymentMethodsToStorage();
                    this.showToast('Metode pembayaran utama telah diperbarui', 'success');
                }
            },
            
            deletePayment(id) {
                this.paymentMethods = this.paymentMethods.filter(method => method.id !== id);
                this.savePaymentMethodsToStorage();
                this.showToast('Metode pembayaran telah dihapus', 'success');
            },
            
            // Checkout methods
            processCheckout() {
                if (this.cart.length === 0) {
                    this.showToast('Keranjang Anda kosong', 'error');
                    return;
                }
                
                if (!this.selectedPaymentMethod) {
                    this.showToast('Pilih metode pembayaran', 'error');
                    return;
                }
                
                // Create a new order
                const newOrder = {
                    id: '#ORD-' + String(this.orders.length + 1).padStart(3, '0'),
                    date: new Date().toLocaleDateString('id-ID', { 
                        day: 'numeric', 
                        month: 'long', 
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    }),
                    items: this.cart.reduce((total, item) => total + item.quantity, 0),
                    total: this.cart.reduce((total, item) => total + (item.price * item.quantity), 0),
                    status: 'processing',
                    itemsList: this.cart.map(item => ({
                        name: item.name,
                        price: item.price,
                        quantity: item.quantity
                    })),
                    paymentNote: this.generatePaymentNote(),
                    timeline: [
                        { 
                            time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }), 
                            status: 'Pesanan dibuat', 
                            description: 'Pesanan Anda telah diterima' 
                        }
                    ]
                };
                
                // Add to orders
                this.orders.unshift(newOrder);
                this.saveOrdersToStorage();
                
                // Send order to admin dashboard
                this.sendOrderToAdmin(newOrder);
                
                // Create order notification
                const orderNotif = {
                    id: this.notifications.length + 1,
                    title: 'Pesanan Dibuat',
                    message: `Pesanan ${newOrder.id} telah berhasil dibuat dan sedang diproses.`,
                    time: 'Baru saja',
                    read: false,
                    type: 'order',
                    icon: 'fa-receipt',
                    color: 'text-green-500'
                };
                
                this.notifications.unshift(orderNotif);
                this.notifCount++;
                
                // Clear cart
                this.cart = [];
                this.saveCartToStorage();
                
                // Close checkout modal
                this.showCheckoutModal = false;
                
                // Show notification
                this.showToast('Pembayaran berhasil! Pesanan sedang diproses.', 'success');
                
                // Switch to orders tab
                this.activeTab = 'orders';
            },
            
            generatePaymentNote() {
                const paymentMethod = this.paymentMethods.find(p => p.id === this.selectedPaymentMethod);
                const amount = this.cart.reduce((total, item) => total + (item.price * item.quantity), 0).toLocaleString('id-ID');
                const now = new Date().toLocaleDateString('id-ID', { 
                    day: 'numeric', 
                    month: 'long', 
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                let note = '';
                
                if (paymentMethod) {
                    if (paymentMethod.type === 'visa' || paymentMethod.type === 'mastercard') {
                        note = `Pembayaran dengan kartu ${paymentMethod.type} berakhiran ****${paymentMethod.last4} sebesar Rp${amount} pada ${now}`;
                    } else if (paymentMethod.type === 'gopay' || paymentMethod.type === 'ovo' || paymentMethod.type === 'dana') {
                        note = `Pembayaran dengan ${paymentMethod.name} berakhiran ****${paymentMethod.last4} sebesar Rp${amount} pada ${now}`;
                    }
                } else if (this.selectedPaymentMethod === 'cash') {
                    note = `Pembayaran tunai di kasir sebesar Rp${amount} pada ${now}`;
                }
                
                if (this.checkoutNote) {
                    note += `. Catatan: ${this.checkoutNote}`;
                }
                
                return note;
            },
            
            // Profile methods
            updateProfile() {
                this.saveProfileToStorage();
                this.showToast('Profil berhasil diperbarui', 'success');
            },
            
            handleProfileImageUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.profile.profileImage = e.target.result;
                        this.saveProfileToStorage();
                        this.showToast('Foto profil berhasil diperbarui', 'success');
                    };
                    reader.readAsDataURL(file);
                }
            },
            
            // Settings methods
            updateSettings() {
                this.saveSettingsToStorage();
                this.applySettings();
                this.showToast('Pengaturan berhasil disimpan', 'success');
            },
            
            toggleFontSize() {
                const sizes = ['small', 'medium', 'large'];
                const currentIndex = sizes.indexOf(this.settings.fontSize);
                this.settings.fontSize = sizes[(currentIndex + 1) % sizes.length];
                this.updateSettings();
                this.showToast(`Ukuran teks diubah menjadi: ${this.settings.fontSize === 'small' ? 'Kecil' : this.settings.fontSize === 'medium' ? 'Sedang' : 'Besar'}`, 'info');
            },
            
            // User type methods
            openUserTypeModal() {
                this.showUserTypeModal = true;
            },
            
            changeUserType(type) {
                this.profile.userType = type;
                this.saveProfileToStorage();
                this.showUserTypeModal = false;
                this.showToast(`Tipe pengguna diubah menjadi: ${type === 'student' ? 'Siswa' : 'Guru'}`, 'success');
            },
            
            // Notification methods
            markNotificationAsRead(id) {
                const notification = this.notifications.find(n => n.id === id);
                if (notification) {
                    notification.read = true;
                    this.notifCount = Math.max(0, this.notifCount - 1);
                }
            },
            
            markAllNotificationsAsRead() {
                this.notifications.forEach(notification => {
                    notification.read = true;
                });
                this.notifCount = 0;
                this.showToast('Semua notifikasi telah ditandai sebagai dibaca', 'info');
            },
            
            // Toast notification
            showToast(message, type = 'success') {
                this.toast.message = message;
                this.toast.type = type;
                this.toast.show = true;
                
                setTimeout(() => {
                    this.toast.show = false;
                }, 3000);
            },
            
            // Logout
            openLogoutModal() {
                this.showLogoutModal = true;
            },
            
            logout() {
                this.showToast('Anda telah keluar dari akun', 'info');
                setTimeout(() => {
                    window.location.href = '/';
                }, 1500);
            }
        }" :class="{ 'dark': settings.darkMode }" class="flex h-screen" x-init="init()">
        
        <!-- ===== SIDEBAR ===== -->
        <aside :class="open ? 'w-64' : 'w-20'" class="bg-white dark:bg-gray-900 shadow-xl flex flex-col transition-all duration-500 border-r border-gray-200 dark:border-gray-700 z-40">
            <!-- Logo -->
            <div class="flex items-center space-x-3 p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="relative">
                    <img alt="MEALYUNG logo" class="h-10 w-10 rounded-lg shadow-md animate-pulse" height="40" src="https://i.pinimg.com/736x/a9/cc/21/a9cc213037bdb11d68a54ca73a80ed54.jpg" width="40"/>
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
                    <span class="transition-opacity select-none" x-show="open">Dashboard</span>
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
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                        <button @click.prevent="document.getElementById('logout-form').submit(); window.location.href='/'"
                             class="block px-4 py-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition cursor-pointer w-full text-left">
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
                        <span class="text-gray-500 dark:text-gray-400 text-2xl">Selamat datang kembali,</span>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight select-none">
                            <span x-show="!loading" x-text="profile.firstName + ' ' + profile.lastName"></span>
                            <span x-show="loading" class="skeleton h-6 w-32 rounded inline-block"></span>
                        </h2>
                        <span class="user-type-badge" :class="profile.userType === 'student' ? 'user-type-student' : 'user-type-teacher'" x-text="profile.userType === 'student' ? 'Siswa' : 'Guru'"></span>
                    </div>
                    
                    <div class="flex items-center space-x-5">
                        
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
                                        <div @click="markNotificationAsRead(notification.id)" class="notification-card" :class="{
                                            'unread': !notification.read,
                                            'order': notification.type === 'order',
                                            'admin': notification.type === 'admin'
                                        }">
                                            <div class="flex items-start">
                                                <i :class="`${notification.icon} ${notification.color} mt-1 mr-3`"></i>
                                                <div class="flex-1">
                                                    <div class="flex justify-between">
                                                        <h4 class="font-medium text-gray-900 dark:text-white" x-text="notification.title"></h4>
                                                        <span class="text-xs text-gray-500 dark:text-gray-400" x-text="notification.time"></span>
                                                    </div>
                                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1" x-text="notification.message"></p>
                                                    <div class="flex items-center mt-2">
                                                        <span x-show="!notification.read" class="inline-block w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                                        <span class="text-xs" :class="notification.color" x-text="notification.type === 'order' ? 'Pesanan' : notification.type === 'admin' ? 'Admin' : 'Promo'"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
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
                    <div class="welcome-gradient rounded-2xl p-6 shadow-lg animate-fadeIn">
                        <div class="welcome-content">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <div>
                                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
                                        Selamat Datang di MEALYUNG
                                    </h1>
                                    <p class="text-white/90 max-w-2xl">
                                        Pesan makanan favorit Anda hanya dengan beberapa klik. Segar, lezat, dan diantarkan ke pintu Anda.
                                    </p>
                                </div>
                                <div class="flex space-x-3">
                                    <button @click="activeTab = 'menu'" class="px-5 py-2 bg-white text-red-600 rounded-xl hover:bg-gray-100 transition-all duration-300 shadow-md btn-animate">
                                        <i class="fas fa-utensils mr-2"></i> Pesan Sekarang
                                    </button>
                                </div>
                            </div>
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
                            <div class="menu-card">
                                <div class="relative">
                                    <img alt="Nasi Goreng Spesial" class="menu-image" height="250" src="https://i.pinimg.com/1200x/94/82/ab/9482ab2e248d249e7daa7fd6924c8d3b.jpg" width="400"/>
                                    <div class="menu-card-badge menu-badge-popular">
                                        Terlaris
                                    </div>
                                </div>
                                <div class="menu-content bg-white">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="menu-title">Nasi Goreng Spesial</h3>
                                        <div class="menu-rating">
                                            <i class="fas fa-star"></i>
                                            <span class="ml-1 text-gray-700 dark:text-gray-300">4.8</span>
                                        </div>
                                    </div>
                                    <p class="menu-description">Nasi goreng dengan telur, ayam, dan sosis.</p>
                                    <div class="nutrition-info">
                                        <div class="nutrition-item">
                                            <i class="fas fa-fire nutrition-icon"></i>
                                            <span>520 cal</span>
                                        </div>
                                        <div class="nutrition-item">
                                            <i class="fas fa-drumstick-bite nutrition-icon"></i>
                                            <span>18g protein</span>
                                        </div>
                                    </div>
                                    <div class="menu-footer">
                                        <span class="menu-price">Rp4.000</span>
                                        <div @click="addToCart({ id: 2, name: 'Nasi Goreng Spesial', price: 4000, image: 'https://i.pinimg.com/1200x/94/82/ab/9482ab2e248d249e7daa7fd6924c8d3b.jpg' })" class="menu-add-btn">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="menu-card">
                                <div class="relative">
                                    <img alt="Bakso Jumbo" class="menu-image" height="250" src="https://i.pinimg.com/736x/80/81/50/80815088a9ead2ca5491f55f8620712f.jpg" width="400"/>
                                    <div class="menu-card-badge menu-badge-new">
                                        Baru
                                    </div>
                                </div>
                                <div class="menu-content bg-white">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="menu-title">Bakso Jumbo</h3>
                                        <div class="menu-rating">
                                            <i class="fas fa-star"></i>
                                            <span class="ml-1 text-gray-700 dark:text-gray-300">4.6</span>
                                        </div>
                                    </div>
                                    <p class="menu-description">Bakso sapi dengan kuah segar dan sambal.</p>
                                    <div class="nutrition-info">
                                        <div class="nutrition-item">
                                            <i class="fas fa-fire nutrition-icon"></i>
                                            <span>380 cal</span>
                                        </div>
                                        <div class="nutrition-item">
                                            <i class="fas fa-drumstick-bite nutrition-icon"></i>
                                            <span>22g protein</span>
                                        </div>
                                    </div>
                                    <div class="menu-footer">
                                        <span class="menu-price">Rp5.000</span>
                                        <div @click="addToCart({ id: 3, name: 'Bakso Jumbo', price: 5000, image: 'https://i.pinimg.com/736x/80/81/50/80815088a9ead2ca5491f55f8620712f.jpg' })" class="menu-add-btn">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="menu-card">
                                <div class="relative">
                                    <img alt="Mie Ayam" class="menu-image" height="250" src="https://i.pinimg.com/736x/12/e3/42/12e3428d9e726a3a8cac72cdc4c28297.jpg" width="400"/>
                                </div>
                                <div class="menu-content bg-white">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="menu-title">Mie Ayam</h3>
                                        <div class="menu-rating">
                                            <i class="fas fa-star"></i>
                                            <span class="ml-1 text-gray-700 dark:text-gray-300">4.7</span>
                                        </div>
                                    </div>
                                    <p class="menu-description">Mie ayam dengan kuah kaldu dan sayuran segar.</p>
                                    <div class="nutrition-info">
                                        <div class="nutrition-item">
                                            <i class="fas fa-fire nutrition-icon"></i>
                                            <span>420 cal</span>
                                        </div>
                                        <div class="nutrition-item">
                                            <i class="fas fa-drumstick-bite nutrition-icon"></i>
                                            <span>16g protein</span>
                                        </div>
                                    </div>
                                    <div class="menu-footer">
                                        <span class="menu-price">Rp6.000</span>
                                        <div @click="addToCart({ id: 4, name: 'Mie Ayam', price: 6000, image: 'https://i.pinimg.com/736x/12/e3/42/12e3428d9e726a3a8cac72cdc4c28297.jpg' })" class="menu-add-btn">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="menu-card">
                                <div class="relative">
                                    <img alt="Sate Ayam" class="menu-image" height="250" src="https://i.pinimg.com/736x/6b/0e/49/6b0e4913e0ad120776bb65757180ad84.jpg" width="400"/>
                                </div>
                                <div class="menu-content bg-white">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="menu-title">Sate Ayam</h3>
                                        <div class="menu-rating">
                                            <i class="fas fa-star"></i>
                                            <span class="ml-1 text-gray-700 dark:text-gray-300">4.9</span>
                                        </div>
                                    </div>
                                    <p class="menu-description">Sate ayam dengan bumbu kacang dan lontong.</p>
                                    <div class="nutrition-info">
                                        <div class="nutrition-item">
                                            <i class="fas fa-fire nutrition-icon"></i>
                                            <span>480 cal</span>
                                        </div>
                                        <div class="nutrition-item">
                                            <i class="fas fa-drumstick-bite nutrition-icon"></i>
                                            <span>24g protein</span>
                                        </div>
                                    </div>
                                    <div class="menu-footer">
                                        <span class="menu-price">Rp6.000</span>
                                        <div @click="addToCart({ id: 5, name: 'Sate Ayam', price: 6000, image: 'https://i.pinimg.com/736x/6b/0e/49/6b0e4913e0ad120776bb65757180ad84.jpg' })" class="menu-add-btn">
                                            <i class="fas fa-plus"></i>
                                        </div>
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
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <i class="fas fa-utensils mr-3 text-red-500"></i>
                            Menu Kami
                        </h2>
                        <div class="flex flex-wrap gap-3">
                            <div class="relative">
                                <input x-model="searchTerm" class="w-64 max-w-xs px-4 py-3 rounded-xl border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 shadow-sm" placeholder="Cari menu..." type="text"/>
                                <i class="fas fa-search absolute top-3.5 right-4 text-gray-400 pointer-events-none"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Category Pills -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <template x-for="category in ['Semua Kategori', 'Makanan', 'Minuman', 'Dessert', 'Gorengan']">
                            <div @click="selectedCategory = category" 
                                 class="category-pill" 
                                 :class="{'active': selectedCategory === category}"
                                 x-text="category">
                            </div>
                        </template>
                    </div>
                    
                    <div x-show="filteredMenuItems.length === 0" class="text-center py-12">
                        <i class="fas fa-search text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                        <p class="text-xl text-gray-600 dark:text-gray-400 mb-2">Tidak ada menu yang ditemukan</p>
                        <p class="text-gray-500 dark:text-gray-500">Coba kata kunci pencarian lain atau pilih kategori berbeda</p>
                    </div>
                    
                    <div x-show="filteredMenuItems.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <template x-for="item in filteredMenuItems" :key="item.id">
                            <div class="menu-card">
                                <div class="relative">
                                    <img :alt="item.name" class="menu-image" height="250" :src="item.image" width="400"/>
                                    <div x-show="item.badge" :class="item.badgeColor" class="menu-card-badge">
                                        <span x-text="item.badge"></span>
                                    </div>
                                </div>
                                <div class="menu-content bg-white">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="menu-title" x-text="item.name"></h3>
                                        <div class="menu-rating">
                                            <i class="fas fa-star"></i>
                                            <span class="ml-1 text-gray-700 dark:text-gray-300" x-text="item.rating"></span>
                                        </div>
                                    </div>
                                    <p class="menu-description" x-text="item.description"></p>
                                    <div class="nutrition-info">
                                        <div class="nutrition-item">
                                            <i class="fas fa-fire nutrition-icon"></i>
                                            <span x-text="item.nutrition.calories + ' cal'"></span>
                                        </div>
                                        <div class="nutrition-item">
                                            <i class="fas fa-drumstick-bite nutrition-icon"></i>
                                            <span x-text="item.nutrition.protein + 'g protein'"></span>
                                        </div>
                                    </div>
                                    <div class="menu-footer">
                                        <span class="menu-price">
                                            Rp<span x-text="item.price.toLocaleString('id-ID')"></span>
                                        </span>
                                        <div @click="addToCart(item)" class="menu-add-btn">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
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
                                    <select x-model="selectedOrderStatus" @change="filterOrders()" class="px-4 py-2 border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                                        <option value="all">Semua Status</option>
                                        <option value="processing">Memproses</option>
                                        <option value="ready">Siap</option>
                                        <option value="cancelled">Dibatalkan</option>
                                        <option value="delivered">Terkirim</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div x-show="filteredOrders.length === 0" class="text-center py-12">
                            <i class="fas fa-receipt text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                            <p class="text-xl text-gray-600 dark:text-gray-400 mb-2">Belum ada pesanan</p>
                            <p class="text-gray-500 dark:text-gray-500 mb-4">Anda belum memiliki riwayat pesanan</p>
                            <button @click="activeTab = 'menu'" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md btn-animate">
                                <i class="fas fa-utensils mr-2"></i> Pesan Sekarang
                            </button>
                        </div>
                        
                        <div x-show="filteredOrders.length > 0" class="space-y-4">
                            <template x-for="order in filteredOrders" :key="order.id">
                                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow cursor-pointer" @click="viewOrderDetail(order)">
                                   <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="font-bold text-gray-900 dark:text-white" x-text="order.id"></h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400" x-text="order.date + ' • ' + order.items + ' item'"></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-gray-900 dark:text-white">Rp<span x-text="order.total.toLocaleString('id-ID')"></span></p>
                                        <div class="flex items-center justify-end mt-1">
                                            <span class="ml-2 text-sm font-medium" :class="{
                                                'text-yellow-600 dark:text-yellow-400': order.status === 'processing',
                                                'text-green-600 dark:text-green-400': order.status === 'ready',
                                                'text-red-600 dark:text-red-400': order.status === 'cancelled',
                                                'text-blue-600 dark:text-blue-400': order.status === 'delivered'
                                            }">
                                                <span x-show="order.status === 'processing'">Memproses</span>
                                                <span x-show="order.status === 'ready'">Siap</span>
                                                <span x-show="order.status === 'cancelled'">Dibatalkan</span>
                                                <span x-show="order.status === 'delivered'">Terkirim</span>
                                            </span>
                                        </div>
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

                <!-- Order Detail Modal -->
                <div x-show="showOrderDetail" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" @click.self="showOrderDetail = false">
                    <div class="bg-white dark:bg-gray-800 rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto" @click.away="showOrderDetail = false">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Pesanan</h2>
                                <button @click="showOrderDetail = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>
                            
                            <div x-show="selectedOrder" class="space-y-6">
                                <!-- Order Info -->
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <div class="flex justify-between mb-2">
                                        <h3 class="font-bold text-lg text-gray-900 dark:text-white" x-text="selectedOrder.id"></h3>
                                        <span class="status-badge" :class="'status-' + selectedOrder.status" x-text="getStatusText(selectedOrder.status)"></span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400" x-text="selectedOrder.date + ' • ' + selectedOrder.items + ' item'"></p>
                                    <p class="font-bold text-gray-900 dark:text-white mt-2">Total: Rp<span x-text="selectedOrder.total.toLocaleString('id-ID')"></span></p>
                                </div>
                                
                                <!-- Order Items -->
                                <div>
                                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-3">Item Pesanan</h3>
                                    <div class="space-y-3">
                                        <template x-for="item in selectedOrder.itemsList" :key="item.id">
                                            <div class="flex justify-between items-center">
                                                <div class="flex items-center">
                                                    <img :src="item.image" class="w-12 h-12 rounded-lg object-cover mr-3" alt="Product image">
                                                    <div>
                                                        <p class="font-medium text-gray-900 dark:text-white" x-text="item.name"></p>
                                                        <p class="text-sm text-gray-600 dark:text-gray-400" x-text="item.quantity + ' x Rp' + item.price.toLocaleString('id-ID')"></p>
                                                    </div>
                                                </div>
                                                <p class="font-medium text-gray-900 dark:text-white">Rp<span x-text="(item.quantity * item.price).toLocaleString('id-ID')"></span></p>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                
                                <!-- Riwayat Pesanan -->
                                <div>
                                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-3">Riwayat Pesanan</h3>
                                    <div class="border-l-2 border-gray-200 dark:border-gray-700 pl-4 space-y-4">
                                        <!-- Pesanan Dibuat -->
                                        <div class="relative">
                                            <div class="absolute -left-5 top-0 w-3 h-3 rounded-full bg-red-500"></div>
                                            <div class="flex justify-between">
                                                <div>
                                                    <p class="font-medium text-gray-900 dark:text-white">Pesanan dibuat</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">Pesanan Anda telah diterima</p>
                                                </div>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">20.05</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Memproses -->
                                        <div x-show="selectedOrder.status !== 'created'" class="relative">
                                            <div class="absolute -left-5 top-0 w-3 h-3 rounded-full bg-yellow-500"></div>
                                            <div class="flex justify-between">
                                                <div>
                                                    <p class="font-medium text-gray-900 dark:text-white">Memproses</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">Memproses makanan</p>
                                                </div>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">20.06</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Siap -->
                                        <div x-show="selectedOrder.status === 'ready' || selectedOrder.status === 'delivered'" class="relative">
                                            <div class="absolute -left-5 top-0 w-3 h-3 rounded-full bg-green-500"></div>
                                            <div class="flex justify-between">
                                                <div>
                                                    <p class="font-medium text-gray-900 dark:text-white">Siap</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">Pesanan sudah siap</p>
                                                </div>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">20.07</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Terkirim -->
                                        <div x-show="selectedOrder.status === 'delivered'" class="relative">
                                            <div class="absolute -left-5 top-0 w-3 h-3 rounded-full bg-blue-500"></div>
                                            <div class="flex justify-between">
                                                <div>
                                                    <p class="font-medium text-gray-900 dark:text-white">Terkirim</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">Pesanan sedang dikirim ke tujuan</p>
                                                </div>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">20.08</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <button @click="showOrderDetail = false" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                        Tutup
                                    </button>
                                    <button x-show="selectedOrder.status === 'ready'" @click="confirmOrder(selectedOrder.id); showOrderDetail = false;" class="px-4 py-2 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg hover:bg-green-200 dark:hover:bg-green-800 transition">
                                        <i class="fas fa-check mr-1"></i> Konfirmasi Pesanan
                                    </button>
                                    <button x-show="selectedOrder.status === 'delivered'" @click="reorder(selectedOrder); showOrderDetail = false;" class="px-4 py-2 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-800 transition">
                                        <i class="fas fa-redo mr-1"></i> Pesan Lagi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Tab -->
                <div x-show="activeTab === 'profile'" class="animate-fadeIn" x-init="loadProfileFromStorage()">
                    <div class="glass rounded-2xl p-6 shadow-xl">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center mb-6">
                            <i class="fas fa-user mr-3 text-red-500"></i>
                            Profil Saya
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-1">
                                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg text-center">
                                    <div class="profile-image-container">
                                        <img :src="profile.profileImage" class="w-32 h-32 rounded-full mx-auto mb-4 border-4 border-red-500">
                                        <div class="profile-image-overlay">
                                            <i class="fas fa-camera text-white text-xl"></i>
                                        </div>
                                        <input type="file" id="profile-image-input" @change="handleProfileImageUpload" accept="image/*">
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white" x-text="profile.firstName + ' ' + profile.lastName"></h3>
                                    <div class="flex justify-center items-center mb-2">
                                        <span class="user-type-badge" :class="profile.userType === 'student' ? 'user-type-student' : 'user-type-teacher'" x-text="profile.userType === 'student' ? 'Siswa' : 'Guru'"></span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 mb-4" x-text="profile.email"></p>
                                    <div class="space-y-2">
                                        <button @click="openUserTypeModal()" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md w-full btn-animate">
                                            <i class="fas fa-exchange-alt mr-2"></i> Ganti Tipe
                                        </button>
                                        <button class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md w-full btn-animate" onclick="document.getElementById('profile-image-input').click()">
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
                                            <input type="text" x-model="profile.firstName" @input="saveProfileToStorage()" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Belakang</label>
                                            <input type="text" x-model="profile.lastName" @input="saveProfileToStorage()" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                            <input type="email" x-model="profile.email" @input="saveProfileToStorage()" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Telepon</label>
                                            <input type="tel" x-model="profile.phone" @input="saveProfileToStorage()" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Lahir</label>
                                            <input type="date" x-model="profile.dateOfBirth" @input="saveProfileToStorage()" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        
                                        <!-- Student specific fields -->
                                        <div x-show="profile.userType === 'student'">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIS</label>
                                            <input type="text" x-model="profile.nis" @input="saveProfileToStorage()" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        <div x-show="profile.userType === 'student'">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kelas</label>
                                            <input type="text" x-model="profile.className" @input="saveProfileToStorage()" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                        
                                        <!-- Teacher specific fields -->
                                        <div x-show="profile.userType === 'teacher'">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIP</label>
                                            <input type="text" x-model="profile.nip" @input="saveProfileToStorage()" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 flex justify-end">
                                        <button @click="updateProfile()" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md btn-animate">
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
                                            <input type="checkbox" x-model="settings.orderNotifications" @change="updateSettings()">
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Promosi</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Terima penawaran promosi</p>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" x-model="settings.promoNotifications" @change="updateSettings()">
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Pengumuman Admin</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Terima pengumuman dari admin</p>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" x-model="settings.adminNotifications" @change="updateSettings()">
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Aksesibilitas</h3>
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Ukuran Teks</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Atur ukuran teks aplikasi</p>
                                        </div>
                                        <button @click="toggleFontSize()" class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                            <span x-text="settings.fontSize === 'small' ? 'Kecil' : settings.fontSize === 'medium' ? 'Sedang' : 'Besar'"></span>
                                        </button>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Kontras Tinggi</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Meningkatkan kontras warna</p>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" x-model="settings.highContrast" @change="updateSettings()">
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Kurangi Animasi</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Kurangi gerakan pada aplikasi</p>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" x-model="settings.reducedMotion" @change="updateSettings()">
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
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
                                </div>
                            </div>
                            
                            <div class="mt-6 bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg md:col-span-2">
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
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <button @click="updateSettings()" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md btn-animate">
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
                            <button @click="openAddPaymentModal()" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md btn-animate">
                                <i class="fas fa-plus mr-2"></i> Tambah Pembayaran
                            </button>
                        </div>
                        
                        <div x-show="paymentMethods.length === 0" class="text-center py-12">
                            <i class="fas fa-credit-card text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                            <p class="text-xl text-gray-600 dark:text-gray-400 mb-2">Belum ada metode pembayaran</p>
                            <p class="text-gray-500 dark:text-gray-500 mb-4">Tambahkan metode pembayaran untuk memudahkan transaksi</p>
                            <button @click="openAddPaymentModal()" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md btn-animate">
                                <i class="fas fa-plus mr-2"></i> Tambah Metode Pembayaran
                            </button>
                        </div>
                        
                        <div x-show="paymentMethods.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <template x-for="payment in paymentMethods" :key="payment.id">
                                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white" x-text="payment.name"></h3>
                                            <p class="text-gray-600 dark:text-gray-400">
                                                <span x-show="payment.type === 'gopay'">GoPay berakhiran </span>
                                                <span x-show="payment.type === 'ovo'">OVO berakhiran </span>
                                                <span x-show="payment.type === 'dana'">DANA berakhiran </span>
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
                                <button @click="updateCartItemQuantity(index, -1)" class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <span class="w-8 text-center font-medium text-gray-900 dark:text-white" x-text="item.quantity"></span>
                                <button @click="updateCartItemQuantity(index, 1)" class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-white hover:bg-red-600 transition">
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
                        <span>Rp<span x-text="cart.reduce((total, item) => total + (item.price * item.quantity), 0).toLocaleString('id-ID')"></span></span>
                    </div>
                </div>
                
                <button @click="showCheckoutModal = true" class="w-full py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md btn-animate">
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
                    
                    <div class="payment-note">
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Catatan Pembayaran</h4>
                        <p class="text-gray-700 dark:text-gray-300" x-text="selectedOrder.paymentNote"></p>
                    </div>
                    
                    <div class="order-timeline">
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Riwayat Pesanan</h4>
                        <div class="border-l-2 border-gray-200 dark:border-gray-700 pl-4 space-y-4">
                        <!-- Pesanan Dibuat -->
                        <div class="relative">
                            <div class="absolute -left-5 top-0 w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="flex justify-between">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">Pesanan dibuat</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Pesanan Anda telah diterima</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Memproses -->
                        <div x-show="selectedOrder.status !== 'created'" class="relative">
                            <div class="absolute -left-5 top-0 w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="flex justify-between">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">Memproses</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Memproses makanan</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Siap -->
                        <div x-show="selectedOrder.status === 'ready' || selectedOrder.status === 'delivered'" class="relative">
                            <div class="absolute -left-5 top-0 w-3 h-3 rounded-full bg-green-500"></div>
                            <div class="flex justify-between">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">Siap</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Pesanan sudah siap</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Terkirim -->
                        <div x-show="selectedOrder.status === 'delivered'" class="relative">
                            <div class="absolute -left-5 top-0 w-3 h-3 rounded-full bg-blue-500"></div>
                            <div class="flex justify-between">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">Terkirim</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Pesanan sedang dikirim ke tujuan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                        <span class="font-bold text-gray-900 dark:text-white">Total</span>
                        <span class="font-bold text-gray-900 dark:text-white">Rp<span x-text="selectedOrder.total.toLocaleString('id-ID')"></span></span>
                    </div>
                    
                    <div class="flex justify-end space-x-2 pt-4">
                        <button x-show="selectedOrder.status === 'processing'" @click="confirmOrder(selectedOrder.id); showOrderDetailModal = false;" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                            <i class="fas fa-check mr-2"></i> Konfirmasi Pesanan
                        </button>
                        <button x-show="selectedOrder.status === 'completed'" @click="reorder(selectedOrder); showOrderDetailModal = false;" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                            <i class="fas fa-redo mr-2"></i> Pesan Lagi
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Checkout Modal -->
        <div x-show="showCheckoutModal" class="modal" @click.self="showCheckoutModal = false">
            <div class="modal-content p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Pembayaran</h3>
                    <button @click="showCheckoutModal = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="space-y-6">
                    <!-- Cart Items -->
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Ringkasan Pesanan</h4>
                        <div class="space-y-3">
                            <template x-for="(item, index) in cart" :key="item.id">
                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                    <div class="flex items-center">
                                        <img :src="item.image" :alt="item.name" class="w-12 h-12 rounded-lg object-cover mr-3">
                                        <div>
                                            <h5 class="font-medium text-gray-900 dark:text-white" x-text="item.name"></h5>
                                            <div class="flex items-center mt-1">
                                                <span class="text-sm text-gray-600 dark:text-gray-400">Rp<span x-text="item.price.toLocaleString('id-ID')"></span></span>
                                                <span class="mx-2 text-gray-300">•</span>
                                                <span class="text-sm text-gray-600 dark:text-gray-400">Jml: <span x-text="item.quantity"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-gray-900 dark:text-white">Rp<span x-text="(item.price * item.quantity).toLocaleString('id-ID')"></span></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    
                    <!-- Total -->
                    <div class="flex justify-between items-center pt-3 border-t border-gray-200 dark:border-gray-700">
                        <span class="font-bold text-lg text-gray-900 dark:text-white">Total</span>
                        <span class="font-bold text-lg text-gray-900 dark:text-white">Rp<span x-text="cart.reduce((total, item) => total + (item.price * item.quantity), 0).toLocaleString('id-ID')"></span></span>
                    </div>
                    
                    <!-- Payment Methods -->
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Pilih Metode Pembayaran</h4>
                        <div class="space-y-3">
                            <template x-for="payment in paymentMethods" :key="payment.id">
                                <div @click="selectedPaymentMethod = payment.id" 
                                     class="payment-method-card" 
                                     :class="{'selected': selectedPaymentMethod === payment.id}">
                                    <div class="flex items-center">
                                        <div class="flex-1">
                                            <div class="flex items-center">
                                                <i class="fas" :class="{
                                                    'fa-money-bill-wave': payment.type === 'gopay' || payment.type === 'ovo' || payment.type === 'dana'
                                                } mr-3 text-lg"></i>
                                                <div>
                                                    <h5 class="font-medium text-gray-900 dark:text-white" x-text="payment.name"></h5>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                                        <span x-show="payment.type === 'gopay'">GoPay berakhiran </span>
                                                        <span x-show="payment.type === 'ovo'">OVO berakhiran </span>
                                                        <span x-show="payment.type === 'dana'">DANA berakhiran </span>
                                                        <span x-text="'****' + payment.last4"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-2">
                                            <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center" :class="{'border-red-500': selectedPaymentMethod === payment.id}">
                                                <div x-show="selectedPaymentMethod === payment.id" class="w-3 h-3 rounded-full bg-red-500"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            
                            <div @click="selectedPaymentMethod = 'cash'" 
                                 class="payment-method-card" 
                                 :class="{'selected': selectedPaymentMethod === 'cash'}">
                                <div class="flex items-center">
                                    <div class="flex-1">
                                        <div class="flex items-center">
                                            <i class="fas fa-money-bill-wave mr-3 text-lg"></i>
                                            <div>
                                                <h5 class="font-medium text-gray-900 dark:text-white">Bayar di Kasir</h5>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">Pembayaran tunai saat pengambilan</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-2">
                                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center" :class="{'border-red-500': selectedPaymentMethod === 'cash'}">
                                            <div x-show="selectedPaymentMethod === 'cash' class="w-3 h-3 rounded-full bg-red-500"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Note -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Catatan untuk kantin</label>
                        <textarea x-model="checkoutNote" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Tambahkan catatan untuk pesanan Anda..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button @click="showCheckoutModal = false" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Batal
                        </button>
                        <button @click="processCheckout()" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md btn-animate">
                            Bayar Sekarang
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
                        <button @click="savePayment()" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md btn-animate">
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
    </div>
</body>
</html>