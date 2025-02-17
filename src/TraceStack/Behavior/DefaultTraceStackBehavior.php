<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\TraceStack\Behavior;

use Simensen\MessageTracing\Trace\Trace;
use Simensen\MessageTracing\Trace\TraceGenerator;
use Simensen\MessageTracing\TraceIdentity\TraceIdentityGenerator;

/**
 * @template TIdentity
 *
 * @property TraceGenerator<TIdentity> $traceGenerator
 * @property TraceIdentityGenerator<TIdentity> $traceIdentityGenerator
 */
trait DefaultTraceStackBehavior
{
    /**
     * @var Trace<TIdentity>[]
     */
    private array $stack = [];

    public function push(Trace $trace): void
    {
        $this->stack[] = $trace;
    }

    public function pop(Trace $trace): Trace
    {
        if ($this->stack && $this->isTail($trace)) {
            array_pop($this->stack);
        }

        // @TODO We should maybe consider raising errors (string?) if
        //       pop is called but the stack is empty or the stack
        //       has a different Trace at the tail.

        return $trace;
    }

    public function start(): Trace
    {
        // @TODO Do we want to throw an exception if stack the
        //       stack is empty?
        return $this->stack
            ? end($this->stack)->next($this->traceIdentityGenerator)
            : $this->traceGenerator->generateTrace($this->traceIdentityGenerator);
    }

    public function next(): Trace
    {
        // @TODO Do we want to throw an exception if stack the
        //       stack is empty?
        return $this->stack
            ? end($this->stack)->next($this->traceIdentityGenerator)
            : $this->traceGenerator->generateTrace($this->traceIdentityGenerator);
    }

    public function isEmpty(): bool
    {
        return count($this->stack) === 0;
    }

    public function isNotEmpty(): bool
    {
        return count($this->stack) > 0;
    }

    public function isTail(Trace $trace): bool
    {
        return $this->stack ? end($this->stack)->equals($trace) : false;
    }

    public function isNotTail(Trace $trace): bool
    {
        return !$this->isTail($trace);
    }
}
