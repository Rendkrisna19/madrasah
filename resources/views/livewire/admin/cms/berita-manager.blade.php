<div>
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-800">Manajemen Berita</h3>
        <button wire:click="openModal" class="px-4 py-2 bg-madrasah-600 text-white rounded-lg hover:bg-madrasah-700 text-sm font-bold shadow-sm">
            <i class="ph ph-plus-circle mr-2"></i> Tulis Berita
        </button>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-emerald-50 text-emerald-700 rounded-lg text-sm border border-emerald-100">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto border border-gray-100 rounded-xl bg-white">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Gambar</th>
                    <th class="px-6 py-4">Judul Berita</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($beritas as $b)
                <tr wire:key="berita-{{ $b->id_berita }}">
                    <td class="px-6 py-4">
                        @if($b->gambar)
                            <img src="{{ asset('storage/'.$b->gambar) }}" class="w-16 h-12 object-cover rounded-lg shadow-sm">
                        @else
                            <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i class="ph ph-image text-gray-400"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-bold text-gray-900">{{ $b->judul_berita }}</td>
                    <td class="px-6 py-4 flex space-x-2">
                        <button wire:click="edit({{ $b->id_berita }})" class="p-2 text-orange-500 hover:bg-orange-50 rounded-lg">
                            <i class="ph ph-pencil-simple"></i>
                        </button>
                        <button wire:click="delete({{ $b->id_berita }})" wire:confirm="Hapus berita ini?" class="p-2 text-red-500 hover:bg-red-50 rounded-lg">
                            <i class="ph ph-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-6 py-10 text-center text-gray-400">Belum ada berita.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($isModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-lg font-bold text-gray-800">{{ $berita_id ? 'Edit Berita' : 'Tambah Berita Baru' }}</h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-red-500 transition"><i class="ph ph-x text-xl"></i></button>
            </div>

            <form wire:submit.prevent="store" class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Berita</label>
                        <div class="relative w-full h-48 bg-gray-100 rounded-xl overflow-hidden border-2 border-dashed border-gray-200 flex items-center justify-center">
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                            @elseif($old_image)
                                <img src="{{ asset('storage/'.$old_image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-center">
                                    <i class="ph ph-image text-4xl text-gray-300"></i>
                                    <p class="text-xs text-gray-400 mt-2">Pilih gambar (Max 2MB)</p>
                                </div>
                            @endif
                            <input type="file" wire:model="image" class="absolute inset-0 opacity-0 cursor-pointer">
                        </div>
                        @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Berita</label>
                            <input type="text" wire:model="judul" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-madrasah-500 outline-none text-sm">
                            @error('judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Isi Berita</label>
                            <textarea wire:model="konten" rows="5" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-madrasah-500 outline-none text-sm"></textarea>
                            @error('konten') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex justify-end space-x-2">
                    <button type="button" wire:click="closeModal" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-madrasah-600 hover:bg-madrasah-700 rounded-lg shadow-md" wire:loading.attr="disabled">
                        <span wire:loading.remove>Simpan Berita</span>
                        <span wire:loading>Memproses...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>