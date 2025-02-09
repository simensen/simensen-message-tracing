<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Fixtures\Activity;

use Simensen\MessageTracing\Behavior\TracedContainerManager\CorrelationTracedContainerManagerBehavior;
use Simensen\MessageTracing\Tests\Fixtures\Activity\Behavior\DefaultTracedActivityBehavior;
use Simensen\MessageTracing\TracedContainerManager;
use Simensen\MessageTracing\TraceStack;

/**
 * @implements TracedContainerManager<Activity,ActivityId>
 */
class CorrelationTracedActivityManager implements TracedContainerManager
{
    use DefaultTracedActivityBehavior;

    /**
     * @use CorrelationTracedContainerManagerBehavior<Activity,ActivityId>
     */
    use CorrelationTracedContainerManagerBehavior;

    /**
     * @param TraceStack<ActivityId> $traceStack
     */
    public function __construct(protected readonly TraceStack $traceStack)
    {
    }
}
