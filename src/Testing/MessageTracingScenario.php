<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Testing;

use Simensen\MessageTracing\Trace\TraceGenerator;
use Simensen\MessageTracing\TracedContainerManager\TracedContainerManager;
use Simensen\MessageTracing\TraceIdentity\TraceIdentityGenerator;
use Simensen\MessageTracing\TraceStack\Adapter\SpyingTraceStack;
use Simensen\MessageTracing\TraceStack\TraceStack;

/**
 * @template TContainer
 * @template TIdentity
 */
abstract readonly class MessageTracingScenario
{
    /**
     * @param TraceIdentityGenerator<TIdentity> $traceIdentityGenerator
     * @param TraceGenerator<TIdentity> $traceGenerator
     * @param TraceStack<TIdentity> $traceStack
     * @param SpyingTraceStack<TIdentity> $spyingTraceStack
     * @param TracedContainerManager<TContainer,TIdentity> $causationTracedContainerManager
     * @param TracedContainerManager<TContainer,TIdentity> $correlationTracedContainerManager
     */
    public function __construct(
        protected TraceIdentityGenerator $traceIdentityGenerator,
        protected TraceGenerator $traceGenerator,
        protected TraceStack $traceStack,
        protected SpyingTraceStack $spyingTraceStack,
        protected TracedContainerManager $causationTracedContainerManager,
        protected TracedContainerManager $correlationTracedContainerManager,
    ) {
    }

    /**
     * @return TraceIdentityGenerator<TIdentity>
     */
    public function getTraceIdentityGenerator(): TraceIdentityGenerator
    {
        return $this->traceIdentityGenerator;
    }

    /**
     * @return TraceGenerator<TIdentity>
     */
    public function getTraceGenerator(): TraceGenerator
    {
        return $this->traceGenerator;
    }

    /**
     * @return TraceStack<TIdentity>
     */
    public function getTraceStack(): TraceStack
    {
        return $this->traceStack;
    }

    /**
     * @return SpyingTraceStack<TIdentity>
     */
    public function getSpyingTraceStack(): SpyingTraceStack
    {
        return $this->spyingTraceStack;
    }

    /**
     * @return TracedContainerManager<TContainer,TIdentity>
     */
    public function getCausationTracedContainerManager(): TracedContainerManager
    {
        return $this->causationTracedContainerManager;
    }

    /**
     * @return TracedContainerManager<TContainer,TIdentity>
     */
    public function getCorrelationTracedContainerManager(): TracedContainerManager
    {
        return $this->correlationTracedContainerManager;
    }

    /**
     * @return self<TContainer,TIdentity>
     */
    abstract public static function create(): self;
}
