<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\TraceIdentity;

/**
 * @template TIdentity
 */
interface TraceIdentityComparator
{
    public function areEqual(mixed $one, mixed $two): bool;

    public function areNotEqual(mixed $one, mixed $two): bool;
}
