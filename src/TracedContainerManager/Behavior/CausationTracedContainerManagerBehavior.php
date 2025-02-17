<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\TracedContainerManager\Behavior;

use Simensen\MessageTracing\TracedContainerManager\Behavior\Operation\PopTracedContainerManagerBehavior;
use Simensen\MessageTracing\TracedContainerManager\Behavior\Operation\PushCausationTracedContainerManagerBehavior;

/**
 * @template TContainer
 * @template TIdentity
 */
trait CausationTracedContainerManagerBehavior
{
    /**
     * @use PopTracedContainerManagerBehavior<TContainer,TIdentity>
     */
    use PopTracedContainerManagerBehavior;

    /**
     * @use PushCausationTracedContainerManagerBehavior<TContainer,TIdentity>
     */
    use PushCausationTracedContainerManagerBehavior;
}
