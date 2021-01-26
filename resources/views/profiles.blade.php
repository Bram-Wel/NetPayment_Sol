<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row space-x-20">
            <div>
                <a href="{{ route('active') }}"
                   class="font-bold text-blue-500 @if(request()->routeIs('profiles')) border-b border-blue-500 @endif">PPPOE
                    Profiles</a>
            </div>
            <div>
                <a href="{{ route('hotspot-profiles') }}"
                   class="font-bold text-blue-500 @if(request()->routeIs('hotspot-profiles')) border-b border-blue-500 @endif">Hotspot
                    Profiles</a>
            </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-row justify-between">
                <h1 class="pb-2 text-2xl">User Profiles</h1>
                <a href="/profile/add"
                   class="bg-green-400 hover:bg-green-800 text-white shadow-lg rounded-xl px-5 py-1 h-8">
                    Add Profile
                </a>
            </div>

            <div class="flex flex-col md:flex-row justify-between">
                <table class="table table-fixed min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            #
                        </th>
                        <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Profile Name
                        </th>
                        <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Local Address
                        </th>
                        <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Remote Address
                        </th>
                        <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Rate Limit
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($profiles as $index=>$profile)
                        @if($profile['name'] != 'default' && $profile['name'] != 'default-encryption')
                        <tr>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                {{ $index }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                {{ $profile['name'] }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">

                            {{ $profile['local-address'] }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                {{ $profile['remote-address'] }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                {{ $profile['rate-limit'] }}
                            </td>
                            <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm">
                                <a href="/profile/remove/{{ $profile['.id']}}"
                                   class="bg-red-400 text-white p-2 rounded-md">Remove</a>
                            </td>
                            <td class="px-2 py-4 border-b border-gray-200 bg-white text-sm">
                                <a href="/profile/edit/{{ $profile['name']  }}"
                                   class="bg-blue-400 hover:bg-blue-800 text-white p-2 px-6 rounded-md">Edit</a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
