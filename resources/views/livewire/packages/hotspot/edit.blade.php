<div class="bg-white p-5 ml-4 mr-4 shadow-xl rounded w-1/3">
    {{-- Do your work, then step back. --}}
    <form wire:submit.prevent="edit" class="pt-4">
        <div class="mb-4">
            <label for="name" class="text-gray-600">Package Name</label>
            <input type="text" id="name" wire:model="name" placeholder="Name"
                   class="w-full border rounded bg-white p-2 mt-2 focus:outline-none">
            @error('name') <span class="error text-red-400">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="price" class="text-gray-600">Price</label>
            <input type="number" id="price" wire:model="price" placeholder="Price"
                   class="w-full border rounded bg-white p-2 mt-2 focus:outline-none">
            @error('price') <span class="error text-red-400">{{ $message }}</span> @enderror

        </div>
        <div class="mb-4">
            <label for="price" class="text-gray-600">Devices</label>
            <select id="time" wire:model="devices"
                    class="w-full text-gray-600 border rounded bg-white p-2 mt-2 focus:outline-none">
                <option value="">---select---</option>
                @for($i=1; $i<= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            @error('devices') <span class="error text-red-400">{{ $message }}</span> @enderror

        </div>
        <div class="mb-4">
            <label for="time" class="text-gray-600">Expiry</label>
            <select id="time" wire:model="time"
                    class="w-full text-gray-600 border rounded bg-white p-2 mt-2 focus:outline-none">
                <option value="">---select---</option>
                <option value="1 Hour">1 Hour</option>
                <option value="6 Hours">6 Hours</option>
                <option value="12 Hours">12 Hours</option>
                <option value="1 Day">1 Day</option>
                <option value="7 Days">7 Days</option>
                <option value="2 Weeks">2 Weeks</option>
                <option value="1 Month">1 Month</option>
            </select>
            @error('time') <span class="error text-red-400">{{ $message }}</span> @enderror

        </div>
        <div class="mb-4">
            <label for="speed" class="text-gray-600">Package Name</label>
            <select id="speed" wire:model="speed"
                    class="w-full border text-gray-600 rounded bg-white p-2 mt-2 focus:outline-none">
                <option value="">--select--</option>
                <option value="1">1 MBPS</option>
                <option value="2">2 MBPS</option>
                <option value="3">3 MBPS</option>
                <option value="4">4 MBPS</option>
                <option value="5">5 MBPS</option>
                <option value="6">6 MBPS</option>
                <option value="7">7 MBPS</option>
                <option value="8">8 MBPS</option>
                <option value="9">9 MBPS</option>
                <option value="10">10 MBPS</option>
            </select>
            @error('speed') <span class="error text-red-400">{{ $message }}</span> @enderror

        </div>
        <div class="mb-4 flex justify-center">
            <button type="submit"
                    class="bg-green-400 hover:shadow-2xl shadow hover:bg-green-600 text-white p-2 px-10 rounded-2xl">
                Edit
            </button>
        </div>
    </form>
</div>
