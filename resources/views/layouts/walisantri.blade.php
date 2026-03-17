<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Portal Wali Santri') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,600,700,800,900&display=swap" rel="stylesheet" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-[Nunito] bg-[#F8FAFC] text-gray-800 antialiased selection:bg-emerald-100 selection:text-emerald-900 flex">

    <aside class="w-72 bg-white border-r border-gray-100 h-screen sticky top-0 flex flex-col hidden lg:flex shadow-[4px_0_24px_rgba(0,0,0,0.02)]">
        <div class="h-24 flex items-center px-8 border-b border-gray-50">
            <div class="bg-emerald-50 text-emerald-600 p-2.5 rounded-xl mr-3">
                <i class="ph-bold ph-users-three text-2xl"></i>
            </div>
            <div>
                <h1 class="font-black text-gray-900 tracking-tight text-lg leading-tight">Portal Wali</h1>
                <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Madrasah Al-Ikhlas</p>
            </div>
        </div>

        <nav class="flex-1 px-6 py-8 space-y-2 overflow-y-auto">
            <p class="px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Menu Utama</p>
            
            <a href="{{ route('wali-santri.dashboard') }}" class="flex items-center px-4 py-3.5 rounded-2xl font-bold bg-emerald-50 text-emerald-700 transition-all">
                <i class="ph-bold ph-squares-four text-xl mr-3"></i> Dashboard
            </a>
           <a href="{{ route('wali-santri.ppdb') }}" class="flex items-center px-4 py-3.5 rounded-2xl font-bold text-gray-500 hover:bg-gray-50 hover:text-emerald-600 transition-all">
    <i class="ph-bold ph-file-text text-xl mr-3 text-gray-400"></i> Form PPDB
</a>
          <a href="{{ route('wali-santri.santri') }}" class="flex items-center px-4 py-3.5 rounded-2xl font-bold transition-all {{ request()->routeIs('wali-santri.santri') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-500 hover:bg-gray-50 hover:text-emerald-600' }}">
    <i class="ph-bold ph-student text-xl mr-3 {{ request()->routeIs('wali-santri.santri') ? 'text-emerald-600' : 'text-gray-400' }}"></i> Data Santri
</a>
        </nav>

        <div class="p-6 border-t border-gray-50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3.5 rounded-2xl font-bold text-red-500 hover:bg-red-50 transition-all">
                    <i class="ph-bold ph-sign-out text-xl mr-3"></i> Keluar Akun
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 min-w-0 flex flex-col h-screen overflow-hidden">
        <header class="h-24 bg-white/80 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-30">
            <div class="flex items-center">
                <button class="lg:hidden p-2 bg-gray-50 rounded-xl text-gray-500 mr-4">
                    <i class="ph-bold ph-list text-2xl"></i>
                </button>
                <h2 class="text-xl font-black text-gray-800">Selamat Datang!</h2>
            </div>
            
            <div class="flex items-center gap-4">
                <button class="w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-50 text-gray-500 hover:text-emerald-600 border border-gray-100 transition-all relative">
                    <i class="ph-bold ph-bell text-xl"></i>
                    <span class="absolute top-3 right-3 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                </button>
                <div class="flex items-center gap-3 pl-4 border-l border-gray-100">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-black text-gray-900">{{ Auth::user()->nama }}</p>
                        <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Wali Santri</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-lg border border-emerald-200">
                        {{ substr(Auth::user()->nama, 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">
            {{ $slot }}
        </div>
    </main>

    @livewireScripts
</body>
</html>