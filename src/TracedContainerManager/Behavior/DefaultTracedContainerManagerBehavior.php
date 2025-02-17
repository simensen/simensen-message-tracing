<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\TracedContainerManager\Behavior;

use Simensen\MessageTracing\Trace\Trace;

/**
 * @template TContainer
 * @template TIdentity
 */
trait DefaultTracedContainerManagerBehavior
{
    /**
     * @param TContainer $container
     *
     * @return ?Trace<TIdentity>
     */
    abstract protected function extractTraceFromContainer(mixed $container): ?Trace;

    /**
     * @param TContainer $container
     * @param ?Trace<TIdentity> $trace
     *
     * @return TContainer
     */
    abstract protected function injectTraceIntoContainer(mixed $container, Trace $trace): mixed;
}
