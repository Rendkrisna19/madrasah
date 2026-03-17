<div class="relative min-h-screen flex items-center justify-center bg-[#FDFDFD] py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="absolute inset-0 z-0 opacity-[0.03]" 
         style="background-image: url('https://images.unsplash.com/vector-1760879601410-fa0b14993e63?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-repeat: repeat;">
    </div>

    <div class="absolute -top-32 -left-32 w-96 h-96 bg-emerald-100 rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-emerald-50 rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>

    <div class="relative z-10 w-full max-w-md p-8 sm:p-10 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2rem] border border-gray-100 mx-4">
        
        <div class="flex flex-col items-center mb-10 text-center">
            <div class="p-3.5 mb-5 bg-madrasah-500/10 text-madrasah-600 rounded-2xl border border-madrasah-100 flex items-center justify-center">
                <i class="ph-bold ph-users-three text-3xl"></i>
            </div>
            <h2 class="text-2xl font-black text-gray-800 tracking-tight uppercase">Daftar Akun</h2>
            <p class="text-sm text-gray-500 mt-1 font-medium">Portal Wali Santri PPDB</p>
        </div>

        @if (session()->has('error'))
            <div class="p-4 mb-6 bg-red-50 text-red-600 rounded-xl flex items-start border border-red-100">
                <i class="ph-fill ph-warning-circle text-xl mr-2"></i>
                <span class="text-sm font-bold">{{ session('error') }}</span>
            </div>
        @endif

        <form wire:submit.prevent="register" class="space-y-5">
            
            <div>
                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Nama Wali / Orang Tua</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph-bold ph-user text-gray-400"></i>
                    </div>
                    <input wire:model="nama" type="text" 
                           class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-800 focus:ring-2 focus:ring-madrasah-500 focus:border-madrasah-500 transition-all outline-none" 
                           placeholder="Contoh: Budi Santoso" required>
                </div>
                @error('nama') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Alamat Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph-bold ph-envelope-simple text-gray-400"></i>
                    </div>
                    <input wire:model="email" type="email" 
                           class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-800 focus:ring-2 focus:ring-madrasah-500 focus:border-madrasah-500 transition-all outline-none" 
                           placeholder="email@contoh.com" required>
                </div>
                @error('email') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Kata Sandi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph-bold ph-lock-key text-gray-400"></i>
                    </div>
                    <input wire:model="password" type="password" 
                           class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-800 focus:ring-2 focus:ring-madrasah-500 focus:border-madrasah-500 transition-all outline-none" 
                           placeholder="Minimal 8 karakter" required>
                </div>
                @error('password') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Ulangi Kata Sandi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph-bold ph-check-circle text-gray-400"></i>
                    </div>
                    <input wire:model="password_confirmation" type="password" 
                           class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-800 focus:ring-2 focus:ring-madrasah-500 focus:border-madrasah-500 transition-all outline-none" 
                           placeholder="Ketik ulang sandi" required>
                </div>
            </div>

            <button type="submit" 
                    class="w-full flex justify-center items-center py-3.5 px-4 rounded-xl shadow-lg shadow-madrasah-200 text-sm font-black uppercase tracking-widest text-white bg-madrasah-600 hover:bg-madrasah-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-madrasah-500 transition-all duration-200 mt-8 active:scale-[0.98]"
                    wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="register">Daftar Sekarang</span>
                <span wire:loading wire:target="register" class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses...
                </span>
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Sudah punya akun?</p>
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center text-sm font-black text-madrasah-700 hover:text-madrasah-800 transition-all">
                &larr; Kembali ke Login
            </a>
        </div>

    </div>
</div>