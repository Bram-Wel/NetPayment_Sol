@include('movies.layouts.default')
<style>
    .poster {
        width: 180px;
        height: 250px;
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
    {{--    <div class="genres flex flex-row">--}}
    {{--        @php--}}
    {{--            $genres = \App\Models\Genre::distinct('genre')->get();--}}
    {{--        @endphp--}}
    {{--        @foreach($genres as $genre)--}}
    {{--            @php--}}
    {{--                $converted = \App\Models\Movie::where('name', $genre->name)->value('converted');--}}
    {{--            @endphp--}}
    {{--            @if($converted == 1)--}}
    {{--                <span class="rounded-2xl bg-gray-100">{{ $genre->genre }}</span>--}}
    {{--            @endif--}}
    {{--        @endforeach--}}
    {{--    </div>--}}
    <div>
        <h1 class="text-gray-600 text-xl pl-6 text-center md:text-left
">Latest movies</h1>
        <div class="flex flex-row flex-wrap justify-center md:justify-start">
            @foreach($movies as $movie)
                @php
                    $url = \Illuminate\Support\Facades\Storage::disk('movies')->url($movie->name . '/poster.jpg');
                @endphp
                <a href="{{ route('player', ['movie' => $movie->id]) }}" class="md:ml-6 mb-6 mt-2">
                    <div
                        style="background: url('{{ $url }}'); background-size: cover; background-position: center; background-repeat: no-repeat"
                        class="rounded-lg shadow-xl poster">
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <div>
        <h1 class="text-gray-600 text-xl md:pl-6 text-center md:text-left">Coming this week</h1>
        <div class="flex flex-row flex-wrap md:flex-row justify-center content-center md:justify-start">
            <?php
            $movies = \App\Models\Movie::where('converted', 0)->latest()->limit(6)->get();
            ?>
            @foreach($movies as $movie)
                <?php
                $url = \Illuminate\Support\Facades\Storage::disk('movies')->url($movie->name . '/poster.jpg');
                ?>
                {{--                <a href="{{ route('player', ['movie' => $movie->id]) }}" class="">--}}
                <div
                    style="background: url('{{ $url }}'); background-size: cover; background-position: center; background-repeat: no-repeat"
                    class="rounded-lg shadow-xl md:ml-6 mb-6 mt-2 poster">
                </div>
                {{--                </a>--}}
            @endforeach
        </div>
    </div>

</div>
@include('movies.layouts.footer')
