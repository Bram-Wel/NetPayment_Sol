@include('movies.layouts.default')
@foreach($movie as $mov)
    <div class="">
        {{ dd($mov) }}
    </div>
@endforeach
