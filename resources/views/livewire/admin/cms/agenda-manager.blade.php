<div>
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-800">Daftar Agenda Kegiatan</h3>
        <button wire:click="openModal" class="flex items-center px-4 py-2 bg-madrasah-600 text-white rounded-lg hover:bg-madrasah-700 transition font-medium text-sm shadow-sm">
            <i class="ph ph-plus-circle text-lg mr-2"></i> Tambah Agenda
        </button>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg flex items-center text-sm">
            <i class="ph ph-check-circle text-xl mr-2"></i> {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto border border-gray-100 rounded-xl">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-4">Nama Agenda</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Deskripsi</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($agendas as $agenda)
                <tr wire:key="agenda-{{ $agenda->id_agenda }}" class="bg-white border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold text-gray-900">{{ $agenda->nama_agenda }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-semibold">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}</span>
                    </td>
                    <td class="px-6 py-4 truncate max-w-xs">{{ $agenda->deskripsi }}</td>
                    <td class="px-6 py-4 flex justify-center space-x-2">
                        <button wire:click="edit({{ $agenda->id_agenda }})" class="p-2 text-orange-500 hover:bg-orange-50 rounded-lg transition" title="Edit">
                            <i class="ph ph-pencil-simple text-lg"></i>
                        </button>
                        <button wire:click="confirmDelete({{ $agenda->id_agenda }})" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <i class="ph ph-trash text-lg"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada data agenda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($isModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 overflow-hidden">
            
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-lg font-bold text-gray-800">{{ $agenda_id ? 'Edit Agenda' : 'Tambah Agenda Baru' }}</h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-red-500 transition">
                    <i class="ph ph-x text-xl"></i>
                </button>
            </div>

            <form wire:submit.prevent="store" class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Agenda</label>
                    <input type="text" wire:model="nama_agenda" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-madrasah-500 outline-none text-sm" placeholder="Contoh: Ujian Tengah Semester">
                    @error('nama_agenda') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Pelaksanaan</label>
                    <input type="date" wire:model="tanggal" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-madrasah-500 outline-none text-sm">
                    @error('tanggal') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Kegiatan</label>
                    <textarea wire:model="deskripsi" rows="3" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-madrasah-500 outline-none text-sm" placeholder="Jelaskan detail agenda..."></textarea>
                    @error('deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4 flex justify-end space-x-2">
                    <button type="button" wire:click="closeModal" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-madrasah-600 hover:bg-madrasah-700 rounded-lg transition">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    @if($isDeleteModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm mx-4 p-6 text-center">
            <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="ph ph-warning text-3xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Hapus Agenda?</h3>
            <p class="text-sm text-gray-500 mb-6">Tindakan ini tidak dapat dibatalkan. Data agenda akan dihapus secara permanen dari sistem.</p>
            <div class="flex justify-center space-x-3">
                <button wire:click="$set('isDeleteModalOpen', false)" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Batal</button>
                <button wire:click="delete" class="px-5 py-2.5 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-lg transition">Ya, Hapus!</button>
            </div>
        </div>
    </div>
    @endif
</div>