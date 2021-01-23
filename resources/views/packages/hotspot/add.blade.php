<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <div class="font-bold text-blue-500">Add Hotspot Package</div>
            <div class="absolute right-20">
                <a href="{{ \Illuminate\Support\Facades\URL::previous() }}"
                   class="bg-green-400 hover:bg-green-600 rounded-2xl focus:outline-none shadow-lg hover:shadow-2xl transition duration-200 text-white px-5 p-2">Back</a>
            </div>
        </div>
    </x-slot>
    <div class="mt-10 flex justify-center">
        @livewire('packages.hotspot.add')
    </div>
</x-app-layout>
