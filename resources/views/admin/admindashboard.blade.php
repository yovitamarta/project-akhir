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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* CSS Variables for consistent theming */
        :root {
            --primary: #ef4444;
            --primary-hover: #dc2626;
            --secondary: #f97316;
            --accent: #3b82f6;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
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
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            background-attachment: fixed;
            color: var(--text-dark);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
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
        
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        
        @keyframes scaleIn {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
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
        
        .animate-slideIn {
            animation: slideIn 0.5s ease-out forwards;
        }
        
        .animate-scaleIn {
            animation: scaleIn 0.3s ease-out forwards;
        }
        
        .animate-slideUp {
            animation: slideUp 0.5s ease-out forwards;
        }
        
        /* Glassmorphism effect */
        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
        }
        
        /* Dark mode glass */
        .dark .glass {
            background: var(--dark-glass-bg);
            border: 1px solid var(--dark-glass-border);
        }
        
        /* Card hover effects */
        .card-hover {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .card-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }
        
        .card-hover:hover::before {
            transform: translateX(100%);
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
        
        /* Enhanced button styles */
        .btn-primary {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, var(--primary-hover), var(--secondary));
            z-index: -1;
            transition: opacity 0.3s ease;
            opacity: 0;
        }
        
        .btn-primary:hover::before {
            opacity: 1;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        /* Enhanced input styles */
        .input-field {
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.625rem 0.875rem;
            transition: all 0.3s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            width: 100%;
        }
        
        .input-field:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        /* Enhanced card styles */
        .stat-card {
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.3), rgba(255,255,255,0.1));
            transform: translateX(-100%);
            transition: transform 0.6s;
            z-index: -1;
        }
        
        .stat-card:hover::after {
            transform: translateX(100%);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Enhanced table styles */
        .data-table {
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .data-table th {
            background-color: #f9fafb;
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 600;
            color: #4b5563;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .data-table td {
            padding: 0.75rem 1rem;
            border-top: 1px solid #f3f4f6;
        }
        
        .data-table tr:hover {
            background-color: rgba(239, 68, 68, 0.05);
        }
        
        /* Enhanced sidebar styles */
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            margin: 0.25rem 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: var(--primary);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .sidebar-link:hover::before,
        .sidebar-link.active::before {
            transform: scaleY(1);
        }
        
        .sidebar-link:hover {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--primary);
        }
        
        .sidebar-link.active {
            background-color: rgba(239, 68, 68, 0.15);
            color: var(--primary);
            font-weight: 600;
        }
        
        /* Enhanced notification styles */
        .notification-item {
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
            transition: all 0.3s ease;
        }
        
        .notification-item:hover {
            background-color: #f9fafb;
        }
        
        .notification-item.unread {
            background-color: rgba(239, 68, 68, 0.05);
            border-left: 3px solid var(--primary);
        }
        
        /* Enhanced menu item card */
        .menu-card {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1;
        }
        
        .menu-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.3), rgba(255,255,255,0.1));
            transform: translateX(-100%);
            transition: transform 0.6s;
            z-index: -1;
        }
        
        .menu-card:hover::after {
            transform: translateX(100%);
        }
        
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .menu-card-image {
            height: 180px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.5s ease;
        }
        
        .menu-card:hover .menu-card-image {
            transform: scale(1.05);
        }
        
        .menu-card-content {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .menu-card-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }
        
        .menu-card-description {
            color: var(--text-light);
            font-size: 0.875rem;
            margin-bottom: 1rem;
            flex-grow: 1;
        }
        
        .menu-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .menu-card-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
        }
        
        /* Enhanced modal styles */
        .modal-content {
            border-radius: 1rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            max-width: 32rem;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark .modal-content {
            background: rgba(30, 41, 59, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(229, 231, 235, 0.5);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .dark .modal-header {
            border-color: rgba(75, 85, 99, 0.5);
        }
        
        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }
        
        .dark .modal-title {
            color: #f3f4f6;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid rgba(229, 231, 235, 0.5);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }
        
        .dark .modal-footer {
            border-color: rgba(75, 85, 99, 0.5);
        }
        
        /* Enhanced form styles */
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }
        
        .dark .form-label {
            color: #f3f4f6;
        }
        
        .form-control {
            display: block;
            width: 100%;
            padding: 0.625rem 0.875rem;
            font-size: 1rem;
            line-height: 1.5;
            color: var(--text-dark);
            background-color: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }
        
        .dark .form-control {
            background-color: #374151;
            border-color: #4b5563;
            color: #f3f4f6;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        /* Dark mode adjustments */
        .dark body {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }
        
        .dark .data-table th {
            background-color: #374151;
            color: #d1d5db;
        }
        
        .dark .data-table td {
            border-top-color: #4b5563;
        }
        
        .dark .data-table tr:hover {
            background-color: #374151;
        }
        
        .dark .notification-item {
            border-bottom-color: #4b5563;
        }
        
        .dark .notification-item:hover {
            background-color: #374151;
        }
        
        /* Status badge */
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
        
        /* Menu category badge */
        .category-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .category-food {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .category-drink {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .category-dessert {
            background-color: #fef3c7;
            color: #92400e;
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
        
        /* Enhanced search bar */
        .search-container {
            position: relative;
        }
        
        .search-input {
            padding-left: 2.5rem;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            background-color: white;
            transition: all 0.3s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        
        .dark .search-input {
            background-color: #374151;
            border-color: #4b5563;
            color: #f3f4f6;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        
        /* Enhanced notification bell */
        .notification-bell {
            position: relative;
        }
        
        .notification-badge {
            position: absolute;
            top: -0.25rem;
            right: -0.25rem;
            background-color: #f59e0b;
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            min-width: 1.25rem;
            height: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            padding: 0 0.25rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        
        /* Enhanced sidebar toggle */
        .sidebar-toggle {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .dark .sidebar-toggle {
            background-color: #374151;
        }
        
        .sidebar-toggle:hover {
            background-color: #f3f4f6;
        }
        
        .dark .sidebar-toggle:hover {
            background-color: #4b5563;
        }
        
        /* Enhanced user menu */
        .user-menu-button {
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .user-menu-button:hover {
            background-color: #f3f4f6;
        }
        
        .dark .user-menu-button:hover {
            background-color: #374151;
        }
        
        /* Enhanced dropdown */
        .dropdown-menu {
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            background-color: white;
            border: 1px solid rgba(229, 231, 235, 0.5);
            backdrop-filter: blur(10px);
        }
        
        .dark .dropdown-menu {
            background-color: #374151;
            border-color: rgba(75, 85, 99, 0.5);
        }
        
        .dropdown-item {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }
        
        .dropdown-item:hover {
            background-color: #f3f4f6;
        }
        
        .dark .dropdown-item:hover {
            background-color: #4b5563;
        }
        
        /* Enhanced welcome section */
        .welcome-section {
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark .welcome-section {
            background: linear-gradient(135deg, rgba(31, 41, 55, 0.9), rgba(31, 41, 55, 0.7));
            border-color: rgba(255, 255, 255, 0.1);
        }
        
        /* Enhanced footer */
        .footer {
            border-radius: 1rem 1rem 0 0;
            padding: 1rem 1.5rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7));
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark .footer {
            background: linear-gradient(135deg, rgba(31, 41, 55, 0.9), rgba(31, 41, 55, 0.7));
            border-color: rgba(255, 255, 255, 0.1);
        }
        
        /* Social media links */
        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 9999px;
            background-color: #f3f4f6;
            color: #6b7280;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        
        .dark .social-link {
            background-color: #4b5563;
            color: #d1d5db;
        }
        
        /* Enhanced chart container */
        .chart-container {
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark .chart-container {
            background: linear-gradient(135deg, rgba(31, 41, 55, 0.9), rgba(31, 41, 55, 0.7));
            border-color: rgba(255, 255, 255, 0.1);
        }
        
        /* Enhanced pagination */
        .pagination-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 0.375rem;
            background-color: #f3f4f6;
            color: #4b5563;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .pagination-button:hover {
            background-color: #e5e7eb;
        }
        
        .pagination-button.active {
            background-color: var(--primary);
            color: white;
        }
        
        .dark .pagination-button {
            background-color: #4b5563;
            color: #d1d5db;
        }
        
        .dark .pagination-button:hover {
            background-color: #6b7280;
        }
        
        /* Enhanced top selling items */
        .top-selling-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .top-selling-item:hover {
            background-color: #f3f4f6;
        }
        
        .dark .top-selling-item:hover {
            background-color: #374151;
        }
        
        .top-selling-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.5rem;
            margin-right: 0.75rem;
        }
        
        /* Enhanced toggle switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 3rem;
            height: 1.5rem;
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
            border-radius: 1.5rem;
        }
        
        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 1.25rem;
            width: 1.25rem;
            left: 0.125rem;
            bottom: 0.125rem;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .toggle-slider {
            background-color: var(--primary);
        }
        
        input:checked + .toggle-slider:before {
            transform: translateX(1.5rem);
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
        
        /* Focus styles for accessibility */
        a:focus, button:focus, input:focus, select:focus, textarea:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }
        
        /* Skip to content link for accessibility */
        .skip-to-content {
            position: absolute;
            top: -40px;
            left: 0;
            background: var(--primary);
            color: white;
            padding: 8px;
            z-index: 100;
            transition: top 0.3s;
        }
        
        .skip-to-content:focus {
            top: 0;
        }
        
        /* Loading spinner */
        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 4px solid var(--primary);
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* New styles for improved accessibility */
        .focus-visible:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }
        
        /* High contrast mode support */
        @media (prefers-contrast: high) {
            :root {
                --primary: #cc0000;
                --primary-hover: #990000;
                --secondary: #cc6600;
                --accent: #0066cc;
                --success: #009900;
                --warning: #cc9900;
                --danger: #cc0000;
                --text-dark: #000000;
                --text-light: #333333;
                --bg-light: #f0f0f0;
            }
            
            .glass {
                background: rgba(255, 255, 255, 0.9);
                border: 1px solid #000000;
            }
            
            .dark .glass {
                background: rgba(0, 0, 0, 0.9);
                border: 1px solid #ffffff;
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
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                height: 100vh;
                z-index: 50;
                transition: left 0.3s ease;
            }
            
            .sidebar.open {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
        
        /* Enhanced order card styles */
        .order-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }
        
        .order-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .order-card-header {
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
            background: #f9fafb;
        }
        
        .order-card-body {
            padding: 1rem;
        }
        
        .order-card-footer {
            padding: 1rem;
            border-top: 1px solid #f3f4f6;
            background: #f9fafb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* Enhanced filter styles */
        .filter-chip {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            background: #f3f4f6;
            color: #4b5563;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        
        .filter-chip:hover {
            background: #e5e7eb;
        }
        
        .filter-chip.active {
            background: var(--primary);
            color: white;
        }
        
        .filter-chip i {
            margin-right: 0.5rem;
        }
        
        /* Enhanced action button styles */
        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            background: transparent;
        }
        
        .action-button:hover {
            background: #f3f4f6;
        }
        
        .action-button.view:hover {
            color: #3b82f6;
        }
        
        .action-button.edit:hover {
            color: #f59e0b;
        }
        
        .action-button.delete:hover {
            color: #ef4444;
        }
        
        .action-button.success:hover {
            color: #10b981;
        }
        
        .dark .action-button:hover {
            background: #374151;
        }
        
        /* Enhanced order status timeline */
        .order-timeline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 1rem 0;
        }
        
        .timeline-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
        }
        
        .timeline-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 1rem;
            left: 50%;
            width: 100%;
            height: 2px;
            background: #e5e7eb;
            z-index: -1;
        }
        
        .timeline-step.completed::after {
            background: var(--primary);
        }
        
        .timeline-dot {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .timeline-step.completed .timeline-dot {
            background: var(--primary);
        }
        
        .timeline-step.active .timeline-dot {
            background: var(--primary);
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.2);
        }
        
        .timeline-label {
            font-size: 0.75rem;
            color: #6b7280;
            text-align: center;
        }
        
        .timeline-step.completed .timeline-label {
            color: var(--primary);
            font-weight: 600;
        }
        
        /* Sync notification styles */
        .sync-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            border-left: 4px solid var(--primary);
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 1rem 1.5rem;
            z-index: 1000;
            display: flex;
            align-items: center;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }
        
        .sync-notification.show {
            transform: translateX(0);
        }
        
        .sync-notification i {
            color: var(--primary);
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }
        
        .sync-notification-content {
            flex: 1;
        }
        
        .sync-notification-title {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }
        
        .sync-notification-message {
            font-size: 0.875rem;
            color: var(--text-light);
        }
        
        /* Menu item highlight for new items */
        .menu-item-new {
            position: relative;
        }
        
        .menu-item-new::before {
            content: 'NEW';
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--primary);
            color: white;
            font-size: 0.625rem;
            font-weight: 700;
            padding: 0.125rem 0.375rem;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            z-index: 10;
        }
    </style>
</head>
<body class="min-h-screen selection:bg-red-500 selection:text-white">
    <a href="#main-content" class="skip-to-content">Skip to main content</a>
    
        <div :class="darkMode ? 'dark' : ''" class="flex h-screen" x-data="{ 
                open: true, 
                darkMode: false, 
                userMenu: false,
                notifCount: 5,
                loading: true,
                activeTab: 'dashboard',
                notifications: [
                    { id: 1, title: 'New Order', message: 'Order #ORD-125 has been placed', time: '2 min ago', read: false },
                    { id: 2, title: 'Payment Received', message: 'Payment from customer #456', time: '15 min ago', read: false },
                    { id: 3, title: 'Low Stock Alert', message: 'Nasi Goreng is running low', time: '1 hour ago', read: true },
                    { id: 4, title: 'New Review', message: '5-star review from customer', time: '3 hours ago', read: true },
                    { id: 5, title: 'System Update', message: 'System will undergo maintenance', time: '5 hours ago', read: true }
                ],
                showNotifications: false,
                stats: {
                    orders: 0,
                    revenue: 0,
                    pending: 0,
                    customers: 0
                },
                profile: JSON.parse(localStorage.getItem('userProfile')) || {
                    nama: 'admin kantin',
                    email: 'admin@gmail.com',
                    telepon: '08511278034',
                    bio: 'kantin SMK 1 Sayung',
                    avatar: ''
                },

                // Fungsi untuk mengunggah avatar
                uploadAvatar(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            // Update avatar di data
                            this.profile.avatar = e.target.result;
                            
                            // Simpan ke localStorage
                            this.saveProfileToStorage();
                            
                            // Tampilkan notifikasi
                            this.showNotification('Foto profil berhasil diperbarui!', 'success');
                        };
                        reader.readAsDataURL(file);
                    }
                },

                // Fungsi untuk menyimpan profil ke localStorage
                saveProfileToStorage() {
                    localStorage.setItem('userProfile', JSON.stringify(this.profile));
                },

                // Fungsi untuk memperbarui profil
                updateProfile() {
                    // Validasi input
                    if (!this.profile.nama.trim()) {
                        this.showNotification('Nama tidak boleh kosong!', 'error');
                        return;
                    }
                    
                    if (!this.profile.email.trim()) {
                        this.showNotification('Email tidak boleh kosong!', 'error');
                        return;
                    }
                    
                    // Validasi format email
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(this.profile.email)) {
                        this.showNotification('Format email tidak valid!', 'error');
                        return;
                    }
                    
                    // Simpan profil ke localStorage
                    this.saveProfileToStorage();
                    
                    // Tampilkan notifikasi sukses
                    this.showNotification('Profil berhasil diperbarui!', 'success');
                    
                    // Di sini biasanya akan ada AJAX call ke server untuk menyimpan data
                    console.log('Profil disimpan:', this.profile);
                },
                searchQuery: '',
                searchResults: [],
                showProfileModal: false,
                showOrderModal: false,
                selectedOrder: null,
                orders: [],
                menuItems: [],
                showMenuModal: false,
                editingMenu: null,
                newMenu: {
                    name: '',
                    description: '',
                    price: 0,
                    category: 'food',
                    image: '',
                    rating: 4.5,
                    badge: ''
                },
                language: 'en',
                translations: {
                    en: {
                        dashboard: 'Dashboard',
                        orders: 'Orders',
                        menu: 'Menu',
                        reports: 'Reports',
                        settings: 'Settings',
                        profile: 'Profile',
                        totalOrders: 'Total Orders',
                        revenue: 'Revenue',
                        pendingOrders: 'Pending Orders',
                        customers: 'Customers',
                        welcome: 'Welcome back',
                        searchPlaceholder: 'Search orders, customers...',
                        notifications: 'Notifications',
                        viewAll: 'View All',
                        addNew: 'Add New',
                        edit: 'Edit',
                        delete: 'Delete',
                        save: 'Save',
                        cancel: 'Cancel',
                        close: 'Close',
                        preparing: 'Preparing',
                        ready: 'Ready',
                        delivered: 'Delivered',
                        cancelled: 'Cancelled',
                        food: 'Food',
                        drink: 'Drink',
                        dessert: 'Dessert',
                gorengan: 'Gorengan',
                        menuSynced: 'Menu successfully synced to user dashboard!',
                        menuAdded: 'New menu item added and synced!'
                    },
                    id: {
                        dashboard: 'Dashboard',
                        orders: 'Pesanan',
                        menu: 'Menu',
                        reports: 'Laporan',
                        settings: 'Pengaturan',
                        profile: 'Profil',
                        totalOrders: 'Total Pesanan',
                        revenue: 'Pendapatan',
                        pendingOrders: 'Pesanan Menunggu',
                        customers: 'Pelanggan',
                        welcome: 'Selamat datang kembali',
                        searchPlaceholder: 'Cari pesanan, pelanggan...',
                        notifications: 'Notifikasi',
                        viewAll: 'Lihat Semua',
                        addNew: 'Tambah Baru',
                        edit: 'Edit',
                        delete: 'Hapus',
                        save: 'Simpan',
                        cancel: 'Batal',
                        close: 'Tutup',
                        preparing: 'Memproses',
                        ready: 'Siap',
                        delivered: 'Terkirim',
                        cancelled: 'Dibatalkan',
                        food: 'Makanan',
                        drink: 'Minuman',
                        dessert: 'Dessert',
                gorengan: 'Gorengan',
                        menuSynced: 'Menu berhasil disinkronkan ke dashboard user!',
                        menuAdded: 'Item menu baru ditambahkan dan disinkronkan!'
                    }
                },
                get t() {
                    return this.translations[this.language];
                },
                // Pagination properties
                currentPage: 1,
                itemsPerPage: 5,
                statusFilter: 'all',
                dateFilter: 'all',
                // Sync notification properties
                showSyncNotification: false,
                syncNotificationMessage: '',
                syncNotificationTitle: '',
                // Chart data
                revenueData: [],
                orderStatusData: [],
                customerActivityData: [],
                topSellingItemsData: [],
                // Order counter for generating new order IDs
                orderCounter: 1,
                init() {
                    // Check user preference for dark mode
                    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        this.darkMode = true;
                    }
                    
                    // Check for saved language preference
                    const savedLanguage = localStorage.getItem('language');
                    if (savedLanguage && this.translations[savedLanguage]) {
                        this.language = savedLanguage;
                    }
                    
                    this.loading = false;
                    
                    // Reset orders and start fresh
                    this.resetOrders();
                    
                    // Load menu items from localStorage
                    this.loadMenuItems();
                    
                    // Load profile from localStorage
                    this.loadProfileFromStorage();
                    
                    // Listen for menu updates from other tabs/windows
                    this.setupMenuSyncListener();
                    
                    // Listen for order updates from user dashboard
                    this.setupOrderSyncListener();
                    
                    // Listen for new orders from user dashboard
                    this.setupNewOrderListener();
                    
                    // Update stats based on orders
                    this.updateStats();
                    
                    // Update chart data
                    this.updateChartData();
                    
                    // Check for new orders periodically
                    setInterval(() => { 
                        this.loadOrders();
                        this.updateStats();
                        this.updateChartData();
                        
                        if (this.notifCount < 99) this.notifCount++; 
                    }, 15000);
                },
                setupMenuSyncListener() {
                    // Listen for storage events (when localStorage changes in another tab)
                    window.addEventListener('storage', (event) => {
                        if (event.key === 'mealyung_menu_items') {
                            // Reload menu items when they change in another tab
                            this.loadMenuItems();
                            this.showSyncNotification = true;
                            this.syncNotificationTitle = 'Menu Updated';
                            this.syncNotificationMessage = this.t.menuSynced;
                            
                            // Hide notification after 3 seconds
                            setTimeout(() => {
                                this.showSyncNotification = false;
                            }, 3000);
                        }
                    });
                    
                    // Listen for custom menu update events
                    window.addEventListener('menuUpdated', (event) => {
                        this.loadMenuItems();
                        this.showSyncNotification = true;
                        this.syncNotificationTitle = 'Menu Updated';
                        this.syncNotificationMessage = this.t.menuSynced;
                        
                        // Hide notification after 3 seconds
                        setTimeout(() => {
                            this.showSyncNotification = false;
                        }, 3000);
                    });
                },
                setupOrderSyncListener() {
                    // Listen for storage events (when localStorage changes in another tab)
                    window.addEventListener('storage', (event) => {
                        if (event.key === 'mealyungOrders') {
                            // Reload orders when they change in another tab
                            this.loadOrders();
                            this.updateStats();
                            this.updateChartData();
                            
                            // Show notification for new order
                            const savedOrders = localStorage.getItem('mealyungOrders');
                            if (savedOrders) {
                                const orders = JSON.parse(savedOrders);
                                if (orders.length > this.orders.length) {
                                    this.notifCount++;
                                    this.showNotification('Pesanan baru diterima!', 'info');
                                }
                            }
                        }
                    });
                    
                    // Listen for custom order update events
                    window.addEventListener('orderUpdated', (event) => {
                        this.loadOrders();
                        this.updateStats();
                        this.updateChartData();
                    });
                },
                setupNewOrderListener() {
                    // Listen for new order events from user dashboard
                    window.addEventListener('newOrderPlaced', (event) => {
                        // Get the order data from the event
                        const newOrder = event.detail;
                        
                        // Add customer info to the order
                        const customerInfo = JSON.parse(localStorage.getItem('mealyungProfile')) || {
                            firstName: 'Pelanggan',
                            lastName: ''
                        };
                        
                        // Create admin order object
                        const adminOrder = {
                            ...newOrder,
                            customer: customerInfo.firstName + ' ' + customerInfo.lastName,
                            phone: customerInfo.phone || '',
                            address: ''
                        };
                        
                        // Add to orders array
                        this.orders.unshift(adminOrder);
                        
                        // Save to localStorage
                        this.saveOrders();
                        
                        // Update stats and charts
                        this.updateStats();
                        this.updateChartData();
                        
                        // Increment notification count
                        this.notifCount++;
                        
                        // Show notification
                        this.showNotification(`Pesanan baru dari ${adminOrder.customer}!`, 'success');
                        
                        // Play sound notification if available
                        this.playNotificationSound();
                    });
                },
                playNotificationSound() {
                    // Create audio context for notification sound
                    try {
                        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                        const oscillator = audioContext.createOscillator();
                        const gainNode = audioContext.createGain();
                        
                        oscillator.connect(gainNode);
                        gainNode.connect(audioContext.destination);
                        
                        oscillator.type = 'sine';
                        oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
                        oscillator.frequency.setValueAtTime(600, audioContext.currentTime + 0.1);
                        
                        gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                        gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);
                        
                        oscillator.start(audioContext.currentTime);
                        oscillator.stop(audioContext.currentTime + 0.5);
                    } catch (e) {
                        console.log('Audio notification not supported');
                    }
                },
                loadProfileFromStorage() {
                    const savedProfile = localStorage.getItem('userProfile');
                    if (savedProfile) {
                        this.profile = JSON.parse(savedProfile);
                    }
                },
                resetOrders() {
                    // Clear existing orders from localStorage
                    localStorage.removeItem('mealyungOrders');
                    localStorage.removeItem('adminOrders');
                    
                    // Reset orders array
                    this.orders = [];
                    
                    // Reset order counter
                    this.orderCounter = 1;
                    
                    // Save empty orders
                    this.saveOrders();
                    
                    // Also reset user orders
                    localStorage.removeItem('mealyung_orders');
                },
                loadOrders() {
                    // Load orders from localStorage
                    const savedOrders = localStorage.getItem('mealyungOrders');
                    if (savedOrders) {
                        this.orders = JSON.parse(savedOrders);
                        
                        // Update order counter to the highest order ID + 1
                        if (this.orders.length > 0) {
                            const highestOrderId = Math.max(...this.orders.map(order => {
                                const match = order.id.match(/ORD-(\d+)/);
                                return match ? parseInt(match[1]) : 0;
                            }));
                            this.orderCounter = highestOrderId + 1;
                        }
                    }
                    
                    // Load orders from user dashboard
                    this.loadUserOrders();
                },
                loadUserOrders() {
                    // Load orders from user dashboard
                    const userOrders = localStorage.getItem('mealyung_orders');
                    if (userOrders) {
                        const orders = JSON.parse(userOrders);
                        
                        // Add user orders to admin orders if they don't exist
                        orders.forEach(userOrder => {
                            if (!this.orders.find(order => order.id === userOrder.id)) {
                                // Add customer info to user order
                                const customerInfo = JSON.parse(localStorage.getItem('mealyungProfile')) || {
                                    firstName: 'Pelanggan',
                                    lastName: ''
                                };
                                
                                this.orders.push({
                                    ...userOrder,
                                    customer: customerInfo.firstName + ' ' + customerInfo.lastName,
                                    phone: customerInfo.phone || '',
                                    address: ''
                                });
                            }
                        });
                        
                        this.saveOrders();
                    }
                },
                saveOrders() {
                    // Save orders to localStorage
                    localStorage.setItem('mealyungOrders', JSON.stringify(this.orders));
                },
                loadMenuItems() {
                    // Load menu items from localStorage
                    const savedMenuItems = localStorage.getItem('mealyung_menu_items');
                    if (savedMenuItems) {
                        this.menuItems = JSON.parse(savedMenuItems);
                    } else {
                        // Default menu items if none saved
                        this.menuItems = [
                            { 
                                id: 1, 
                                name: 'Nasi Goreng Spesial', 
                                description: 'Nasi goreng dengan telur, ayam, dan sosis.', 
                                price: 7000, 
                                category: 'food', 
                                image: 'https://i.pinimg.com/1200x/94/82/ab/9482ab2e248d249e7daa7fd6924c8d3b.jpg', 
                                rating: 4.8, 
                                badge: 'Bestseller' 
                            },
                            { 
                                id: 2, 
                                name: 'Bakso Jumbo', 
                                description: 'Bakso sapi dengan kuah segar dan sambal.', 
                                price: 10000, 
                                category: 'food', 
                                image: 'https://i.pinimg.com/736x/80/81/50/80815088a9ead2ca5491f55f8620712f.jpg', 
                                rating: 4.6, 
                                badge: 'New' 
                            },
                            { 
                                id: 3, 
                                name: 'Mie Ayam', 
                                description: 'Mie ayam dengan kuah kaldu dan sayuran segar.', 
                                price: 6000, 
                                category: 'food', 
                                image: 'https://i.pinimg.com/736x/12/e3/42/12e3428d9e726a3a8cac72cdc4c28297.jpg', 
                                rating: 4.7, 
                                badge: '' 
                            },
                            { 
                                id: 4, 
                                name: 'Es Teh Manis', 
                                description: 'Teh manis dingin dengan es batu.', 
                                price: 3000, 
                                category: 'drink', 
                                image: 'https://i.pinimg.com/736x/63/30/04/633004a76c6f03ab9665d8cce7dade47.jpg', 
                                rating: 4.5, 
                                badge: '' 
                            },
                            { 
                                id: 5, 
                                name: 'Es Jeruk', 
                                description: 'Jeruk segar diperas dengan es batu.', 
                                price: 4000, 
                                category: 'drink', 
                                image: 'https://i.pinimg.com/1200x/59/bb/fd/59bbfd2e5107ecc820fc0a8f39e1620f.jpg', 
                                rating: 4.6, 
                                badge: '' 
                            },
                            { 
                                id: 6, 
                                name: 'Brownies', 
                                description: 'Brownies lembut dan legit dengan rasa cokelat pekat yang memanjakan lidah.', 
                                price: 3000, 
                                category: 'dessert', 
                                image: 'https://i.pinimg.com/1200x/6a/ed/44/6aed44243d963e6b8c39fc733a68e38f.jpg ', 
                                rating: 4.9, 
                                badge: 'terlaris' 
                            }
                        ];
                        this.saveMenuItems();
                    }
                },
                saveMenuItems() {
                    // Save menu items to localStorage
                    localStorage.setItem('mealyung_menu_items', JSON.stringify(this.menuItems));
                    
                    // Dispatch custom event for menu update
                    const menuUpdateEvent = new CustomEvent('menuUpdated', {
                        detail: {
                            menuItems: this.menuItems,
                            timestamp: new Date().toISOString()
                        }
                    });
                    
                    // Dispatch to current window
                    window.dispatchEvent(menuUpdateEvent);
                    
                    // Also trigger storage event for other tabs
                    localStorage.setItem('mealyung_menu_last_update', new Date().toISOString());
                },
                updateStats() {
                    // Calculate stats based on orders
                    this.stats.orders = this.orders.length;
                    this.stats.revenue = this.orders.reduce((sum, order) => sum + order.total, 0);
                    this.stats.pending = this.orders.filter(order => order.status === 'preparing' || order.status === 'ready').length;
                    
                    // Calculate unique customers
                    const uniqueCustomers = new Set(this.orders.map(order => order.customer));
                    this.stats.customers = uniqueCustomers.size;
                },
                updateChartData() {
                    // Update Revenue Trend data
                    this.revenueData = this.generateRevenueData();
                    
                    // Update Order Status Distribution data
                    this.orderStatusData = this.generateOrderStatusData();
                    
                    // Update Customer Activity data
                    this.customerActivityData = this.generateCustomerActivityData();
                    
                    // Update Top Selling Items data
                    this.topSellingItemsData = this.generateTopSellingItemsData();
                },
                generateRevenueData() {
                    // Generate revenue data for the last 7 days
                    const revenueData = [];
                    const today = new Date();
                    
                    for (let i = 6; i >= 0; i--) {
                        const date = new Date(today);
                        date.setDate(date.getDate() - i);
                        
                        const dateStr = date.toISOString().split('T')[0];
                        const ordersOnDate = this.orders.filter(order => order.date === dateStr);
                        const revenue = ordersOnDate.reduce((sum, order) => sum + order.total, 0);
                        
                        revenueData.push({
                            date: date.toLocaleDateString('id-ID', { weekday: 'short' }),
                            revenue: revenue
                        });
                    }
                    
                    return revenueData;
                },
                generateOrderStatusData() {
                    // Generate order status distribution data
                    const statusCounts = {
                        preparing: 0,
                        ready: 0,
                        delivered: 0,
                        cancelled: 0
                    };
                    
                    this.orders.forEach(order => {
                        if (statusCounts.hasOwnProperty(order.status)) {
                            statusCounts[order.status]++;
                        }
                    });
                    
                    return [
                        { status: 'preparing', count: statusCounts.preparing, label: 'Memproses' },
                        { status: 'ready', count: statusCounts.ready, label: 'Siap' },
                        { status: 'delivered', count: statusCounts.delivered, label: 'Terkirim' },
                        { status: 'cancelled', count: statusCounts.cancelled, label: 'Dibatalkan' }
                    ];
                },
                generateCustomerActivityData() {
                    // Generate customer activity data for the last 7 days
                    const activityData = [];
                    const today = new Date();
                    
                    for (let i = 6; i >= 0; i--) {
                        const date = new Date(today);
                        date.setDate(date.getDate() - i);
                        
                        const dateStr = date.toISOString().split('T')[0];
                        const ordersOnDate = this.orders.filter(order => order.date === dateStr);
                        
                        // Count unique customers for this date
                        const customersOnDate = new Set(ordersOnDate.map(order => order.customer));
                        
                        activityData.push({
                            date: date.toLocaleDateString('id-ID', { weekday: 'short' }),
                            customers: customersOnDate.size
                        });
                    }
                    
                    return activityData;
                },
                generateTopSellingItemsData() {
                    // Generate top selling items data
                    const itemCounts = {};
                    
                    this.orders.forEach(order => {
                        if (order.itemsList) {
                            order.itemsList.forEach(item => {
                                if (itemCounts[item.name]) {
                                    itemCounts[item.name] += item.quantity;
                                } else {
                                    itemCounts[item.name] = item.quantity;
                                }
                            });
                        }
                    });
                    
                    // Convert to array and sort by count
                    const topItems = Object.keys(itemCounts)
                        .map(name => ({ name, count: itemCounts[name] }))
                        .sort((a, b) => b.count - a.count)
                        .slice(0, 5); // Get top 5 items
                    
                    return topItems;
                },
                showNotification(message, type = 'info') {
                    // Create a simple toast notification
                    const toast = document.createElement('div');
                    toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white z-50 ${
                        type === 'success' ? 'bg-green-500' : 
                        type === 'error' ? 'bg-red-500' : 
                        type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500'
                    }`;
                    toast.textContent = message;
                    
                    document.body.appendChild(toast);
                    
                    // Remove after 3 seconds
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 3000);
                },
                logout() {
                    if (confirm('Are you sure you want to logout?')) {
                        window.location.href = 'welcome.bade.php';
                    }
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
                    // Find order by ID
                    this.selectedOrder = this.orders.find(order => order.id === orderId);
                    if (this.selectedOrder) {
                        this.showOrderModal = true;
                    } else {
                        alert('Order not found');
                    }
                },
                updateOrderStatus(status) {
                    if (this.selectedOrder) {
                        this.selectedOrder.status = status;
                        this.saveOrders();
                        this.updateStats();
                        this.updateChartData();
                        
                        // If status is 'ready', update the order in user dashboard
                        if (status === 'ready') {
                            this.updateUserOrderStatus(this.selectedOrder.id, 'ready');
                        }
                        
                        alert(`Order status updated to ${status}`);
                        this.showOrderModal = false;
                    }
                },
                updateUserOrderStatus(orderId, status) {
                    // Update order status in user dashboard
                    const userOrders = localStorage.getItem('mealyung_orders');
                    if (userOrders) {
                        const orders = JSON.parse(userOrders);
                        const orderIndex = orders.findIndex(order => order.id === orderId);
                        
                        if (orderIndex !== -1) {
                            orders[orderIndex].status = status;
                            localStorage.setItem('mealyung_orders', JSON.stringify(orders));
                            
                            // Dispatch custom event for order update
                            const orderUpdateEvent = new CustomEvent('orderUpdated', {
                                detail: {
                                    orderId: orderId,
                                    status: status,
                                    timestamp: new Date().toISOString()
                                }
                            });
                            
                            // Dispatch to current window
                            window.dispatchEvent(orderUpdateEvent);
                            
                            // Also trigger storage event for other tabs
                            localStorage.setItem('mealyung_order_last_update', new Date().toISOString());
                        }
                    }
                },
                openAddMenuModal() {
                    this.editingMenu = null;
                    this.newMenu = {
                        name: '',
                        description: '',
                        price: 0,
                        category: 'food',
                        image: '',
                        rating: 4.5,
                        badge: ''
                    };
                    this.showMenuModal = true;
                },
                openEditMenuModal(menuItem) {
                    this.editingMenu = menuItem;
                    this.newMenu = { ...menuItem };
                    this.showMenuModal = true;
                },
                saveMenuItem() {
                    if (this.editingMenu) {
                        // Update existing menu item
                        const index = this.menuItems.findIndex(item => item.id === this.editingMenu.id);
                        if (index !== -1) {
                            this.menuItems[index] = { ...this.newMenu };
                        }
                        alert('Menu item updated successfully!');
                    } else {
                        // Add new menu item
                        const newId = this.menuItems.length > 0 ? Math.max(...this.menuItems.map(item => item.id)) + 1 : 1;
                        const newItem = {
                            id: newId,
                            ...this.newMenu
                        };
                        
                        this.menuItems.push(newItem);
                        
                        // Show success notification
                        this.showSyncNotification = true;
                        this.syncNotificationTitle = 'Menu Added';
                        this.syncNotificationMessage = this.t.menuAdded;
                        
                        // Hide notification after 3 seconds
                        setTimeout(() => {
                            this.showSyncNotification = false;
                        }, 3000);
                        
                        alert('Menu item added successfully!');
                    }
                    
                    this.saveMenuItems();
                    this.showMenuModal = false;
                },
                deleteMenuItem(menuId) {
                    if (confirm('Are you sure you want to delete this menu item?')) {
                        this.menuItems = this.menuItems.filter(item => item.id !== menuId);
                        this.saveMenuItems();
                        alert('Menu item deleted successfully!');
                    }
                },
                changeLanguage(lang) {
                    this.language = lang;
                    localStorage.setItem('language', lang);
                },
                exportData(format) {
                    // Simulate data export
                    alert(`Exporting data in ${format.toUpperCase()} format...`);
                },
                printReport() {
                    // Simulate print functionality
                    alert('Preparing report for printing...');
                    setTimeout(() => {
                        window.print();
                    }, 1000);
                },
                // Pagination methods
                get filteredOrders() {
                    let filtered = this.orders;
                    
                    if (this.statusFilter !== 'all') {
                        filtered = filtered.filter(order => order.status === this.statusFilter);
                    }
                    
                    if (this.dateFilter !== 'all') {
                        const today = new Date();
                        const filterDate = new Date();
                        
                        if (this.dateFilter === 'today') {
                            filterDate.setDate(today.getDate() - 1);
                        } else if (this.dateFilter === 'week') {
                            filterDate.setDate(today.getDate() - 7);
                        } else if (this.dateFilter === 'month') {
                            filterDate.setMonth(today.getMonth() - 1);
                        }
                        
                        filtered = filtered.filter(order => new Date(order.date) >= filterDate);
                    }
                    
                    return filtered;
                },
                get paginatedOrders() {
                    const filtered = this.filteredOrders;
                    const startIndex = (this.currentPage - 1) * this.itemsPerPage;
                    const endIndex = startIndex + this.itemsPerPage;
                    return filtered.slice(startIndex, endIndex);
                },
                get totalPages() {
                    return Math.ceil(this.filteredOrders.length / this.itemsPerPage);
                },
                changePage(page) {
                    if (page >= 1 && page <= this.totalPages) {
                        this.currentPage = page;
                    }
                },
                setStatusFilter(status) {
                    this.statusFilter = status;
                    this.currentPage = 1; // Reset to first page when filter changes
                },
                setDateFilter(date) {
                    this.dateFilter = date;
                    this.currentPage = 1; // Reset to first page when filter changes
                }
            }">
        
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

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 text-gray-700 dark:text-gray-300 font-medium">
                <template x-for="item in [
                    {id: 'dashboard', icon: 'fa-home', label: t.dashboard},
                    {id: 'orders', icon: 'fa-shopping-cart', label: t.orders},
                    {id: 'menu', icon: 'fa-utensils', label: t.menu},
                    {id: 'reports', icon: 'fa-chart-line', label: t.reports},
                    {id: 'profile', icon: 'fa-user-circle', label: t.profile}
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
                        <img :src="profile.avatar" class="w-9 h-9 rounded-full border-2 border-gray-300 dark:border-gray-600"/>
                        <div x-show="open" class="text-left">
                            <p class="text-gray-800 dark:text-gray-200 font-medium" x-text="profile.name"></p>
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
                            <i class="fas fa-user-circle mr-2"></i> <span x-text="t.profile"></span>
                        </a>
                        <a @click="activeTab = 'settings'; userMenu = false" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg mx-1 my-1 transition-colors">
                            <i class="fas fa-cog mr-2"></i> <span x-text="t.settings"></span>
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
                        <span class="text-gray-500 dark:text-gray-400 text-2xl" x-text="t.welcome + ','"></span>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight select-none">
                            <span x-show="!loading" x-text="profile.name"></span>
                            <span x-show="loading" class="skeleton h-6 w-32 rounded inline-block"></span>
                        </h2>
                    </div>
                    <div class="flex items-center space-x-5">
                        <div class="relative">
                            <input class="w-64 max-w-xs px-4 py-3 rounded-xl border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 shadow-sm" 
                                   :placeholder="t.searchPlaceholder" 
                                   type="text"
                                   x-model="searchQuery"
                                   @input="performSearch()">
                                <i class="fas fa-search absolute top-3.5 right-4 text-gray-400 pointer-events-none"></i>
                            
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
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white" x-text="t.notifications"></h3>
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
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Main Content -->
            <main id="main-content" class="flex-1 overflow-y-auto p-6 space-y-8">
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
                                    Pantau dan kelola operasi restoran Anda dari satu lokasi pusat.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                   <!-- Overview Cards -->
                    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Total Orders -->
                        <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white p-6 rounded-2xl shadow-xl card-hover animate-fadeIn" style="animation-delay: 0.1s">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-sm uppercase opacity-90 tracking-wider font-semibold" x-text="t.totalOrders"></h3>
                                    <p class="text-4xl font-extrabold mt-2 drop-shadow-lg" x-text="stats.orders.toLocaleString()"></p>
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
                                    <h3 class="text-sm uppercase opacity-90 tracking-wider font-semibold" x-text="t.revenue"></h3>
                                    <p class="text-4xl font-extrabold mt-2 drop-shadow-lg">Rp<span x-text="stats.revenue.toLocaleString('id-ID')"></span></p>
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
                                    <h3 class="text-sm uppercase opacity-90 tracking-wider font-semibold" x-text="t.pendingOrders"></h3>
                                    <p class="text-4xl font-extrabold mt-2 drop-shadow-lg" x-text="stats.pending"></p>
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
                                    <h3 class="text-sm uppercase opacity-90 tracking-wider font-semibold" x-text="t.customers"></h3>
                                    <p class="text-4xl font-extrabold mt-2 drop-shadow-lg" x-text="stats.customers.toLocaleString()"></p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl shadow-lg animate-float" style="animation-delay: 1.5s">
                                    <i class="fas fa-users text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Recent Orders -->
                    <section class="glass rounded-2xl p-6 shadow-xl animate-fadeIn" style="animation-delay: 0.7s">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-shopping-cart mr-3 text-red-500"></i>
                                <span x-text="t.orders"></span>
                            </h2>
                            <a @click="activeTab = 'orders'" href="#" class="text-red-600 hover:text-red-700 transition-colors" x-text="t.viewAll"></a>
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
                                    <template x-for="order in orders.slice(0, 5)" :key="order.id">
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer" @click="viewOrder(order.id)">
                                            <td class="py-3 px-4 font-mono text-gray-900 dark:text-white" x-text="order.id"></td>
                                            <td class="py-3 px-4 text-gray-700 dark:text-gray-300">
                                                <div class="flex items-center">
                                                    <img :src="`https://i.pravatar.cc/30?u=${order.customer}`" class="w-8 h-8 rounded-full mr-2">
                                                    <span x-text="order.customer"></span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4 text-gray-700 dark:text-gray-300">
                                                <span x-text="order.itemsList.map(item => item.name).join(', ')"></span>
                                            </td>
                                            <td class="py-3 px-4 font-semibold text-gray-900 dark:text-white">Rp<span x-text="order.total.toLocaleString('id-ID')"></span></td>
                                            <td class="py-3 px-4">
                                                <span class="status-badge" :class="'status-' + order.status" x-text="order.status.charAt(0).toUpperCase() + order.status.slice(1)"></span>
                                            </td>
                                            <td class="py-3 px-4 text-gray-700 dark:text-gray-300" x-text="order.date"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
                
                    <!-- Orders Tab -->
                    <div x-show="activeTab === 'orders'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="animate-fadeIn" x-data="ordersData()">
                        <div class="glass rounded-2xl p-6 shadow-xl">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                    <i class="fas fa-shopping-cart mr-3 text-red-500"></i>
                                    <span x-text="t.orders + ' Management'"></span>
                                </h2>
            
                    <!-- Filter Controls -->
                    <div class="flex flex-wrap gap-3">
                        <!-- Status Filter -->
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Status:</span>
                            <div class="flex space-x-1">
                                <button @click="setStatusFilter('all')" 
                                        :class="{'bg-red-500 text-white': statusFilter === 'all', 'bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300': statusFilter !== 'all'}" 
                                        class="px-3 py-1 rounded-lg text-sm font-medium transition-colors">
                                    All
                                </button>
                                <button @click="setStatusFilter('preparing')" 
                                        :class="{'bg-yellow-500 text-white': statusFilter === 'preparing', 'bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300': statusFilter !== 'preparing'}" 
                                        class="px-3 py-1 rounded-lg text-sm font-medium transition-colors">
                                    <span x-text="t.preparing"></span>
                                </button>
                                <button @click="setStatusFilter('ready')" 
                                        :class="{'bg-blue-500 text-white': statusFilter === 'ready', 'bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300': statusFilter !== 'ready'}" 
                                        class="px-3 py-1 rounded-lg text-sm font-medium transition-colors">
                                    <span x-text="t.ready"></span>
                                </button>
                                <button @click="setStatusFilter('delivered')" 
                                        :class="{'bg-green-500 text-white': statusFilter === 'delivered', 'bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300': statusFilter !== 'delivered'}" 
                                        class="px-3 py-1 rounded-lg text-sm font-medium transition-colors">
                                    <span x-text="t.delivered"></span>
                                </button>
                                <button @click="setStatusFilter('cancelled')" 
                                        :class="{'bg-red-500 text-white': statusFilter === 'cancelled', 'bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300': statusFilter !== 'cancelled'}" 
                                        class="px-3 py-1 rounded-lg text-sm font-medium transition-colors">
                                    <span x-text="t.cancelled"></span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Date Filter -->
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Date:</span>
                            <select @change="setDateFilter($event.target.value)" class="px-3 py-1 border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                                <option value="all">All Time</option>
                                <option value="today">Today</option>
                                <option value="week">Last 7 Days</option>
                                <option value="month">Last 30 Days</option>
                            </select>
                        </div>
                        
                        <!-- Items Per Page -->
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Show:</span>
                            <select x-model="itemsPerPage" @change="currentPage = 1" class="px-3 py-1 border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Orders Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    <template x-for="order in paginatedOrders" :key="order.id">
                        <div class="order-card animate-fadeIn">
                            <div class="order-card-header">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-900 dark:text-white" x-text="order.id"></h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400" x-text="order.date"></p>
                                    </div>
                                    <span class="status-badge" :class="'status-' + order.status" x-text="order.status.charAt(0).toUpperCase() + order.status.slice(1)"></span>
                                </div>
                            </div>
                            
                            <div class="order-card-body">
                                <div class="flex items-center mb-3">
                                    <img :src="`https://i.pravatar.cc/40?u=${order.customer}`" class="w-10 h-10 rounded-full mr-3">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white" x-text="order.customer"></p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400" x-text="order.phone"></p>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Items:</p>
                                    <div class="space-y-1">
                                        <template x-for="item in order.itemsList" :key="item.name">
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-600 dark:text-gray-400" x-text="item.name"></span>
                                                <span class="text-gray-900 dark:text-white">Rp<span x-text="(item.price * item.quantity).toLocaleString('id-ID')"></span></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                
                                <!-- Order Status Timeline -->
                                <div class="order-timeline">
                                    <div class="timeline-step" :class="{'completed': order.status === 'delivered' || order.status === 'ready' || order.status === 'preparing', 'active': order.status === 'preparing'}">
                                        <div class="timeline-dot">
                                            <i class="fas fa-receipt text-xs"></i>
                                        </div>
                                        <span class="timeline-label">Order</span>
                                    </div>
                                    <div class="timeline-step" :class="{'completed': order.status === 'delivered' || order.status === 'ready', 'active': order.status === 'ready'}">
                                        <div class="timeline-dot">
                                            <i class="fas fa-utensils text-xs"></i>
                                        </div>
                                        <span class="timeline-label" x-text="t.preparing"></span>
                                    </div>
                                    <div class="timeline-step" :class="{'completed': order.status === 'delivered', 'active': order.status === 'ready'}">
                                        <div class="timeline-dot">
                                            <i class="fas fa-check text-xs"></i>
                                        </div>
                                        <span class="timeline-label" x-text="t.ready"></span>
                                    </div>
                                    <div class="timeline-step" :class="{'completed': order.status === 'delivered', 'active': order.status === 'delivered'}">
                                        <div class="timeline-dot">
                                            <i class="fas fa-truck text-xs"></i>
                                        </div>
                                        <span class="timeline-label" x-text="t.delivered"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="order-card-footer">
                                <div class="text-lg font-bold text-red-600">Rp<span x-text="order.total.toLocaleString('id-ID')"></span></div>
                                <div class="flex space-x-2">
                                    <button @click="viewOrder(order.id)" class="action-button view" title="View Order">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button @click="updateOrderStatus(order.id, 'preparing')" class="action-button edit" :title="t.preparing" x-show="order.status !== 'preparing' && order.status !== 'ready' && order.status !== 'delivered'">
                                        <i class="fas fa-clock"></i>
                                    </button>
                                    <button @click="updateOrderStatus(order.id, 'ready')" class="action-button success" :title="t.ready" x-show="order.status === 'preparing'">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button @click="updateOrderStatus(order.id, 'delivered')" class="action-button success" :title="t.delivered" x-show="order.status === 'ready'">
                                        <i class="fas fa-truck"></i>
                                    </button>
                                    <button @click="updateOrderStatus(order.id, 'cancelled')" class="action-button delete" :title="t.cancelled" x-show="order.status !== 'delivered' && order.status !== 'cancelled'">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                
                <!-- Pagination -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 bg-white dark:bg-gray-800 rounded-xl p-4">
                    <div class="text-sm text-gray-1000 dark:text-gray-400">
                        Showing <span class="font-semibold" x-text="(currentPage - 1) * itemsPerPage + 1"></span> to 
                        <span class="font-semibold" x-text="Math.min(currentPage * itemsPerPage, filteredOrders.length)"></span> of 
                        <span class="font-semibold" x-text="filteredOrders.length"></span> orders
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <!-- Previous Button -->
                        <button @click="changePage(currentPage - 1)" 
                                :disabled="currentPage === 1"
                                :class="{'opacity-50 cursor-not-allowed': currentPage === 1, 'hover:bg-gray-200 dark:hover:bg-gray-600': currentPage !== 1}"
                                class="px-3 py-2 rounded-lg transition-colors">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        
                        <!-- Page Numbers -->
                        <template x-for="page in Math.min(5, totalPages)" :key="page">
                            <button @click="changePage(page)" 
                                    :class="{'bg-red-500 text-white': page === currentPage, 'hover:bg-gray-200 dark:hover:bg-gray-600': page !== currentPage}"
                                    class="w-10 h-10 rounded-lg font-medium transition-colors"
                                    x-text="page">
                            </button>
                        </template>
                        
                        <!-- Next Button -->
                        <button @click="changePage(currentPage + 1)" 
                                :disabled="currentPage === totalPages"
                                :class="{'opacity-50 cursor-not-allowed': currentPage === totalPages, 'hover:bg-gray-200 dark:hover:bg-gray-600': currentPage !== totalPages}"
                                class="px-3 py-2 rounded-lg transition-colors">
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
                            <span x-text="t.menu + ' Management'"></span>
                        </h2>
                        <button @click="openAddMenuModal()" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                            <i class="fas fa-plus mr-2"></i> <span x-text="t.addNew + ' ' + t.menu + ' Item'"></span>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <template x-for="menuItem in menuItems" :key="menuItem.id">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                                <div class="relative">
                                    <img :alt="menuItem.name" class="w-full h-48 object-cover" height="250" :src="menuItem.image" width="400"/>
                                    <div x-show="menuItem.badge" class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full" x-text="menuItem.badge"></div>
                                    <div class="absolute top-3 left-3">
                                        <span class="category-badge" :class="'category-' + menuItem.category" x-text="t[menuItem.category]"></span>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white" x-text="menuItem.name"></h3>
                                        <div class="flex items-center text-yellow-400">
                                            <i class="fas fa-star"></i>
                                            <span class="ml-1 text-gray-700 dark:text-gray-300" x-text="menuItem.rating"></span>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 mb-4" x-text="menuItem.description"></p>
                                    <div class="flex justify-between items-center">
                                        <span class="font-extrabold text-red-600 text-xl">Rp<span x-text="menuItem.price.toLocaleString('id-ID')"></span></span>
                                        <div class="flex space-x-2">
                                            <button @click="openEditMenuModal(menuItem)" class="text-blue-600 hover:text-blue-800" :title="t.edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button @click="deleteMenuItem(menuItem.id)" class="text-red-600 hover:text-red-800" :title="t.delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                
                <!-- Reports Tab -->
                <div x-show="activeTab === 'reports'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="animate-fadeIn">
                    <div class="glass rounded-2xl p-6 shadow-xl">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                <i class="fas fa-chart-line mr-3 text-red-500"></i>
                                <span x-text="t.reports"></span>
                            </h2>
                            <div class="flex space-x-3">
                                <select class="px-4 py-2 border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                                    <option>Last 7 Days</option>
                                    <option>Last 30 Days</option>
                                    <option>Last 90 Days</option>
                                    <option>Last Year</option>
                                </select>
                                <button @click="window.open('https://docs.google.com/document/d/1jiooUNGOG-ogIIkOzqIwHYWC6eNKzkkKAUAbCKFPhWo/edit?tab=t.0#heading=h.y6uf39yo8p8p')" class="px-5 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md">
                                    <i class="fas fa-download mr-2"></i> Export Data
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
                            <div class="glass rounded-2xl p-6 shadow-xl animate-fadeIn bg-white dark:bg-gray-800" style="animation-delay: 0.6s">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Orders by Category</h3>
                            <div class="h-64">
                                <canvas id="ordersChart"></canvas>
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
                            <span x-text="t.settings"></span>
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
                            <span x-text="t.profile + ' Settings'"></span>
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
                                    </div>
                                </div>
                            </div>
                            
                            <div class="lg:col-span-2">
                                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Akun</h3>
                                    <div class="space-y-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Depan</label>
                                                <input type="text" x-model="profile.name" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                                <input type="email" x-model="profile.email" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Telepon</label>
                                                <input type="text" x-model="profile.phone" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bio</label>
                                                <input type="text" x-model="profile.bio" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                            </div>
                                        </div>
                                        <div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 flex justify-end">
                                        <button @click="updateProfile" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                                          Simpan Perubahan
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
        
        <!-- Sync Notification -->
        <div x-show="showSyncNotification" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-4"
             class="sync-notification">
            <i class="fas fa-sync-alt"></i>
            <div class="sync-notification-content">
                <div class="sync-notification-title" x-text="syncNotificationTitle"></div>
                <div class="sync-notification-message" x-text="syncNotificationMessage"></div>
            </div>
        </div>
        
        <!-- Profile Modal -->
        <div x-show="showProfileModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 modal">
            <div class="absolute inset-0 modal-backdrop" @click="showProfileModal = false"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-md w-full p-6 transform transition-all">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white" x-text="t.edit + ' ' + t.profile"></h3>
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
                        <span x-text="t.cancel"></span>
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
                        <p class="font-medium text-gray-900 dark:text-white" x-text="selectedOrder.itemsList.map(item => item.name).join(', ')"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total</p>
                        <p class="font-medium text-gray-900 dark:text-white">Rp<span x-text="selectedOrder.total.toLocaleString('id-ID')"></span></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                        <span class="status-badge" :class="'status-' + selectedOrder.status" x-text="selectedOrder.status.charAt(0).toUpperCase() + selectedOrder.status.slice(1)"></span>
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
                        <button @click="updateOrderStatus('preparing')" class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition" x-text="t.preparing"></button>
                        <button @click="updateOrderStatus('ready')" class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition" x-text="t.ready"></button>
                        <button @click="updateOrderStatus('delivered')" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition" x-text="t.delivered"></button>
                        <button @click="updateOrderStatus('cancelled')" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition" x-text="t.cancelled"></button>
                    </div>
                    <button @click="showOrderModal = false" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition" x-text="t.close"></button>
                </div>
            </div>
        </div>
        
        <!-- Menu Modal -->
        <div x-show="showMenuModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 modal">
            <div class="absolute inset-0 modal-backdrop" @click="showMenuModal = false"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-md w-full p-6 transform transition-all">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white" x-text="(editingMenu ? t.edit : 'Add') + ' ' + t.menu + ' Item'"></h3>
                    <button @click="showMenuModal = false" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                        <input type="text" x-model="newMenu.name" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                        <textarea x-model="newMenu.description" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" rows="3"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Price (Rp)</label>
                        <input type="number" x-model="newMenu.price" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                        <select x-model="newMenu.category" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="food" x-text="t.food"></option>
                            <option value="drink" x-text="t.drink"></option>
                            <option value="dessert" x-text="t.dessert"></option>
			                <option value="gorengan" x-text="t.gorengan"></option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Image URL</label>
                        <input type="text" x-model="newMenu.image" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rating</label>
                        <input type="number" x-model="newMenu.rating" min="0" max="5" step="0.1" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Badge (optional)</label>
                        <input type="text" x-model="newMenu.badge" placeholder="e.g. Bestseller, New" class="w-full px-4 py-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button @click="showMenuModal = false" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition" x-text="t.cancel"></button>
                    <button @click="saveMenuItem" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md" x-text="editingMenu ? t.save : 'Add'"></button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
    // ========== REVENUE CHART ==========
    const revenueCtx = document.getElementById("revenueChart");
    if (revenueCtx) {
        new Chart(revenueCtx.getContext("2d"), {
            type: "bar", // Mengubah dari line ke bar untuk sesuai dengan tampilan cards
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May"],
                datasets: [{
                    label: "Revenue (Rp)",
                    data: [10000000, 15000000, 12000000, 18000000, 24560000],
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.8)',  // Merah untuk konsistensi dengan cards
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgb(239, 68, 68)',
                        'rgb(239, 68, 68)',
                        'rgb(239, 68, 68)',
                        'rgb(239, 68, 68)',
                        'rgb(239, 68, 68)'
                    ],
                    borderWidth: 1,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Menyembunyikan legend untuk tampilan yang lebih clean
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#ef4444',
                        titleFont: {
                            weight: 'bold'
                        },
                        bodyColor: '#1f2937',
                        bodyFont: {
                            weight: '500'
                        },
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(239, 68, 68, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#ef4444',
                            font: {
                                weight: 'bold'
                            },
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return (value / 1000000) + ' jt';
                                } else if (value >= 1000) {
                                    return (value / 1000) + ' rb';
                                }
                                return value;
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#ef4444',
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
    }

    // ========== ORDERS CHART ==========
    const ordersCtx = document.getElementById("ordersChart");
    if (ordersCtx) {
        new Chart(ordersCtx.getContext("2d"), {
            type: "doughnut",
            data: {
                labels: ["Food", "Drinks", "Desserts", "Gorengan"],
                datasets: [{
                    data: [65, 25, 10, 15],
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.8)',  // Merah untuk konsistensi
                        'rgba(249, 115, 22, 0.8)', // Orange untuk minuman
                        'rgba(245, 158, 11, 0.8)',  // Kuning untuk makanan penutup
                        'rgba(83, 255, 15, 0.8)'   // Hijau untuk lauk pauk
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
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
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#ef4444',
                        titleFont: {
                            weight: 'bold'
                        },
                        bodyColor: '#1f2937',
                        bodyFont: {
                            weight: '500'
                        },
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${percentage}% (${value})`;
                            }
                        }
                    }
                }
            }
        });
    }

    // ========== REVENUE REPORT CHART ==========
    const revenueReportCtx = document.getElementById("revenueReportChart");
    if (revenueReportCtx) {
        new Chart(revenueReportCtx.getContext("2d"), {
            type: "bar",
            data: {
                labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                datasets: [{
                    label: "Revenue (Rp)",
                    data: [3200000, 4100000, 3800000, 5100000, 4900000, 6200000, 5800000],
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgb(239, 68, 68)',
                        'rgb(239, 68, 68)',
                        'rgb(239, 68, 68)',
                        'rgb(239, 68, 68)',
                        'rgb(239, 68, 68)',
                        'rgb(239, 68, 68)',
                        'rgb(239, 68, 68)'
                    ],
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#ef4444',
                        titleFont: {
                            weight: 'bold'
                        },
                        bodyColor: '#1f2937',
                        bodyFont: {
                            weight: '500'
                        },
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(239, 68, 68, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#ef4444',
                            font: {
                                weight: 'bold'
                            },
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return (value / 1000000) + ' jt';
                                } else if (value >= 1000) {
                                    return (value / 1000) + ' rb';
                                }
                                return value;
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#ef4444',
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
    }
            });
            </script>
            <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('adminDashboard', () => ({
                // Data yang ada tetap sama...
                
                init() {
                    // Memuat data dari localStorage saat inisialisasi
                    this.loadFromLocalStorage();
                    
                    // Jika tidak ada data di localStorage, gunakan data default
                    if (!this.stats.orders) {
                        this.fetchDashboardData();
                    }
                    
                    // Inisialisasi chart setelah data dimuat
                    this.$nextTick(() => {
                        this.initCharts();
                    });
                },
                
                // Fungsi untuk menyimpan data ke localStorage
                saveToLocalStorage() {
                    const dataToSave = {
                        stats: this.stats,
                        orders: this.orders,
                        menuItems: this.menuItems,
                        lastUpdated: new Date().toISOString()
                    };
                    localStorage.setItem('mealyungDashboardData', JSON.stringify(dataToSave));
                },
                
                // Fungsi untuk memuat data dari localStorage
                loadFromLocalStorage() {
                    const savedData = localStorage.getItem('mealyungDashboardData');
                    if (savedData) {
                        const data = JSON.parse(savedData);
                        this.stats = data.stats || this.stats;
                        this.orders = data.orders || this.orders;
                        this.menuItems = data.menuItems || this.menuItems;
                        
                        // Periksa apakah data sudah kedaluwarsa (lebih dari 24 jam)
                        if (data.lastUpdated) {
                            const lastUpdated = new Date(data.lastUpdated);
                            const now = new Date();
                            const hoursDiff = (now - lastUpdated) / (1000 * 60 * 60);
                            
                            if (hoursDiff > 24) {
                                // Jika data lebih dari 24 jam, refresh data dari server
                                this.fetchDashboardData();
                            }
                        }
                    }
                },
                
                // Fungsi untuk mengambil data dari server (API)
                fetchDashboardData() {
                    // Simulasi pengambilan data dari server
                    // Dalam implementasi nyata, ini akan menjadi panggilan API
                    setTimeout(() => {
                        // Update data dengan data baru dari server
                        this.stats = {
                            orders: 1242,
                            revenue: 45678000,
                            pending: 18,
                            customers: 856
                        };
                        
                        // Simpan data baru ke localStorage
                        this.saveToLocalStorage();
                        
                        // Update chart dengan data baru
                        this.updateCharts();
                    }, 1000);
                },
                
                // Override fungsi yang memodifikasi data untuk menyimpan ke localStorage
                updateOrderStatus(status) {
                    // Logika update status pesanan yang sudah ada...
                    
                    // Setelah update, simpan ke localStorage
                    this.saveToLocalStorage();
                },
                
                addMenuItem() {
                    // Logika tambah menu item yang sudah ada...
                    
                    // Setelah menambah, simpan ke localStorage
                    this.saveToLocalStorage();
                },
                
                deleteMenuItem(id) {
                    // Logika hapus menu item yang sudah ada...
                    
                    // Setelah menghapus, simpan ke localStorage
                    this.saveToLocalStorage();
                },
                
                // Fungsi untuk memaksa refresh data dari server
                refreshData() {
                    this.fetchDashboardData();
                    this.showSyncNotification = true;
                    this.syncNotificationTitle = "Data Refreshed";
                    this.syncNotificationMessage = "Dashboard data has been updated from server";
                    
                    setTimeout(() => {
                        this.showSyncNotification = false;
                    }, 3000);
                }
            }));
        });
        </script>
        <script>
        // Dashboard Stats Component
        function dashboardStats() {
            return {
                stats: {
                    orders: 0,
                    revenue: 0,
                    pending: 0,
                    customers: 0,
                    ordersChange: '+12',
                    revenueChange: '+8',
                    customersChange: '+15',
                    avgWaitTime: 15
                },
                socket: null,
                
                init() {
                    // Load stats from localStorage
                    this.loadStatsFromStorage();
                    
                    // Setup event listeners
                    this.setupEventListeners();
                    
                    // Setup WebSocket connection
                    this.setupWebSocket();
                    
                    // Setup polling for updates
                    this.setupPolling();
                },
                
                // Load stats from localStorage
                loadStatsFromStorage() {
                    const savedStats = localStorage.getItem('dashboardStats');
                    if (savedStats) {
                        try {
                            this.stats = JSON.parse(savedStats);
                        } catch (e) {
                            console.error('Error parsing saved stats:', e);
                        }
                    }
                },
                
                // Save stats to localStorage
                saveStatsToStorage() {
                    localStorage.setItem('dashboardStats', JSON.stringify(this.stats));
                },
                
                // Setup event listeners
                setupEventListeners() {
                    // Listen for new order events
                    document.addEventListener('newOrder', (event) => {
                        if (event.detail && event.detail.order) {
                            this.updateStatsWithNewOrder(event.detail.order);
                        }
                    });
                    
                    // Listen for order status updates
                    document.addEventListener('orderStatusUpdated', (event) => {
                        if (event.detail && event.detail.orderId && event.detail.status) {
                            this.updateStatsWithStatusChange(event.detail.orderId, event.detail.status);
                        }
                    });
                },
                
                // Setup WebSocket connection
                setupWebSocket() {
                    try {
                        this.socket = new WebSocket('wss://your-websocket-server.com');
                        
                        this.socket.onopen = () => {
                            console.log('Dashboard stats WebSocket connected');
                        };
                        
                        this.socket.onmessage = (event) => {
                            const data = JSON.parse(event.data);
                            
                            if (data.type === 'statsUpdate') {
                                this.stats = data.stats;
                                this.saveStatsToStorage();
                            } else if (data.type === 'newOrder') {
                                this.updateStatsWithNewOrder(data.order);
                            } else if (data.type === 'orderStatusUpdate') {
                                this.updateStatsWithStatusChange(data.orderId, data.status);
                            }
                        };
                        
                        this.socket.onerror = (error) => {
                            console.error('WebSocket error:', error);
                        };
                        
                        this.socket.onclose = () => {
                            console.log('WebSocket connection closed');
                            // Attempt to reconnect after 5 seconds
                            setTimeout(() => {
                                this.setupWebSocket();
                            }, 5000);
                        };
                    } catch (error) {
                        console.error('WebSocket setup error:', error);
                    }
                },
                
                // Setup polling for stats updates
                setupPolling() {
                    // Polling every 30 seconds
                    setInterval(() => {
                        this.fetchStatsFromServer();
                    }, 30000);
                },
                
                // Fetch stats from server
                async fetchStatsFromServer() {
                    try {
                        const response = await fetch('/api/dashboard/stats');
                        if (response.ok) {
                            const data = await response.json();
                            this.stats = data;
                            this.saveStatsToStorage();
                        }
                    } catch (error) {
                        console.error('Error fetching stats:', error);
                    }
                },
                
                // Update stats with new order
                updateStatsWithNewOrder(order) {
                    // Increment orders count
                    this.stats.orders++;
                    
                    // Add to revenue
                    this.stats.revenue += order.total;
                    
                    // Increment pending count if status is pending
                    if (order.status === 'pending') {
                        this.stats.pending++;
                    }
                    
                    // Check if customer is new
                    const customers = JSON.parse(localStorage.getItem('customers') || '[]');
                    const existingCustomer = customers.find(c => c.id === order.customerId);
                    if (!existingCustomer) {
                        this.stats.customers++;
                        // Add to customers list
                        customers.push({
                            id: order.customerId,
                            name: order.customer,
                            phone: order.phone
                        });
                        localStorage.setItem('customers', JSON.stringify(customers));
                    }
                    
                    // Save updated stats
                    this.saveStatsToStorage();
                    
                    // Show notification
                    this.showNotification(`New order: ${order.id}`, 'new');
                    
                    // Play notification sound
                    this.playNotificationSound();
                },
                
                // Update stats with status change
                updateStatsWithStatusChange(orderId, newStatus) {
                    // Find the order
                    const orders = JSON.parse(localStorage.getItem('restaurantOrders') || '[]');
                    const order = orders.find(o => o.id === orderId);
                    
                    if (!order) return;
                    
                    // Update pending count based on status change
                    if (order.status === 'pending' && newStatus !== 'pending') {
                        this.stats.pending--;
                    } else if (order.status !== 'pending' && newStatus === 'pending') {
                        this.stats.pending++;
                    }
                    
                    // Update order status
                    order.status = newStatus;
                    localStorage.setItem('restaurantOrders', JSON.stringify(orders));
                    
                    // Save updated stats
                    this.saveStatsToStorage();
                },
                
                // Show notification
                showNotification(message, type = 'info') {
                    // Create a toast notification
                    const toast = document.createElement('div');
                    const bgColor = type === 'success' ? 'bg-green-500' : type === 'new' ? 'bg-red-500' : 'bg-blue-500';
                    
                    toast.className = `fixed bottom-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fadeIn`;
                    toast.innerHTML = `
                        <div class="flex items-center">
                            <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'new' ? 'fa-bell' : 'fa-info-circle'} mr-2"></i>
                            <span>${message}</span>
                        </div>
                    `;
                    
                    document.body.appendChild(toast);
                    
                    // Remove after 3 seconds
                    setTimeout(() => {
                        toast.classList.add('opacity-0');
                        setTimeout(() => {
                            document.body.removeChild(toast);
                        }, 300);
                    }, 3000);
                },
                
                // Play notification sound
                playNotificationSound() {
                    try {
                        const audio = new Audio('/sounds/notification.mp3');
                        audio.play().catch(e => console.log('Audio play failed:', e));
                    } catch (error) {
                        console.log('Audio play failed:', error);
                    }
                }
            }
        }

        // Orders Management Component
        function ordersManagement() {
            return {
                orders: [],
                statusFilter: 'all',
                dateFilter: 'all',
                currentPage: 1,
                itemsPerPage: 10,
                newOrdersCount: 0,
                socket: null,
                
                init() {
                    // Load orders from localStorage
                    this.loadOrdersFromStorage();
                    
                    // Setup event listeners
                    this.setupEventListeners();
                    
                    // Setup WebSocket connection
                    this.setupWebSocket();
                    
                    // Setup polling for updates
                    this.setupPolling();
                },
                
                // Load orders from localStorage
                loadOrdersFromStorage() {
                    const savedOrders = localStorage.getItem('restaurantOrders');
                    if (savedOrders) {
                        try {
                            this.orders = JSON.parse(savedOrders);
                            // Check for new orders
                            this.checkForNewOrders();
                        } catch (e) {
                            console.error('Error parsing saved orders:', e);
                            this.orders = [];
                        }
                    } else {
                        this.orders = [];
                    }
                },
                
                // Save orders to localStorage
                saveOrdersToStorage() {
                    localStorage.setItem('restaurantOrders', JSON.stringify(this.orders));
                },
                
                // Check for new orders
                checkForNewOrders() {
                    const lastViewed = localStorage.getItem('lastOrdersViewed') || '0';
                    const lastViewedTime = new Date(parseInt(lastViewed));
                    
                    this.newOrdersCount = this.orders.filter(order => {
                        const orderTime = new Date(order.createdAt || order.date);
                        return orderTime > lastViewedTime && order.status === 'pending';
                    }).length;
                },
                
                // Setup WebSocket connection
                setupWebSocket() {
                    try {
                        this.socket = new WebSocket('wss://your-websocket-server.com');
                        
                        this.socket.onopen = () => {
                            console.log('Orders WebSocket connected');
                        };
                        
                        this.socket.onmessage = (event) => {
                            const data = JSON.parse(event.data);
                            
                            if (data.type === 'newOrder') {
                                this.addNewOrder(data.order);
                            } else if (data.type === 'orderStatusUpdate') {
                                this.updateOrderStatusInList(data.orderId, data.status);
                            }
                        };
                        
                        this.socket.onerror = (error) => {
                            console.error('WebSocket error:', error);
                        };
                        
                        this.socket.onclose = () => {
                            console.log('WebSocket connection closed');
                            // Attempt to reconnect after 5 seconds
                            setTimeout(() => {
                                this.setupWebSocket();
                            }, 5000);
                        };
                    } catch (error) {
                        console.error('WebSocket setup error:', error);
                    }
                },
                
                // Setup event listeners
                setupEventListeners() {
                    // Listen for new order events
                    document.addEventListener('newOrder', (event) => {
                        if (event.detail && event.detail.order) {
                            this.addNewOrder(event.detail.order);
                        }
                    });
                    
                    // Listen for order status updates
                    document.addEventListener('orderStatusUpdated', (event) => {
                        if (event.detail && event.detail.orderId && event.detail.status) {
                            this.updateOrderStatusInList(event.detail.orderId, event.detail.status);
                        }
                    });
                    
                    // Update last viewed time when tab becomes active
                    document.addEventListener('visibilitychange', () => {
                        if (!document.hidden) {
                            localStorage.setItem('lastOrdersViewed', Date.now().toString());
                            this.newOrdersCount = 0;
                        }
                    });
                },
                
                // Setup polling for order updates
                setupPolling() {
                    // Polling every 30 seconds
                    setInterval(() => {
                        this.fetchOrdersFromServer();
                    }, 30000);
                },
                
                // Fetch orders from server
                async fetchOrdersFromServer() {
                    try {
                        const response = await fetch('/api/orders');
                        if (response.ok) {
                            const data = await response.json();
                            this.orders = data;
                            this.saveOrdersToStorage();
                            this.checkForNewOrders();
                        }
                    } catch (error) {
                        console.error('Error fetching orders:', error);
                    }
                },
                
                // Refresh orders manually
                async refreshOrders() {
                    await this.fetchOrdersFromServer();
                    this.showNotification('Orders refreshed successfully', 'success');
                },
                
                // Add new order to the list
                addNewOrder(order) {
                    // Mark as new
                    order.isNew = true;
                    
                    // Add to the beginning of the array
                    this.orders.unshift(order);
                    
                    // Save to localStorage
                    this.saveOrdersToStorage();
                    
                    // Increment new orders count
                    this.newOrdersCount++;
                    
                    // Show notification
                    this.showNotification(`New order received: ${order.id}`, 'new');
                    
                    // Play notification sound
                    this.playNotificationSound();
                },
                
                // Update order status in the list
                updateOrderStatusInList(orderId, newStatus) {
                    const orderIndex = this.orders.findIndex(order => order.id === orderId);
                    if (orderIndex !== -1) {
                        this.orders[orderIndex].status = newStatus;
                        this.saveOrdersToStorage();
                        this.showNotification(`Order ${orderId} status updated to ${newStatus}`, 'success');
                    }
                },
                
                // Show notification
                showNotification(message, type = 'info') {
                    // Create a toast notification
                    const toast = document.createElement('div');
                    const bgColor = type === 'success' ? 'bg-green-500' : type === 'new' ? 'bg-red-500' : 'bg-blue-500';
                    
                    toast.className = `fixed bottom-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fadeIn`;
                    toast.innerHTML = `
                        <div class="flex items-center">
                            <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'new' ? 'fa-bell' : 'fa-info-circle'} mr-2"></i>
                            <span>${message}</span>
                        </div>
                    `;
                    
                    document.body.appendChild(toast);
                    
                    // Remove after 3 seconds
                    setTimeout(() => {
                        toast.classList.add('opacity-0');
                        setTimeout(() => {
                            document.body.removeChild(toast);
                        }, 300);
                    }, 3000);
                },
                
                // Play notification sound
                playNotificationSound() {
                    try {
                        const audio = new Audio('/sounds/notification.mp3');
                        audio.play().catch(e => console.log('Audio play failed:', e));
                    } catch (error) {
                        console.log('Audio play failed:', error);
                    }
                },
                
                // Filter orders based on status and date
                get filteredOrders() {
                    let filtered = [...this.orders];
                    
                    // Status filter
                    if (this.statusFilter !== 'all') {
                        filtered = filtered.filter(order => order.status === this.statusFilter);
                    }
                    
                    // Date filter
                    if (this.dateFilter !== 'all') {
                        const now = new Date();
                        let startDate;
                        
                        switch (this.dateFilter) {
                            case 'today':
                                startDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
                                break;
                            case 'week':
                                startDate = new Date(now);
                                startDate.setDate(now.getDate() - 7);
                                break;
                            case 'month':
                                startDate = new Date(now);
                                startDate.setDate(now.getDate() - 30);
                                break;
                        }
                        
                        if (startDate) {
                            filtered = filtered.filter(order => {
                                const orderDate = new Date(order.createdAt || order.date);
                                return orderDate >= startDate;
                            });
                        }
                    }
                    
                    return filtered;
                },
                
                // Get paginated orders
                get paginatedOrders() {
                    const startIndex = (this.currentPage - 1) * this.itemsPerPage;
                    const endIndex = startIndex + parseInt(this.itemsPerPage);
                    return this.filteredOrders.slice(startIndex, endIndex);
                },
                
                // Get total pages
                get totalPages() {
                    return Math.ceil(this.filteredOrders.length / this.itemsPerPage);
                },
                
                // Change page
                changePage(page) {
                    if (page >= 1 && page <= this.totalPages) {
                        this.currentPage = page;
                    }
                },
                
                // Set status filter
                setStatusFilter(status) {
                    this.statusFilter = status;
                    this.currentPage = 1;
                },
                
                // Set date filter
                setDateFilter(date) {
                    this.dateFilter = date;
                    this.currentPage = 1;
                },
                
                // View order details
                viewOrder(orderId) {
                    // Implement view order logic
                    console.log('View order:', orderId);
                    // You can open a modal or navigate to order details page
                },
                
                // Update order status
                async updateOrderStatus(orderId, newStatus) {
                    try {
                        // Send update to server
                        const response = await fetch(`/api/orders/${orderId}/status`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ status: newStatus })
                        });
                        
                        if (response.ok) {
                            // Update local data
                            this.updateOrderStatusInList(orderId, newStatus);
                            
                            // Trigger event for other components
                            const event = new CustomEvent('orderStatusUpdated', {
                                detail: { orderId, status: newStatus }
                            });
                            document.dispatchEvent(event);
                        } else {
                            console.error('Failed to update order status');
                            this.showNotification('Failed to update order status', 'error');
                        }
                    } catch (error) {
                        console.error('Error updating order status:', error);
                        this.showNotification('Error updating order status', 'error');
                    }
                }
            }
        }

        // Function to trigger new order event (can be called from anywhere)
        function triggerNewOrderEvent(order) {
            const event = new CustomEvent('newOrder', { detail: { order } });
            document.dispatchEvent(event);
        }

        // Function to trigger order status update event (can be called from anywhere)
        function triggerOrderStatusUpdateEvent(orderId, status) {
            const event = new CustomEvent('orderStatusUpdated', { detail: { orderId, status } });
            document.dispatchEvent(event);
        }
        </script>
        
</body>
</html>