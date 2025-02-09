<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Fixtures\Activity;

final class Activity
{
    public function __construct(
        private ?ActivityTracer $activityTracer = null,
    ) {
    }

    public function getActivityTracer(): ?ActivityTracer
    {
        return $this->activityTracer;
    }

    public function setActivityTracer(ActivityTracer $activityTracer): void
    {
        $this->activityTracer = $activityTracer;
    }
}
