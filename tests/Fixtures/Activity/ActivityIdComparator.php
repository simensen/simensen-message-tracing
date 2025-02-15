<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Fixtures\Activity;

use Simensen\MessageTracing\TraceIdentityComparator;

/**
 * @implements TraceIdentityComparator<ActivityId>
 */
class ActivityIdComparator implements TraceIdentityComparator
{
    public function areEqual(mixed $one, mixed $two): bool
    {
        return $one instanceof ActivityId && $one->equals($two);
    }

    public function areNotEqual(mixed $one, mixed $two): bool
    {
        return !$this->areEqual($one, $two);
    }
}
