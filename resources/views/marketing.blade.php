<x-app-layout>
    <x-slot name="header">
        <h1>{{ __('Marketing') }}</h1>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row">
            <div class="w-1/2 mr-8">
                <h1 class="text-2xl font-bold border-b border-gray-500 w-24 mb-8">SMS</h1>
                @livewire('sms-form')
            </div>
            <div class=" w-1/2">
                <h1 class="text-2xl font-bold border-b border-gray-500 w-24 mb-8">Email</h1>
                @livewire('email-form')
            </div>
        </div>

        <div class="mt-5 mb-5 p-8">
            <h1 class="pl-5 pr-5 pt-2 pb-2 text-2xl">Messages Sent</h1>
            <table class="table table-fixed min-w-full leading-normal">
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
                        Email
                    </th>
                    <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Message
                    </th>
                    <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Type
                    </th>
                    <th class="px-5 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Time
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($messages as $index=>$message)
                    <tr>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {{ $message->username }}
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {{ $message->phone }}
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {{ $message->email }}
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {{ $message->message }}
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {{ $message->type }}
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            {{ date('d/M/Y', strtotime($message->created_at)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pl-8 pr-8">
            {{ $messages->links() }}
        </div>
    </div>
</x-app-layout>
