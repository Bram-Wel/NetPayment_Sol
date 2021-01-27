<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h1 class="text-xl font-bold">Movie Packages</h1>
        </div>
    </x-slot>
    <div class="md:py-12">
        <div class="mx-auto px-6 md:px-0 lg:px-2">
            <div class="flex flex-col md:flex-row justify-center flex-wrap items-center md:space-x-4">
                <div
                    class="package bg-white shadow mb-4 md:mb-0 rounded-lg p-4 text-center w-4/5
                    md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background-image:linear-gradient(to right, #2193b0, #6dd5ed);">
                    <h1 class="text-white"><span class="text-4xl text-white font-bold">kshs 20/=</span>
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">Unlimited movies</li>
                        <li class="text-white">HD Quality</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('subscribe-movie', ['package'=>1, 'freq'=>'daily'])
                    </div>
                </div>

                <div
                    class="package bg-white shadow rounded-lg mb-4 md:mb-0 p-4 text-center w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background-image:linear-gradient(to right, #11998e, #38ef7d);">
                    <h1 class="text-white"><span class="text-4xl font-bold">kshs 120/=</span>
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">Unlimited movies</li>
                        <li class="text-white">HD Quality</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('subscribe-movie', ['package'=>2, 'freq'=>'daily'])
                    </div>
                </div>

                <div
                    class="package bg-white rounded-lg shadow p-4 mb-4 md:mb-0 text-center w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background-image: linear-gradient(to right, #4e54c8, #8f94fb);">
                    <h1 class="text-white"><span class="text-4xl font-bold">kshs 450/=</span>
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">Unlimited movies</li>
                        <li class="text-white">HD Quality</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('subscribe-movie', ['package'=>3, 'freq'=>'daily'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
