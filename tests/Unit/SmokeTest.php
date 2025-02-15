<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Tests\Unit;

use Simensen\MessageTracing\Testing\MessageTracingScenario;
use Simensen\MessageTracing\Testing\MessageTracingScenarioTestCase;
use Simensen\MessageTracing\Tests\Fixtures\Activity\Activity;
use Simensen\MessageTracing\Tests\Fixtures\Activity\ActivityId;
use Simensen\MessageTracing\Tests\Fixtures\Activity\ActivityScenario;

/**
 * @extends MessageTracingScenarioTestCase<Activity,ActivityId>
 */
class SmokeTest extends MessageTracingScenarioTestCase
{
    protected static function buildMessageTracingScenario(): MessageTracingScenario
    {
        return ActivityScenario::create();
    }

    public function testBasicFunctionality(): void
    {
        $activityOne = new Activity();

        self::assertNull($activityOne->getActivityTracer());
        self::assertTrue($this->messageTracingScenario()->getTraceStack()->isEmpty());

        $activityOne = $this->messageTracingScenario()->getCausationTracedContainerManager()->push($activityOne);

        self::assertNotNull($activityTracerOne = $activityOne->getActivityTracer());
        self::assertTrue($this->messageTracingScenario()->getTraceStack()->isNotEmpty());
        self::assertTrue($this->messageTracingScenario()->getTraceStack()->isTail($activityTracerOne));

        $activityTwo = new Activity();

        $activityTwo = $this->messageTracingScenario()->getCorrelationTracedContainerManager()->push($activityTwo);

        self::assertNotNull($activityTracerTwo = $activityTwo->getActivityTracer());
        self::assertFalse($activityTracerTwo->equals($activityTracerOne));
        self::assertTrue($this->messageTracingScenario()->getTraceStack()->isTail($activityTracerOne));

        $activityThree = new Activity();

        $activityThree = $this->messageTracingScenario()->getCausationTracedContainerManager()->push($activityThree);

        self::assertNotNull($activityTracerThree = $activityThree->getActivityTracer());
        self::assertFalse($activityTracerThree->equals($activityTracerOne));
        self::assertFalse($activityTracerThree->equals($activityTracerTwo));
        self::assertTrue($this->messageTracingScenario()->getTraceStack()->isTail($activityTracerThree));

        $activityThree = $this->messageTracingScenario()->getCausationTracedContainerManager()->pop($activityThree);

        self::assertTrue($this->messageTracingScenario()->getTraceStack()->isTail($activityTracerOne));

        $activityTwo = $this->messageTracingScenario()->getCausationTracedContainerManager()->pop($activityTwo);

        self::assertTrue($this->messageTracingScenario()->getTraceStack()->isTail($activityTracerOne));

        $activityOne = $this->messageTracingScenario()->getCausationTracedContainerManager()->pop($activityOne);

        self::assertTrue($this->messageTracingScenario()->getTraceStack()->isEmpty());
    }
}
