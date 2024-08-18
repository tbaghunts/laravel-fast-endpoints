<?php

namespace Baghunts\LaravelFastEndpoints\Generator\Pipes;

use Baghunts\LaravelFastEndpoints\Contracts\RouteGeneratorContract;
use Closure;

class GroupPipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $configGroups = config('fast-endpoints.groups');

        $endpointConfig = $generator->getEndpointConfiguration();
        $groups = $endpointConfig->getGroups();

        $groupsMergerIsPossible = !empty($configGroups) && !empty($groups);

        if ($groupsMergerIsPossible) {
            $discoveredGroups = collect($groups)
                ->filter(fn(string $group) => array_key_exists($group, $configGroups))
                ->map(fn(string $group) => $configGroups[$group]);

            if ($discoveredGroups->isNotEmpty()) {
                $endpointConfig->mergeCollection(
                    $discoveredGroups->toArray()
                );
            }
        }

        $next($generator);
    }
}