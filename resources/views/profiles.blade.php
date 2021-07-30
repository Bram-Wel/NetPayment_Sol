<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <div>
                <a href="{{ route('active') }}"
                   class="font-bold text-blue-500 @if(request()->routeIs('profiles')) border-b border-blue-500 @endif">PPPOE
                    Profiles</a>
                    <a href="{{ route('hotspot-profiles') }}"
                   class="font-bold ml-20 text-blue-500 @if(request()->routeIs('hotspot-profiles')) border-b border-blue-500 @endif">Hotspot
                    Profiles</a>
            </div>
            <div class="flex flex-row ml-auto">
                <a href="/profile/add"
                   class="bg-green-400 hover:shadow-lg text-white font-bold shadow rounded px-5 py-1 transition duration-200">
                    Add Profile
                </a>
            </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between shadow-lg rounded-lg">
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
                        <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Action
                        </th>
                        <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Action
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
                                {{ $profile['local-address'] ?? '' }}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                {{ $profile['remote-address'] ?? ''}}
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                {{ $profile['rate-limit'] ?? ''  }}
                            </td>
                            <td class="text-center py-4 border-b border-gray-200 bg-white text-sm">
                                <a href="/profile/edit/{{ $profile['name']  }}"
                                   class="text-blue-500 border-b border-blue-500">Edit</a>
                            </td>
                            <td class="text-center border-b border-gray-200 bg-white text-sm">
                                <a href="/profile/remove/{{ $profile['.id']}}"
                                   class="text-red-500 border-b border-red-500">Remove</a>
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
