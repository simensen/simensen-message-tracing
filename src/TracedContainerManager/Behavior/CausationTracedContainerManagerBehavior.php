<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Behavior\TracedContainerManager;

use Simensen\MessageTracing\Behavior\TracedContainerManager\Operation\PopTracedContainerManagerBehavior;
use Simensen\MessageTracing\Behavior\TracedContainerManager\Operation\PushCausationTracedContainerManagerBehavior;

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
