<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Trace\Behavior;

use Simensen\MessageTracing\TraceIdentity\TraceIdentityGenerator;

/**
 * @template TIdentity
 */
trait TraceGenerationBehavior
{
    /**
     * @param TIdentity $id
     * @param TIdentity $causationId
     * @param TIdentity $correlationId
     */
    final private function __construct(
        private readonly mixed $id,
        private readonly mixed $causationId,
        private readonly mixed $correlationId,
    ) {
    }

    public static function start(TraceIdentityGenerator $traceIdentityGenerator): static
    {
        $id = $traceIdentityGenerator->generateTraceIdentity();

        return new static(
            $id,
            clone $id,
            clone $id,
        );
    }

    public function next(TraceIdentityGenerator $traceIdentityGenerator): static
    {
        return new static(
            $traceIdentityGenerator->generateTraceIdentity(),
            $this->id,
            $this->correlationId
        );
    }
}
