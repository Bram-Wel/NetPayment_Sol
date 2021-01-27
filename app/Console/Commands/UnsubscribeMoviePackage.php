<?php

namespace App\Console\Commands;

use App\Models\MovieSubscription;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UnsubscribeMoviePackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unsubscribe:movie';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unsubscribe from movie packages';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscribers = MovieSubscription::get();
        foreach ($subscribers as $subscriber) {
            $expiry = $subscriber->expiry;
            $expiry = Carbon::parse($expiry);
            if ($expiry->isPast()) {
                $id = $subscriber->id;
                MovieSubscription::delete($id);
            }
        }
    }
}
