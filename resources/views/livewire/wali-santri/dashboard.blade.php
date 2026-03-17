<div>
    <div class="bg-white rounded-[2.5rem] p-8 md:p-12 mb-8 shadow-sm border border-gray-100 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-emerald-50 rounded-full blur-3xl opacity-50"></div>
        
        <div class="relative z-10 max-w-2xl text-center md:text-left">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-[10px] font-black uppercase tracking-widest mb-4">
                <i class="ph-fill ph-check-circle"></i> Akun Berhasil Dibuat
            </span>
            <h2 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight mb-4">
                Halo, Bapak/Ibu {{ $user->nama }}!
            </h2>
            <p class="text-gray-500 font-medium leading-relaxed">
                Terima kasih telah bergabung di Portal Wali Santri. Langkah selanjutnya adalah melengkapi formulir Pendaftaran Peserta Didik Baru (PPDB) untuk putra/putri Anda.
            </p>
        </div>
        
        <div class="relative z-10 shrink-0">
            <div class="w-32 h-32 bg-emerald-100 rounded-[2rem] flex items-center justify-center rotate-3 border-4 border-white shadow-xl">
                <i class="ph-bold ph-student text-6xl text-emerald-600"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all group">
            <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                <i class="ph-bold ph-clipboard-text"></i>
            </div>
            <h3 class="font-black text-gray-400 text-[11px] uppercase tracking-widest mb-1">Status PPDB</h3>
            <p class="text-2xl font-black text-gray-900 mb-2">Belum Mengisi</p>
            <p class="text-sm font-bold text-amber-500 flex items-center gap-1">
                <i class="ph-fill ph-warning-circle"></i> Segera lengkapi data
            </p>
        </div>

        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all group">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                <i class="ph-bold ph-users"></i>
            </div>
            <h3 class="font-black text-gray-400 text-[11px] uppercase tracking-widest mb-1">Anak Terdaftar</h3>
            <p class="text-2xl font-black text-gray-900 mb-2">0 <span class="text-base text-gray-400 font-bold">Santri</span></p>
            <p class="text-sm font-bold text-gray-400">Tahun Ajaran 2025/2026</p>
        </div>

        <div class="bg-emerald-600 rounded-[2rem] p-6 shadow-xl shadow-emerald-200 relative overflow-hidden flex flex-col justify-center items-start text-white group cursor-pointer hover:bg-emerald-700 transition-colors">
            <i class="ph-bold ph-arrow-right absolute -right-4 -bottom-4 text-8xl opacity-10 group-hover:translate-x-2 transition-transform"></i>
            <h3 class="text-xl font-black mb-2 relative z-10">Mulai Pendaftaran!</h3>
            <p class="text-emerald-100 text-sm mb-6 relative z-10 font-medium">Klik di sini untuk membuka formulir PPDB online.</p>
            <button class="relative z-10 px-6 py-3 bg-white text-emerald-700 rounded-xl font-black text-sm uppercase tracking-widest shadow-lg active:scale-95 transition-all">
                Isi Formulir
            </button>
        </div>
        
    </div>
</div>