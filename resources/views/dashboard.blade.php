<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card-body border pb-5">
                    <h1 class="h3 pb-2 mb-5 border-bottom">Form Create Product</h1>
                    @livewire('product.create')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
