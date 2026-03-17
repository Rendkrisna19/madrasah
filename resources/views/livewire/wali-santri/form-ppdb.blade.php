<div>
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Data PPDB</h2>
            <p class="text-gray-500 font-medium">Kelola pendaftaran putra/putri Anda di sini.</p>
        </div>
        <button wire:click="openModal" class="px-6 py-3 bg-emerald-600 text-white font-black rounded-2xl shadow-xl hover:bg-emerald-700 transition-all flex items-center gap-2">
            <i class="ph-bold ph-plus"></i> Tambah Santri
        </button>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-2xl flex items-center border border-emerald-100">
            <i class="ph-fill ph-check-circle text-xl mr-3"></i> <span class="font-bold">{{ session('message') }}</span>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-2xl flex items-center border border-red-100">
            <i class="ph-fill ph-warning-circle text-xl mr-3"></i> <span class="font-bold">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($pendaftarans as $p)
            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 px-4 py-1.5 rounded-bl-2xl font-black text-[10px] uppercase tracking-widest 
                    {{ $p->status == 'Pending' ? 'bg-amber-100 text-amber-700' : ($p->status == 'Diterima' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700') }}">
                    {{ $p->status }}
                </div>

                <div class="flex items-center gap-4 mb-6 mt-2">
                    <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center border border-gray-100">
                        <i class="ph-bold ph-student text-2xl text-gray-400"></i>
                    </div>
                    <div>
                        <h3 class="font-black text-gray-900 text-lg line-clamp-1">{{ $p->nama_lengkap }}</h3>
                        <p class="text-xs font-bold text-gray-400">{{ $p->no_pendaftaran }}</p>
                    </div>
                </div>

                <div class="space-y-2 mb-6 text-sm">
                    <div class="flex justify-between"><span class="text-gray-400">Asal Sekolah:</span> <span class="font-bold text-gray-700">{{ $p->asal_sekolah }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-400">Tgl Lahir:</span> <span class="font-bold text-gray-700">{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d M Y') }}</span></div>
                </div>

                @if($p->status === 'Pending')
                    <div class="flex gap-2">
                        <button wire:click="edit({{ $p->id_pendaftaran }})" class="flex-1 py-3 bg-gray-50 hover:bg-emerald-50 text-gray-600 hover:text-emerald-600 font-bold rounded-xl transition border border-gray-100 text-sm">Edit Data</button>
                        <button onclick="confirm('Yakin ingin menghapus?') || event.stopImmediatePropagation()" wire:click="delete({{ $p->id_pendaftaran }})" class="w-12 flex items-center justify-center bg-gray-50 hover:bg-red-50 text-gray-400 hover:text-red-500 font-bold rounded-xl transition border border-gray-100"><i class="ph-bold ph-trash text-lg"></i></button>
                    </div>
                @elseif($p->status === 'Diterima')
                    <div class="bg-emerald-50 rounded-xl p-4 text-center border border-emerald-100">
                        <p class="text-xs text-emerald-700 font-black mb-3">🎉 SELAMAT! Putra/Putri Anda Diterima.</p>
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20wali%20dari%20{{ urlencode($p->nama_lengkap) }}%20({{ $p->no_pendaftaran }}).%20Ingin%20konfirmasi%20daftar%20ulang." target="_blank" class="w-full py-2.5 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg flex items-center justify-center gap-2 text-sm shadow-md transition">
                            <i class="ph-fill ph-whatsapp-logo text-xl"></i> Konfirmasi WA
                        </a>
                    </div>
                @else
                    <div class="bg-red-50 rounded-xl p-4 text-center border border-red-100">
                        <p class="text-xs text-red-600 font-bold">Mohon maaf, pendaftaran tidak dapat diterima saat ini.</p>
                    </div>
                @endif
            </div>
        @empty
            <div class="col-span-full py-24 text-center border-2 border-dashed border-gray-200 rounded-[3rem]">
                <div class="inline-flex w-20 h-20 bg-gray-50 text-gray-300 rounded-full items-center justify-center mb-4"><i class="ph-bold ph-file-text text-4xl"></i></div>
                <h3 class="text-lg font-black text-gray-800 mb-1">Belum Ada Pendaftaran</h3>
                <p class="text-gray-500">Klik tombol Tambah Santri untuk memulai.</p>
            </div>
        @endforelse
    </div>

    @if($isModalOpen)
    <div class="fixed inset-0 z-[200] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="closeModal"></div>
        <div class="bg-white w-full max-w-2xl rounded-[2.5rem] relative z-[210] shadow-2xl overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h2 class="text-xl font-black text-gray-900">{{ $id_pendaftaran ? 'Edit' : 'Tambah' }} Pendaftaran</h2>
                <button wire:click="closeModal" class="text-gray-400 hover:text-red-500 bg-white shadow-sm w-8 h-8 rounded-full flex items-center justify-center"><i class="ph-bold ph-x"></i></button>
            </div>
            
            <form wire:submit.prevent="store" class="p-8 max-h-[75vh] overflow-y-auto custom-scrollbar">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="col-span-full">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Nama Lengkap</label>
                        <input wire:model="nama_lengkap" type="text" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl font-bold focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Jenis Kelamin</label>
                        <select wire:model="jk" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl font-bold focus:ring-2 focus:ring-emerald-500 outline-none">
                            <option value="">Pilih...</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Asal Sekolah</label>
                        <input wire:model="asal_sekolah" type="text" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl font-bold focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Tempat Lahir</label>
                        <input wire:model="tempat_lahir" type="text" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl font-bold focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Tanggal Lahir</label>
                        <input wire:model="tanggal_lahir" type="date" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl font-bold focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Nama Ayah</label>
                        <input wire:model="nama_ayah" type="text" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl font-bold focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-1">No. HP / WA</label>
                        <input wire:model="no_hp_orang_tua" type="text" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl font-bold focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div class="col-span-full">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Alamat Lengkap</label>
                        <textarea wire:model="alamat_lengkap" rows="3" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl font-bold focus:ring-2 focus:ring-emerald-500 outline-none"></textarea>
                    </div>
                </div>
                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button" wire:click="closeModal" class="px-6 py-3 font-bold text-gray-500 hover:bg-gray-100 rounded-xl transition">Batal</button>
                    <button type="submit" class="px-8 py-3 bg-emerald-600 text-white font-black rounded-xl shadow-lg shadow-emerald-200 hover:bg-emerald-700 transition flex items-center gap-2">
                        <i class="ph-bold ph-floppy-disk"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>