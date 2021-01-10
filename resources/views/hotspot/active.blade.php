<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row space-x-20">
            <div>
                <a href="{{ route('active') }}"
                   class="font-bold text-blue-500 @if(request()->routeIs('active')) border-b border-blue-500 @endif">PPPOE
                    Users</a>
            </div>
            <div>
                <a href="{{ route('hotspot-active') }}"
                   class="font-bold text-blue-500 @if(request()->routeIs('hotspot-active')) border-b border-blue-500 @endif">Hotspot
                    Users</a>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="mb-5 p-3">
                <h1 class="pb-2 text-2xl">Active Users</h1>
                @livewire('active-table')
                {{--                    <table class="table table-fixed min-w-full leading-normal">--}}
                {{--                        <thead>--}}
                {{--                        <tr>--}}
                {{--                            <th class="px-15 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">--}}
                {{--                                #--}}
                {{--                            </th>--}}
                {{--                            <th class="px-15 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">--}}
                {{--                                Username--}}
                {{--                            </th>--}}
                {{--                            <th class="px-15 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">--}}
                {{--                                Address--}}
                {{--                            </th>--}}
                {{--                            <th class="px-15 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">--}}
                {{--                                up time--}}
                {{--                            </th>--}}
                {{--                            <th class="px-15 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">--}}
                {{--                                Idle Time--}}
                {{--                            </th>--}}
                {{--                        </tr>--}}
                {{--                        </thead>--}}
                {{--                        <tbody>--}}
                {{--                        @foreach ($users as $index=>$user)--}}
                {{--                            <tr>--}}
                {{--                                <td class="px-15 py-2 border-b border-gray-200 bg-white text-sm">--}}
                {{--                                    {{ $index + 1 }}--}}
                {{--                                </td>--}}
                {{--                                <td class="px-15 py-2 border-b border-gray-200 bg-white text-sm">--}}
                {{--                                    {{ $user['user'] }}--}}
                {{--                                </td>--}}
                {{--                                <td class="px-15 py-2 border-b border-gray-200 bg-white text-sm">--}}
                {{--                                    {{ $user['address'] }}--}}
                {{--                                </td>--}}
                {{--                                <td class="px-15 py-2 border-b border-gray-200 bg-white text-sm">--}}
                {{--                                    {{ $user['uptime'] }}--}}
                {{--                                </td>--}}
                {{--                                <td class="px-15 py-2 border-b border-gray-200 bg-white text-sm">--}}
                {{--                                    {{ $user['idle-time'] }}--}}
                {{--                                </td>--}}
                {{--                                <td class="px-15 py-4 border-b bord`er-gray-200 bg-white text-sm">--}}

                {{--                                </td>--}}
                {{--                            </tr>--}}
                {{--                        @endforeach--}}
                {{--                        </tbody>--}}
                {{--                    </table>--}}
            </div>
        </div>
    </div>
</x-app-layout>
