@include('movies.layouts.default')
@php
    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name);
@endphp
<div style="background: url('{!! $url !!}/fanart.jpg')">
    {{  $movie->name }}
</div>
