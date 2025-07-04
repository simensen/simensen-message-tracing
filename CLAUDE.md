# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a PHP library for message tracing with causation and correlation tracking. The library provides interfaces and traits for implementing distributed tracing patterns in message-based systems.

## Development Commands

### Primary Development Workflow
```bash
make it                    # Run the complete development workflow (tools, vendor, cs, tests)
```

### Individual Commands
```bash
make vendor                # Install dependencies via composer
make cs                    # Run code style fixes with php-cs-fixer
make tests                 # Run PHPUnit tests
make phpstan               # Run static analysis with PHPStan (level 9)
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

### Code Quality
```bash
# Fix code style issues
php-cs-fixer fix

# Run static analysis
phpstan analyse --memory-limit 1G -l9 src tests/Fixtures -v
```

## Architecture

The library is built around several core concepts:

### Core Components

- **Trace**: Interface for tracing identity and relationships with causation/correlation IDs
- **TraceGenerator**: Creates Trace instances with proper identity generation
- **TraceStack**: Low-level stack management for Trace objects
- **TracedContainerManager**: High-level interface for managing traced containers (e.g., messages)
- **TraceIdentityGenerator**: Generates unique identities for traces
- **TraceIdentityComparator**: Compares trace identities

### Architecture Patterns

1. **Generic/Template Design**: All core interfaces use PHP generics (`@template`) for type safety
2. **Behavior Traits**: Implementation logic is provided via traits (e.g., `TraceGenerationBehavior`, `TraceComparisonBehavior`)
3. **Adapter Pattern**: Concrete implementations in `Adapter/` directories
4. **Testing Infrastructure**: `MessageTracingScenario` provides test scenarios with spying capabilities

### Package Structure

```
src/
├── Trace/                          # Core tracing interfaces and behaviors
├── TraceIdentity/                  # Identity generation and comparison
├── TraceStack/                     # Stack management for traces
├── TracedContainerManager/         # High-level container management
└── Testing/                        # Testing utilities and scenarios

tests/
├── Fixtures/                       # Test fixtures and example implementations
└── Unit/                          # Unit tests
```

### Key Design Principles

- **No concrete implementations**: Core interfaces ship with traits but no concrete classes
- **Causation vs Correlation**: Supports both causation (direct cause-effect) and correlation (related) tracing
- **Container-agnostic**: Works with any container type that can hold tracing metadata
- **Test-first**: Extensive testing infrastructure with spy implementations

## Development Notes

- PHP 8.2+ required
- Uses strict types throughout
- PHPStan level 9 analysis enforced
- All code must pass composer-require-checker validation
- Code style automatically fixed with php-cs-fixer