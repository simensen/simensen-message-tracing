<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Simensen\MessageTracing\Tests\Fixtures\Activity\Activity;
use Simensen\MessageTracing\Tests\Fixtures\Activity\ActivityScenario;

class SmokeTest extends TestCase
{
    protected ActivityScenario $scenario;

    public function setUp(): void
    {
        $this->scenario = ActivityScenario::create();
    }

    public function testSomething(): void
    {
        $activityOne = new Activity();

        self::assertNull($activityOne->getActivityTracer());
        self::assertTrue($this->scenario->getTraceStack()->isEmpty());

        $activityOne = $this->scenario->getCausationTracedContainerManager()->push($activityOne);

        self::assertNotNull($activityTracerOne = $activityOne->getActivityTracer());
        self::assertTrue($this->scenario->getTraceStack()->isNotEmpty());
        self::assertTrue($this->scenario->getTraceStack()->isTail($activityTracerOne));

        $activityTwo = new Activity();

        $activityTwo = $this->scenario->getCorrelationTracedContainerManager()->push($activityTwo);

        self::assertNotNull($activityTracerTwo = $activityTwo->getActivityTracer());
        self::assertFalse($activityTracerTwo->equals($activityTracerOne));
        self::assertTrue($this->scenario->getTraceStack()->isTail($activityTracerOne));

        $activityThree = new Activity();

        $activityThree = $this->scenario->getCausationTracedContainerManager()->push($activityThree);

        self::assertNotNull($activityTracerThree = $activityThree->getActivityTracer());
        self::assertFalse($activityTracerThree->equals($activityTracerOne));
        self::assertFalse($activityTracerThree->equals($activityTracerTwo));
        self::assertTrue($this->scenario->getTraceStack()->isTail($activityTracerThree));

        $activityThree = $this->scenario->getCausationTracedContainerManager()->pop($activityThree);

        self::assertTrue($this->scenario->getTraceStack()->isTail($activityTracerOne));

        $activityTwo = $this->scenario->getCausationTracedContainerManager()->pop($activityTwo);

        self::assertTrue($this->scenario->getTraceStack()->isTail($activityTracerOne));

        $activityOne = $this->scenario->getCausationTracedContainerManager()->pop($activityOne);

        self::assertTrue($this->scenario->getTraceStack()->isEmpty());
    }
}
