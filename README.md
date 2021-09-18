[![Type Coverage](https://shepherd.dev/github/strictify/lazy/coverage.svg)](https://shepherd.dev/github/strictify/lazy)

### Add laziness to data evaluation

#### Requirements
PHP ^8.0

#### Installation

```bash
composer require strictify/lazy
```

Usage:

```php
use Strictify\Lazy\LazyValue;

function someSlowFunction() {
    sleep(5);
    
    return 42;
}

// assigning the value does nothing
$lazy = new LazyValue(fn() => someSlowFunction());

// waits 5 seconds, returns 42
$lazy->getValue();

// immediately returns 42
$lazy->getValue();

```

Full static analysis; psalm will always know the correct type.

More real cases soon.
