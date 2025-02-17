<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Fixtures\Activity;

use Simensen\MessageTracing\Trace\Trace;
use Simensen\MessageTracing\Trace\TraceGenerator;
use Simensen\MessageTracing\TraceIdentity\TraceIdentityGenerator;

/**
 * @implements TraceGenerator<ActivityId>
 */
class ActivityTracerGenerator implements TraceGenerator
{
    public function generateTrace(TraceIdentityGenerator $traceIdentityGenerator): Trace
    {
        return ActivityTracer::start($traceIdentityGenerator);
    }
}
