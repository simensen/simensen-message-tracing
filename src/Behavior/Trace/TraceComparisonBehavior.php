<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Behavior\Trace;

use Simensen\MessageTracing\Adapter\StringableTraceIdentityComparator;
use Simensen\MessageTracing\Trace;
use Simensen\MessageTracing\TraceIdentityComparator;

/**
 * @template TIdentity
 */
trait TraceComparisonBehavior
{
    /**
     * @var TraceIdentityComparator<TIdentity>
     */
    private TraceIdentityComparator $traceIdentityComparator;

    /**
     * @return TraceIdentityComparator<TIdentity>
     */
    protected function getDefaultTraceIdentityComparator(): TraceIdentityComparator
    {
        /** @var TraceIdentityComparator<TIdentity> */
        return new StringableTraceIdentityComparator();
    }

    /**
     * @return TraceIdentityComparator<TIdentity>
     */
    protected function getTraceIdentityComparator(): TraceIdentityComparator
    {
        return $this->traceIdentityComparator ??= $this->getDefaultTraceIdentityComparator();
    }

    public function isRoot(): bool
    {
        return $this->getTraceIdentityComparator()->areEqual($this, $this->getCorrelationId());
    }

    public function causedBy(Trace $other): bool
    {
        return
            $this->getTraceIdentityComparator()->areEqual($this->getCausationId(), $other)
            && $this->getTraceIdentityComparator()->areNotEqual($this->getCausationId(), $this);
    }

    public function correlatesWith(Trace $other): bool
    {
        return $this->getTraceIdentityComparator()->areEqual(
            $this->getCorrelationId(),
            $other->getCorrelationId()
        );
    }

    public function equals(mixed $other): bool
    {
        if (!$other instanceof Trace) {
            return false;
        }

        return $this->getTraceIdentityComparator()->areEqual($this->getId(), $other->getId())
            && $this->getTraceIdentityComparator()->areEqual($this->getCausationId(), $other->getCausationId())
            && $this->getTraceIdentityComparator()->areEqual($this->getCorrelationId(), $other->getCorrelationId());
    }
}
