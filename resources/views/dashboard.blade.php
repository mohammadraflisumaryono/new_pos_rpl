<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white-pink overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Tambahkan ini di bagian akhir template jika Anda ingin mengintegrasikan CSS langsung di template ini -->
<style>
    .bg-white-pink {
        background-color: #ffcccc;
    }
    .font-semibold {
        color: #ff66b2; /* Warna pink */
    }
    .text-gray-900 {
        color: #333333;
    }
</style>
