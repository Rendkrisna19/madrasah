<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - SI Madrasah</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Space Grotesk"', 'sans-serif'] },
                    colors: {
                        madrasah: {
                            50: '#ecfdf5', 100: '#d1fae5', 200: '#a7f3d0', 300: '#6ee7b7', 
                            400: '#34d399', 500: '#10b981', 600: '#059669', 700: '#047857',
                        }
                    }
                }
            }
        }
    </script>
    
    @livewireStyles
</head>
<body class="font-sans antialiased text-gray-800 bg-[#f8fafc] flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden" @click="sidebarOpen = false"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-100 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0 flex flex-col justify-between">
        
        <div>
            <div class="h-16 flex items-center px-6 border-b border-gray-50">
                <i class="ph ph-book-open text-2xl text-madrasah-600 mr-2"></i>
                <h1 class="text-xl font-bold text-madrasah-600 tracking-tight">SI Madrasah</h1>
            </div>
            
            <nav class="p-4 space-y-1 overflow-y-auto">
                <p class="px-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-2">Menu Utama</p>
                
                <a href="{{ route('admin.dashboard') }}" wire:navigate 
                   class="flex items-center px-3 py-2.5 rounded-lg font-medium transition group {{ request()->routeIs('admin.dashboard') ? 'bg-madrasah-600 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-madrasah-600' }}">
                    <i class="ph ph-squares-four text-lg mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-madrasah-600' }}"></i>
                    Overview
                </a>
                
                <a href="{{ route('admin.cms') }}" wire:navigate 
                   class="flex items-center px-3 py-2.5 rounded-lg font-medium transition group {{ request()->routeIs('admin.cms*') ? 'bg-madrasah-600 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-madrasah-600' }}">
                    <i class="ph ph-browser text-lg mr-3 {{ request()->routeIs('admin.cms*') ? 'text-white' : 'text-gray-400 group-hover:text-madrasah-600' }}"></i>
                    Kelola CMS
                </a>

              <a href="{{ route('admin.akademik') }}" wire:navigate 
   class="flex items-center px-3 py-2.5 rounded-lg font-medium transition group {{ request()->routeIs('admin.akademik*') ? 'bg-madrasah-600 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-madrasah-600' }}">
    <i class="ph ph-graduation-cap text-lg mr-3 {{ request()->routeIs('admin.akademik*') ? 'text-white' : 'text-gray-400 group-hover:text-madrasah-600' }}"></i>
    Data Akademik
</a>

               <a href="{{ route('admin.ppdb') }}" wire:navigate 
   class="flex items-center px-3 py-2.5 rounded-lg font-medium transition group {{ request()->routeIs('admin.ppdb*') ? 'bg-madrasah-600 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-madrasah-600' }}">
    <i class="ph ph-check-circle text-lg mr-3 {{ request()->routeIs('admin.ppdb*') ? 'text-white' : 'text-gray-400 group-hover:text-madrasah-600' }}"></i>
    Kelola PPDB
</a>

                <a href="{{ route('admin.users') }}" wire:navigate 
   class="flex items-center px-3 py-2.5 rounded-lg font-medium transition group {{ request()->routeIs('admin.users*') ? 'bg-madrasah-600 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-madrasah-600' }}">
    <i class="ph ph-users text-lg mr-3 {{ request()->routeIs('admin.users*') ? 'text-white' : 'text-gray-400 group-hover:text-madrasah-600' }}"></i>
    Pengguna
</a>
            </nav>
        </div>

        <div class="p-4 border-t border-gray-50">
            <div class="flex items-center p-3 bg-gray-50 rounded-xl mb-4">
                <div class="h-9 w-9 rounded-full bg-madrasah-200 text-madrasah-700 flex items-center justify-center font-bold mr-3">
                    {{ substr(Auth::user()->nama ?? 'A', 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->nama ?? 'Admin Madrasah' }}</p>
                    <p class="text-xs text-gray-500 capitalize">{{ str_replace('_', ' ', Auth::user()->role ?? 'Admin') }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-2 py-2 text-sm font-medium text-red-500 hover:text-red-600 transition">
                    <i class="ph ph-sign-out text-lg mr-2"></i>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">
        
        <header class="h-16 bg-white border-b border-gray-100 flex items-center justify-between px-4 sm:px-6 z-10 lg:justify-end">
            <button @click="sidebarOpen = true" class="text-gray-500 hover:text-madrasah-600 focus:outline-none lg:hidden">
                <i class="ph ph-list text-2xl"></i>
            </button>
            
            <a href="/" target="_blank" class="text-sm font-medium text-madrasah-600 hover:text-madrasah-700 transition flex items-center">
                Lihat Web Publik
                <i class="ph ph-arrow-up-right ml-1"></i>
            </a>
        </header>

        <main class="flex-1 overflow-y-auto p-4 sm:p-8">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>