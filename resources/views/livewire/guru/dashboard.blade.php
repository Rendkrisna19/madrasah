<div class="max-w-7xl mx-auto space-y-8 pb-12">
    
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-600 to-teal-500 rounded-[2.5rem] p-8 md:p-12 text-white shadow-2xl shadow-emerald-100">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-center md:text-left">
                <h1 class="text-3xl md:text-5xl font-black mb-4 tracking-tight">Assalamu'alaikum,<br> {{ $user->nama }}!</h1>
                <p class="text-emerald-50 text-lg font-medium opacity-90">Hari ini adalah <span class="font-black underline">{{ $hariIni }}</span>. Siap untuk membimbing santri hari ini?</p>
                <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-4">
                    <div class="bg-white/20 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20 text-sm font-bold">
                        <i class="ph ph-users-three mr-2"></i> {{ $totalSantriWali }} Santri Binaan
                    </div>
                    <div class="bg-white/20 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20 text-sm font-bold">
                        <i class="ph ph-calendar-check mr-2"></i> {{ $jadwals->count() }} Jadwal Mengajar
                    </div>
                </div>
            </div>
            
            <div class="hidden lg:block w-64 animate-float">
                <img src="https://i.pinimg.com/736x/01/ff/10/01ff103dafc5d35c06cb142c5311dfe9.jpg" alt="Guru Mengajar" class="w-full h-auto drop-shadow-2xl">
            </div>
        </div>

        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -left-10 -top-10 w-40 h-40 bg-emerald-400/20 rounded-full blur-2xl"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-black text-gray-900 tracking-tight flex items-center gap-2">
                    <i class="ph ph-clock-countdown text-emerald-600"></i> Jadwal Mengajar Anda
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($jadwals as $j)
                    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-500 group relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-50 rounded-bl-[4rem] -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-700"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase rounded-lg tracking-widest">{{ $j->hari }}</span>
                                <span class="text-[10px] font-bold text-gray-400 italic">{{ $j->kelas->nama_kelas }}</span>
                            </div>
                            <h4 class="text-lg font-black text-gray-900 mb-2 leading-tight">{{ $j->nama_mapel }}</h4>
                            <div class="flex items-center text-sm font-bold text-gray-500">
                                <i class="ph ph-timer mr-2 text-emerald-500"></i> {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 bg-gray-50 rounded-[2.5rem] border-2 border-dashed border-gray-200 text-center">
                        <img src="https://illustrations.popsy.co/white/creative-work.svg" class="w-32 mx-auto mb-4 opacity-50">
                        <p class="text-gray-400 font-bold italic">Anda belum memiliki jadwal mengajar.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="space-y-6">
            <h3 class="text-xl font-black text-gray-900 tracking-tight flex items-center gap-2">
                <i class="ph ph-door text-emerald-600"></i> Kelas Binaan (Wali)
            </h3>

            @if($kelasWali)
                <div class="bg-white rounded-[2.5rem] border border-gray-100 p-8 shadow-sm relative overflow-hidden">
                    <div class="text-center relative z-10">
                        <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-3xl mx-auto flex items-center justify-center mb-4 shadow-inner">
                            <i class="ph-fill ph-chalkboard-teacher text-4xl"></i>
                        </div>
                        <h4 class="text-2xl font-black text-gray-900 mb-1">{{ $kelasWali->nama_kelas }}</h4>
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-6">Wali Kelas: {{ $user->nama }}</p>
                        
                        <div class="grid grid-cols-1 gap-3 text-left">
                            <a href="{{ route('admin.akademik') }}" wire:navigate class="p-4 bg-gray-50 rounded-2xl flex items-center justify-between hover:bg-emerald-50 transition group">
                                <span class="text-sm font-bold text-gray-600 group-hover:text-emerald-700 transition">Lihat Daftar Santri</span>
                                <i class="ph ph-arrow-right text-gray-300 group-hover:text-emerald-500"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-orange-50 rounded-[2.5rem] border border-orange-100 p-8 text-center">
                    <i class="ph ph-info text-4xl text-orange-400 mb-3"></i>
                    <p class="text-orange-700 font-bold text-sm leading-relaxed">Anda tidak ditugaskan sebagai Wali Kelas saat ini.</p>
                </div>
            @endif

            <div class="bg-gray-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden">
                <h4 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-4">Akses Cepat</h4>
                <div class="space-y-3">
                    <a href="#" class="block w-full py-3 px-6 bg-white/10 rounded-xl text-sm font-bold hover:bg-white/20 transition border border-white/5">Input Nilai Santri</a>
                    <a href="#" class="block w-full py-3 px-6 bg-white/10 rounded-xl text-sm font-bold hover:bg-white/20 transition border border-white/5">Absensi Kelas</a>
                </div>
            </div>
        </div>

    </div>
</div>