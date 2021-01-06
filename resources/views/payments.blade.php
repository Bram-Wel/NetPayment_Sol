<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h1 class="text-xl font-bold text-blue-500 border-b border-blue-500 border-gray-500 w-24">{{ __('Payments') }}</h1>
            <a href="" class="absolute right-20 text-white font-bold bg-green-400 px-3 py-1 shadow-lg rounded-2xl">Record
                payment</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-10">
            <div class="flex flex-col md:flex-row justify-center">
                <div class="p-3">
                    <h1 class="pt-2 pb-2 text-2xl">Payments</h1>
                    <table class="table table-fixed min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-10 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                #
                            </th>
                            <th class="px-10 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Username
                            </th>
                            <th class="px-10 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Phone
                            </th>
                            <th class="px-10 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Receipt Number
                            </th>
                            <th class="px-10 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                amount
                            </th>
                            <th class="px-10 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Time
                            </th>
                            <th class="px-10 py-3 border-b border-t border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($payments as $index=>$payment)
                            <tr>
                                <td class="px-10 py-2 border-b border-gray-200 bg-white text-sm">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-10 py-2 border-b border-gray-200 bg-white text-sm">
                                    <?php
                                    $username = \Illuminate\Support\Facades\DB::table('users')->where('phone', $payment->phone)->value('username');
                                    ?>
                                    {{ $username }}
                                </td>
                                <td class="px-10 py-2 border-b border-gray-200 bg-white text-sm">
                                    {{ $payment->phone}}
                                </td>
                                <td class="px-10 py-2 border-b border-gray-200 bg-white text-sm">
                                    {{ $payment->receipt_number }}
                                </td>
                                <td class="px-10 py-2 border-b border-gray-200 bg-white text-sm">
                                    {{ $payment->amount }}
                                </td>
                                <td class="px-10 py-2 border-b border-gray-200 bg-white text-sm">
                                    {{ date('d/M/Y h:i A', strtotime($payment->created_at)) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="p-5">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
