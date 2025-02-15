<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Fixtures\Activity;

use Simensen\MessageTracing\Behavior\Trace\TraceComparisonBehavior;
use Simensen\MessageTracing\Behavior\Trace\TraceGenerationBehavior;
use Simensen\MessageTracing\Behavior\Trace\TraceGettersBehavior;
use Simensen\MessageTracing\Trace;
use Simensen\MessageTracing\TraceIdentityComparator;

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
