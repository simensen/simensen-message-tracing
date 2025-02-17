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
    protected function __construct(
        private readonly mixed $id,
        private readonly mixed $causationId,
        private readonly mixed $correlationId,
    ) {
    }

    public static function start(TraceIdentityGenerator $traceIdentityGenerator): self
    {
        $id = $traceIdentityGenerator->generateTraceIdentity();

        return new self(
            $id,
            clone $id,
            clone $id,
        );
    }

    public function next(TraceIdentityGenerator $traceIdentityGenerator): self
    {
        return new self(
            $traceIdentityGenerator->generateTraceIdentity(),
            $this->id,
            $this->correlationId
        );
    }
}
