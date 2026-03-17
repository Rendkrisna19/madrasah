<div>
    <div class="flex justify-between mb-4">
        <select wire:model.live="filterKelas" class="rounded-xl border-gray-200 text-sm">
            <option value="">Semua Kelas</option>
            @foreach($listKelas as $k) <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option> @endforeach
        </select>
        <button wire:click="openModal" class="bg-madrasah-600 text-white px-4 py-2 rounded-xl text-sm font-bold">+ Tambah Jadwal</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($jadwals as $j)
        <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm relative group">
            <div class="flex justify-between items-start mb-2">
                <span class="px-2 py-1 bg-madrasah-50 text-madrasah-700 rounded-lg text-[10px] font-black uppercase">{{ $j->hari }}</span>
                <button onclick="confirm('Hapus?') || event.stopImmediatePropagation()" wire:click="delete({{ $j->id_jadwal }})" class="text-red-400 hover:text-red-600 opacity-0 group-hover:opacity-100 transition">
                    <i class="ph ph-trash"></i>
                </button>
            </div>
            <h4 class="font-bold text-gray-900">{{ $j->nama_mapel }}</h4>
            <p class="text-xs text-gray-500 mb-2">{{ $j->guru->nama_guru }}</p>
            <div class="flex items-center text-xs font-bold text-madrasah-600 bg-gray-50 p-2 rounded-lg">
                <i class="ph ph-clock mr-1"></i> {{ $j->jam_mulai }} - {{ $j->jam_selesai }}
                <span class="ml-auto text-gray-400">{{ $j->kelas->nama_kelas }}</span>
            </div>
        </div>
        @endforeach
    </div>

    @if($isModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
        <div class="bg-white rounded-3xl w-full max-w-lg p-8">
            <h2 class="text-xl font-black mb-6">Setup Jadwal Pelajaran</h2>
            <form wire:submit.prevent="store" class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-xs font-black text-gray-400 uppercase mb-1">Mata Pelajaran</label>
                    <input wire:model="nama_mapel" type="text" class="w-full rounded-xl border-gray-200">
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase mb-1">Hari</label>
                    <select wire:model="hari" class="w-full rounded-xl border-gray-200">
                        <option value="">Pilih Hari</option>
                        @foreach($listHari as $h) <option value="{{ $h }}">{{ $h }}</option> @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase mb-1">Kelas</label>
                    <select wire:model="kelas_id" class="w-full rounded-xl border-gray-200">
                        <option value="">Pilih Kelas</option>
                        @foreach($listKelas as $k) <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option> @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase mb-1">Guru Pengajar</label>
                    <select wire:model="guru_id" class="w-full rounded-xl border-gray-200">
                        <option value="">Pilih Guru</option>
                        @foreach($listGuru as $g) <option value="{{ $g->id_guru }}">{{ $g->nama_guru }}</option> @endforeach
                    </select>
                </div>
                <div class="flex gap-2 col-span-1">
                    <div class="flex-1">
                        <label class="block text-xs font-black text-gray-400 uppercase mb-1">Mulai</label>
                        <input wire:model="jam_mulai" type="time" class="w-full rounded-xl border-gray-200">
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-black text-gray-400 uppercase mb-1">Selesai</label>
                        <input wire:model="jam_selesai" type="time" class="w-full rounded-xl border-gray-200">
                    </div>
                </div>
                <div class="col-span-2 flex justify-end gap-2 mt-4">
                    <button type="button" wire:click="closeModal" class="px-4 py-2 text-gray-400">Batal</button>
                    <button type="submit" class="bg-madrasah-600 text-white px-8 py-2 rounded-xl font-bold">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>