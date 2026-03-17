<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Manajemen Pengguna</h2>
            <p class="text-sm text-gray-500 font-medium">Atur hak akses akun sistem informasi madrasah.</p>
        </div>
        
        <button wire:click="openModal" class="px-6 py-3 bg-madrasah-600 text-white font-black rounded-2xl shadow-lg shadow-emerald-100 hover:bg-madrasah-700 transition flex items-center gap-2 text-sm">
            <i class="ph-bold ph-user-plus text-lg"></i> Tambah Pengguna
        </button>
    </div>

    <div class="flex gap-4 mb-4">
        <div class="relative w-full md:w-1/3">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="ph ph-magnifying-glass text-gray-400"></i>
            </span>
            <input wire:model.live="search" type="text" placeholder="Cari nama, username, atau email..." 
                   class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-madrasah-500 outline-none text-sm shadow-sm transition">
        </div>
    </div>

    @if (session()->has('message_user'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl text-sm flex items-center mb-4">
            <i class="ph ph-check-circle mr-2 text-xl"></i> {{ session('message_user') }}
        </div>
    @endif

    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Nama / Username</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Email</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Role</th>
                    <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-madrasah-100 text-madrasah-700 flex items-center justify-center font-black">
                                {{ substr($user->nama, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $user->nama }}</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">@ {{ $user->username }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 font-medium">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-600' : 'bg-blue-100 text-blue-600' }}">
                            {{ str_replace('_', ' ', $user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-1">
                        <button wire:click="edit({{ $user->id }})" class="p-2 text-orange-600 hover:bg-orange-50 rounded-lg transition"><i class="ph-bold ph-pencil-simple text-xl"></i></button>
                        <button onclick="confirm('Hapus pengguna ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $user->id }})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition"><i class="ph-bold ph-trash text-xl"></i></button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-10 text-center text-gray-400">Data tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-6 border-t border-gray-50">{{ $users->links() }}</div>
    </div>

    @if($isModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" wire:click="closeModal"></div>
        <div class="bg-white w-full max-w-md rounded-[2.5rem] relative z-10 overflow-hidden shadow-2xl">
            <div class="p-8">
                <h2 class="text-2xl font-black text-gray-900 mb-6">{{ $id_user ? 'Edit' : 'Tambah' }} Pengguna</h2>

                <form wire:submit.prevent="store" class="space-y-4">
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                        <input wire:model="nama" type="text" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none font-bold">
                        @error('nama') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Username</label>
                        <input wire:model="username" type="text" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none font-bold">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Email</label>
                        <input wire:model="email" type="email" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none font-bold">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Role Akses</label>
                        <select wire:model.live="role" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none font-bold">
                            <option value="admin">Admin</option>
                            <option value="guru">Guru</option>
                            <option value="wali_santri">Wali Santri</option>
                        </select>
                    </div>

                    @if($role === 'guru')
                    <div data-aos="fade-down">
                        <label class="block text-xs font-black text-emerald-600 uppercase tracking-widest mb-2 italic">Hubungkan ke Data Guru:</label>
                        <select wire:model="guru_id" class="w-full px-6 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none font-bold text-emerald-900">
                            <option value="">-- Pilih Guru --</option>
                            @foreach($listGuru as $g)
                                <option value="{{ $g->id_guru }}">{{ $g->nama_guru }} (NIP: {{ $g->nip }})</option>
                            @endforeach
                        </select>
                        @error('guru_id') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>
                    @endif

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Password</label>
                        <input wire:model="password" type="password" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none font-bold">
                    </div>

                    <button type="submit" class="w-full py-5 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl transition-all">
                        {{ $id_user ? 'Simpan Perubahan' : 'Buat Akun Sekarang' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>