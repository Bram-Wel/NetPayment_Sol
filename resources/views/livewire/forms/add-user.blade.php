<div class="flex justify-center">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <form wire:submit.prevent="add" class="w-1/2 bg-white rounded-md shadow-lg p-4">
        @csrf
        <h1 class="text-2xl font-bold border-b border-gray-800 w-32">Add User</h1>
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
        <label for="username">Username</label>

        <br>
        <input type="text" id="username" name="username" wire:model="username"
               class="w-full bg-white p-2 rounded border">
        <br>
        @error('username')
        <p class="text-red-500 mt-1">{{ $message }}</p>
        @enderror
        <br>
        <label for="phone">Phone</label>

        <br>
        <input type="tel" id="phone" name="phone" wire:model="phone" class="w-full bg-white p-2 rounded border">
        <br>
        @error('phone')
        <p class="text-red-500 mt-1">{{ $message }}</p>
        @enderror
        <br>
        <label for="password">Password</label>

        <br>
        <input type="password" id="password" name="password" wire:model="password"
               class="w-full bg-white p-2 rounded border">
        <br>
        @error('password')
        <p class="text-red-500 mt-1">{{ $message }}</p>
        @enderror
        <br>
        <label for="profile">Profile</label>

        <br>
        <select name="profile" id="profile" class="bg-white rounded border w-full p-2" wire:model="profile">
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

            $query = (new Query('/ppp/profile/print'));
            $response = $client->q($query)->read();
            ?>
            <option value="">--select--</option>
            @foreach($response as $res)
                <option value="{{ $res['name'] }}">{{ $res['name'] }}</option>
            @endforeach
        </select>
        @error('profile')
        <p class="text-red-500 mt-1">{{ $message }}</p>
        @enderror

        <button
            class="mt-3 flex px-6 py-2 text-center text-white bg-indigo-500 rounded-md hover:bg-indigo-600 hover:text-white focus:outline-none focus:shadow-outline focus:border-indigo-300"
            type="submit">
            Add user
        </button>

    </form>
</div>
