<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row space-x-20">
            <div>
                <a href="{{ route('Users') }}"
                   class="font-bold text-blue-500 @if(request()->routeIs('Users')) border-b border-blue-500 @endif">PPPOE
                    Users</a>
            </div>
            <div>
                <a href="{{ route('hotspot-users') }}"
                   class="font-bold text-blue-500 @if(request()->routeIs('hotspot-users')) border-b border-blue-500 @endif">Hotspot
                    Users</a>
            </div>
            <div class="flex flex-row justify-between absolute right-20">
                <a href="/hotspot/user/add"
                   class="bg-green-400 transition duration-200 text-white font-bold shadow hover:shadow-lg rounded py-1 px-5">
                    Add user
                </a>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="flex flex-col md:flex-row justify-center">
                <div class="p-3">
                <table class="table table-fixed min-w-full leading-normal shadow-lg rounded-lg">
                <thead>
                        <tr>
                            <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                #
                            </th>
                            <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Username
                            </th>
                            <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Phone
                            </th>
                            <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Profile
                            </th>
                            <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Uptime
                            </th>
                            <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Expiry
                            </th>
                            <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Action
                            </th>
                            <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $index=>$user)
                        @if($user['name'] !== 'default-trial')
                            <tr>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                    {{ $index }}
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                    {{ $user['name'] ?? ''}}
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                    @php
                                        $phone = DB::table('users')->where('username', $user['name'])->where('type', 'hotspot')->value('phone');
                                    @endphp
                                    {{ $phone ?? ''}}
                                </td>

                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">
                                    {{ $user['profile']  ?? ''}}
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm whitespace-nowrap">
                                    {{ $user['uptime']  ?? ''}}
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-green-400 capitalize text-sm">
                                    @php
                                        $config =new \RouterOS\Config([
                                            'host' => env('MIKROTIK_HOST'),
                                            'port' => (int)env('MIKROTIK_PORT'),
                                            'user' => env('MIKROTIK_USERNAME'),
                                            'pass' => env('MIKROTIK_PASSWORD'),
                                            ]);

                                        $client = new \RouterOS\Client($config);

                                        $query = (new \RouterOS\Query('/system/scheduler/print'))->where('name', "deactivate-$user[name]");

                                        $response = $client->query($query)->read();
                                    @endphp

                                    {{ isset($response[0]['next-run']) ? $response[0]['next-run'] : "No scheduler"}}
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                    <a href="{{route('hotspot-user-edit', ['username'=>$user['name']])}}"
                                        class="text-blue-500 border-b border-blue-500">
                                        Edit
                                    </a>
                                </td>
                                <td class="px-5 py-4 border-b bord`er-gray-200 bg-white text-sm">
                                    <a href="{{route('delete-user', ['name'=>$user['name']])}}"
                                        class="text-red-500 border-b border-red-500">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
