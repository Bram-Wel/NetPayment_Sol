<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h1 class="text-xl font-bold">Packages</h1>
            <div class="absolute right-6 md:right-20 flex -space-x-5">
                @if($package != '0MBPS')
                <span class="relative inline-flex rounded-md shadow-sm">
                    <span
                        class="inline-flex items-center px-4 py-1 border border-green-400 text-base leading-6 font-medium rounded-md font-bold text-green-800 hover:text-green-700 focus:border-green-300 transition ease-in-out duration-150">
                        {{ $package }}
                    </span>
                    <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                </span>
                @else
                <span class="relative inline-flex rounded-md shadow-sm">
                    <span
                        class="inline-flex items-center px-4 py-1 border border-red-400 text-base leading-6 font-medium rounded-md text-red-400 font-bold hover:text-red-700 focus:border-red-300 transition ease-in-out duration-150">
                        Not Subscribed
                    </span>
                    <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                </span>
                @endif
            </div>
        </div>
    </x-slot>
    <div class="md:py-12">
        <div class="mx-auto px-6 md:px-0 lg:px-2">
            <div class="mt-4 mb-4 px-10 md:px-0 md:w-1/4 md:ml-20 text-center md:text-left">
                <h1 class="text-xl font-bold border-b md:w-1/2">Daily Packages</h1>
            </div>
            <div class="flex flex-col md:flex-row justify-center flex-wrap items-center md:space-x-4">
                <div class="package bg-white shadow mb-4 md:mb-0 rounded-lg p-4 text-center w-4/5
                    md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background-image:linear-gradient(to right, #2193b0, #6dd5ed);">
                    <h1 class="text-white"><span class="text-4xl text-white font-bold">1</span><span
                            class="text-sm text-white font-bold">MBPS</span> @ kshs30
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">1mbps uploads</li>
                        <li class="text-white">1mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>1, 'freq'=>'daily'])
                    </div>
                </div>

                <div class="package bg-white shadow rounded-lg mb-4 md:mb-0 p-4 text-center w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background-image:linear-gradient(to right, #11998e, #38ef7d);">
                    <h1 class="text-white"><span class="text-4xl font-bold">2</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs40
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">2mbps uploads</li>
                        <li class="text-white">2mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>2, 'freq'=>'daily'])
                    </div>
                </div>

                <div class="package bg-white rounded-lg shadow p-4 mb-4 md:mb-0 text-center w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background-image: linear-gradient(to right, #4e54c8, #8f94fb);">
                    <h1 class="text-white"><span class="text-4xl font-bold">3</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs55
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">3mbps uploads</li>
                        <li class="text-white">3mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>3, 'freq'=>'daily'])
                    </div>
                </div>

                <div class="package bg-white rounded-lg shadow-2xl p-6 mb-4 md:mb-0 text-center w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="  background: linear-gradient(to right, #e44d26, #f16529);">
                    <h1 class="text-white"><span class="text-4xl font-bold">4</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs75
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">4mbps uploads</li>
                        <li class="text-white">4mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>4, 'freq'=>'daily'])
                    </div>
                </div>

                <div class="package bg-white rounded-lg shadow-lg p-4 mb-4 md:mb-0 text-center w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background: linear-gradient(to right, #f7971e, #ffd200)">
                    <h1 class="text-white"><span class="text-4xl font-bold">5</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs85
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">5mbps uploads</li>
                        <li class="text-white">5mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>5, 'freq'=>'daily'])
                    </div>
                </div>
            </div>
            <div class="mt-4 mb-4 px-10 md:px-0 md:w-1/4 md:ml-20 mt-8 text-center md:text-left">
                <h1 class="text-xl font-bold border-b md:w-1/2">Weekly Packages</h1>
            </div>
            <div class="flex flex-col md:flex-row justify-center flex-wrap items-center md:space-x-4">
                <div class="package bg-white shadow rounded-lg mb-4 md:mb-0 p-4 text-center w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background-image:linear-gradient(to right, #2193b0, #6dd5ed);">
                    <h1 class="text-white"><span class="text-4xl font-bold">1</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs180
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">1mbps uploads</li>
                        <li class="text-white">1mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>1, 'freq'=>'weekly'])
                    </div>
                </div>

                <div class="package bg-white shadow rounded-lg mb-4 md:mb-0 p-4 text-center w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background-image:linear-gradient(to right, #11998e, #38ef7d);">
                    <h1 class="text-white"><span class="text-4xl font-bold">2</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs280
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">2mbps uploads</li>
                        <li class="text-white">2mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>2, 'freq'=>'weekly'])
                    </div>
                </div>

                <div class="package bg-white rounded-lg shadow p-4 mb-4 md:mb-0 text-center w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background-image: linear-gradient(to right, #4e54c8, #8f94fb);">
                    <h1 class="text-white"><span class="text-4xl font-bold">3</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs380
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">3mbps uploads</li>
                        <li class="text-white">3mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>3, 'freq'=>'weekly'])
                    </div>
                </div>

                <div class="package bg-white rounded-lg shadow-2xl p-6 text-center mb-4 md:mb-0 w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background: linear-gradient(to right, #e44d26, #f16529);">
                    <h1 class="text-white"><span class="text-4xl font-bold">4</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs510
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">4mbps uploads</li>
                        <li class="text-white">4mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>4, 'freq'=>'weekly'])
                    </div>
                </div>

                <div class="package bg-white rounded-lg shadow p-4 text-center mb-4 md:mb-0  w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background: linear-gradient(to right, #f7971e, #ffd200)">
                    <h1 class="text-white"><span class="text-4xl font-bold">5</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs580
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">5mbps uploads</li>
                        <li class="text-white">5mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>5, 'freq'=>'weekly'])
                    </div>
                </div>
            </div>
            <div class="mt-4 mb-4 px-10 md:px-0 md:w-1/3 md:ml-20 mt-8 text-center md:text-left">
                <h1 class="text-xl font-bold border-b md:w-1/2">Monthly Packages</h1>
            </div>
            <div class="flex flex-col md:flex-row justify-center flex-wrap items-center md:space-x-4">
                <div class="package bg-white shadow rounded-lg p-4 mb-4 md:mb-0 text-center  w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background-image:linear-gradient(to right, #2193b0, #6dd5ed);">
                    <h1 class="text-white"><span class="text-4xl font-bold">1</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs700
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">1mbps uploads</li>
                        <li class="text-white">1mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>1, 'freq'=>'monthly'])
                    </div>
                </div>

                <div class="package bg-white shadow rounded-lg p-4 mb-4 md:mb-0 text-center  w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background-image:linear-gradient(to right, #11998e, #38ef7d);">
                    <h1 class="text-white"><span class="text-4xl font-bold">2</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs1100
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">2mbps uploads</li>
                        <li class="text-white">2mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>2, 'freq'=>'monthly'])
                    </div>
                </div>

                <div class="package bg-white rounded-lg shadow p-4 mb-4 md:mb-0 text-center w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="background-image: linear-gradient(to right, #4e54c8, #8f94fb);">
                    <h1 class="text-white"><span class="text-4xl font-bold">3</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs1500
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">3mbps uploads</li>
                        <li class="text-white">3mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>3, 'freq'=>'monthly'])
                    </div>
                </div>

                <div class="package bg-white rounded-lg shadow-2xl p-6 mb-4 md:mb-0 text-center w-4/5 md:w-1/6 hover:shadow-2xl transition duration-300"
                    style="  background: linear-gradient(to right, #e44d26, #f16529);">
                    <h1 class="text-white"><span class="text-4xl font-bold">4</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs2000
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">4mbps uploads</li>
                        <li class="text-white">4mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>4, 'freq'=>'monthly'])
                    </div>
                </div>

                <div class="package bg-white rounded-lg shadow mb-4 md:mb-0 p-4 text-center w-4/5 md:w-1/6  hover:shadow-2xl transition duration-300"
                    style="background: linear-gradient(to right, #f7971e, #ffd200)">
                    <h1 class="text-white"><span class="text-4xl font-bold">5</span><span
                            class="text-sm font-bold">MBPS</span> @ kshs2500
                    </h1>
                    <ul class="mb-5 text-left ml-4 mt-4 leading-7">
                        <li class="text-white">5mbps uploads</li>
                        <li class="text-white">5mbps downloads</li>
                        <li class="text-white">24/7 support</li>
                        <li class="text-white">Fast Mobile Payments</li>
                    </ul>
                    <div class="mx-auto">
                        @livewire('buy-now', ['package'=>5, 'freq'=>'monthly'])
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
