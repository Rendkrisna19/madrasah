<div class="p-6 bg-gray-50 min-h-screen">
    <style>
        /* PENGATURAN CETAK PROFESIONAL */
        @media print {
            nav, aside, .sidebar, .no-print, button, input[type="date"] {
                display: none !important;
            }
            body {
                background: white !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .print-container {
                width: 100% !important;
                max-width: 100% !important;
            }
            .printable-card {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
            }
            table {
                width: 100% !important;
                border-collapse: collapse !important;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #000 !important;
                padding: 10px !important;
                color: black !important;
                font-size: 12pt !important;
            }
            .print-header { display: block !important; }
        }
        .print-header { display: none; }
    </style>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-6 print-container">
            
            @if (session()->has('message'))
                <div class="no-print p-4 bg-emerald-500 text-white rounded-2xl shadow-lg flex items-center">
                    <i class="ph-bold ph-check-circle mr-3 text-2xl"></i>
                    <span class="font-bold">{{ session('message') }}</span>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="no-print p-4 bg-red-500 text-white rounded-2xl shadow-lg flex items-center">
                    <i class="ph-bold ph-warning-circle mr-3 text-2xl"></i>
                    <span class="font-bold">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 printable-card relative">
                
                <div wire:loading wire:target="kelas_id, tanggal" class="absolute inset-0 bg-white/70 backdrop-blur-sm z-10 flex flex-col items-center justify-center rounded-[2.5rem] no-print">
                    <div class="w-10 h-10 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin"></div>
                    <p class="mt-3 font-bold text-gray-500">Memuat Data Santri...</p>
                </div>

                <div class="print-header text-center mb-8 border-b-4 border-double border-gray-800 pb-4">
                    <h1 class="text-2xl font-black uppercase">LAPORAN ABSENSI HARIAN SANTRI</h1>
                    <p class="text-sm font-bold uppercase">Madrasah Aliyah KodifyHub</p>
                    <p class="text-xs italic">Alamat: Jl. Contoh No. 123, Kota Medan</p>
                </div>

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <div>
                        <h2 class="text-2xl font-black text-gray-800 tracking-tight uppercase">Data Kehadiran</h2>
                        <p class="text-sm text-emerald-600 font-bold uppercase">
                            Kelas: {{ $kelas_id ? \App\Models\Kelas::find($kelas_id)->nama_kelas : 'Belum Dipilih' }}
                        </p>
                    </div>
                    <div class="no-print">
                        <input type="date" wire:model.live="tanggal" class="px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                    </div>
                    <div class="print-header text-right text-sm font-bold">
                        Tanggal: {{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y') }}
                    </div>
                </div>

                <div class="mb-8 no-print">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Pilih Kelas</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @foreach($listKelas as $k)
                            <button wire:click="$set('kelas_id', {{ $k->id_kelas }})" 
                                class="p-4 rounded-2xl border-2 transition-all text-center {{ $kelas_id == $k->id_kelas ? 'border-emerald-500 bg-emerald-50 text-emerald-700 shadow-sm' : 'border-gray-100 hover:border-emerald-200 text-gray-500 hover:bg-gray-50' }}">
                                <i class="ph-bold ph-users-three text-2xl mb-1"></i>
                                <div class="text-[11px] font-black uppercase">{{ $k->nama_kelas }}</div>
                            </button>
                        @endforeach
                    </div>
                </div>

                @if($kelas_id)
                <div class="overflow-x-auto rounded-3xl border border-gray-100 no-print">
                    <table class="w-full">
                        <thead class="bg-gray-50 text-[10px] font-black uppercase text-gray-500 tracking-wider">
                            <tr>
                                <th class="px-6 py-4 text-left">Info Santri</th>
                                <th class="px-6 py-4 text-center">Kehadiran (H/S/I/A)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($santris as $s)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800 uppercase text-sm">{{ $s->nama_santri }}</div>
                                    <div class="text-[11px] text-gray-400 font-mono mt-0.5">NIS: {{ $s->nis }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-3">
                                        @foreach([
                                            'H' => 'peer-checked:bg-emerald-500 peer-checked:border-emerald-500 text-emerald-600', 
                                            'S' => 'peer-checked:bg-blue-500 peer-checked:border-blue-500 text-blue-600', 
                                            'I' => 'peer-checked:bg-amber-500 peer-checked:border-amber-500 text-amber-600', 
                                            'A' => 'peer-checked:bg-red-500 peer-checked:border-red-500 text-red-600'
                                        ] as $key => $classes)
                                            <label class="relative flex items-center justify-center cursor-pointer group">
                                                <input type="radio" 
                                                       name="absen_{{ $s->id_santri }}" 
                                                       wire:model="absensiData.{{ $s->id_santri }}" 
                                                       value="{{ $key }}" 
                                                       class="hidden peer">
                                                <div class="w-10 h-10 rounded-xl border-2 border-gray-200 bg-white {{ $classes }} peer-checked:text-white transition-all flex items-center justify-center font-black text-sm shadow-sm group-hover:scale-105">
                                                    {{ $key }}
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <table class="print-header">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 20%;">NIS</th>
                            <th style="width: 50%;">Nama Santri</th>
                            <th style="width: 25%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($santris as $index => $s)
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td>{{ $s->nis }}</td>
                            <td>{{ strtoupper($s->nama_santri) }}</td>
                            <td style="text-align: center; font-weight: bold;">
                                {{ $absensiData[$s->id_santri] ?? '-' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="print-header mt-12 grid grid-cols-2 text-center">
                    <div>
                        <p>Mengetahui,</p>
                        <p style="margin-top: 80px; font-weight: bold; text-decoration: underline;">Kepala Madrasah</p>
                    </div>
                    <div>
                        <p>Medan, {{ date('d F Y') }}</p>
                        <p style="margin-top: 80px; font-weight: bold; text-decoration: underline;">{{ Auth::user()->name }}</p>
                    </div>
                </div>

                <button wire:click="saveAbsensi" wire:loading.attr="disabled" class="no-print mt-8 w-full py-4 bg-gray-900 text-white rounded-2xl font-black text-sm shadow-xl hover:bg-emerald-600 transition-all uppercase tracking-widest flex justify-center items-center disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="saveAbsensi">
                        <i class="ph-bold ph-floppy-disk mr-2 text-lg"></i> Simpan Data Absensi
                    </span>
                    <span wire:loading wire:target="saveAbsensi">
                        <i class="ph-bold ph-spinner animate-spin mr-2 text-lg"></i> Menyimpan...
                    </span>
                </button>
                @else
                <div class="py-24 text-center border-2 border-dashed border-gray-200 rounded-3xl mt-4 no-print">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-50 text-gray-300 mb-4">
                        <i class="ph-bold ph-files text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-800 mb-1">Belum Ada Kelas Terpilih</h3>
                    <p class="text-sm text-gray-400 font-medium">Silakan klik salah satu kelas di atas untuk memulai absensi.</p>
                </div>
                @endif
            </div>
        </div>

        <div class="space-y-6 no-print">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8">
                <h3 class="text-lg font-black text-gray-800 mb-6 uppercase tracking-tighter flex items-center">
                    <i class="ph-bold ph-chart-pie-slice mr-2 text-emerald-500"></i> Statistik
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between p-4 bg-emerald-50 rounded-2xl border border-emerald-100/50">
                        <span class="font-bold text-emerald-700 uppercase text-xs">Hadir (H)</span>
                        <span class="font-black text-emerald-700 text-lg">{{ $rekap['H'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between p-4 bg-blue-50 rounded-2xl border border-blue-100/50">
                        <span class="font-bold text-blue-700 uppercase text-xs">Sakit (S)</span>
                        <span class="font-black text-blue-700 text-lg">{{ $rekap['S'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between p-4 bg-amber-50 rounded-2xl border border-amber-100/50">
                        <span class="font-bold text-amber-700 uppercase text-xs">Izin (I)</span>
                        <span class="font-black text-amber-700 text-lg">{{ $rekap['I'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between p-4 bg-red-50 rounded-2xl border border-red-100/50">
                        <span class="font-bold text-red-700 uppercase text-xs">Alpha (A)</span>
                        <span class="font-black text-red-700 text-lg">{{ $rekap['A'] ?? 0 }}</span>
                    </div>
                </div>

                <button onclick="window.print()" {{ !$kelas_id ? 'disabled' : '' }} class="mt-8 w-full py-4 bg-white border-2 border-gray-200 rounded-2xl font-black text-gray-600 hover:bg-gray-900 hover:text-white hover:border-gray-900 flex items-center justify-center transition-all group disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="ph-bold ph-printer mr-2 text-xl group-hover:animate-bounce"></i> CETAK LAPORAN
                </button>
            </div>
        </div>
        
    </div>
</div>