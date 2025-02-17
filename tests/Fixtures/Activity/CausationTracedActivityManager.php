<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Fixtures\Activity;

use Simensen\MessageTracing\Tests\Fixtures\Activity\Behavior\DefaultTracedActivityBehavior;
use Simensen\MessageTracing\TracedContainerManager\Behavior\CausationTracedContainerManagerBehavior;
use Simensen\MessageTracing\TracedContainerManager\TracedContainerManager;
use Simensen\MessageTracing\TraceStack\TraceStack;

/**
 * @implements TracedContainerManager<Activity,ActivityId>
 */
class CausationTracedActivityManager implements TracedContainerManager
{
    use DefaultTracedActivityBehavior;

    /**
     * @use CausationTracedContainerManagerBehavior<Activity,ActivityId>
     */
    use CausationTracedContainerManagerBehavior;

    /**
     * @param TraceStack<ActivityId> $traceStack
     */
    public function __construct(protected readonly TraceStack $traceStack)
    {
    }
}
