@include('movies.layouts.default')
@php
    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name);
@endphp
<style>
    .main {
        background: url("{!! $url !!}/fanart.jpg");
    }
</style>
<div
    style="width: 100%; height: 100vh; background-size: cover; background-position: center"
    class="overflow-none main">
    {{  $movie->name }}
</div>
