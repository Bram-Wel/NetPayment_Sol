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
    <div class="absolute top-40 left-20">
        <h1 class="text-white font-bold text-5xl">{{ $movie->name }}</h1>
    </div>
</div>
