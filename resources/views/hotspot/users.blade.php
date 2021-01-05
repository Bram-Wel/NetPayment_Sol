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
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="flex flex-col md:flex-row justify-center">
                <div class="p-3">
                    <div class="flex flex-row justify-between">
                        <h1 class="pt-2 pb-2 text-2xl">Users</h1>
                        <a href="/hotspot/user/add"
                           class="bg-green-400 hover:bg-green-800 text-white shadow-lg rounded-xl h-8 pt-1 px-5">
                            Add User
                        </a>
                    </div>
                    <table class="table table-fixed min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-4 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                #
                            </th>
                            <th class="px-4 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Username
                            </th>
                            <th class="px-4 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Phone
                            </th>
                            <th class="px-4 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Profile
                            </th>
                            <th class="px-4 py-3 border-b border-t border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-no-wrap">
                                Last Logged Out
                            </th>
                            <th class="px-4 py-3 border-b border-t border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-no-wrap">
                                Member Since
                            </th>
                            <th class="px-4 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                            </th>
                            <th class="px-4 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $index=>$user)
                            <tr>
                                <td class="px-4 py-2 border-b border-gray-200 bg-white text-sm">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-200 bg-white text-sm whitespace-no-wrap">
                                    {{ $user->username }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-200 bg-white text-sm whitespace-no-wrap">
                                    {{ $user->phone }}
                                </td>
                                @livewire('user-secrets', ['username'=>$user->username])
                                <td class="px-4 py-4 border-b border-gray-200 bg-white text-sm whitespace-no-wrap">
                                    {{ date('d/M/Y h:i:s A', strtotime($user->created_at)) }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-200 bg-white text-sm">
                                    <a href="/hotspot/user/edit/{{ $user->username }}"
                                       class="bg-green-500 hover:bg-green-800 px-5 text-white p-2 rounded-md">Edit
                                        user</a>
                                </td>
                                @livewire('users.activate', ['username' => $user->username])
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="p-5">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
