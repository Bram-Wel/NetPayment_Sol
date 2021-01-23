<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row space-x-20">
            <div class="pppoe">
                <a href="{{ route('packages') }}"
                   class="text-blue-500 font-bold @if(request()->routeIs('packages')) border-b border-blue-500 @endif">PPPOE</a>
            </div>
            <div class="hotspot">
                <a href="{{ route('hotspot-packages') }}"
                   class="text-blue-500 font-bold @if(request()->routeIs('hotspot-packages')) border-b border-blue-500 @endif">Hotspot</a>
            </div>
            <div class="absolute right-20">
                <a href="/packages/add"
                   class="bg-green-400 hover:bg-green-600 shadow-lg hover:shadow-xl transition duration-200 rounded-2xl text-white p-2 px-4 transition duration-200">Add
                    PPPOE Package</a>
            </div>
        </div>
    </x-slot>

    <div class="flex flex-row flex-wrap justify-center mt-10">
        @foreach($packages as $package)
            <div class="bg-white rounded-lg shadow-lg mr-4 mb-6 p-4 w-1/5 text-center">
                <h1 class="text-xl font-bold mb-2">{{ $package->speed }}mbps @ {{ $package->price }}/=</h1>
                <p class="leading-loose mb-2 font-bold">For {{ $package->time }}</p>
                <p class="leading-loose mb-2">{{ $package->speed }}mbps downloads</p>
                <p class="leading-loose mb-2">{{ $package->speed }}mbps uploads</p>
                <p class="leading-loose mb-2">24/7 support</p>
                <p class="leading-loose mb-4">Fast Mobile Payment</p>
                <a href="/packages/edit/{{{$package->id}}}" class="bg-blue-400 hover:bg-blue-600 transition duration-200 text-white font-bold p-2 mb-4 px-8
             rounded-2xl shadow hover:shadow-lg">Edit</a>

                <a href="/packages/delete/{{{$package->id}}}"
                   class="mt-4 mb-4 text-red-500 font-bold pt-4 w-full pl-8 hover:underline">Delete</a>
            </div>
        @endforeach
    </div>
</x-app-layout>
