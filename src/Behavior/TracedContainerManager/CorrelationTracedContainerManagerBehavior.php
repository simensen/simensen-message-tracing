<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Behavior\TracedContainerManager;

use Simensen\MessageTracing\Behavior\TracedContainerManager\Operation\PopTracedContainerManagerBehavior;
use Simensen\MessageTracing\Behavior\TracedContainerManager\Operation\PushCorrelationTracedContainerManagerBehavior;

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
