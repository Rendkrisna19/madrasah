<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Kelola PPDB</h2>
            <p class="text-sm text-gray-500 font-medium">Pantau dan seleksi calon santri baru yang telah mendaftar.</p>
        </div>
        
        <div class="flex gap-3 w-full md:w-auto">
            <select wire:model.live="filterStatus" class="rounded-xl border-gray-200 text-sm focus:ring-madrasah-500">
                <option value="">Semua Status</option>
                <option value="Pending">Pending</option>
                <option value="Diterima">Diterima</option>
                <option value="Ditolak">Ditolak</option>
            </select>
            <input wire:model.live="search" type="text" placeholder="Cari nama atau no pendaftaran..." class="rounded-xl border-gray-200 text-sm focus:ring-madrasah-500 w-full md:w-64">
        </div>
    </div>

    @if (session()->has('message_ppdb'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl text-sm flex items-center">
            <i class="ph ph-check-circle mr-2 text-xl"></i> {{ session('message_ppdb') }}
        </div>
    @endif

    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">No. Daftar</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Calon Santri</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest text-center">Status</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($pendaftarans as $p)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4 text-sm font-black text-emerald-600">{{ $p->no_pendaftaran }}</td>
                    <td class="px-6 py-4">
                        <p class="text-sm font-bold text-gray-900">{{ $p->nama_lengkap }}</p>
                        <p class="text-[10px] text-gray-400 font-bold uppercase">{{ $p->asal_sekolah }}</p>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $p->status == 'Diterima' ? 'bg-emerald-100 text-emerald-600' : ($p->status == 'Ditolak' ? 'bg-red-100 text-red-600' : 'bg-orange-100 text-orange-600') }}">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-1">
                        <button wire:click="showDetail({{ $p->id_pendaftaran }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat Detail">
                            <i class="ph ph-eye text-xl"></i>
                        </button>
                        @if($p->status == 'Pending')
                        <button wire:click="updateStatus({{ $p->id_pendaftaran }}, 'Diterima')" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition" title="Terima">
                            <i class="ph ph-check-circle text-xl"></i>
                        </button>
                        <button wire:click="updateStatus({{ $p->id_pendaftaran }}, 'Ditolak')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Tolak">
                            <i class="ph ph-x-circle text-xl"></i>
                        </button>
                        @endif
                        <button onclick="confirm('Hapus data ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $p->id_pendaftaran }})" class="p-2 text-gray-400 hover:text-red-600 transition">
                            <i class="ph ph-trash text-xl"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center text-gray-400 italic font-bold">Belum ada data pendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-6 border-t border-gray-50">
            {{ $pendaftarans->links() }}
        </div>
    </div>

    @if($isModalDetailOpen && $selectedPendaftaran)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" wire:click="closeModal"></div>
        <div class="bg-white w-full max-w-lg rounded-[2.5rem] relative z-10 overflow-hidden shadow-2xl">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-black text-gray-900">Detail Calon Santri</h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-red-500"><i class="ph ph-x text-2xl"></i></button>
                </div>
                
                <div class="space-y-4 text-sm">
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-400 font-bold uppercase text-[10px]">No Pendaftaran</span>
                        <span class="font-black text-emerald-600">{{ $selectedPendaftaran->no_pendaftaran }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-400 font-bold uppercase text-[10px]">Nama Lengkap</span>
                        <span class="font-bold">{{ $selectedPendaftaran->nama_lengkap }} ({{ $selectedPendaftaran->jk }})</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-400 font-bold uppercase text-[10px]">TTL</span>
                        <span class="font-bold">{{ $selectedPendaftaran->tempat_lahir }}, {{ \Carbon\Carbon::parse($selectedPendaftaran->tanggal_lahir)->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-400 font-bold uppercase text-[10px]">Nama Ayah</span>
                        <span class="font-bold">{{ $selectedPendaftaran->nama_ayah }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-400 font-bold uppercase text-[10px]">WhatsApp</span>
                        <span class="font-bold text-emerald-600">{{ $selectedPendaftaran->no_hp_orang_tua }}</span>
                    </div>
                    <div class="pt-2">
                        <span class="text-gray-400 font-bold uppercase text-[10px] block mb-1">Alamat</span>
                        <p class="font-bold text-gray-700 leading-relaxed">{{ $selectedPendaftaran->alamat_lengkap }}</p>
                    </div>
                </div>

                <div class="mt-8 flex gap-3">
                    @if($selectedPendaftaran->status == 'Pending')
                        <button wire:click="updateStatus({{ $selectedPendaftaran->id_pendaftaran }}, 'Diterima')" class="flex-1 py-3 bg-emerald-600 text-white font-black rounded-xl hover:bg-emerald-700 transition">Terima Santri</button>
                        <button wire:click="updateStatus({{ $selectedPendaftaran->id_pendaftaran }}, 'Ditolak')" class="flex-1 py-3 bg-red-50 text-red-600 font-black rounded-xl hover:bg-red-100 transition">Tolak</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>