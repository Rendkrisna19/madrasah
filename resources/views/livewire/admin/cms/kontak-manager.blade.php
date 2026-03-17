<div>
    <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-800">Pengaturan Informasi Kontak</h3>
        <p class="text-sm text-gray-500">Informasi ini akan tampil di bagian Footer dan Section Kontak landing page.</p>
    </div>

    @if (session()->has('message_kontak'))
        <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-2xl text-sm border border-emerald-100 flex items-center">
            <i class="ph ph-check-circle mr-2 text-xl"></i> {{ session('message_kontak') }}
        </div>
    @endif

    <div class="bg-gray-50 rounded-[2rem] border border-gray-100 p-8">
        <form wire:submit.prevent="store" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-5">
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-emerald-600 mb-2 text-left">Alamat Lengkap</label>
                    <textarea wire:model="alamat" rows="3" class="w-full px-5 py-3 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm shadow-sm"></textarea>
                    @error('alamat') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-emerald-600 mb-2 text-left">Nomor WhatsApp / HP</label>
                    <input type="text" wire:model="no_hp" class="w-full px-5 py-3 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm shadow-sm" placeholder="62812xxx">
                </div>
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-emerald-600 mb-2 text-left">Email Instansi</label>
                    <input type="email" wire:model="email" class="w-full px-5 py-3 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm shadow-sm">
                </div>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-emerald-600 mb-2 text-left">Embed Google Maps (Iframe)</label>
                    <textarea wire:model="lokasi_maps" rows="6" class="w-full px-5 py-3 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none text-xs shadow-sm font-mono" placeholder="Paste <iframe> dari Google Maps di sini..."></textarea>
                    <p class="text-[10px] text-gray-400 mt-2 italic">*Buka Google Maps > Share > Embed a map > Copy HTML.</p>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="w-full md:w-auto px-10 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition-all">
                        Simpan Perubahan Kontak
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>