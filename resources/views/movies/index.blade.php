@include('movies.layouts.default')
<div class="py-5">
    <div>
        <h1 class="text-gray-600 text-xl pl-6">Latest movies</h1>
        <div class="flex flex-row flex-wrap justify-start">
            @foreach($movies as $movie)
                <?php
                $url = \Illuminate\Support\Facades\Storage::disk('movies')->url($movie->name . '/poster.jpg');
                ?>
                <a href="{{ route('player', ['movie' => $movie->id]) }}" class="ml-6 mb-6 mt-2">
                    <div
                        style="background: url('{{ $url }}'); background-size: cover; width: 180px; height: 250px; background-position: center; background-repeat: no-repeat"
                        class="rounded-lg shadow-xl">
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <div>
        <h1 class="text-gray-600 text-xl pl-6">Coming this week</h1>
        <div class="flex flex-row justify-start">
            <?php
            $movies = \App\Models\Movie::where('converted', 0)->latest()->limit(6)->get();
            ?>
            @foreach($movies as $movie)
                <?php
                $url = \Illuminate\Support\Facades\Storage::disk('movies')->url($movie->name . '/poster.jpg');
                ?>
                <a href="{{ route('player', ['movie' => $movie->id]) }}" class="ml-6 mb-6 mt-2">
                    <div
                        style="background: url('{{ $url }}'); background-size: cover; width: 180px; height: 250px; background-position: center; background-repeat: no-repeat"
                        class="rounded-lg shadow-xl hover:transform scale-100 md:scale-75">
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</div>
@include('movies.layouts.footer')
