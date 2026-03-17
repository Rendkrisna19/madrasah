<div>
    <div class="flex justify-between mb-4">
        <input wire:model.live="search" type="text" placeholder="Cari Guru..." class="rounded-lg border-gray-300 w-1/3">
        <button wire:click="openModal" class="bg-madrasah-600 text-white px-4 py-2 rounded-lg text-sm font-bold">
            + Tambah Guru
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4">{{ session('message') }}</div>
    @endif

    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">NIP</th>
                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Mapel</th>
                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($gurus as $g)
                <tr>
                    <td class="px-6 py-4 text-sm">{{ $g->nip }}</td>
                    <td class="px-6 py-4 text-sm font-bold">{{ $g->nama_guru }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $g->mapel }}</td>
                    <td class="px-6 py-4 text-sm">
                        <button wire:click="edit({{ $g->id_guru }})" class="text-blue-600 mr-2">Edit</button>
                        <button onclick="confirm('Hapus?') || event.stopImmediatePropagation()" wire:click="delete({{ $g->id_guru }})" class="text-red-600">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">{{ $gurus->links() }}</div>
    </div>

    @if($isModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-2xl w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">{{ $id_guru ? 'Edit' : 'Tambah' }} Guru</h2>
            <div class="space-y-3">
                <input wire:model="nip" type="text" placeholder="NIP" class="w-full rounded-lg border-gray-300">
                <input wire:model="nama_guru" type="text" placeholder="Nama Guru" class="w-full rounded-lg border-gray-300">
                <input wire:model="mapel" type="text" placeholder="Mata Pelajaran" class="w-full rounded-lg border-gray-300">
                <input wire:model="no_hp" type="text" placeholder="No HP" class="w-full rounded-lg border-gray-300">
            </div>
            <div class="flex justify-end mt-6 gap-2">
                <button wire:click="closeModal" class="px-4 py-2 text-gray-500">Batal</button>
                <button wire:click="store" class="px-4 py-2 bg-madrasah-600 text-white rounded-lg">Simpan</button>
            </div>
        </div>
    </div>
    @endif
</div>