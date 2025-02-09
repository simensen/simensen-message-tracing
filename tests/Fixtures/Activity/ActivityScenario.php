<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Fixtures\Activity;

use Simensen\MessageTracing\Adapter\DefaultTraceStack;
use Simensen\MessageTracing\Adapter\SpyingTraceStack;

final readonly class ActivityScenario
{
    /**
     * @param DefaultTraceStack<ActivityId> $traceStack
     * @param SpyingTraceStack<ActivityId> $spyingTraceStack
     */
    public function __construct(
        public ActivityIdTraceIdentityGenerator $traceIdentityGenerator,
        public ActivityTracerGenerator $tracerGenerator,
        public DefaultTraceStack $traceStack,
        public SpyingTraceStack $spyingTraceStack,
        public CausationTracedActivityManager $causationTracedContainerManager,
        public CorrelationTracedActivityManager $correlationTracedContainerManager,
    ) {
    }

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
