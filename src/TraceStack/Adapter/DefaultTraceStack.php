<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\TraceStack\Adapter;

use Simensen\MessageTracing\Trace\TraceGenerator;
use Simensen\MessageTracing\TraceIdentity\TraceIdentityGenerator;
use Simensen\MessageTracing\TraceStack\Behavior\DefaultTraceStackBehavior;
use Simensen\MessageTracing\TraceStack\TraceStack;

/**
 * @template TIdentity
 *
 * @implements TraceStack<TIdentity>
 */
final class DefaultTraceStack implements TraceStack
{
    /**
     * @use DefaultTraceStackBehavior<TIdentity>
     */
    use DefaultTraceStackBehavior;

    /**
     * @param TraceGenerator<TIdentity> $traceGenerator
     * @param TraceIdentityGenerator<TIdentity> $traceIdentityGenerator
     */
    public function __construct(
        protected readonly TraceGenerator $traceGenerator,
        protected readonly TraceIdentityGenerator $traceIdentityGenerator,
    ) {
    }
}
