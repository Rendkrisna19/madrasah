<div class="max-w-7xl mx-auto space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Data Akademik</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola data guru, santri, kelas, dan jadwal pelajaran.</p>
    </div>

    <div x-data="{ activeTab: 'santri' }" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="flex overflow-x-auto border-b border-gray-100 bg-gray-50/50 p-2 gap-2 hide-scroll">
            <template x-for="tab in ['santri', 'guru', 'kelas', 'jadwal']">
                <button @click="activeTab = tab" 
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all whitespace-nowrap capitalize"
                        :class="activeTab === tab ? 'bg-madrasah-600 text-white shadow-md' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700'">
                    <span x-text="tab"></span>
                </button>
            </template>
        </div>

        <div class="p-6">
            <div x-show="activeTab === 'santri'" x-cloak x-transition.opacity>
                @livewire('admin.akademik.santri-manager')
            </div>

            <div x-show="activeTab === 'guru'" x-cloak x-transition.opacity>
                @livewire('admin.akademik.guru-manager')
            </div>

            <div x-show="activeTab === 'kelas'" x-cloak x-transition.opacity>
                @livewire('admin.akademik.kelas-manager')
            </div>

            <div x-show="activeTab === 'jadwal'" x-cloak x-transition.opacity>
                @livewire('admin.akademik.jadwal-manager')
            </div>
        </div>
    </div>
</div>