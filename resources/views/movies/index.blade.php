@include('movies.layouts.default')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/assets/slick.css') }}"/>
<script type="text/javascript" src="{{ asset('js/assets/slick.js') }}"></script>
<script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
<style>
    .poster {
        width: 160px;
        height: 230px;
        transition: transform 1s; /* Animation */
    }

    video {
        filter: brightness(50%);
        object-fit: cover;
        height: 100vh;
        width: 100%;
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
<div>
    @php
        $featured = \Illuminate\Support\Facades\DB::table('movies')->select('*')->whereNotIn('name', function ($query) {
    $query->select('movie')->from('watchers');
    })->inRandomOrder()->limit(1)->get();
    @endphp
    @foreach($featured as $movie)
        @php
            $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name);
        @endphp
        <div class="header">
            <video id="video" poster="{{ $url }}/fanart.jpg" class="absolute w-screen h-screen" preload="auto"
                   playsinline
                   style="object-fit: cover; ">
                <source src="{{ $url }}/trailer.mp4">
            </video>
            <div class="absolute mt-32 ml-12 w-1/2">
                <h1 class="text-5xl text-white font-bold">{{ $movie->name }}</h1>
                <p class="text-white font-bold">{{ $movie->description }}</p>
                <div class="buttons flex flex-row mt-4">
                    <a href="{{ route('player', ['movie' => $movie->id]) }}"
                       class="mr-4 bg-white rounded-xl shadow-xl hover:shadow-2xl font-bold p-2 px-8 transition duration-200 hover:opacity-9 flex">
                        <ion-icon name="play-outline" class="pr-2 text-xl flex whitespace-no-wrap flex-col"></ion-icon>
                        Play</a>
                    {{--                    <a href="{{ route('movie.info', ['movie' => $movie->id]) }}"--}}
                    {{--                       class="mr-4 bg-white rounded-xl shadow-xl hover:shadow-2xl font-bold p-2 px-8 transition duration-200 hover:opacity-9 flex">--}}
                    {{--                        <ion-icon name="information-outline"--}}
                    {{--                                  class="pr-2 text-xl flex whitespace-no-wrap flex-col"></ion-icon>--}}
                    {{--                        More info--}}
                    {{--                    </a>--}}
                </div>
            </div>
        </div>
    @endforeach

    <div class="pt-1/3">
        <h1 class="font-bold text-xl pl-15 text-center md:text-left mt-8 relative z-20 text-white">Latest releases</h1>
        <div class="pl-8 grab">
            @foreach($movies as $movie)
                @php
                    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                @endphp
                <a href="{{ route('player', ['movie' => $movie->id]) }}" class="md:ml-5 mb-6 mt-2">
                    <img src="{{ $url }}" alt="" class="rounded-xl shadow-2xl poster thumbnail lazy">
                </a>
            @endforeach
        </div>
    </div>

    <div>
        <h1 class="font-bold text-xl pl-15 text-center md:text-left">Recently Added</h1>
        <div class="pl-8 grab">
            @php
                $latest = \App\Models\Movie::orderBy('created_at', 'desc')->limit(15)->get();
            @endphp
            @foreach($latest as $movie)
                @php
                    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                @endphp
                <a href="{{ route('player', ['movie' => $movie->id]) }}" class="md:ml-5 mb-6 mt-2">
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
        <div class="grab flex">
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
                        <img src="{{ $url }}" class="rounded-lg shadow-xl md:ml-6 mb-6 mt-2 poster lazy" alt="">
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
            <div id="container" class="mr-4 grab flex justify-center">
                @php
                    $movies = \App\Models\Genre::where('genre', $g->genre)->select('name')->inRandomOrder()->groupBy('name')->get();
                @endphp
                @foreach($movies as $movie)
                    <div>
                        @php
                            $video = \App\Models\Movie::where('name', $movie->name)->get();
                        @endphp
                        @foreach($video as $info)
                            @php
                                $url = \Illuminate\Support\Facades\Storage::disk($info->disk)->url($info->name . '/poster.jpg');
                            @endphp
                            <a href="{{ route('player', ['movie' => $info->id]) }}" class="w-48">
                                <img src="{{ $url }}"
                                     class="rounded-lg shadow-xl md:ml-6 mb-6 mt-2 poster border-0 lazy w-full" alt="">
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
                    <a href="{{ route('player', ['movie' => $movie->id]) }}" class="md:ml-5 mb-6 mt-2">
                        <img src="{{ $url }}"
                             class="rounded-xl shadow-2xl poster thumbnail lazy">
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
<script>
    $('.grab').slick({
        slidesToShow: 7,
        slidesToScroll: 3
    });
</script>
<script>
    $(document).ready(function () {
        $(document).on('scroll', function () {
            let video = $('video');

        })
    })
</script>
@include('movies.layouts.footer')
