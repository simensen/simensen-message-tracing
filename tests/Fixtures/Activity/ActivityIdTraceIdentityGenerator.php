<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Fixtures\Activity;

use Simensen\MessageTracing\TraceIdentity\TraceIdentityGenerator;

/**
 * @implements TraceIdentityGenerator<ActivityId>
 */
class ActivityIdTraceIdentityGenerator implements TraceIdentityGenerator
{
    public function generateTraceIdentity(): mixed
    {
        return ActivityId::generate();
    }
}
