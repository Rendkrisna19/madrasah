<div class="p-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wider">
                <i class="fas fa-calendar-alt mr-2 text-indigo-600"></i> Jadwal Mengajar Anda
            </h2>
            <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded uppercase">
                {{ Auth::user()->name }}
            </span>
        </div>
        
        <div class="overflow-x-auto border border-gray-100 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Hari</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Mata Pelajaran</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($jadwalKu as $jadwal)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $jadwal->hari }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-mono">
                                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $jadwal->kelas ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $jadwal->kelas->nama_kelas ?? 'Kelas Tidak Ditemukan' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <span class="font-semibold">{{ $jadwal->nama_mapel }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 17.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-gray-500 font-medium">Jadwal tidak ditemukan untuk ID Guru: {{ Auth::user()->guru_id }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>