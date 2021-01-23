<x-app-layout>
    <x-slot name="header">
        <h1>{{ __('Dashboard') }}</h1>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between">
                @livewire('new-users')
                @livewire('active-users')
                @livewire('total-amount-daily')
                @livewire('total-amount')
            </div>

            <div class="flex flex-col md:flex-row mt-8 justify-around">
                @livewire('graphs.payments-trend')
                @livewire('graphs.users-trend')
                @livewire('graphs.messages-sent')
            </div>
        </div>
    </div>
</x-app-layout>
