<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guru Dashboard - SI Madrasah</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Space Grotesk"', 'sans-serif'] },
                }
            }
        }
    </script>

    @livewireStyles
</head>
<body class="font-sans antialiased text-gray-800 bg-[#f8fafc] flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-black/50 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-72 bg-white border-r border-gray-100 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0 flex flex-col justify-between shadow-sm">
        <div class="flex flex-col h-full">
            
            <div class="h-20 flex items-center px-8 border-b border-gray-50 shrink-0">
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center mr-3 text-emerald-600">
                    <i class="ph-fill ph-chalkboard-teacher text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-lg font-black text-gray-900 tracking-tight leading-none">Portal Guru</h1>
                    <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest mt-1">SI Madrasah</p>
                </div>
            </div>
            
            <nav class="p-6 space-y-2 flex-1 overflow-y-auto custom-scrollbar">
                <p class="px-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Menu Utama</p>
                
                <a href="{{ route('guru.dashboard') }}" wire:navigate 
                   class="flex items-center px-4 py-3.5 rounded-2xl font-bold transition-all group {{ request()->routeIs('guru.dashboard') ? 'bg-emerald-50 text-emerald-600 shadow-sm border border-emerald-100' : 'text-gray-500 hover:bg-gray-50 hover:text-emerald-600' }}">
                    <i class="ph-bold ph-squares-four text-xl mr-3 {{ request()->routeIs('guru.dashboard') ? 'text-emerald-500' : 'text-gray-400 group-hover:text-emerald-500' }}"></i>
                    Dashboard
                </a>

             <a href="{{ route('guru.jadwal') }}" 
       wire:navigate
       class="{{ request()->routeIs('guru.jadwal') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <svg class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Jadwal Mengajar
    </a>

               <a href="{{ route('guru.absensi') }}" 
   wire:navigate 
   class="flex items-center px-4 py-3.5 rounded-2xl font-bold transition-all group {{ request()->routeIs('guru.absensi') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-500 hover:bg-gray-50 hover:text-emerald-600' }}">
    
    <i class="ph-bold ph-user-list text-xl mr-3 {{ request()->routeIs('guru.absensi') ? 'text-emerald-500' : 'text-gray-400 group-hover:text-emerald-500' }}"></i>
    
    <span>Absensi Santri</span>
</a>
            </nav>

            <div class="px-6 pb-2">
                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-3xl p-5 text-center relative overflow-hidden border border-emerald-100/50 shadow-inner">
                    <div class="absolute -right-4 -top-4 w-16 h-16 bg-white/60 rounded-full blur-xl"></div>
                    
                    <img src="https://illustrations.popsy.co/emerald/student-going-to-school.svg" alt="Guru Maskot" class="w-32 mx-auto mb-2 relative z-10 drop-shadow-md hover:scale-105 transition-transform duration-500">
                    <p class="text-xs font-black text-emerald-800 relative z-10 leading-tight">Semangat Mengajar<br>Hari Ini!</p>
                </div>
            </div>

            <div class="p-6 mt-2 border-t border-gray-50 shrink-0">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="h-10 w-10 shrink-0 rounded-full bg-emerald-100 flex items-center justify-center font-black text-emerald-700 border border-emerald-200">
                            {{ substr(Auth::user()->nama, 0, 1) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->nama }}</p>
                            <p class="text-[10px] text-gray-500 font-medium truncate">{{ Auth::user()->guru->mapel ?? 'Guru Pengajar' }}</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center justify-center w-full px-4 py-2.5 bg-red-50 text-xs font-bold text-red-600 rounded-xl hover:bg-red-100 hover:text-red-700 transition">
                        <i class="ph-bold ph-sign-out mr-2"></i> Keluar
                    </button>
                </form>
            </div>
            
        </div>
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden relative">
        <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-6 lg:px-10 z-10 shadow-sm">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="text-gray-400 hover:text-emerald-600 bg-gray-50 p-2 rounded-xl lg:hidden transition">
                    <i class="ph-bold ph-list text-2xl"></i>
                </button>
                <h2 class="hidden md:block text-xl font-black text-gray-800 tracking-tight">Ruang Kerja Guru</h2>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="hidden sm:flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl border border-gray-100 text-xs font-bold text-gray-500">
                    <i class="ph-bold ph-calendar-blank text-emerald-500"></i>
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </div>
                
                <a href="/" target="_blank" class="flex items-center gap-2 text-sm font-bold text-emerald-600 hover:text-emerald-700 bg-emerald-50 px-4 py-2 rounded-xl transition">
                    Lihat Web <i class="ph-bold ph-arrow-up-right"></i>
                </a>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6 lg:p-10 bg-[#f8fafc]">
            {{ $slot }}
        </main>
    </div>

    <style>
        /* Custom Scrollbar biar elegan */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: #cbd5e1; }
    </style>
    @livewireScripts
</body>
</html>