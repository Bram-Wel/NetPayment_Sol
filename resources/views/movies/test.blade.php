@include('movies.layouts.default')
<script src="https://cdn.jsdelivr.net/npm/intersection-observer@0.7.0/intersection-observer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.3.0/dist/lazyload.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<style>
    .poster {
        width: 160px;
        height: 230px;
        transition: transform 1s; /* Animation */
    }

    .slick-arrow {
        display: none !important;
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
        $featured = \App\Models\Movie::inRandomOrder()->limit(1);
        $url = \Illuminate\Support\Facades\Storage::disk($featured->disk)->url($featured->name . '/fanart.jpg');

    @endphp
    <div
        style="background: url('{{ $url }}'); background-size: cover; background-position: center; width: 100%; height: 80vh">

    </div>
    <div>
        <h1 class="font-bold text-xl pl-15 text-center md:text-left">Latest movies</h1>
        <div class="pl-8 grab">
            @foreach($movies as $movie)
                @php
                    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                @endphp
                <a href="{{ route('player', ['movie' => $movie->name]) }}" class="md:ml-5 mb-6 mt-2">
                    <img src="{{ $url }}" alt="" class="rounded-xl shadow-2xl poster thumbnail lazy">
                </a>
            @endforeach
        </div>
    </div>

    <div class="pl-8">
        <h1 class="font-bold text-xl md:pl-6 text-center md:text-left">Most Watched</h1>
        @php
            $watchers = \App\Models\Watchers::select('movie')
            ->groupBy('movie')
            ->orderByRaw('COUNT(*) DESC')
            ->get();
        @endphp
        <div class="grab">
            @foreach($watchers as $movie)
                @php
                    $name = $movie->movie;
                    $video = \App\Models\Movie::where('name', $name)->get();
                @endphp
                @foreach($video as $movie)
                    @php
                        $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                    @endphp
                    <a href="{{ route('player', ['movie' => $movie->name]) }}" class="">
                        <img data-src="{{ $url }}" class="rounded-lg shadow-xl md:ml-6 mb-6 mt-2 poster lazy" alt="">
                    </a>
                @endforeach
            @endforeach
        </div>
    </div>

    @php
        $genres = \Illuminate\Support\Facades\DB::table('genres')->select('genre')
    ->groupBy('genre')->inRandomOrder()->get();
    @endphp
    @foreach($genres as $g)
        <div class="pl-8 w-screen">
            <h1 class="font-bold text-xl md:pl-6 text-center md:text-left">{{ $g->genre }}</h1>
            <div id="container" class="mr-4 grab">
                @php
                    $movies = \App\Models\Genre::where('genre', $g->genre)->select('name')->inRandomOrder()->groupBy('name')->get();
                @endphp
                @foreach($movies as $movie)
                    <div class>
                        @php
                            $video = \App\Models\Movie::where('name', $movie->name)->get();
                        @endphp
                        @foreach($video as $info)
                            @php
                                $url = \Illuminate\Support\Facades\Storage::disk($info->disk)->url($info->name . '/poster.jpg');
                            @endphp
                            <a href="{{ route('player', ['movie' => $info->name]) }}" class="w-48">
                                <img src="{{ $url }}"
                                     class="rounded-lg shadow-xl md:ml-6 mb-6 mt-2 poster border-0 lazy" alt="">
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <div>
        @php
            $movies = \App\Models\Movie::where('converted', 0)->orderBy('year', 'desc')->get();
        @endphp
        @if(count($movies) > 0)
            <h1 class="font-bold text-xl pl-15 text-center md:text-left">Coming today</h1>
            <div class="pl-8 grab">
                @foreach($movies as $movie)
                    @php
                        $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                    @endphp
                    <a href="{{ route('player', ['movie' => $movie->name]) }}" class="md:ml-5 mb-6 mt-2">
                        <img src="{{ $url }}"
                             class="rounded-xl shadow-2xl poster thumbnail lazy">
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
<script>var lazyLoadInstance = new LazyLoad({
        // Your custom settings go here
    });</script>
<script>
    $('.grab').slick({
        slidesToShow: 7,
        slidesToScroll: 3
    });
</script>
@include('movies.layouts.footer')

