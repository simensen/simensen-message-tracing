<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Fixtures\Activity;

use Simensen\MessageTracing\Tests\Fixtures\Activity\Behavior\DefaultTracedActivityBehavior;
use Simensen\MessageTracing\TracedContainerManager\Behavior\CorrelationTracedContainerManagerBehavior;
use Simensen\MessageTracing\TracedContainerManager\TracedContainerManager;
use Simensen\MessageTracing\TraceStack\TraceStack;

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
