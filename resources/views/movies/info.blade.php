@include('movies.layouts.default')
@php
    $url = \Illuminate\Support\Facades\Storage::disk($movie->disk)->url($movie->name);
@endphp
<style>
    video {
        object-fit: cover;
        width: 100%;
        height: 100vh;
        filter: brightness(50%);
    }
</style>
<div
    class="overflow-none main">
    <video id="video" poster="{!! $url !!}/fanart.jpg">
        <source src="{{ $url }}/trailer.mp4">
    </video>
    <div class="absolute top-16 left-20 w-1/2">
        <div class="mb-14">
            <a href="{{ route('movies') }}"
               class="text-white font-bold text-xl flex">
                <ion-icon name="arrow-back-circle-outline" title="Back" class="text-xl relative mt-1 mr-4"></ion-icon>
                Back</a>
        </div>
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
            <img src="{!! $url !!}/logo.jpg" alt="" style="width: 500px;" id="logo">
        @else
            <h1 class="text-white font-bold text-5xl">{{ $movie->name }}</h1>
        @endif
        <div id="description">
            <div class="details mt-2 mb-2">
                @php
                    $genres = \Illuminate\Support\Facades\DB::table('genres')
                ->where('name', $movie->name)
                ->get();
                @endphp
                <div class="text-gray-200 mb-1"> {{ $movie->mpaa }} · {{ $movie->year }}
                    · {{  \Carbon\CarbonInterval::minutes((int)$movie->runtime)->cascade()->forHumans() }}
                    · @foreach($genres as $g) {{ $g->genre . ',' }} @endforeach
                </div>
            </div>
            <p class="text-white font-bold">{{ $movie->description }}</p>
        </div>

        <div class="flex mt-4">
            <a href="{{ route('player', ['movie' => $movie->id]) }}"
               class="mr-4 bg-white rounded-xl shadow-xl hover:shadow-2xl font-bold p-2 px-8 transition duration-200 hover:opacity-9 flex">
                <ion-icon name="play-outline" class="pr-2 text-xl flex whitespace-no-wrap flex-col"></ion-icon>
                Play</a>
            @php
                $trailerPresent = \App\Models\Trailers::where('movie', $movie->name)->count();
            @endphp
            @if($trailerPresent)
                <button onclick="playTrailer()"
                        class="mr-4 bg-white rounded-xl shadow-xl hover:shadow-2xl focus:outline-none font-bold p-2 px-8 transition duration-200 hover:opacity-9 flex">
                    <ion-icon name="videocam-outline" class="pr-2 text-xl flex whitespace-no-wrap flex-col"></ion-icon>
                    <span id="play" class="mr-1">Play</span> trailer
                </button>
            @endif
        </div>
    </div>
</div>

<script>
    @php
        $volume = \App\Models\Volume::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->value('volume');
    @endphp
    let playState = null;

    function playTrailer() {
        let video = $('#video');
        video.volume =
        {{ $volume }}
        if (playState) {
            video.get(0).pause();
            playState = false;
            $('#description').show(1000);
            $('#play').html('Play');
            $('#logo').css({
                'position': 'absolute',
                'bottom': 0,
                'left': 0,
                'top': '400px',
                'transform': "scale(0.5)"
            })
        } else {
            video.get(0).play();
            playState = true;
            setTimeout(function () {
                $('#description').hide(500)
            }, 6000)
            $('#play').html('Pause');
        }
    }

    const video = document.querySelector("#video");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                video.pause();
                playState = false;
                video.onpause = function () {
                    $('#description').show(1000);
                    $('#play').html('Play');
                }
            } else {
                video.play();
                playState = true;
                video.onplay = function () {
                    setTimeout(function () {
                        $('#description').hide(500)
                    }, 6000)
                    $('#play').html('Pause');
                }
            }
        });
    }, {});

    observer.observe(video);

    const onVisibilityChange = () => {
        if (document.hidden || !playState) {
            video.pause();
            playState = false;
            video.onpause = function () {
                setTimeout(function () {
                    $('#description').hide(500)
                }, 6000)
                $('#play').html('Play');
            }
        } else {
            video.play();
            playState = true;
            video.onplay = function () {
                setTimeout(function () {
                    $('#description').hide(500)
                }, 6000)
                $('#play').html('Pause');
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
        console.log('ended');
    }, false);

</script>
