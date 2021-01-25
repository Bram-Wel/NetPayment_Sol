<?php

namespace App\Console\Commands;

use FFMpeg\Format\Video\X264;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert movies to hls mode';

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
        // create some video formats...
        $lowBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(500);
        $midBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(1500);
        $highBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(3000);

        FFMpeg::fromDisk('movies')
            ->open('Outside the Wire/Outside the Wire.mp4')
            ->export()
            ->inFormat($highBitrateFormat)
            ->save('Outside the Wire/Outside the Wire' . '.m3u8');
    }
}
