@include('movies.layouts.default')
<style>
    .poster {
        width: 160px;
        height: 230px;
        transition: transform 1s; /* Animation */
    }

    .header {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .header video {
        /* Make video to at least 100% wide and tall */
        min-width: 100%;
        min-height: 100%;

        /* Setting width & height to auto prevents the browser from stretching or squishing the video */
        width: auto;
        height: auto;

        /* Center the video */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .small {
        transform-origin: left bottom;
        transform: scale(1) translate3d(0px, 0px, 0px);
        transition-duration: 1300ms;
        transition-delay: 0ms;
    }

    video {
        filter: brightness(50%);
        object-fit: cover;
        height: 100vh;
        width: 100%;
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
            <video id="video" poster="{{ $url }}/fanart.jpg" class="absolute w-screen h-screen"
                   style="object-fit: cover; ">
                <source src="{{ $url }}/trailer.mp4">
            </video>
            <div class="absolute mt-32 ml-12 w-1/2">
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
                    <div
                        style="background: url('{!! $url !!}/logo.jpg'); width: 350px; height: 130px;
                            background-size: contain; background-repeat: no-repeat; background-position: 0% 50%"
                        class="mb-4 lazyload"></div>
                @else
                    <h1 class="text-white font-bold text-5xl">{{ $movie->name }}</h1>
                @endif
                <div id="description">
                    <div class="details mt-2 mb-2">
                        @php
                            $genres = \Illuminate\Support\Facades\DB::table('genres')
                        ->where('name', $movie->name)
                        ->get();
                            $count = count($genres);
                            $i = 0;
                        @endphp
                        <div class="text-gray-200 mb-1"> {{ $movie->mpaa }} · {{ $movie->year }}
                            · {{  \Carbon\CarbonInterval::minutes((int)$movie->runtime)->cascade()->forHumans() }}
                            · @foreach($genres as $g)
                                {{ $g->genre }}
                                @if(++$i != $count)
                                    {{ ',' }}
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <p class="text-white font-bold pt-4 pb-4">{{ substr($movie->description, 0, 250) }}...</p>
                </div>

                <div class="buttons flex flex-row mt-4 mb-8">
                    <a href="{{ route('player', ['movie' => $movie->id]) }}"
                       class="mr-4 bg-white rounded-xl shadow-xl hover:shadow-2xl font-bold p-2 px-8 transition duration-200 hover:opacity-9 flex">
                        <ion-icon name="play-outline" class="pr-2 text-xl flex whitespace-no-wrap flex-col"></ion-icon>
                        Play</a>
                    <a href="{{ route('movie.info', ['movie' => $movie->id]) }}"
                       class="mr-4 bg-white rounded-xl shadow-xl hover:shadow-2xl font-bold p-2 px-8 transition duration-200 hover:opacity-9 flex">
                        <ion-icon name="information-outline"
                                  class="pr-2 text-xl flex whitespace-no-wrap flex-col"></ion-icon>
                        More info
                    </a>
                </div>
            </div>
        </div>
    @endforeach

    <div class="pt-1/3">
        <p class="mt-8
"></p>
        <h1 class="font-bold text-xl pl-15 text-center md:text-left mt-12 relative z-20 text-white">Latest releases</h1>
        <div class="pl-8 grab flex relative z-20">
            @foreach($movies as $movie)
                @php
                    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                @endphp
                <a href="{{ route('movie.info', ['movie' => $movie->id]) }}"
                   class="md:ml-5 mb-6 mt-2 focus:outline-none">
                    <img data-src="{{ $url }}" alt=""
                         class="rounded-xl shadow-2xl lazyload poster thumbnail lazy focus:outline-none" width="160"
                         height="230">
                </a>
            @endforeach
        </div>
    </div>

    <div>
        <h1 class="font-bold text-xl pl-15 text-center md:text-left">Recently Added</h1>
        <div class="pl-8 flex">
            @php
                $latest = \App\Models\Movie::orderBy('created_at', 'desc')->limit(7)->get();
            @endphp
            @foreach($latest as $movie)
                @php
                    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                @endphp
                <a href="{{ route('movie.info', ['movie' => $movie->id]) }}"
                   class="md:ml-5 mb-6 mt-2 focus:outline-none">
                    <img data-src="{{ $url }}" alt=""
                         class="rounded-xl lazyload shadow-2xl poster thumbnail lazy focus:outline-none"
                         width="160" height="230">
                </a>
            @endforeach
        </div>
    </div>

    <div>
        <h1 class="font-bold text-xl pl-15 text-center md:text-left">Most Watched</h1>
        @php
            $watchers = \App\Models\Watchers::select('movie')
            ->groupBy('movie')
            ->orderByRaw('COUNT(*) DESC')
            ->get();
        @endphp
        <div class="grab flex pl-8">
            @foreach($watchers as $movie)
                @php
                    $name = $movie->movie;
                    $video = \App\Models\Movie::where('name', $name)->get();
                @endphp
                @foreach($video as $movie)
                    @php
                        $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name . '/poster.jpg');
                    @endphp
                    <a href="{{ route('movie.info', ['movie' => $movie->id]) }}" class="focus:outline-none">
                        <img data-src="{{ $url }}"
                             class="rounded-lg lazyload shadow-xl md:ml-6 mb-6 mt-2 poster lazy focus:outline-none"
                             alt=""
                             width="160" height="230">
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
                    $movies = \App\Models\Genre::where('genre', $g->genre)->select('name')->limit(7)->inRandomOrder()->groupBy('name')->get();
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
                            <a href="{{ route('movie.info', ['movie' => $info->id]) }}" class="w-48 focus:outline-none">
                                <img data-src="{{ $url }}" loading="lazy"
                                     class="lazyload rounded-lg shadow-xl md:ml-6 mb-6 mt-2 poster border-0 lazy w-full focus:outline-none"
                                     alt="" width="160" height="230">
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
                    <a href="{{ route('movie.info', ['movie' => $movie->id]) }}"
                       class="md:ml-5 mb-6 mt-2 focus:outline-none">
                        <img data-src="{{ $url }}"
                             class="lazyload rounded-xl shadow-2xl poster thumbnail lazy focus:outline-none" width="160"
                             height="230">
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
<script>
    @php
        $volume = \App\Models\Volume::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->value('volume');
    @endphp

    const video = $('#video').get(0);

    const isVideoPlaying = video => !!(video.currentTime > 0 && !video.paused && !video.ended && video.readyState > 2);

    function playTrailer() {
        let video = $('#video').get(0);
        video.volume = {{ $volume }}
        video.get(0).play();
        let playing = isVideoPlaying(video);
        console.log(playing);
        if (playing) {
            setTimeout(function () {
                $('#description').hide(500)
            }, 6000)
        }
    }

    $('#play').bind("click keydown keyup", playTrailer);

    let playState = null;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                video.pause();
                playState = false;
                video.onpause = function () {
                    $('#description').show(500);
                }
            } else {
                video.play();
                playState = true;
                let playing = isVideoPlaying(video);
                if (playing) {
                    setTimeout(function () {
                        $('#description').hide(500)
                    }, 6000)
                }
            }
        });
    }, {});

    observer.observe(video);

    const onVisibilityChange = () => {
        if (document.hidden || !playState) {
            video.pause();
            video.onpause = function () {
                $('#description').show(500);
            }
        } else {
            video.play();
            let playing = isVideoPlaying(video);
            if (playing) {
                console.log('playing');
                setTimeout(function () {
                    $('#description').hide(500)
                }, 6000)
            }
        }
    };

    document.addEventListener("visibilitychange", onVisibilityChange);
    // ux
    $(document).ready(function () {
        $('#video').on('contextmenu', function () {
            return false;
        });
    })

    //detect video end
    video.addEventListener('ended', function () {
        video.load();
        $('#description').show(1000);
    }, false);

</script>
@include('movies.layouts.footer')
