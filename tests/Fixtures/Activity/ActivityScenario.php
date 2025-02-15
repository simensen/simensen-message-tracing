<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Fixtures\Activity;

use Simensen\MessageTracing\Adapter\DefaultTraceStack;
use Simensen\MessageTracing\Adapter\SpyingTraceStack;
use Simensen\MessageTracing\Testing\MessageTracingScenario;

/**
 * @extends MessageTracingScenario<Activity,ActivityId>
 */
final readonly class ActivityScenario extends MessageTracingScenario
{
    public static function create(): self
    {
        $traceIdentityGenerator = new ActivityIdTraceIdentityGenerator();
        $traceGenerator = new ActivityTracerGenerator();
        $traceStack = new DefaultTraceStack(
            $traceGenerator,
            $traceIdentityGenerator
        );

        $spyingTraceStack = new SpyingTraceStack($traceStack);

        $causationTracedContainerManager = new CausationTracedActivityManager($spyingTraceStack);
        $correlationTracedContainerManager = new CorrelationTracedActivityManager($spyingTraceStack);

        return new self(
            $traceIdentityGenerator,
            $traceGenerator,
            $traceStack,
            $spyingTraceStack,
            $causationTracedContainerManager,
            $correlationTracedContainerManager,
        );
    }
}
