<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    @if($package==1)
        <button wire:click="buy"
                class="transition duration-300 p-2 px-5 rounded-2xl text-white font-bold px-5 shadow-xl"
                style="background: #6dd5ed">{{ $message }}</button>
    @elseif($package==2)
        <button wire:click="buy"
                class="transition duration-300 p-2 px-5 rounded-2xl text-white font-bold px-5 shadow-xl"
                style="background: #38ef7d">{{ $message }}</button>
    @elseif($package == 3)
        <button wire:click="buy"
                class="transition duration-300 p-2 px-5 rounded-2xl text-white font-bold px-5 shadow-xl"
                style="background:  #8f94fb">{{ $message }}</button>
    @elseif($package==4)
        <button wire:click="buy"
                class="transition duration-300 p-2 px-5 rounded-2xl text-white font-bold px-5 shadow-xl"
                style="background:  #f16529">{{ $message }}</button>
    @elseif($package==5)
        <button wire:click="buy"
                class="transition duration-300 p-2 px-5 rounded-2xl text-white font-bold px-5 shadow-xl"
                style="background:  #ffd200">{{ $message }}</button>
    @endif

    <x-jet-confirmation-modal wire:model="openModal">
        <x-slot name="title">
            Confirm Payment
        </x-slot>

        <x-slot name="content">
            Check your phone and enter your m-pesa pin to confirm payment.
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openModal')" wire:loading.attr="disabled">
                Ok
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
