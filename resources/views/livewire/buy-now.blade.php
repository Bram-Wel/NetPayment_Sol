<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    @if($package==1)
    <button wire:click="buy"
        class="transition duration-300 p-2 px-5 rounded-2xl text-white font-bold px-5 shadow-xl focus:outline-none"
        style="background: #6dd5ed">{{ $message }}</button>
    @elseif($package==2)
    <button wire:click="buy"
        class="transition duration-300 p-2 px-5 rounded-2xl text-white font-bold px-5 shadow-xl focus:outline-none"
        style="background: #38ef7d">{{ $message }}</button>
    @elseif($package == 3)
    <button wire:click="buy"
        class="transition duration-300 p-2 px-5 rounded-2xl text-white font-bold px-5 shadow-xl focus:outline-none"
        style="background:  #8f94fb">{{ $message }}</button>
    @elseif($package==4)
    <button wire:click="buy"
        class="transition duration-300 p-2 px-5 rounded-2xl text-white font-bold px-5 shadow-xl focus:outline-none"
        style="background:  #f16529">{{ $message }}</button>
    @elseif($package==5)
    <button wire:click="buy"
        class="transition duration-300 p-2 px-5 rounded-2xl text-white font-bold px-5 shadow-xl focus:outline-none"
        style="background:  #ffd200">{{ $message }}</button>
    @endif

    <x-jet-confirmation-modal wire:model="openModal">
        <x-slot name="title">
            @if (isset($mpesaError))
            <h1 class="text-red-500 font-bold">An error has occurred. Please try again later.</h1>
            @else
            <h1 class="text-green-500 font-bold">{{ $mpesaResponse }}</h1>
            @endif
        </x-slot>

        <x-slot name="content">
            @if (isset($mpesaError))
            {{ $mpesaError }}
            @else
            Check your phone and enter your m-pesa pin to confirm payment.
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openModal')" wire:loading.attr="disabled">
                Ok
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
