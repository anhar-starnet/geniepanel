<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            GeniePanel Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold">Pelanggan</h3>
                    <p class="text-3xl mt-2">0</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold">ONT Online</h3>
                    <p class="text-3xl mt-2">0</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold">ONT Offline</h3>
                    <p class="text-3xl mt-2">0</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold">ODP</h3>
                    <p class="text-3xl mt-2">0</p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
