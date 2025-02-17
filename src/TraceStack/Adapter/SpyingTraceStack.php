<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\TraceStack\Adapter;

use Simensen\MessageTracing\Trace\Trace;
use Simensen\MessageTracing\TraceStack\TraceStack;

/**
 * @template TIdentity
 *
 * @implements TraceStack<TIdentity>
 */
final class SpyingTraceStack implements TraceStack
{
    /**
     * @var Trace<TIdentity>[]
     */
    private array $stack = [];

    /**
     * @param TraceStack<TIdentity> $subject
     */
    public function __construct(private readonly TraceStack $subject)
    {
    }

    public function push(Trace $trace): void
    {
        $this->subject->push($trace);

        $this->stack[] = $trace;
    }

    public function pop(Trace $trace): Trace
    {
        // @WARNING This block contains more logic than maybe it should...
        if ($this->stack && end($this->stack)->equals($trace)) {
            array_pop($this->stack);
        }

        return $this->subject->pop($trace);
    }

    public function start(): Trace
    {
        return $this->subject->start();
    }

    public function next(): Trace
    {
        return $this->subject->next();
    }

    public function isEmpty(): bool
    {
        return $this->subject->isEmpty();
    }

    public function isNotEmpty(): bool
    {
        return $this->subject->isNotEmpty();
    }

    public function isTail(Trace $trace): bool
    {
        return $this->subject->isTail($trace);
    }

    public function isNotTail(Trace $trace): bool
    {
        return $this->subject->isNotTail($trace);
    }

    /**
     * @return Trace<TIdentity>[]
     */
    public function getRawStack(): array
    {
        return $this->stack;
    }
}
