<?php

declare(strict_types=1);

namespace Simensen\MessageTracing\Behavior\Trace;

trait TraceGettersBehavior
{
    public function getId(): mixed
    {
        return $this->id;
    }

    public function getCausationId(): mixed
    {
        return $this->causationId;
    }

    public function getCorrelationId(): mixed
    {
        return $this->correlationId;
    }
}
