<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\TraceIdentity\Adapter;

use Simensen\MessageTracing\TraceIdentity\TraceIdentityGenerator;

/**
 * @implements TraceIdentityGenerator<int>
 */
final class SeedableAutoIncrementingTraceIdentityGenerator implements TraceIdentityGenerator
{
    public function __construct(private int $seed = 0)
    {
    }

    public function generateTraceIdentity(): mixed
    {
        return ++$this->seed;
    }
}
