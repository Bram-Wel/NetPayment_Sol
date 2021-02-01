<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row space-x-20">
            <div>
                <h1 class="text-xl font-bold text-blue-500 border-b border-blue-500 border-gray-500">{{ __('Record Payment') }}</h1>
            </div>
        </div>
    </x-slot>
    <div class="py-12 flex justify-center">
        @livewire('forms.payments.record')
    </div>
</x-app-layout>
