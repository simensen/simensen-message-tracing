<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Testing;

use PHPUnit\Framework\TestCase;

/**
 * @template TContainer
 * @template TIdentity
 */
abstract class MessageTracingScenarioTestCase extends TestCase
{
    /**
     * @use MessageTracingScenarioBehavior<TContainer,TIdentity>
     */
    use MessageTracingScenarioBehavior;
}
