<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Testing;

/**
 * @template TContainer
 * @template TIdentity
 */
trait MessageTracingScenarioBehavior
{
    /**
     * @var MessageTracingScenario<TContainer,TIdentity>
     */
    private MessageTracingScenario $messageTracingScenario;

    /**
     * @return MessageTracingScenario<TContainer,TIdentity>
     */
    protected function messageTracingScenario(): MessageTracingScenario
    {
        return $this->messageTracingScenario ??= static::buildMessageTracingScenario();
    }

    /**
     * @return MessageTracingScenario<TContainer,TIdentity>
     */
    abstract protected static function buildMessageTracingScenario(): MessageTracingScenario;
}
