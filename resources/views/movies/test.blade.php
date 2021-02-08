@include('movies.layouts.default')
<style>
    video {
        filter: brightness(50%);
        object-fit: cover;
        height: 100vh;
        width: 100%;
    }

    @media screen and (max-width: 720px) {
        .poster {
            width: 150px;
            height: 200px;
            margin: 10px;
        }
    }


    .wrapper {
        display: grid;
        grid-template-columns: repeat(3, 100%);
        overflow: hidden;
        scroll-behavior: smooth;
    }

    .wrapper section {
        width: 100%;
        position: relative;
        display: grid;
        grid-template-columns: repeat(7, auto);
        margin: 20px 0;
    }

    .wrapper section .item {
        padding: 0 2px;
        transition: 250ms all;
    }

    .wrapper section .item:hover {
        margin: 0 40px;
        transform: scale(1.2);
    }

    .wrapper section a {
        position: absolute;
        color: #fff;
        text-decoration: none;
        font-size: 6em;
        background: black;
        width: 80px;
        padding: 20px;
        text-align: center;
        z-index: 1;
    }

    .wrapper section a:nth-of-type(1) {
        top: 0;
        bottom: 0;
        left: 0;
        background: linear-gradient(-90deg, rgba(0, 0, 0, 0) 0%, black 100%);
    }

    .wrapper section a:nth-of-type(2) {
        top: 0;
        bottom: 0;
        right: 0;
        background: linear-gradient(90deg, rgba(0, 0, 0, 0) 0%, black 100%);
    }

    @media only screen and (max-width: 600px) {
        a.arrow__btn {
            display: none;
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
            <video poster="{{ $url }}/fanart.jpg" class="absolute w-screen h-screen" style="object-fit: cover; ">
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

    <div class="wrapper">
        <section id="section1">
            <a href="#section3" class="arrow__btn">‹</a>
            @php
                $latest = \App\Models\Movie::orderBy('created_at', 'desc')->limit(7)->get();
            @endphp
            @foreach($latest as $movie)
                @php
                    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                @endphp
                <div class="item">
                    <img
                        src="{{ $url }}"
                        alt="Describe Image">
                </div>
            @endforeach
            <a href="#section2" class="arrow__btn">›</a>
        </section>
        <section id="section2">
            <a href="#section1" class="arrow__btn">‹</a>
            @php
                $latest = \App\Models\Movie::orderBy('created_at', 'desc')->limit(7)->offset(7)->get();
            @endphp
            @foreach($latest as $movie)
                @php
                    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                @endphp
                <div class="item">
                    <img
                        src="{{ $url }}"
                        alt="Describe Image">
                </div>
            @endforeach
            <a href="#section3" class="arrow__btn">›</a>
        </section>
        <section id="section3">
            <a href="#section2" class="arrow__btn">‹</a>
            @php
                $latest = \App\Models\Movie::orderBy('created_at', 'desc')->limit(7)->get();
            @endphp
            @foreach($latest as $movie)
                @php
                    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                @endphp
                <div class="item">
                    <img
                        src="{{ $url }}"
                        alt="Describe Image">
                </div>
            @endforeach
            <a href="#section1" class="arrow__btn">›</a>
        </section>
    </div>

    <div class="pt-1/3">
        <h1 class="font-bold text-xl pl-15 text-center md:text-left mt-8 relative z-20 text-white">Latest releases</h1>
        <div class="pl-8 grab flex flex-row">
            @foreach($movies as $movie)
                @php
                    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                @endphp
                <a href="{{ route('player', ['movie' => $movie->id]) }}" class="md:ml-5 mb-6 mt-2 focus:outline-none">
                    <img src="{{ $url }}" alt="" class="rounded-xl shadow-2xl poster thumbnail lazy focus:outline-none">
                </a>
            @endforeach
        </div>
    </div>

    <div>
        <h1 class="font-bold text-xl pl-15 text-center md:text-left">Recently Added</h1>
        <div class="pl-4 grab" style="display: flex">
            @php
                $latest = \App\Models\Movie::orderBy('created_at', 'desc')->limit(15)->get();
            @endphp
            @foreach($latest as $movie)
                @php
                    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                @endphp
                <a href="{{ route('player', ['movie' => $movie->id]) }}" class="md:ml-5 mb-6 mt-2 focus:outline-none">
                    <img src="{{ $url }}" alt="" class="rounded-xl shadow-2xl poster thumbnail lazy focus:outline-none">
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
                    <a href="{{ route('player', ['movie' => $movie->id]) }}" class="focus:outline-none">
                        <img src="{{ $url }}"
                             class="rounded-lg shadow-xl md:ml-6 mb-6 mt-2 poster lazy focus:outline-none" alt="">
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
                    $movies = \App\Models\Genre::where('genre', $g->genre)->select('name')->inRandomOrder()->limit(10)->groupBy('name')->get();
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
                            <a href="{{ route('player', ['movie' => $info->id]) }}" class="w-48 focus:outline-none">
                                <img src="{{ $url }}"
                                     class="rounded-lg shadow-xl md:ml-6 mb-6 mt-2 poster border-0 lazy w-full focus:outline-none"
                                     alt="">
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
                    <a href="{{ route('player', ['movie' => $movie->id]) }}"
                       class="md:ml-5 mb-6 mt-2 focus:outline-none">
                        <img src="{{ $url }}"
                             class="rounded-xl shadow-2xl poster thumbnail lazy focus:outline-none">
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>

@include('movies.layouts.footer')
