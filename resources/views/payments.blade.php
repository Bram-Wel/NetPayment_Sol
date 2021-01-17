<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h1 class="text-xl font-bold text-blue-500 border-b border-blue-500 border-gray-500 w-24">{{ __('Payments') }}</h1>
            <a href="{{ route('record-payment') }}"
               class="absolute right-20 text-white font-bold bg-green-400 px-3 py-1 shadow-lg rounded-2xl">Record
                payment</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-10">
            <div class="flex flex-col md:flex-row justify-center">
                <div class="p-3">
                    <h1 class="pt-2 pb-2 text-2xl">Payments</h1>
                    @livewire('tables.payments-table')
                </div>
            </div>
            <div class="p-5">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
