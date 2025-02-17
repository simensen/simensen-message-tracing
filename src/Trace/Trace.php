<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Trace;

use Simensen\MessageTracing\Trace\Behavior\TraceComparisonBehavior;
use Simensen\MessageTracing\Trace\Behavior\TraceGenerationBehavior;
use Simensen\MessageTracing\Trace\Behavior\TraceGettersBehavior;
use Simensen\MessageTracing\TraceIdentity\TraceIdentityGenerator;

/**
 * A Trace is a container for identity and relationships.
 *
 * The template type `TIdentity` specifies the type for the `id`, `causationId`,
 * and `correlationId` properties.
 *
 * There is no concrete implementation shipped with this interface.
 * Traits are provided to satisfy the behavior requirements.
 *
 * @see TraceGenerationBehavior
 * @see TraceGettersBehavior
 * @see TraceComparisonBehavior
 *
 * @template TIdentity
 */
interface Trace
{
    /**
     * @param TraceIdentityGenerator<TIdentity> $traceIdentityGenerator
     *
     * @return Trace<TIdentity>
     */
    public static function start(TraceIdentityGenerator $traceIdentityGenerator): self;

    /**
     * @param TraceIdentityGenerator<TIdentity> $traceIdentityGenerator
     *
     * @return Trace<TIdentity>
     */
    public function next(TraceIdentityGenerator $traceIdentityGenerator): self;

    /**
     * @return TIdentity
     */
    public function getId(): mixed;

    /**
     * @return TIdentity
     */
    public function getCausationId(): mixed;

    /**
     * @return TIdentity
     */
    public function getCorrelationId(): mixed;

    public function equals(mixed $other): bool;

    public function isRoot(): bool;

    /**
     * @param Trace<TIdentity> $other
     */
    public function correlatesWith(Trace $other): bool;

    /**
     * @param Trace<TIdentity> $other
     */
    public function causedBy(Trace $other): bool;
}
