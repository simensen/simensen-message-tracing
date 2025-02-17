<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\TraceStack;

use Simensen\MessageTracing\Trace\Trace;
use Simensen\MessageTracing\TraceStack\Adapter\DefaultTraceStack;
use Simensen\MessageTracing\TraceStack\Adapter\SpyingTraceStack;

/**
 * Low-level stack of Traces.
 *
 * This interface defines the lwo-level stack of Traces extracted
 * from containers managed by a Traced Container Manager.
 *
 * Unlike the Traced Container Manager interface, there is no
 * magic expected from this service. A push always pushes
 * and a pop always pops.
 *
 * A default implementation (`DefaultTraceStack`) is shipped with this
 * interface. A spy implementation (`SpyingTraceStack`) is also
 * shipped to help test a stack.
 *
 * @see DefaultTraceStack
 * @see SpyingTraceStack
 *
 * @template TIdentity
 */
interface TraceStack
{
    /**
     * @param Trace<TIdentity> $trace
     */
    public function push(Trace $trace): void;

    /**
     * @param Trace<TIdentity> $trace
     *
     * @return Trace<TIdentity>
     */
    public function pop(Trace $trace): Trace;

    /**
     * @return Trace<TIdentity>
     */
    public function start(): Trace;

    /**
     * @return Trace<TIdentity>
     */
    public function next(): Trace;

    public function isEmpty(): bool;

    public function isNotEmpty(): bool;

    /**
     * @param Trace<TIdentity> $trace
     */
    public function isTail(Trace $trace): bool;

    /**
     * @param Trace<TIdentity> $trace
     */
    public function isNotTail(Trace $trace): bool;
}
