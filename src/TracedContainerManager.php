<?php

declare(strict_types=1);

namespace Simensen\MessageTracing;

/**
 * Manages a stack of objects that contain Traces.
 *
 * A common scenario for tracing involves adding tracing information
 * to metadata related to a message. The "message" is what
 * we refer to as a "traced container".
 *
 * This is an extremely high-level interface for managing the tracing
 * of these container objects. There are still stack-related calls
 * like `push()` and `pop()`, but there is no actual pushing or
 * popping of the container objects themselves.
 *
 * Instead, this interface extracts Traces from and injects Traces into
 * these containers. It leverages a Trace Stack to create and manage
 * relationships between container objects by way of their Traces.
 *
 * @see Trace
 * @see TraceStack
 *
 * @template TContainer
 * @template TIdentity
 */
interface TracedContainerManager
{
    /**
     * @param TContainer $container
     *
     * @return TContainer
     */
    public function push(mixed $container): mixed;

    /**
     * @param TContainer $container
     *
     * @return TContainer
     */
    public function pop(mixed $container): mixed;
}
