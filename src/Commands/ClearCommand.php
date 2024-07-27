<?php

namespace Baghunts\LaravelFastEndpoint\Commands;

use Illuminate\Console\Command;

class ClearCommand extends Command
{

    protected $signature = 'fast-endpoint:cache:clear';

    protected $description = 'Clear fast endpoints cached routes';

    public function handle(): int
    {
//        dump("Fast-endpoints clear command");

        return 0;
    }

}