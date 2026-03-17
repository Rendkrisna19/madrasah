<div>
    <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
        <div class="relative w-full md:w-1/3">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="ph ph-magnifying-glass text-gray-400"></i>
            </span>
            <input wire:model.live="search" type="text" placeholder="Cari NIS atau Nama Santri..." 
                   class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-madrasah-500 outline-none text-sm transition">
        </div>
        <button wire:click="openModal" class="px-5 py-2.5 bg-madrasah-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-emerald-100 hover:bg-madrasah-700 transition flex items-center justify-center">
            <i class="ph ph-user-plus mr-2 text-lg"></i> Tambah Santri
        </button>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center text-sm">
            <i class="ph ph-check-circle text-xl mr-2"></i> {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">NIS</th>
                        <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Nama Santri</th>
                        <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest text-center">L/P</th>
                        <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest">Kelas</th>
                        <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($santris as $s)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-600">{{ $s->nis }}</td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-900">{{ $s->nama_santri }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2.5 py-1 rounded-lg text-[10px] font-black {{ $s->jk == 'L' ? 'bg-blue-50 text-blue-600' : 'bg-pink-50 text-pink-600' }}">
                                {{ $s->jk }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-600 font-medium italic">
                                {{ $s->kelas->nama_kelas ?? 'Belum Ada Kelas' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button wire:click="edit({{ $s->id_santri }})" class="p-2 text-orange-600 hover:bg-orange-50 rounded-lg transition">
                                <i class="ph-bold ph-pencil-simple"></i>
                            </button>
                            <button onclick="confirm('Hapus santri ini?') || event.stopImmediatePropagation()" 
                                    wire:click="delete({{ $s->id_santri }})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                <i class="ph-bold ph-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <i class="ph ph-users-four text-5xl text-gray-200 mb-2"></i>
                                <p class="text-gray-400 font-bold italic">Data santri tidak ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-50">
            {{ $santris->links() }}
        </div>
    </div>

    @if($isModalOpen)
    <div class="fixed inset-0 z-[110] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" wire:click="closeModal"></div>
        
        <div class="bg-white rounded-[2rem] w-full max-w-md shadow-2xl relative overflow-hidden transition-all transform">
            <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                <h2 class="text-xl font-black text-gray-800 tracking-tight">{{ $id_santri ? 'Edit' : 'Tambah' }} Santri</h2>
                <button wire:click="closeModal" class="p-2 hover:bg-red-50 text-gray-400 hover:text-red-500 rounded-xl transition">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>

            <form wire:submit.prevent="store" class="p-8 space-y-5">
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">NIS (Nomor Induk Santri)</label>
                    <input wire:model="nis" type="text" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-madrasah-500 outline-none text-sm transition">
                    @error('nis') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Nama Lengkap</label>
                    <input wire:model="nama_santri" type="text" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-madrasah-500 outline-none text-sm transition">
                    @error('nama_santri') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Jenis Kelamin</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" wire:model="jk" value="L" class="text-madrasah-600 focus:ring-madrasah-500">
                            <span class="text-sm font-bold text-gray-700">Laki-laki</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" wire:model="jk" value="P" class="text-madrasah-600 focus:ring-madrasah-500">
                            <span class="text-sm font-bold text-gray-700">Perempuan</span>
                        </label>
                    </div>
                    @error('jk') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Pilih Kelas</label>
                    <select wire:model="kelas_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-madrasah-500 outline-none text-sm transition">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($listKelas as $k)
                            <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                    @error('kelas_id') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" wire:click="closeModal" class="px-6 py-3 text-sm font-bold text-gray-500 hover:bg-gray-100 rounded-xl transition">Batal</button>
                    <button type="submit" class="px-8 py-3 bg-madrasah-600 text-white text-sm font-black rounded-xl shadow-lg shadow-emerald-100 hover:bg-madrasah-700 transition">
                        {{ $id_santri ? 'Simpan Perubahan' : 'Daftarkan Santri' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>