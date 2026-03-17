<div>
    <h3 class="text-lg font-bold text-gray-800 mb-4">Pengaturan Halaman Profil Instansi</h3>

    @if (session()->has('message_profil'))
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg flex items-center text-sm">
            <i class="ph ph-check-circle text-xl mr-2"></i> {{ session('message_profil') }}
        </div>
    @endif

    <form wire:submit.prevent="store" class="space-y-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Sejarah Madrasah</label>
            <textarea wire:model="sejarah" rows="4" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-madrasah-500 outline-none text-sm"></textarea>
            @error('sejarah') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Visi & Misi</label>
            <textarea wire:model="visi_misi" rows="4" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-madrasah-500 outline-none text-sm" placeholder="Masukkan Visi dan Misi madrasah..."></textarea>
            @error('visi_misi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar Struktur Organisasi</label>
            <div class="flex items-center gap-4">
                @if($struktur_organisasi)
                    <img src="{{ $struktur_organisasi->temporaryUrl() }}" class="w-32 h-20 object-cover rounded-lg border">
                @elseif($old_struktur)
                    <img src="{{ asset('storage/'.$old_struktur) }}" class="w-32 h-20 object-cover rounded-lg border">
                @endif
                <input type="file" wire:model="struktur_organisasi" class="text-sm">
            </div>
            @error('struktur_organisasi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="pt-2 flex justify-end">
            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-madrasah-600 hover:bg-madrasah-700 rounded-lg transition">Simpan Konten Profil</button>
        </div>
    </form>
</div>