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
        <div class="mx-auto sm:px-3 lg:px-8">
            <div class="mb-5 p-3">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-3 align-middle inline-block min-w-full sm:px-3 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Username
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Mac Address
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ip Address
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Uptime
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($users as $index=>$user)
                                        <tr>
                                            <td class="px-3 py-3 whitespace-nowrap">
                                                {{ $index+1 }}
                                            </td>
                                            <td class="px-3 py-3 whitespace-nowrap">
                                                {{ $user['name'] }}
                                            </td>
                                            <td class="px-3 py-3 whitespace-nowrap">
                                                {{ $user['caller-id'] }}
                                            </td>
                                            <td class="px-3 py-3 whitespace-nowrap">
                                                {{ $user['address'] }}
                                            </td>
                                            <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500">
                                                {{ $user['uptime'] }}
                                            </td>
                                            <td class="px-3 py-3 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('pppoe.active.remove', ['id' => $user['.id']]) }}"
                                                   class="text-white transition duration-200 rounded-lg hover:shadow-lg bg-red-500 px-4 py-1">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <!-- More people... -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
