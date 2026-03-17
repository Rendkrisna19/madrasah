<div>
    <div class="flex justify-between mb-4">
        <input wire:model.live="search" type="text" placeholder="Cari Kelas..." class="rounded-xl border-gray-200 text-sm w-1/3">
        <button wire:click="openModal" class="bg-madrasah-600 text-white px-4 py-2 rounded-xl text-sm font-bold">+ Tambah Kelas</button>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase">Nama Kelas</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase">Wali Kelas</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($listKelas as $k)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-bold text-gray-800">{{ $k->nama_kelas }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $k->wali->nama_guru ?? '-' }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <button wire:click="edit({{ $k->id_kelas }})" class="text-orange-600"><i class="ph-bold ph-pencil-simple"></i></button>
                        <button onclick="confirm('Hapus?') || event.stopImmediatePropagation()" wire:click="delete({{ $k->id_kelas }})" class="text-red-600"><i class="ph-bold ph-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($isModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
        <div class="bg-white rounded-3xl w-full max-w-md p-8 relative">
            <h2 class="text-xl font-black mb-6">{{ $id_kelas ? 'Edit' : 'Tambah' }} Kelas</h2>
            <form wire:submit.prevent="store" class="space-y-4">
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase mb-1">Nama Kelas</label>
                    <input wire:model="nama_kelas" type="text" class="w-full rounded-xl border-gray-200">
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase mb-1">Wali Kelas</label>
                    <select wire:model="guru_id" class="w-full rounded-xl border-gray-200">
                        <option value="">-- Pilih Guru --</option>
                        @foreach($listGuru as $g)
                            <option value="{{ $g->id_guru }}">{{ $g->nama_guru }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" wire:click="closeModal" class="px-4 py-2 text-gray-400">Batal</button>
                    <button type="submit" class="bg-madrasah-600 text-white px-6 py-2 rounded-xl font-bold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>