<div>
    <h3 class="text-lg font-bold text-gray-800 mb-4">Pengaturan Halaman Beranda (Home)</h3>

    @if (session()->has('message_home'))
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg flex items-center text-sm">
            <i class="ph ph-check-circle text-xl mr-2"></i> {{ session('message_home') }}
        </div>
    @endif

    <form wire:submit.prevent="store" class="space-y-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Banner Utama (Gambar)</label>
            <div class="flex items-center gap-4">
                @if($banner)
                    <img src="{{ $banner->temporaryUrl() }}" class="w-32 h-20 object-cover rounded-lg">
                @elseif($old_banner)
                    <img src="{{ asset('storage/'.$old_banner) }}" class="w-32 h-20 object-cover rounded-lg">
                @endif
                <input type="file" wire:model="banner" class="text-sm">
            </div>
            @error('banner') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Teks Sambutan</label>
            <textarea wire:model="sambutan" rows="4" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-madrasah-500 outline-none text-sm" placeholder="Masukkan teks sambutan hero section..."></textarea>
            @error('sambutan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="pt-2 flex justify-end">
            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-madrasah-600 hover:bg-madrasah-700 rounded-lg transition" wire:loading.attr="disabled">
                <span wire:loading.remove>Simpan Konten Home</span>
                <span wire:loading>Menyimpan...</span>
            </button>
        </div>
    </form>
</div>