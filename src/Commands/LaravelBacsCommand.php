<?php

namespace LaravelBacs\LaravelBacs\Commands;

use Illuminate\Console\Command;

class LaravelBacsCommand extends Command
{
    public $signature = 'laravel-bacs';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
