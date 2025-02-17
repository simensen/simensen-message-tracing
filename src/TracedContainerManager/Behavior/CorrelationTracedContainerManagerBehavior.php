<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\TracedContainerManager\Behavior;

use Simensen\MessageTracing\TracedContainerManager\Behavior\Operation\PopTracedContainerManagerBehavior;
use Simensen\MessageTracing\TracedContainerManager\Behavior\Operation\PushCorrelationTracedContainerManagerBehavior;

/**
 * @template TContainer
 * @template TIdentity
 */
trait CorrelationTracedContainerManagerBehavior
{
    /**
     * @use PopTracedContainerManagerBehavior<TContainer,TIdentity>
     */
    use PopTracedContainerManagerBehavior;

    /**
     * @use PushCorrelationTracedContainerManagerBehavior<TContainer,TIdentity>
     */
    use PushCorrelationTracedContainerManagerBehavior;
}
