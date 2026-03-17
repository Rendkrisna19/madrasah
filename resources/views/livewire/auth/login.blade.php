<div class="relative min-h-screen flex items-center justify-center bg-[#FDFDFD]">
    
    <div class="absolute inset-0 z-0 opacity-[0.03]" 
         style="background-image: url('https://images.unsplash.com/vector-1760879601410-fa0b14993e63?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-repeat: repeat;">
    </div>

    <div class="absolute -top-32 -left-32 w-96 h-96 bg-emerald-100 rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-emerald-50 rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>

    <div class="relative z-10 w-full max-w-md p-8 sm:p-10 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2rem] border border-gray-100 mx-4">
        
        <div class="flex flex-col items-center mb-10">
            <div class="p-3.5 mb-5 bg-madrasah-500/10 text-madrasah-600 rounded-2xl border border-madrasah-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-black text-gray-800 tracking-tight uppercase">Login Portal</h2>
            <p class="text-sm text-gray-500 mt-1 font-medium">Sistem Informasi Madrasah Diniyah</p>
        </div>

        <form wire:submit="authenticate" class="space-y-5">
            
            <div>
                <label for="email" class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Email Address</label>
                <input type="email" id="email" wire:model="email" 
                       class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-800 focus:ring-2 focus:ring-madrasah-500 focus:border-madrasah-500 transition-all outline-none" 
                       placeholder="admin@madrasah.sch.id" required autofocus>
                @error('email') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password" class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Password</label>
                <input type="password" id="password" wire:model="password" 
                       class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-800 focus:ring-2 focus:ring-madrasah-500 focus:border-madrasah-500 transition-all outline-none" 
                       placeholder="••••••••" required>
                @error('password') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between mt-2">
                <div class="flex items-center">
                    <input id="remember_me" wire:model="remember" type="checkbox" class="h-4 w-4 text-madrasah-600 focus:ring-madrasah-500 border-gray-300 rounded cursor-pointer">
                    <label for="remember_me" class="ml-2 block text-xs font-bold text-gray-500 cursor-pointer">
                        Ingat saya
                    </label>
                </div>
                <a href="#" class="text-xs font-bold text-madrasah-600 hover:text-madrasah-500 transition-colors">Lupa sandi?</a>
            </div>

            <button type="submit" 
                    class="w-full flex justify-center items-center py-3.5 px-4 rounded-xl shadow-lg shadow-madrasah-200 text-sm font-black uppercase tracking-widest text-white bg-madrasah-600 hover:bg-madrasah-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-madrasah-500 transition-all duration-200 mt-6 active:scale-[0.98]"
                    wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="authenticate">Masuk ke Sistem</span>
                <span wire:loading wire:target="authenticate" class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses...
                </span>
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-100">
            <div class="bg-madrasah-50/50 rounded-xl p-4 text-center border border-madrasah-100/50">
                <p class="text-[11px] font-bold text-gray-500 mb-1">Ingin mendaftar PPDB?</p>
                <a href="{{ route('register.walisantri') }}" class="inline-flex text-sm font-black text-madrasah-700 hover:text-madrasah-800 transition-colors">
                    Buat Akun Wali Santri &rarr;
                </a>
            </div>
        </div>

    </div>
</div>