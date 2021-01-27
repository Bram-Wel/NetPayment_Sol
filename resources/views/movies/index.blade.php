@include('movies.layouts.default')
<div class="py-5">
    <div class="flex flex-row flex-wrap justify-center">
        @foreach($movies as $movie)
            <?php
            $url = \Illuminate\Support\Facades\Storage::disk('movies')->url($movie->name . '/poster.jpg');
            ?>
            <a href="{{ route('player', ['movie' => $movie->id]) }}" class="ml-6 mb-6 mt-6">
                <div
                    style="background: url('{{ $url }}'); background-size: cover; width: 180px; height: 250px; background-position: center; background-repeat: no-repeat"
                    class="rounded-lg shadow-lg">
                </div>
            </a>
        @endforeach
    </div>
</div>
@include('movies.layouts.footer')
