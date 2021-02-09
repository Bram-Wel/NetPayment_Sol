@include('movies.layouts.default')
@php
    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name);
@endphp
<div
    style="background: url('{!! $url !!}/fanart.jpg'); width: 100%; height: 100vh; background-size: cover; background-position: center"
    class="overflow-none">
    {{  $movie->name }}
</div>
