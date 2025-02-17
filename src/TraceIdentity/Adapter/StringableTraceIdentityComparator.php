<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\TraceIdentity\Adapter;

use Simensen\MessageTracing\Trace\Trace;
use Simensen\MessageTracing\TraceIdentity\TraceIdentityComparator;

/**
 * @implements TraceIdentityComparator<string>
 */
final readonly class StringableTraceIdentityComparator implements TraceIdentityComparator
{
    public function areEqual(mixed $one, mixed $two): bool
    {
        if ($two instanceof Trace) {
            $two = $two->getId();
        }

        if (!(is_string($two) || $two instanceof \Stringable)) {
            return false;
        }

        if ($one instanceof Trace) {
            $one = $one->getId();
        }

        return (is_string($one) || $one instanceof \Stringable) && (string) $one === (string) $two;
    }

    public function areNotEqual(mixed $one, mixed $two): bool
    {
        return !$this->areEqual($one, $two);
    }
}
