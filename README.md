# Message Tracing

A PHP library for message tracing with causation and correlation tracking. This library provides interfaces and traits for implementing distributed tracing patterns in message-based systems.

## Features

- **Causation Tracking**: Track direct cause-effect relationships between messages
- **Correlation Tracking**: Group related messages that share common context
- **Generic/Template Design**: Type-safe interfaces using PHP generics
- **Container-Agnostic**: Works with any container type that can hold tracing metadata
- **No Concrete Dependencies**: Ships with interfaces and traits, not concrete implementations
- **Comprehensive Testing**: Includes testing utilities and spy implementations

## Requirements

- PHP 8.2 or higher

## Installation

```bash
composer require simensen/message-tracing
```

## Core Concepts

### Trace

The `Trace` interface represents tracing identity and relationships with causation and correlation IDs. Each trace has:

- **ID**: Unique identifier for this trace
- **Causation ID**: ID of the direct cause (parent) trace
- **Correlation ID**: ID that groups related traces together

### TraceGenerator

Creates `Trace` instances with proper identity generation.

### TraceStack

Low-level stack management for `Trace` objects, maintaining the current trace context.

### TracedContainerManager

High-level interface for managing traced containers (e.g., messages, events, commands).

### TraceIdentityGenerator

Generates unique identities for traces.

### TraceIdentityComparator

Compares trace identities for equality.

## Quick Start

This library provides interfaces and behavior traits without concrete implementations. Here's how to use it:

### 1. Create Your Identity Type

```php
final readonly class MessageId
{
    public function __construct(
        public string $value
    ) {}
}
```

### 2. Implement a Trace

```php
use Simensen\MessageTracing\Trace\Trace;
use Simensen\MessageTracing\Trace\Behavior\TraceGenerationBehavior;
use Simensen\MessageTracing\Trace\Behavior\TraceGettersBehavior;
use Simensen\MessageTracing\Trace\Behavior\TraceComparisonBehavior;

/**
 * @implements Trace<MessageId>
 */
final readonly class MessageTrace implements Trace
{
    use TraceGenerationBehavior;
    use TraceGettersBehavior;
    use TraceComparisonBehavior;

    public function __construct(
        private MessageId $id,
        private MessageId $causationId,
        private MessageId $correlationId,
    ) {}
}
```

### 3. Create Identity Generator

```php
use Simensen\MessageTracing\TraceIdentity\TraceIdentityGenerator;

/**
 * @implements TraceIdentityGenerator<MessageId>
 */
final class MessageIdGenerator implements TraceIdentityGenerator
{
    public function generate(): MessageId
    {
        return new MessageId(uniqid());
    }
}
```

### 4. Set Up Tracing

```php
use Simensen\MessageTracing\TraceStack\Adapter\DefaultTraceStack;
use Simensen\MessageTracing\TracedContainerManager\Behavior\CausationTracedContainerManagerBehavior;

$identityGenerator = new MessageIdGenerator();
$traceGenerator = new MessageTraceGenerator();
$traceStack = new DefaultTraceStack($traceGenerator, $identityGenerator);

// For causation tracking
class CausationMessageManager
{
    use CausationTracedContainerManagerBehavior;
    
    public function __construct(private TraceStack $traceStack) {}
}

$manager = new CausationMessageManager($traceStack);
```

## Architecture

### Package Structure

```
src/
├── Trace/                          # Core tracing interfaces and behaviors
├── TraceIdentity/                  # Identity generation and comparison
├── TraceStack/                     # Stack management for traces
├── TracedContainerManager/         # High-level container management
└── Testing/                        # Testing utilities and scenarios
```

### Key Design Principles

- **No concrete implementations**: Core interfaces ship with traits but no concrete classes
- **Causation vs Correlation**: Supports both causation (direct cause-effect) and correlation (related) tracing
- **Container-agnostic**: Works with any container type that can hold tracing metadata
- **Test-first**: Extensive testing infrastructure with spy implementations

## Development

### Setup

```bash
make vendor    # Install dependencies
```

### Development Workflow

```bash
make it        # Run complete development workflow (tools, vendor, cs, tests)
```

### Individual Commands

```bash
make cs                    # Run code style fixes
make tests                 # Run PHPUnit tests
make phpstan               # Run static analysis (level 9)
make dependency-analysis   # Run composer-require-checker
make clover                # Generate code coverage report
```

### Testing

```bash
# Run all tests
./vendor/bin/phpunit

# Run tests with coverage
XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-clover=coverage.clover
```

## Testing Your Implementation

The library includes `MessageTracingScenario` for testing implementations:

```php
use Simensen\MessageTracing\Testing\MessageTracingScenario;

/**
 * @extends MessageTracingScenario<Message,MessageId>
 */
final readonly class MessageScenario extends MessageTracingScenario
{
    public static function create(): self
    {
        // Set up your trace components
        return new self(
            $traceIdentityGenerator,
            $traceGenerator,
            $traceStack,
            $spyingTraceStack,
            $causationTracedContainerManager,
            $correlationTracedContainerManager,
        );
    }
}
```

## License

MIT License. See LICENSE file for details.