<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h1 class="text-xl font-bold text-blue-500 mr-10">{{ __('Payments') }}</h1>
            <a href="{{ route('payment.clicks') }}"
               class="text-xl font-bold text-blue-500 ">{{ __('Payment Clicks') }}</a>

            <a href="{{ route('record-payment') }}"
               class="absolute right-20 text-white font-bold bg-green-400 px-3 py-1 shadow-lg rounded-2xl">Record
                payment</a>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-10">
        <div class="flex flex-col md:flex-row justify-center">
            <div class="p-3">
                @livewire('tables.payments-table')
            </div>
        </div>
    </div>
</x-app-layout>
