<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @if($disabled == "false")
        <td class="px-4 py-2 border-b border-gray-200 bg-white text-sm">
            <a href="/user/deactivate/{{ $username }}"
               class="bg-red-400 text-white p-2 rounded-md">Deactivate</a>
        </td>
    @else
        <td class="px-4 py-2 border-b border-gray-400 bg-white text-sm">
            <a href="/user/activate/{{{$username}}}"
               class="bg-green-400 text-white p-2 rounded-md">Activate</a>
        </td>
    @endif
</div>
