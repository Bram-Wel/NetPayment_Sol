<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <button wire:click="buy"
            class="bg-green-400 hover:bg-green-600 transition duration-300 p-2 px-5 rounded-2xl text-white font-bold px-5 shadow-lg">{{ $message }}</button>


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
