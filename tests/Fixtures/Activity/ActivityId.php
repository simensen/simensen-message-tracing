<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Fixtures\Activity;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV7;

class ActivityId
{
    /**
     * @param UuidV7 $value
     */
    public function __construct(private Uuid $value)
    {
    }

    public static function generate(): self
    {
        return new self(Uuid::v7());
    }

    public function equals(mixed $other): bool
    {
        if (!$other instanceof ActivityId) {
            return false;
        }

        return $this->value->equals($other->getValue());
    }

    public function getValue(): Uuid
    {
        return $this->value;
    }
}
