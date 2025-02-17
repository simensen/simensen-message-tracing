<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Fixtures\Activity;

use Simensen\MessageTracing\Trace\Behavior\TraceComparisonBehavior;
use Simensen\MessageTracing\Trace\Behavior\TraceGenerationBehavior;
use Simensen\MessageTracing\Trace\Behavior\TraceGettersBehavior;
use Simensen\MessageTracing\Trace\Trace;
use Simensen\MessageTracing\TraceIdentity\TraceIdentityComparator;

/**
 * @implements Trace<ActivityId>
 */
class ActivityTracer implements Trace
{
    /**
     * @use TraceGenerationBehavior<ActivityId>
     */
    use TraceGenerationBehavior;

    /**
     * @use TraceComparisonBehavior<ActivityId>
     */
    use TraceComparisonBehavior;

    use TraceGettersBehavior;

    /**
     * @return TraceIdentityComparator<ActivityId>
     */
    protected function getDefaultTraceIdentityComparator(): TraceIdentityComparator
    {
        return new ActivityIdComparator();
    }
}
