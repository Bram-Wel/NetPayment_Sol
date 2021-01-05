<div class="flex justify-center">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <form wire:submit.prevent="save" class="w-1/2 bg-white rounded-md shadow-lg p-4">
        @csrf
        <h1 class="text-2xl font-bold border-b border-gray-800 w-32">
            Edit Profile</h1>
        <br>
        @if ($success)
            <div class="inline-flex w-full ml-3 overflow-hidden bg-white rounded-lg shadow-sm">
                <div class="flex items-center justify-center w-12 bg-green-500">
                </div>
                <div class="px-3 py-2 text-left">
                    <span class="font-semibold text-green-500">Success</span>
                    <p class="mb-1 text-sm leading-none text-gray-500">{{ $success }}</p>
                </div>
            </div>
        @endif
        <br>
        <label for="profile">Profile Name</label>

        <br>
        <input type="text" id="profile" name="profile" wire:model="profile" class="w-full bg-white p-2 rounded border">
        <br>
        @error('profile')
        <p class="text-red-500 mt-1">{{ $message }}</p>
        @enderror
        <br>
        <label for="rateLimit">Rate Limit</label>

        <br>
        <input type="text" id="rateLimit" name="rateLimit" wire:model="rateLimit"
               class="w-full bg-white p-2 rounded border">
        <br>
        @error('rateLimit')
        <p class="text-red-500 mt-1">{{ $message }}</p>
        @enderror
        <br>
        <label for="localAddress">Local Address</label>
        <br>
        <input type="text" id="localAddress" name="localAddress" wire:model="localAddress"
               class="w-full bg-white p-2 rounded border">
        <br>
        @error('localAddress')
        <p class="text-red-500 mt-1">{{ $message }}</p>
        @enderror
        <br>
        <label for="remoteAddress">Remote Address</label>

        <br>
        <select name="remoteAddress" id="remoteAddress" class="bg-white rounded border w-full p-2"
                wire:model="remoteAddress">
            <?php
            use RouterOS\Client;use RouterOS\Config;use RouterOS\Exceptions\ClientException;use RouterOS\Exceptions\ConfigException;use RouterOS\Exceptions\QueryException;use RouterOS\Query;try {
                $config = new Config([
                    'host' => env('MIKROTIK_HOST'),
                    'user' => env('MIKROTIK_USERNAME'),
                    'pass' => env('MIKROTIK_PASSWORD'),
                    'port' => (int)env('MIKROTIK_PORT'),
                ]);
            } catch (ConfigException $e) {
                dd('configuration error');
            }
            try {
                $client = new Client($config);
            } catch (ClientException $e) {
                dd('exception');
            } catch (QueryException $e) {
            }

            $query = (new Query('/ip/pool/print'));
            $response = $client->q($query)->read();
            ?>
            <option value="">--select--</option>
            @foreach($response as $res)
                <option value="{{ $res['name'] }}">{{ $res['name'] }}</option>
            @endforeach
        </select>
        @error('remoteAddress')
        <p class="text-red-500 mt-1">{{ $message }}</p>
        @enderror

        <button
            class="mt-3 flex px-6 py-2 text-center text-white bg-indigo-500 rounded-md hover:bg-indigo-600 hover:text-white focus:outline-none focus:shadow-outline focus:border-indigo-300"
            type="submit">
            Edit Profile
        </button>

    </form>
</div>
