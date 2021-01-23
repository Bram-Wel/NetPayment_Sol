<x-app-layout>
    <x-slot name="header">
        <h1>Edit Hotspot User</h1>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('forms.hotspot.edit-user', ['username'=>$username])
        </div>
    </div>
</x-app-layout>
