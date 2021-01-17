<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h1 class="text-xl font-bold text-blue-500 border-b border-blue-500 border-gray-500 w-24">{{ __('Payment Clicks') }}</h1>
            <a href="{{ \Illuminate\Support\Facades\URL::previous() }}"
               class="absolute right-20 text-white font-bold bg-green-400 px-3 py-1 shadow-lg rounded-2xl">bACK</a>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-10">
        <div class="flex flex-col md:flex-row justify-center">
            <div class="p-3">
                @livewire('tables.payment-clicks-table')
            </div>
        </div>
    </div>
</x-app-layout>
