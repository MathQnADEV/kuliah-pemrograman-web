<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - Pet Hotel & Adopt')</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        .sidebar {
            transition: all 0.3s ease;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e5e7eb;
        }
    </style>
    @yield('styles')
</head>

<body class="bg-gray-50">
    <!-- Mobile Menu Button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="menuToggle" class="btn btn-square btn-ghost border border-gray-200 bg-white shadow-sm">
            <i class="fas fa-bars text-gray-700"></i>
        </button>
    </div>

    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('Admin.layoutsAdmin.sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Bar -->
            @include('Admin.layoutsAdmin.topbar')

            <!-- Page Content -->
            <main class="p-4 md:p-6">
                @if(session('success'))
                    <div class="alert alert-success bg-green-50 border border-green-200 text-green-800 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error bg-red-50 border border-red-200 text-red-800 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info bg-blue-50 border border-blue-200 text-blue-800 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-blue-500 mr-3"></i>
                            <span>{{ session('info') }}</span>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            @include('admin.layoutsAdmin.footer')
        </div>
    </div>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.toggle('active');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const sidebar = document.querySelector('.sidebar');
                const menuToggle = document.getElementById('menuToggle');

                if (window.innerWidth <= 768 && sidebar && menuToggle) {
                    if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                        sidebar.classList.remove('active');
                    }
                }
            });

            // Update time every minute
            function updateTime() {
                const now = new Date();
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                };
                const dateElement = document.querySelector('.date-display');
                if (dateElement) {
                    dateElement.textContent = now.toLocaleDateString('id-ID', options);
                }
            }

            // Initial update
            updateTime();
            // Update every minute
            setInterval(updateTime, 60000);
        });
    </script>
    @yield('scripts')
</body>
</html>
