<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row space-x-20">
            <div>
                <a href="{{ route('Users') }}"
                   class="font-bold text-blue-500 @if(request()->routeIs('Users')) border-b border-blue-500 @endif">PPPOE
                    Users</a>
            </div>
            <div>
                <a href="{{ route('hotspot-users') }}"
                   class="font-bold text-blue-500 @if(request()->routeIs('hotspot-users')) border-b border-blue-500 @endif">Hotspot
                    Users</a>
            </div>
            <div class="absolute right-20 flex justify-center content-center items-center">
                <a href="/user/add"
                   class="bg-green-400 hover:bg-green-800 text-white shadow-lg rounded-xl h-8 pt-1 px-5">
                    Add User
                </a>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="flex flex-col md:flex-row justify-center">
                <div class="p-3">
                    <h1 class="pt-2 pb-2 text-2xl">Users</h1>
                    @livewire('tables.pppoe-users-table')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
