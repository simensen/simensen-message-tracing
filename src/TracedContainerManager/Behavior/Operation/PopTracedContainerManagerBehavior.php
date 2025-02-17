<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Behavior\TracedContainerManager\Operation;

use Simensen\MessageTracing\Behavior\TracedContainerManager\DefaultTracedContainerManagerBehavior;

/**
 * @template TContainer
 * @template TIdentity
 */
trait PopTracedContainerManagerBehavior
{
    /**
     * @use DefaultTracedContainerManagerBehavior<TContainer,TIdentity>
     */
    use DefaultTracedContainerManagerBehavior;

    /**
     * @param TContainer $container
     *
     * @return TContainer
     */
    public function pop(mixed $container): mixed
    {
        if (!$trace = $this->extractTraceFromContainer($container)) {
            return $container;
        }

        if ($this->traceStack->isNotTail($trace)) {
            return $container;
        }

        return $this->injectTraceIntoContainer(
            $container,
            $this->traceStack->pop($trace)
        );
    }
}
