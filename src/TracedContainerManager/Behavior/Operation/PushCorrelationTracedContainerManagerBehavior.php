<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Behavior\TracedContainerManager\Operation;

use Simensen\MessageTracing\Behavior\TracedContainerManager\DefaultTracedContainerManagerBehavior;

/**
 * @template TContainer
 * @template TIdentity
 */
trait PushCorrelationTracedContainerManagerBehavior
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
    public function push(mixed $container): mixed
    {
        $trace = $this->extractTraceFromContainer($container);

        if (!$trace && $this->traceStack->isNotEmpty()) {
            $trace = $this->traceStack->next();
        } else {
            $trace ??= $this->traceStack->start();

            // @TODO Only push if stack is empty?
            // @TODO Only push if $trace isn't already at the top of the stack?
            $this->traceStack->push($trace);
        }

        return $this->injectTraceIntoContainer($container, $trace);
    }
}
