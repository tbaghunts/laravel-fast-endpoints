<?php

namespace Baghunts\LaravelFastEndpoint\Commands;

use Symfony\Component\Console\Input\InputOption;

use Illuminate\Support\Str;
use Illuminate\Console\Command;

class MakeEndpointCommand extends Command
{

    protected $signature = 'make:fast-endpoint {path} {--R|request} {--r|response}';

    protected $description = 'Make a Fast Endpoint';

    public function handle(): int
    {
        dd($this->arguments(), $this->options());

        return 0;
    }

    protected function getOptions(): array
    {
        return [
            ["name", null, InputOption::VALUE_OPTIONAL, "Endpoint name"],
            ["className", null, InputOption::VALUE_OPTIONAL, "Endpoint class name"],
            ["request", "R", InputOption::VALUE_OPTIONAL, "Generate endpoint request"],
            ["response", "r", InputOption::VALUE_OPTIONAL, "Generate endpoint response"],
            ["middleware", null, InputOption::VALUE_OPTIONAL, "Generate endpoint middlewares list"],
            ["method", null, InputOption::VALUE_OPTIONAL, "Endpoint method (get|post|put|patch|delete|options|any) or List of methods"],
        ];
    }

    private function getPath(): string
    {
        dd(Str::of($this->argument('name'))->replace(".", DIRECTORY_SEPARATOR)->ucfirst());
    }

}