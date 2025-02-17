<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\TracedContainerManager\Behavior\Operation;

use Simensen\MessageTracing\TracedContainerManager\Behavior\DefaultTracedContainerManagerBehavior;

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
