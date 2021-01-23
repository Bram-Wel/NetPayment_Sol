<div class="bg-white w-1/3 rounded-lg shadow-lg">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day --}}
    <form wire:submit.prevent="saveProfile" class="p-4">
        <div class="mb-4">
            <label for="name" class="text-gray-600">Name</label>
            <input type="text" placeholder="Profile name" id="name" wire:model="name"
                   class="border rounded focus:outline-none w-full bg-white p-2">
        </div>
        <div class="mb-4">
            <label for="pool" class="text-gray-600">Address Pool</label>
            <select id="pool" wire:model="pool" class="border rounded focus:outline-none w-full bg-white p-2">
                <option value="">--select--</option>
                <?php
                use RouterOS\Client;use RouterOS\Config;use RouterOS\Query;$config = new Config([
                    'host' => env('MIKROTIK_HOST'),
                    'user' => env('MIKROTIK_USERNAME'),
                    'pass' => env('MIKROTIK_PASSWORD', ''),
                    'port' => (int)env('MIKROTIK_PORT'),
                ]);
                $client = new Client($config);

                $query = (new Query('/ip/pool/print'));
                $response = $client->q($query)->read();
                ?>
                @foreach($response as $res)
                    <option value="{{ $res['name'] }}">{{ $res['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="shared_users" class="text-gray-600">Shared Users</label>
            <input type="text" placeholder="Shared users" id="shared_users" wire:model="shared_users"
                   class="border rounded focus:outline-none w-full bg-white p-2">
        </div>
        <div class="mb-4">
            <label for="limit" class="text-gray-600">Rate Limit</label>
            <input type="text" placeholder="2" id="limit" wire:model="limit"
                   class="border rounded focus:outline-none w-full bg-white p-2">
        </div>
        <div class="mb-4">
            <button type="submit"
                    class="bg-green-400 hover:bg-green-600 rounded-2xl focus:outline-none shadow-lg hover:shadow-2xl transition duration-200 text-white px-5 p-2">
                Add Profile
            </button>
        </div>
    </form>
</div>
