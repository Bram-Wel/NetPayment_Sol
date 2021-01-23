<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row space-x-20">
            <div>
                <a href="{{ route('active') }}"
                   class="font-bold text-blue-500 @if(request()->routeIs('active')) border-b border-blue-500 @endif">PPPOE
                    Users</a>
            </div>
            <div>
                <a href="{{ route('hotspot-active') }}"
                   class="font-bold text-blue-500 @if(request()->routeIs('hotspot-active')) border-b border-blue-500 @endif">Hotspot
                    Users</a>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="mb-5 p-3">
                @livewire('active-table')
            </div>
        </div>
    </div>
</x-app-layout>
