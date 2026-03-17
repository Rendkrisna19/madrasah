<div class="min-h-screen bg-[#FDFDFD] overflow-x-hidden relative selection:bg-emerald-100 selection:text-emerald-900">
    <style>
        @keyframes float-smooth {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(1deg); }
        }
        .animate-float { animation: float-smooth 6s ease-in-out infinite; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 10px; }
        [x-cloak] { display: none !important; }
    </style>

    <nav class="fixed top-0 w-full z-[100] transition-all duration-500 py-4 px-4 md:px-0" 
         x-data="{ open: false, scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 50) ? true : false">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center transition-all duration-500 p-3 rounded-2xl" 
                 :class="scrolled ? 'glass-nav shadow-lg border border-white/40' : 'bg-transparent'">
                <div class="flex items-center gap-3 ml-2">
                    <div class="bg-emerald-600 text-white p-2.5 rounded-2xl shadow-lg shadow-emerald-200">
                        <i class="ph ph-book-open-text text-2xl"></i>
                    </div>
                    <div class="leading-tight">
                        <h1 class="font-black text-gray-900 text-lg tracking-tighter">Madrasah Diniyah</h1>
                        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em]">Al-Ikhlas</p>
                    </div>
                </div>

                <div class="hidden lg:flex items-center bg-white/40 backdrop-blur-md p-1.5 rounded-full border border-white/60 shadow-inner">
                    <a href="#" class="px-6 py-2.5 text-sm font-bold bg-emerald-600 text-white rounded-full shadow-md transition">Beranda</a>
                    <a href="#profil" class="px-6 py-2.5 text-sm font-bold text-gray-600 hover:text-emerald-600 transition">Profil</a>
                    <a href="#berita" class="px-6 py-2.5 text-sm font-bold text-gray-600 hover:text-emerald-600 transition">Berita</a>
                    <a href="#agenda" class="px-6 py-2.5 text-sm font-bold text-gray-600 hover:text-emerald-600 transition">Agenda</a>
                    <a href="#galeri" class="px-6 py-2.5 text-sm font-bold text-gray-600 hover:text-emerald-600 transition">Galeri</a>
                    <a href="#kontak" class="px-6 py-2.5 text-sm font-bold text-gray-600 hover:text-emerald-600 transition">Kontak</a>
                </div>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden md:flex px-6 py-3 text-sm font-bold text-white bg-gray-900 rounded-full hover:bg-black transition-all shadow-lg">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden md:flex px-6 py-3 text-sm font-extrabold text-emerald-700 bg-emerald-50 rounded-full hover:bg-emerald-100 transition-all border border-emerald-100">Login</a>
                    @endauth
                    <button @click="open = !open" class="lg:hidden p-3 text-gray-600 bg-white rounded-2xl border border-gray-100">
                        <i class="ph-bold text-xl" :class="open ? 'ph-x' : 'ph-dots-nine'"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 lg:pt-56 pb-20 lg:pb-40 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                <div class="lg:col-span-7 text-center lg:text-left order-2 lg:order-1" data-aos="fade-right">
                    <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white border border-emerald-100 text-emerald-700 text-[11px] font-black uppercase tracking-widest mb-8 shadow-sm">
                        PENERIMAAN SANTRI BARU 2025/2026
                    </div>
                    <h1 class="text-5xl md:text-6xl lg:text-[72px] font-black text-[#0F2D25] leading-[1.1] mb-8 tracking-tight">
                        {{ $home->sambutan ?? 'Membentuk Generasi Qur\'ani & Berprestasi' }}
                    </h1>
                    
                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start items-center gap-4">
                        @auth
                            <button wire:click="openPPDB" class="group w-full sm:w-auto px-10 py-5 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-200 transition-all flex items-center justify-center gap-3 active:scale-95">
                                Daftar Sekarang <i class="ph-bold ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="group w-full sm:w-auto px-10 py-5 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-200 transition-all flex items-center justify-center gap-3 active:scale-95 text-center">
                                Login untuk Mendaftar <i class="ph-bold ph-lock-key group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest bg-emerald-50 px-4 py-2.5 rounded-xl border border-emerald-100 shadow-sm flex items-center gap-2">
                                <i class="ph-fill ph-info text-emerald-500"></i> Wajib memiliki akun
                            </span>
                        @endauth
                    </div>
                    </div>
                <div class="lg:col-span-5 relative order-1 lg:order-2 animate-float" data-aos="zoom-in" data-aos-delay="200">
                    <div class="relative z-20 overflow-hidden rounded-[4rem] border-[12px] border-white shadow-2xl">
                        @if($home && $home->banner)
                            <img src="{{ asset('storage/'.$home->banner) }}" alt="Hero Banner" class="w-full h-[450px] lg:h-[550px] object-cover">
                        @else
                            <img src="https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?auto=format&fit=crop&w=800&q=80" alt="Placeholder" class="w-full h-[450px] lg:h-[550px] object-cover">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="profil" class="py-24 bg-[#F8FAFC] relative z-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative" data-aos="fade-up">
                    <div class="bg-emerald-600 rounded-[3rem] p-2 rotate-3 overflow-hidden shadow-2xl">
                        @if($profil && $profil->struktur_organisasi)
                            <img src="{{ asset('storage/'.$profil->struktur_organisasi) }}" alt="Struktur" class="rounded-[2.5rem] -rotate-3 scale-110 object-cover h-[500px] w-full transition-all hover:scale-100 duration-700">
                        @else
                            <img src="https://images.unsplash.com/photo-1577412647305-991150c7d163?auto=format&fit=crop&w=800&q=80" alt="Placeholder" class="rounded-[2.5rem] -rotate-3 scale-110 object-cover h-[500px] w-full">
                        @endif
                    </div>
                </div>
                <div data-aos="fade-left" data-aos-delay="200">
                    <span class="text-emerald-600 font-black text-[11px] uppercase tracking-[0.3em] mb-4 block">TENTANG KAMI</span>
                    <h2 class="text-4xl md:text-5xl font-black text-[#0F2D25] mb-8 tracking-tight">Sejarah & Visi Misi</h2>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed font-medium text-justify whitespace-pre-line">
                        {{ $profil->sejarah ?? 'Sejarah madrasah sedang diperbarui.' }}
                    </p>
                    <div class="p-8 bg-white rounded-[2rem] shadow-xl border border-emerald-50 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                            <i class="ph ph-quotes text-6xl text-emerald-600"></i>
                        </div>
                        <h4 class="font-black text-emerald-600 text-lg mb-2 italic">Visi & Misi Kami</h4>
                        <p class="text-sm text-gray-500 font-semibold leading-relaxed whitespace-pre-line">
                            {{ $profil->visi_misi ?? 'Visi & Misi sedang diperbarui.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="berita" class="py-24 bg-white relative z-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center" data-aos="fade-down">
            <span class="text-emerald-600 font-black text-[11px] uppercase tracking-[0.3em] mb-4 block">KABAR TERBARU</span>
            <h2 class="text-4xl font-black text-[#0F2D25] mb-16">Berita & Artikel</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                @forelse($beritas as $news)
                <div class="bg-white border border-gray-100 rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="h-60 overflow-hidden">
                        <img src="{{ asset('storage/'.$news->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-8">
                        <p class="text-emerald-600 text-xs font-bold uppercase mb-3">{{ \Carbon\Carbon::parse($news->tanggal)->format('d M Y') }}</p>
                        <h3 class="text-xl font-bold text-gray-900 mb-4 line-clamp-2">{{ $news->judul_berita }}</h3>
                        <a href="#" class="text-gray-900 font-black text-sm flex items-center gap-2 hover:text-emerald-600 transition group">
                            Baca Selengkapnya <i class="ph ph-arrow-right group-hover:translate-x-2 transition-transform"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center border-2 border-dashed border-gray-100 rounded-[3rem] text-gray-400 font-bold italic">Belum ada berita terbaru.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="agenda" class="py-24 bg-[#F8FAFC] relative z-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-end mb-16" data-aos="fade-right">
                <div>
                    <span class="text-emerald-600 font-black text-[11px] uppercase tracking-[0.3em] mb-4 block text-left">KEGIATAN</span>
                    <h2 class="text-4xl font-black text-[#0F2D25]">Agenda Mendatang</h2>
                </div>
                <a href="#" class="text-emerald-600 font-black hover:underline group">Lihat Semua <i class="ph ph-caret-double-right group-hover:translate-x-1 transition-transform"></i></a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($agendas as $agenda)
                    <div wire:key="agenda-{{ $agenda->id_agenda }}" class="group bg-white border border-gray-100 rounded-[2.5rem] p-8 hover:shadow-2xl transition-all duration-500" data-aos="zoom-in-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="w-16 h-20 bg-emerald-600 text-white rounded-2xl flex flex-col items-center justify-center font-black mb-8 shadow-lg group-hover:rotate-6 transition-transform">
                            <span class="text-2xl">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d') }}</span>
                            <span class="text-[10px] uppercase tracking-widest">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('M') }}</span>
                        </div>
                        <h3 class="text-2xl font-black text-[#0F2D25] mb-4">{{ $agenda->nama_agenda }}</h3>
                        <p class="text-gray-500 font-medium line-clamp-3 leading-relaxed">{{ $agenda->deskripsi }}</p>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center text-gray-400 font-bold italic border-2 border-dashed rounded-[3rem]">Belum ada agenda terdekat.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="galeri" class="py-24 bg-white relative z-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div data-aos="fade-down">
                <span class="text-emerald-600 font-black text-[11px] uppercase tracking-[0.3em] mb-4 block">MOMEN MADRASAH</span>
                <h2 class="text-4xl font-black text-[#0F2D25] mb-12">Galeri Foto</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($galeries as $galeri)
                    <div class="group relative h-64 overflow-hidden rounded-2xl shadow-sm" data-aos="flip-left" data-aos-delay="{{ $loop->iteration * 50 }}">
                        <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->kategori }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-125">
                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6 text-left transform translate-y-4 group-hover:translate-y-0">
                            <p class="text-white font-black text-sm uppercase tracking-wider mb-1">{{ $galeri->kategori }}</p>
                            <p class="text-emerald-100 text-[10px] line-clamp-2 leading-tight">{{ $galeri->deskripsi }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 border-2 border-dashed border-gray-100 rounded-[2rem]">
                        <p class="text-gray-400 font-bold italic text-center">Belum ada koleksi foto yang diunggah.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="kontak" class="py-24 bg-emerald-900 text-white relative z-20 overflow-hidden shadow-2xl">
        <div class="max-w-7xl mx-auto px-8 lg:px-12 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-aos="fade-right">
                <h2 class="text-4xl md:text-5xl font-black mb-6 tracking-tight">Hubungi Kami</h2>
                <p class="text-emerald-100/70 text-lg mb-10 leading-relaxed">Punya pertanyaan seputar pendaftaran atau kegiatan belajar mengajar? Tim kami siap membantu Anda.</p>
                <div class="space-y-8">
                    <div class="flex items-start gap-6 group">
                        <div class="w-14 h-14 bg-white/10 rounded-xl flex items-center justify-center shrink-0 border border-white/5 transition-all group-hover:scale-110 group-hover:bg-emerald-600">
                            <i class="ph ph-map-pin text-2xl text-emerald-300"></i>
                        </div>
                        <div>
                            <p class="text-xs text-emerald-400 font-black uppercase tracking-[0.2em] mb-1">Alamat Madrasah</p>
                            <p class="text-lg font-bold leading-relaxed">{{ $kontak->alamat ?? 'Alamat belum diatur' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6 group">
                        <div class="w-14 h-14 bg-white/10 rounded-xl flex items-center justify-center shrink-0 border border-white/5 transition-all group-hover:scale-110 group-hover:bg-emerald-600">
                            <i class="ph ph-phone text-2xl text-emerald-300"></i>
                        </div>
                        <div>
                            <p class="text-xs text-emerald-400 font-black uppercase tracking-[0.2em] mb-1">WhatsApp / Telepon</p>
                            <p class="text-lg font-bold">{{ $kontak->no_hp ?? '+62 8xx-xxxx-xxxx' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6 group">
                        <div class="w-14 h-14 bg-white/10 rounded-xl flex items-center justify-center shrink-0 border border-white/5 transition-all group-hover:scale-110 group-hover:bg-emerald-600">
                            <i class="ph ph-envelope text-2xl text-emerald-300"></i>
                        </div>
                        <div>
                            <p class="text-xs text-emerald-400 font-black uppercase tracking-[0.2em] mb-1">Email Resmi</p>
                            <p class="text-lg font-bold">{{ $kontak->email ?? 'info@madrasah.sch.id' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-2 rounded-2xl text-gray-900 shadow-2xl relative" data-aos="fade-left">
                <div class="w-full h-[450px] rounded-xl overflow-hidden relative">
                    @if($kontak && $kontak->lokasi_maps)
                        <div class="w-full h-full scale-105 transition-transform duration-700">
                            {!! $kontak->lokasi_maps !!}
                        </div>
                        <style>
                            iframe { width: 100% !important; height: 100% !important; border: 0 !important; }
                        </style>
                    @else
                        <div class="flex flex-col items-center justify-center h-full text-gray-400 space-y-3 bg-gray-50">
                            <i class="ph ph-map-pin-line text-4xl"></i>
                            <p class="font-bold italic text-sm text-center">Peta belum dikonfigurasi...</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @auth
    <div x-show="$wire.isModalPPDB" x-cloak class="fixed inset-0 z-[200] flex items-center justify-center p-4">
        <div x-show="$wire.isModalPPDB" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0 bg-emerald-950/60 backdrop-blur-md" wire:click="closePPDB"></div>
        
        <div x-show="$wire.isModalPPDB" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="bg-white w-full max-w-2xl rounded-[3rem] relative z-[210] overflow-hidden shadow-2xl border border-white/20">
            <div class="p-8 md:p-10 max-h-[90vh] overflow-y-auto custom-scrollbar">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Formulir PPDB</h2>
                        <p class="text-sm text-emerald-600 font-black uppercase tracking-widest mt-1">Tahun Ajaran 2025/2026</p>
                    </div>
                    <button wire:click="closePPDB" class="w-12 h-12 flex items-center justify-center bg-gray-50 text-gray-400 rounded-full hover:bg-red-50 hover:text-red-500 transition-all duration-300">
                        <i class="ph ph-x text-2xl"></i>
                    </button>
                </div>

                <form wire:submit.prevent="submitPendaftaran" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-full">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap Santri</label>
                            <input wire:model="nama_lengkap" type="text" class="w-full px-6 py-4 bg-gray-50 border border-transparent rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none font-bold transition-all" placeholder="Masukkan nama lengkap...">
                            @error('nama_lengkap') <span class="text-red-500 text-[10px] font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Jenis Kelamin</label>
                            <select wire:model="jk" class="w-full px-6 py-4 bg-gray-50 border border-transparent rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none font-bold transition-all">
                                <option value="">Pilih JK</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('jk') <span class="text-red-500 text-[10px] font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Asal Sekolah</label>
                            <input wire:model="asal_sekolah" type="text" class="w-full px-6 py-4 bg-gray-50 border border-transparent rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none font-bold transition-all" placeholder="SD/MI Asal...">
                            @error('asal_sekolah') <span class="text-red-500 text-[10px] font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Tempat Lahir</label>
                            <input wire:model="tempat_lahir" type="text" class="w-full px-6 py-4 bg-gray-50 border border-transparent rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none font-bold transition-all" placeholder="Kota Lahir...">
                            @error('tempat_lahir') <span class="text-red-500 text-[10px] font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Tanggal Lahir</label>
                            <input wire:model="tanggal_lahir" type="date" class="w-full px-6 py-4 bg-gray-50 border border-transparent rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none font-bold transition-all">
                            @error('tanggal_lahir') <span class="text-red-500 text-[10px] font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Nama Ayah / Wali</label>
                            <input wire:model="nama_ayah" type="text" class="w-full px-6 py-4 bg-gray-50 border border-transparent rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none font-bold transition-all" placeholder="Nama wali murid...">
                            @error('nama_ayah') <span class="text-red-500 text-[10px] font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">No. WA Orang Tua</label>
                            <input wire:model="no_hp_orang_tua" type="text" class="w-full px-6 py-4 bg-gray-50 border border-transparent rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none font-bold transition-all" placeholder="628xxxx">
                            @error('no_hp_orang_tua') <span class="text-red-500 text-[10px] font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-full">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Alamat Lengkap</label>
                            <textarea wire:model="alamat_lengkap" rows="3" class="w-full px-6 py-4 bg-gray-50 border border-transparent rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none font-bold transition-all" placeholder="Alamat rumah sekarang..."></textarea>
                            @error('alamat_lengkap') <span class="text-red-500 text-[10px] font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <button type="submit" class="w-full py-5 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 hover:shadow-emerald-200 transition-all flex items-center justify-center gap-3">
                        <span wire:loading.remove wire:target="submitPendaftaran">Kirim Pendaftaran</span>
                        <span wire:loading wire:target="submitPendaftaran" class="flex items-center gap-2">
                            <i class="ph ph-circle-notch animate-spin"></i> Memproses...
                        </span>
                        <i wire:loading.remove wire:target="submitPendaftaran" class="ph-bold ph-paper-plane-tilt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if(session()->has('success_ppdb'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 6000)" x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="translate-y-20 opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-20 opacity-0" class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[300] bg-white border-2 border-emerald-500 p-2 rounded-[2.5rem] shadow-2xl flex items-center gap-4 pr-6">
        <div class="bg-emerald-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg">
            <i class="ph-bold ph-check text-2xl"></i>
        </div>
        <div>
            <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Pendaftaran Terkirim!</p>
            <p class="font-bold text-gray-900 text-sm">{{ session('success_ppdb') }}</p>
        </div>
        <button @click="show = false" class="ml-4 p-2 text-gray-400 hover:text-gray-900 transition-colors">
            <i class="ph ph-x font-bold"></i>
        </button>
    </div>
    @endif
    @endauth
    <footer class="py-16 border-t border-gray-100 bg-white relative z-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 items-center gap-12">
            <div class="flex items-center gap-3">
                <div class="bg-emerald-600 text-white p-3 rounded-2xl shadow-lg">
                    <i class="ph ph-book-open-text text-2xl"></i>
                </div>
                <div class="text-left">
                    <p class="font-black text-gray-900 text-xl tracking-tighter uppercase">Al-Ikhlas</p>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Madrasah Diniyah</p>
                </div>
            </div>
            
            <div class="text-center order-3 md:order-2">
                <p class="text-gray-400 text-sm font-medium">© 2026 Madrasah Diniyah Al-Ikhlas. <br> Made with <i class="ph-fill ph-heart text-red-500"></i> for Education.</p>
            </div>
            
            <div class="flex justify-end gap-6 order-2 md:order-3">
                <a href="#" class="w-12 h-12 flex items-center justify-center rounded-xl bg-gray-50 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 transition-all border border-gray-100 shadow-sm"><i class="ph ph-instagram-logo text-2xl"></i></a>
                <a href="#" class="w-12 h-12 flex items-center justify-center rounded-xl bg-gray-50 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 transition-all border border-gray-100 shadow-sm"><i class="ph ph-facebook-logo text-2xl"></i></a>
                <a href="#" class="w-12 h-12 flex items-center justify-center rounded-xl bg-gray-50 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 transition-all border border-gray-100 shadow-sm"><i class="ph ph-youtube-logo text-2xl"></i></a>
            </div>
        </div>
    </footer>
</div>