<?php

namespace Baghunts\LaravelFastEndpoint\Commands;

use Illuminate\Console\Command;

class CacheCommand extends Command
{

    protected $signature = 'fast-endpoint:cache';

    protected $description = 'Caching Fast endpoints generated routes';


    public function handle(): int
    {
        dump("Fast-endpoints cache command");

        return 0;
    }

}