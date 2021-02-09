@include('movies.layouts.default')
@php
    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name);
@endphp
<style>
    .main {
        background: linear-gradient(
            rgba(0, 0, 0, 0.4),
            rgba(0, 0, 0, 0.4)
        ), url("{!! $url !!}/fanart.jpg");
    }
</style>
<div
    style="width: 100%; height: 100vh; background-size: cover; background-position: center"
    class="overflow-none main">
    <div class="absolute top-40 left-20">
        @php
            function does_url_exists($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
    }
        @endphp
        @if(does_url_exists($url.'/logo.jpg'))
            <img src="{!! $url !!}/logo.jpg" alt="" style="width: 200px;">
        @else
            <h1 class="text-white font-bold text-5xl">{{ $movie->name }}</h1>
        @endif
    </div>
</div>
