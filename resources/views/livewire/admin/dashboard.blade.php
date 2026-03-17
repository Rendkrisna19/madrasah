<div class="max-w-7xl mx-auto space-y-8" wire:poll.10s>
    
    <div>
        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Dashboard Admin</h2>
        <p class="text-sm text-gray-500 mt-1 font-medium">Ringkasan data sistem informasi madrasah secara real-time.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center transition-all hover:shadow-md">
            <div class="p-3 bg-blue-50 text-blue-500 rounded-xl mr-4">
                <i class="ph ph-users text-2xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Santri</p>
                <h3 class="text-2xl font-black text-gray-800 mt-0.5">{{ $totalSantri }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center transition-all hover:shadow-md">
            <div class="p-3 bg-emerald-50 text-emerald-500 rounded-xl mr-4">
                <i class="ph ph-graduation-cap text-2xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Guru</p>
                <h3 class="text-2xl font-black text-gray-800 mt-0.5">{{ $totalGuru }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center transition-all hover:shadow-md">
            <div class="p-3 bg-purple-50 text-purple-500 rounded-xl mr-4">
                <i class="ph ph-book-open-text text-2xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Kelas</p>
                <h3 class="text-2xl font-black text-gray-800 mt-0.5">{{ $totalKelas }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center transition-all hover:shadow-md">
            <div class="p-3 bg-orange-50 text-orange-500 rounded-xl mr-4">
                <i class="ph ph-check-circle text-2xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest text-orange-600">Pendaftar Baru</p>
                <h3 class="text-2xl font-black text-gray-800 mt-0.5">{{ $pendaftarBaru }}</h3>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-sm font-black text-emerald-600 uppercase tracking-widest">Pendaftar PPDB Terbaru</h3>
                <a href="{{ route('admin.ppdb') }}" wire:navigate class="text-[10px] font-black text-gray-400 hover:text-emerald-600 uppercase">Lihat Semua</a>
            </div>
            
            <div class="divide-y divide-gray-50">
                @forelse($latestPendaftaran as $p)
                <div class="py-4 flex justify-between items-center group">
                    <div>
                        <h4 class="text-sm font-bold text-gray-800 group-hover:text-emerald-600 transition">{{ $p->nama_lengkap }}</h4>
                        <p class="text-[10px] text-gray-400 font-bold mt-0.5 uppercase tracking-tighter">
                            {{ $p->asal_sekolah }} • {{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y') }}
                        </p>
                    </div>
                    @php
                        $statusClass = match($p->status) {
                            'Diterima' => 'bg-emerald-50 text-emerald-600',
                            'Ditolak' => 'bg-red-50 text-red-600',
                            default => 'bg-orange-50 text-orange-600',
                        };
                    @endphp
                    <span class="px-3 py-1 {{ $statusClass }} text-[9px] font-black uppercase rounded-full tracking-wider">
                        {{ $p->status }}
                    </span>
                </div>
                @empty
                <div class="py-10 text-center">
                    <p class="text-gray-400 text-sm italic font-medium">Belum ada pendaftar masuk.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="bg-emerald-900 rounded-[2rem] border border-emerald-800 p-8 shadow-xl relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-800 rounded-full opacity-20"></div>
            
            <h3 class="text-sm font-black text-emerald-300 mb-6 uppercase tracking-widest relative z-10">Akses Cepat</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 relative z-10">
                <a href="{{ route('admin.cms') }}" wire:navigate class="bg-white/10 backdrop-blur-md py-4 px-4 rounded-2xl text-center text-xs font-black text-white hover:bg-white hover:text-emerald-900 transition-all border border-white/10">
                    KONTEN WEBSITE (CMS)
                </a>
                <a href="{{ route('admin.akademik') }}" wire:navigate class="bg-white/10 backdrop-blur-md py-4 px-4 rounded-2xl text-center text-xs font-black text-white hover:bg-white hover:text-emerald-900 transition-all border border-white/10">
                    JADWAL PELAJARAN
                </a>
                <a href="{{ route('admin.akademik') }}" wire:navigate class="bg-white/10 backdrop-blur-md py-4 px-4 rounded-2xl text-center text-xs font-black text-white hover:bg-white hover:text-emerald-900 transition-all border border-white/10">
                    DATA SANTRI
                </a>
                <a href="{{ route('admin.users') }}" wire:navigate class="bg-white/10 backdrop-blur-md py-4 px-4 rounded-2xl text-center text-xs font-black text-white hover:bg-white hover:text-emerald-900 transition-all border border-white/10">
                    PENGATURAN PENGGUNA
                </a>
            </div>
        </div>

    </div>
</div>