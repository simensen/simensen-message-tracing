<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Adapter;

use Simensen\MessageTracing\Behavior\TraceStack\DefaultTraceStackBehavior;
use Simensen\MessageTracing\TraceGenerator;
use Simensen\MessageTracing\TraceIdentityGenerator;
use Simensen\MessageTracing\TraceStack;

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
