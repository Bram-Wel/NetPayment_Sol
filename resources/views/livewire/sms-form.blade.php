<div>
    {{-- Stop trying to control. --}}
    <form class="form">
        <label for="user">User</label>
    <?php
        use Illuminate\Support\Facades\DB;$users = DB::table('users')->orderBy('username', 'asc')->get();
        ?>
        <select class="bg-white p-2 rounded w-full border" name="user">
            <option value="">--selected--</option>
            @foreach($users as $user)
                <option value="{{ $user->username }}"> {{ $user->username }}</option>
            @endforeach
        </select>
        <br>
        <br>
        <label for="message">Message</label>
        <textarea name="message" wire:model="message" id="message" class="w-full bg-white border rounded p-4"></textarea>
        <input type="submit" value="Send" class="bg-blue-500 hover:bg-blue-800 px-6 shadow-lg text-white font-bold p-2 rounded-xl">
    </form>
</div>
