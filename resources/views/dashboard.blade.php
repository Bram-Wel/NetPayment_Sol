<x-app-layout>
    <x-slot name="header">
        <h1>{{ __('Profile') }}</h1>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-center">
                <div class="package bg-white shadow-lg rounded-lg p-8 text-center mr-5">
                    <h1 class="font-weight-bolder text-2xl">3mbps at 1500/=</h1>
                    <ul class="text-center mb-5">
                        <li class="text-gray-500">3mbps uploads</li>
                        <li class="text-gray-500">3mbps downloads</li>
                        <li class="text-gray-500">24/7 support</li>
                        <li class="text-gray-500">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>3])
                    </div>
                </div>

                <div class="package bg-white shadow-lg rounded p-8 text-center mr-5">
                    <h1 class="font-weight-bolder text-2xl">5mbps at 2200/=</h1>
                    <ul class="text-center mb-5">
                        <li class="text-gray-500">5mbps uploads</li>
                        <li class="text-gray-500">5mbps downloads</li>
                        <li class="text-gray-500">24/7 support</li>
                        <li class="text-gray-500">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>5])
                    </div>
                </div>

                <div class="package bg-white rounded shadow-lg p-8 text-center">
                    <h1 class="font-weight-bolder text-2xl">7mbps at 3000/=</h1>
                    <ul class="text-center mb-5">
                        <li class="text-gray-500">7mbps uploads</li>
                        <li class="text-gray-500">7mbps downloads</li>
                        <li class="text-gray-500">24/7 support</li>
                        <li class="text-gray-500">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>7])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
