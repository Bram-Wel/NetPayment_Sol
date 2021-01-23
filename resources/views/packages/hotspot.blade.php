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
                <a href="/packages/hotspot/add"
                   class="bg-green-400 hover:bg-green-600 shadow-lg hover:shadow-xl rounded-2xl text-white p-2 px-4 transition duration-200">Add
                    Hotspot Package</a>
            </div>
        </div>
    </x-slot>

    <div class="flex flex-row justify-center flex-wrap space-x-10 mt-10">
        @foreach($packages as $package)
            <div class="bg-white rounded-lg shadow-lg p-4 w-1/5 text-center">
                <h1 class="text-xl font-bold mb-2">{{ $package->speed }}mbps @ {{ $package->price }}/=</h1>
                <p class="leading-loose mb-2 font-bold">For {{ $package->time }}</p>
                <p class="leading-loose mb-2">{{ $package->speed }}mbps downloads</p>
                <p class="leading-loose mb-2">{{ $package->speed }}mbps uploads</p>
                <p class="leading-loose mb-2">24/7 support</p>
                <p class="leading-loose mb-4">Fast Mobile Payment</p>
                <a href="/packages/hotspot/edit/{{{$package->id}}}" class="bg-green-500 hover:bg-green-600 transition duration-200 text-white font-bold p-2 mb-4 px-5
             rounded-2xl shadow hover:shadow-lg">Edit</a>
                <a href="/packages/hotspot/delete/{{{$package->id}}}"
                   class="font-bold text-red-500 hover:underline transition duration-200 pl-6">Delete</a>
            </div>
        @endforeach
    </div>
</x-app-layout>
