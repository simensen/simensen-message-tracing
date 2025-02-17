<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\TracedContainerManager\Behavior\Operation;

use Simensen\MessageTracing\TracedContainerManager\Behavior\DefaultTracedContainerManagerBehavior;

/**
 * @template TContainer
 * @template TIdentity
 */
trait PushCausationTracedContainerManagerBehavior
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

            $this->traceStack->push($trace);
        } else {
            $trace ??= $this->traceStack->start();

            // @TODO Only push if stack is empty?
            // @TODO Only push if $trace isn't already at the top of the stack?
            $this->traceStack->push($trace);
        }

        return $this->injectTraceIntoContainer($container, $trace);
    }
}
