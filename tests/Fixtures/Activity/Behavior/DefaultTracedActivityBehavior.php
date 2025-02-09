<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Fixtures\Activity\Behavior;

use Simensen\MessageTracing\Behavior\TracedContainerManager\DefaultTracedContainerManagerBehavior;
use Simensen\MessageTracing\Tests\Fixtures\Activity\Activity;
use Simensen\MessageTracing\Tests\Fixtures\Activity\ActivityId;
use Simensen\MessageTracing\Tests\Fixtures\Activity\ActivityTracer;
use Simensen\MessageTracing\Trace;

trait DefaultTracedActivityBehavior
{
    /**
     * @use DefaultTracedContainerManagerBehavior<Activity,ActivityId>
     */
    use DefaultTracedContainerManagerBehavior;

    /**
     * @param Activity $container
     *
     * @return ?ActivityTracer
     */
    protected function extractTraceFromContainer(mixed $container): ?Trace
    {
        return $container->getActivityTracer();
    }

    /**
     * @param Activity $container
     * @param Trace<ActivityId> $trace
     *
     * @return Activity
     */
    protected function injectTraceIntoContainer(mixed $container, Trace $trace): mixed
    {
        assert($trace instanceof ActivityTracer);

        $container->setActivityTracer($trace);

        return $container;
    }
}
