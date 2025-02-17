<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Trace;

use Simensen\MessageTracing\TraceIdentity\TraceIdentityGenerator;

/**
 * Generates Traces.
 *
 * Since Trace and its TIdentity are generic, a Trace Generator
 * is required to ensure the correct construction of a
 * specific implementation of the Trace interface.
 *
 * @template TIdentity
 */
interface TraceGenerator
{
    /**
     * @param TraceIdentityGenerator<TIdentity> $traceIdentityGenerator
     *
     * @return Trace<TIdentity>
     */
    public function generateTrace(TraceIdentityGenerator $traceIdentityGenerator): Trace;
}
