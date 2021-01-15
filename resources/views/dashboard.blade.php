<x-app-layout>
    <x-slot name="header">
        <h1>{{ __('Packages') }}</h1>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-4 mb-8 w-1/4 ml-1/6">
                <h1 class="text-xl font-bold border-b w-1/2">Daily Packages</h1>
            </div>
            <div class="flex flex-col md:flex-row justify-center">
                <div class="package bg-white shadow-lg rounded-lg p-8 text-center mr-5">
                    <h1 class="font-weight-bolder text-2xl">1mbps at 25/=</h1>
                    <ul class="text-center mb-5">
                        <li class="text-gray-500">1mbps uploads</li>
                        <li class="text-gray-500">1mbps downloads</li>
                        <li class="text-gray-500">24/7 support</li>
                        <li class="text-gray-500">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>3, 'freq'=>'daily'])
                    </div>
                </div>

                <div class="package bg-white shadow-lg rounded p-8 text-center mr-5">
                    <h1 class="font-weight-bolder text-2xl">2mbps at 40/=</h1>
                    <ul class="text-center mb-5">
                        <li class="text-gray-500">2mbps uploads</li>
                        <li class="text-gray-500">2mbps downloads</li>
                        <li class="text-gray-500">24/7 support</li>
                        <li class="text-gray-500">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>2, 'freq'=>'daily'])
                    </div>
                </div>

                <div class="package bg-white rounded shadow-lg p-8 text-center">
                    <h1 class="font-weight-bolder text-2xl">3mbps at 50/=</h1>
                    <ul class="text-center mb-5">
                        <li class="text-gray-500">3mbps uploads</li>
                        <li class="text-gray-500">3mbps downloads</li>
                        <li class="text-gray-500">24/7 support</li>
                        <li class="text-gray-500">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>3, 'freq'=>'daily'])
                    </div>
                </div>

                <div class="package bg-white rounded shadow-lg p-8 text-center">
                    <h1 class="font-weight-bolder text-2xl">4mbps at 65/=</h1>
                    <ul class="text-center mb-5">
                        <li class="text-gray-500">4mbps uploads</li>
                        <li class="text-gray-500">4mbps downloads</li>
                        <li class="text-gray-500">24/7 support</li>
                        <li class="text-gray-500">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>4, 'freq'=>'daily'])
                    </div>
                </div>

                <div class="package bg-white rounded shadow-lg p-8 text-center">
                    <h1 class="font-weight-bolder text-2xl">5mbps at 85/=</h1>
                    <ul class="text-center mb-5">
                        <li class="text-gray-500">5mbps uploads</li>
                        <li class="text-gray-500">5mbps downloads</li>
                        <li class="text-gray-500">24/7 support</li>
                        <li class="text-gray-500">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>5, 'freq'=>'daily'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
