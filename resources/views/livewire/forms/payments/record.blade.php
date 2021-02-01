<div class="w-1/3 shadow-lg p-2">
    <form wire:submit.prevent="record" class="w-full">
        <div class="mt-4">
            <label for="phone">Phone</label>
            <input type="tel" id="phone" placeholder="phone" class="p-2 focus:outline-none w-full rounded">
        </div>
        <div class="mt-4">
            <label for="receipt">Receipt</label>
            <input type="text" id="receipt" placeholder="Receipt" class="p-2 focus:outline-none w-full rounded">
        </div>
        <div class="mt-4">
            <label for="amount">Amount</label>
            <input type="number" id="amount" placeholder="Number" class="p-2 focus:outline-none w-full rounded">
        </div>

        <div class="mt-4">
            <input type="submit" class="p-2 focus:outline-none w-full rounded">
        </div>
    </form>
</div>
