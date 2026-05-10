<div>
    <div class="flex justify-between mb-6 items-center">
        <input wire:model.live="search" type="text" placeholder="Cari Guru..." class="rounded-lg border-gray-300 w-1/3 shadow-sm focus:ring-madrasah-500 focus:border-madrasah-500 transition">
        <button wire:click="openModal" class="bg-madrasah-600 hover:bg-madrasah-700 transition duration-200 text-white px-5 py-2.5 rounded-lg text-sm font-bold shadow-md">
            + Tambah Guru
        </button>
    </div>

    <!-- Alert Success -->
    @if (session()->has('message'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-5 rounded-r-lg shadow-sm flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span class="font-medium">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Alert Error (Muncul jika ada constraint fail) -->
    @if (session()->has('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-5 rounded-r-lg shadow-sm flex items-center">
            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">NIP</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Mapel</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($gurus as $g)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $g->nip }}</td>
                    <td class="px-6 py-4 text-sm font-bold text-gray-900">{{ $g->nama_guru }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $g->mapel }}</td>
                    <td class="px-6 py-4 text-sm flex justify-end items-center space-x-3">
                        <button wire:click="edit({{ $g->id_guru }})" class="text-blue-600 hover:text-blue-800 font-medium transition">Edit</button>
                        
                        <div class="border-l border-gray-300 h-4 mx-2"></div> <!-- Divider -->
                        
                        <!-- Tombol Hapus Normal (Aman) -->
                        <button onclick="confirm('Yakin ingin menghapus guru ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $g->id_guru }})" class="text-red-500 hover:text-red-700 font-medium transition">Hapus</button>
                        
                        <!-- Tombol Paksa Hapus (Berisiko) -->
                        <button onclick="confirm('PERINGATAN: Menghapus paksa akan menghilangkan seluruh data Jadwal yang terkait dengan guru ini secara permanen! Tetap lanjutkan?') || event.stopImmediatePropagation()" wire:click="forceDelete({{ $g->id_guru }})" class="bg-red-100 text-red-700 hover:bg-red-200 hover:text-red-800 px-3 py-1 rounded-md text-xs font-bold transition ml-2">
                            Paksa Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 text-sm">
                        Data guru belum tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-gray-100 bg-gray-50">{{ $gurus->links() }}</div>
    </div>

    <!-- Modal Form -->
    @if($isModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity">
        <div class="bg-white p-6 rounded-2xl w-full max-w-md shadow-2xl transform transition-all">
            <h2 class="text-xl font-bold mb-5 text-gray-800">{{ $id_guru ? 'Edit' : 'Tambah' }} Guru</h2>
            
            <div class="space-y-4">
                <div>
                    <input wire:model="nip" type="text" placeholder="NIP" class="w-full rounded-lg border-gray-300 focus:border-madrasah-500 focus:ring focus:ring-madrasah-200 transition shadow-sm">
                    @error('nip') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <input wire:model="nama_guru" type="text" placeholder="Nama Guru" class="w-full rounded-lg border-gray-300 focus:border-madrasah-500 focus:ring focus:ring-madrasah-200 transition shadow-sm">
                    @error('nama_guru') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <input wire:model="mapel" type="text" placeholder="Mata Pelajaran" class="w-full rounded-lg border-gray-300 focus:border-madrasah-500 focus:ring focus:ring-madrasah-200 transition shadow-sm">
                    @error('mapel') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <input wire:model="no_hp" type="text" placeholder="No HP" class="w-full rounded-lg border-gray-300 focus:border-madrasah-500 focus:ring focus:ring-madrasah-200 transition shadow-sm">
                    @error('no_hp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end mt-8 gap-3">
                <button wire:click="closeModal" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition font-medium">Batal</button>
                <button wire:click="store" class="px-5 py-2 bg-madrasah-600 hover:bg-madrasah-700 text-white rounded-lg shadow-md transition font-bold">Simpan</button>
            </div>
        </div>
    </div>
    @endif
</div>