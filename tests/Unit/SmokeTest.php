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
        self::assertTrue($this->scenario->traceStack->isEmpty());

        $activityOne = $this->scenario->causationTracedContainerManager->push($activityOne);

        self::assertNotNull($activityTracerOne = $activityOne->getActivityTracer());
        self::assertTrue($this->scenario->traceStack->isNotEmpty());
        self::assertTrue($this->scenario->traceStack->isTail($activityTracerOne));

        $activityTwo = new Activity();

        $activityTwo = $this->scenario->correlationTracedContainerManager->push($activityTwo);

        self::assertNotNull($activityTracerTwo = $activityTwo->getActivityTracer());
        self::assertFalse($activityTracerTwo->equals($activityTracerOne));
        self::assertTrue($this->scenario->traceStack->isTail($activityTracerOne));

        $activityThree = new Activity();

        $activityThree = $this->scenario->causationTracedContainerManager->push($activityThree);

        self::assertNotNull($activityTracerThree = $activityThree->getActivityTracer());
        self::assertFalse($activityTracerThree->equals($activityTracerOne));
        self::assertFalse($activityTracerThree->equals($activityTracerTwo));
        self::assertTrue($this->scenario->traceStack->isTail($activityTracerThree));

        $activityThree = $this->scenario->causationTracedContainerManager->pop($activityThree);

        self::assertTrue($this->scenario->traceStack->isTail($activityTracerOne));

        $activityTwo = $this->scenario->causationTracedContainerManager->pop($activityTwo);

        self::assertTrue($this->scenario->traceStack->isTail($activityTracerOne));

        $activityOne = $this->scenario->causationTracedContainerManager->pop($activityOne);

        self::assertTrue($this->scenario->traceStack->isEmpty());
    }
}
