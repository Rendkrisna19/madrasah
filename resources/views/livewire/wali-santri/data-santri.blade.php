<div>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Data Santri</h2>
            <p class="text-gray-500 font-medium">Profil akademik putra/putri Anda yang terdaftar di Madrasah.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($santris as $santri)
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden group hover:shadow-xl hover:shadow-emerald-100 transition-all duration-300 relative">
                
                <div class="h-24 bg-gradient-to-r from-emerald-500 to-emerald-600 relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="absolute -left-10 -bottom-10 w-24 h-24 bg-black/10 rounded-full blur-xl"></div>
                </div>

                <div class="relative -mt-12 flex justify-center">
                    <div class="w-24 h-24 bg-white rounded-full p-1.5 shadow-lg">
                        <div class="w-full h-full rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600">
                            @if($santri->jk == 'L')
                                <i class="ph-fill ph-user text-4xl"></i>
                            @else
                                <i class="ph-fill ph-user-focus text-4xl text-pink-500"></i>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-6 text-center">
                    <h3 class="font-black text-gray-900 text-xl mb-1 truncate px-4" title="{{ $santri->nama_santri }}">
                        {{ $santri->nama_santri }}
                    </h3>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">NIS: {{ $santri->nis ?? 'Belum Ada' }}</p>

                    <div class="space-y-3 text-left bg-gray-50 rounded-2xl p-4 border border-gray-100/50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500 text-sm font-bold">
                                <i class="ph-fill ph-door mr-2 text-emerald-500 text-lg"></i> Kelas
                            </div>
                            <span class="text-sm font-black text-gray-800">{{ $santri->kelas->nama_kelas ?? 'Belum Penempatan' }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500 text-sm font-bold">
                                <i class="ph-fill ph-gender-intersex mr-2 text-blue-500 text-lg"></i> Gender
                            </div>
                            <span class="text-sm font-black text-gray-800">
                                {{ $santri->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500 text-sm font-bold">
                                <i class="ph-fill ph-check-circle mr-2 text-emerald-500 text-lg"></i> Status
                            </div>
                            <span class="px-2.5 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-[10px] font-black uppercase tracking-wider">
                                Aktif
                            </span>
                        </div>
                    </div>
                </div>

                <div class="px-6 pb-6 mt-2">
                    <button class="w-full py-3.5 bg-white border-2 border-gray-100 text-gray-400 font-bold rounded-2xl hover:bg-emerald-50 hover:border-emerald-200 hover:text-emerald-600 transition-all flex items-center justify-center gap-2 text-sm group-hover:bg-emerald-600 group-hover:border-emerald-600 group-hover:text-white">
                        Lihat Detail Akademik <i class="ph-bold ph-arrow-right"></i>
                    </button>
                </div>

            </div>
        @empty
            <div class="col-span-full py-20 text-center border-2 border-dashed border-gray-200 rounded-[3rem] bg-white">
                <div class="inline-flex w-20 h-20 bg-emerald-50 text-emerald-400 rounded-full items-center justify-center mb-4">
                    <i class="ph-bold ph-student text-4xl"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 mb-2">Belum Ada Data Santri</h3>
                <p class="text-gray-500 text-sm max-w-md mx-auto">
                    Data santri akan muncul secara otomatis di sini setelah pendaftaran PPDB putra/putri Anda diverifikasi dan diterima oleh Admin.
                </p>
                <a href="{{ route('wali-santri.ppdb') }}" class="inline-block mt-6 px-6 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-emerald-600 transition shadow-lg">
                    Cek Status Pendaftaran
                </a>
            </div>
        @endforelse
    </div>
</div>