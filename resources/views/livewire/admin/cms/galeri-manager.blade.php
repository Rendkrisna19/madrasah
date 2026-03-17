<div>
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-800">Manajemen Galeri Foto</h3>
        <button wire:click="openModal" class="px-4 py-2 bg-madrasah-600 text-white rounded-lg hover:bg-madrasah-700 text-sm font-bold shadow-sm flex items-center">
            <i class="ph ph-image-square mr-2"></i> Tambah Foto
        </button>
    </div>

    @if (session()->has('message_galeri'))
        <div class="mb-4 p-3 bg-emerald-50 text-emerald-700 rounded-xl text-sm border border-emerald-100">
            {{ session('message_galeri') }}
        </div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
       @forelse($galeries as $g)
            <div class="group relative bg-gray-50 rounded-2xl overflow-hidden border border-gray-100">
                <img src="{{ asset('storage/'.$g->gambar) }}" class="w-full h-48 object-cover transition group-hover:scale-110">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                    <button wire:click="edit({{ $g->id_galeri }})" class="p-2 bg-white text-orange-500 rounded-full hover:bg-orange-50"><i class="ph ph-pencil-simple"></i></button>
                    <button wire:click="delete({{ $g->id_galeri }})" wire:confirm="Hapus foto ini?" class="p-2 bg-white text-red-500 rounded-full hover:bg-red-50"><i class="ph ph-trash"></i></button>
                </div>
                <div class="p-3 bg-white border-t">
                    <p class="text-xs font-bold text-gray-800 truncate">{{ $g->kategori }}</p>
                    <p class="text-[10px] text-gray-500 line-clamp-1">{{ $g->deskripsi }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center text-gray-400">Belum ada koleksi foto.</div>
        @endforelse
    </div>

    @if($isModalOpen)
    <div class="fixed inset-0 z-[110] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white rounded-[2rem] w-full max-w-lg shadow-2xl overflow-hidden">
            <div class="px-6 py-4 border-b flex justify-between items-center bg-gray-50">
                <h3 class="font-black text-gray-800">{{ $id_galeri ? 'Edit Foto' : 'Upload Foto Baru' }}</h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-red-500"><i class="ph ph-x text-xl"></i></button>
            </div>
            <form wire:submit.prevent="store" class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Upload Gambar</label>
                    <div class="relative h-40 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex items-center justify-center overflow-hidden">
                        @if($gambar)
                            <img src="{{ $gambar->temporaryUrl() }}" class="w-full h-full object-cover">
                        @elseif($old_gambar)
                            <img src="{{ asset('storage/'.$old_gambar) }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-center">
                                <i class="ph ph-cloud-arrow-up text-3xl text-gray-300"></i>
                                <p class="text-[10px] text-gray-400 mt-1">PNG, JPG max 2MB</p>
                            </div>
                        @endif
                        <input type="file" wire:model="gambar" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-700 mb-1">Kategori / Judul</label>
                    <input type="text" wire:model="kategori" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm" placeholder="Contoh: Kegiatan Ramadhan">
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-700 mb-1">Deskripsi Singkat</label>
                    <textarea wire:model="deskripsi" rows="3" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm"></textarea>
                </div>
                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" wire:click="closeModal" class="px-6 py-2 text-sm font-bold text-gray-500 bg-gray-100 rounded-xl">Batal</button>
                    <button type="submit" class="px-6 py-2 text-sm font-bold text-white bg-emerald-600 rounded-xl shadow-lg shadow-emerald-100">Simpan Foto</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>