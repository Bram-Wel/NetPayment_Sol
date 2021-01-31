@include('movies.layouts.default')
<link href="https://cdn.rawgit.com/anthonykrivonos/flix-carousel/65556d56/src/carousel.css" rel="stylesheet">

<style>
    .poster {
        width: 160px;
        height: 230px;
        transition: transform .2s; /* Animation */
    }

    .poster:hover {
        transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }

    @media screen and (max-width: 720px) {
        .poster {
            width: 150px;
            height: 200px;
            margin: 10px;
        }
    }
</style>
<div class="py-5">
    @php
        $featured = \App\Models\Movie::where('converted', 1)->inRandomOrder()->limit(4)->get();
    @endphp
    <div class="hidden md:inline-block">
        <div class="flex flex-row flex-wrap justify-center md:justify-start pl-10">
            @foreach($featured as $index=>$movie)
                @php
                    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                    $banner = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/fanart.jpg')
                @endphp
                <a href="{{ route('player', ['movie' => $movie->id]) }}" class="md:ml-6 mb-6 mt-2">
                    @if($index==0 || $index ==1)
                        <div
                            style="background: url('{{ addslashes($url) }}'); background-size: cover; background-position: center; background-repeat: no-repeat; width: 220px; height: 350px"
                            class="shadow-xl rounded-xl">
                        </div>
                    @elseif($index==2)
                        <div
                            style="background: url('{{ $banner }}'); background-size: cover; background-position: center; background-repeat: no-repeat; width: 500px; height: 350px"
                            class="shadow-xl rounded-xl">
                        </div>
                    @else
                        <div
                            style="background: url('{{ $url }}'); background-size: cover; background-position: center; background-repeat: no-repeat; width: 220px; height: 350px"
                            class="shadow-xl rounded-xl">
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
    </div>

    <div class="carousel">
        <h1 class="text-gray-600 text-xl pl-15 text-center md:text-left">Latest movies</h1>
        <div class="flex flex-row flex-wrap justify-center md:justify-start pl-8 carousel-row">
            <div class="carousel-tile">
                @foreach($movies as $movie)
                    @php
                        $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                    @endphp
                    <a href="{{ route('player', ['movie' => $movie->id]) }}" class="md:ml-5 mb-6 mt-2">
                        <div
                            style="
                                background: url('{{ addslashes($url) }}'); background-size: cover; background-position: center; background-repeat: no-repeat"
                            class="rounded-xl shadow-2xl poster thumbnail">
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </div>

    <div class="pl-8">
        <h1 class="text-gray-600 text-xl md:pl-6 text-center md:text-left">Most Watched</h1>
        @php
            $watchers = \App\Models\Watchers::select('movie')
            ->groupBy('movie')
            ->orderByRaw('COUNT(*) DESC')
            ->take(7)
            ->get();
        @endphp
        <div class="flex flex-row flex-wrap md:flex-row justify-center content-center md:justify-start">
            @foreach($watchers as $movie)
                @php
                    $name = $movie->movie;
                    $video = \App\Models\Movie::where('name', $name)->get();
                @endphp
                @foreach($video as $movie)
                    @php
                        $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                    @endphp
                    <a href="{{ route('player', ['movie' => $movie->id]) }}" class="">
                        <div
                            style="background: url('{{ $url }}'); background-size: cover; background-position: center; background-repeat: no-repeat"
                            class="rounded-lg shadow-xl md:ml-6 mb-6 mt-2 poster">
                        </div>
                    </a>
                @endforeach
            @endforeach
        </div>
    </div>

    @php
        $genres = \Illuminate\Support\Facades\DB::table('genres')->select('genre')
    ->groupBy('genre')->get();
    @endphp
    @foreach($genres as $g)
        <div class="pl-8">
            <h1 class="text-gray-600 text-xl md:pl-6 text-center md:text-left">{{ $g->genre }}</h1>
            <div class="flex flex-row flex-wrap md:flex-row justify-center content-center md:justify-start">
                @php
                    $movies = \App\Models\Genre::where('genre', $g->genre)->select('name')->groupBy('name')->limit(7)->get();
                @endphp
                @foreach($movies as $movie)
                    @php
                        $video = \App\Models\Movie::where('name', $movie->name)->where('converted', 1)->get();
                    @endphp
                    @foreach($video as $info)
                        @php
                            $url = \Illuminate\Support\Facades\Storage::disk($info->disk)->url($info->name . '/poster.jpg');
                        @endphp
                        <a href="{{ route('player', ['movie' => $info->id]) }}" class="">
                            <div
                                style="background: url('{{ addslashes($url) }}'); background-size: cover; background-position: center; background-repeat: no-repeat"
                                class="rounded-lg shadow-xl md:ml-6 mb-6 mt-2 poster">
                            </div>
                        </a>
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach

    <div class="overflow-x-scroll">
        <h1 class="text-gray-600 text-xl pl-15 text-center md:text-left">Coming this week</h1>
        <div class="flex flex-row justify-center md:justify-start pl-8">
            @php
                $movies = \App\Models\Movie::where('converted', 0)->orderBy('year', 'desc')->get();
            @endphp
            @foreach($movies as $movie)
                @php
                    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                @endphp
                <a href="{{ route('player', ['movie' => $movie->id]) }}" class="md:ml-5 mb-6 mt-2">
                    <div
                        style="
                            background: url('{{ addslashes($url) }}'); background-size: cover; background-position: center; background-repeat: no-repeat"
                        class="rounded-xl shadow-2xl poster thumbnail">
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@include('movies.layouts.footer')
