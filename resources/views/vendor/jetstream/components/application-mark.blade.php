@if(!request()->routeIs('movies'))
    <img src="{{ asset('/images/logo.png') }}" alt="logo" style="width: 60px">
@else
    <img src="{{ asset('/images/logo-white.png') }}" alt="logo" style="width: 60px">
@endif

