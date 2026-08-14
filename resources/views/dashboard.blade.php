<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Store Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-lg font-semibold">Welcome to the PROPHAMART admin panel.</p>
                    <p class="mt-2 text-gray-600">Use the menu to manage products and edit your CMS website content.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
