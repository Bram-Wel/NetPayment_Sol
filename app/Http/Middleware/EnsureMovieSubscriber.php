<?php

namespace App\Http\Middleware;

use App\Models\MovieSubscription;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnsureMovieSubscriber
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $name = Auth::user()->name;
        DB::table('movie_subscriptions')
            ->where('name', $name)
            ->count('id');
        if ($count == 0) {
            session()->flash('message', 'Kindly subscribe to watch movies!');
            return redirect()->to(route('movie-packages'));
        }
        return $next($request);
    }
}
