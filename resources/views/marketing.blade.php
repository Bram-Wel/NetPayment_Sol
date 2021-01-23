<x-app-layout>
    <x-slot name="header">
        <h1>{{ __('Marketing') }}</h1>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row">
            <div class="w-1/2 mr-8">
                <h1 class="text-2xl font-bold border-b border-gray-500 w-24 mb-8">SMS</h1>
                @livewire('sms-form')
            </div>
            <div class=" w-1/2">
                <h1 class="text-2xl font-bold border-b border-gray-500 w-24 mb-8">Email</h1>
                @livewire('email-form')
            </div>
        </div>

        <div class="mt-5 mb-5 p-8">
            <h1 class="pl-5 pr-5 pt-2 pb-2 text-2xl">Messages Sent</h1>
            @livewire('tables.messages-sent')
        </div>
    </div>
</x-app-layout>
