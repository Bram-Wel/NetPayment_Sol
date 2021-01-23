<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <div class="font-bold text-blue-500">Add Hotspot Profile</div>
            <div class="absolute right-20">
                <a href="{{ \Illuminate\Support\Facades\URL::previous() }}"
                   class="bg-green-400 hover:bg-green-600 rounded-2xl focus:outline-none shadow-lg hover:shadow-2xl transition duration-200 text-white px-5 p-2">Back</a>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            @livewire('hotspot.profile.add')
        </div>
    </div>
</x-app-layout>
