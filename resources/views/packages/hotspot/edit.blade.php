<x-app-layout>
    <x-slot name="header">
        <h1>{{ __('Edit Hotspot Package') }}</h1>
    </x-slot>
    <div class="mt-10 flex justify-center">
        @livewire('packages.hotspot.edit', ['packageId'=>$packageId])
    </div>
</x-app-layout>
