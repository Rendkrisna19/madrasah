<div class="max-w-7xl mx-auto space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Kelola Konten CMS</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola semua informasi publik website madrasah dalam satu tempat.</p>
    </div>

    <div x-data="{ activeTab: 'agenda' }" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="flex overflow-x-auto border-b border-gray-100 bg-gray-50/50 p-2 gap-2 hide-scroll">
            <template x-for="tab in ['home', 'profil', 'agenda', 'berita', 'galeri', 'kontak']">
                <button @click="activeTab = tab" 
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all whitespace-nowrap capitalize"
                        :class="activeTab === tab ? 'bg-madrasah-600 text-white shadow-md' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700'">
                    <span x-text="tab"></span>
                </button>
            </template>
        </div>

        <div class="p-6">
            <div x-show="activeTab === 'home'" x-cloak x-transition.opacity>
                @livewire('admin.cms.home-manager')
            </div>

            <div x-show="activeTab === 'profil'" x-cloak x-transition.opacity>
                @livewire('admin.cms.profil-manager')
            </div>

            <div x-show="activeTab === 'agenda'" x-cloak x-transition.opacity>
                @livewire('admin.cms.agenda-manager')
            </div>

            <div x-show="activeTab === 'berita'" x-cloak x-transition.opacity>
                @livewire('admin.cms.berita-manager')
            </div>

            <div x-show="activeTab === 'galeri'" x-cloak x-transition.opacity>
                @livewire('admin.cms.galeri-manager')
            </div>

            <div x-show="activeTab === 'kontak'" x-cloak x-transition.opacity>
                @livewire('admin.cms.kontak-manager')
            </div>
        </div>
    </div>
</div>