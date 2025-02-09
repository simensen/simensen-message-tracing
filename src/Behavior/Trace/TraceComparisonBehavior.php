<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Behavior\Trace;

use Simensen\MessageTracing\Trace;

trait TraceComparisonBehavior
{
    public function isRoot(): bool
    {
        return $this->getId()->equals($this->getCorrelationId());
    }

    public function causedBy(Trace $other): bool
    {
        return $this->getCausationId()->equals($other) && !$this->getCausationId()->equals($this->getId());
    }

    public function correlatesWith(Trace $other): bool
    {
        return $this->getCorrelationId()->equals($other->getCorrelationId());
    }

    public function equals(mixed $other): bool
    {
        if (!$other instanceof Trace) {
            return false;
        }

        return $this->getId()->equals($other->getId())
            && $this->getCausationId()->equals($other->getCausationId())
            && $this->getCorrelationId()->equals($other->getCorrelationId());
    }
}
