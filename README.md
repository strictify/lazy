[![Type Coverage](https://shepherd.dev/github/strictify/lazy/coverage.svg)](https://shepherd.dev/github/strictify/lazy)

### Add laziness to data evaluation

#### Requirements
PHP ^8.0

#### Installation

```jsunicoderegexp
composer require strictify/lazy
```

Usage

```php
function someSlowFunction() {
    sleep(5);
    
    return 42;
}

// assigning the value does nothing
$lazy = new LazyValue(fn() => someSlowFunction());

// waits 5 seconds, return 42
$lazy->getValue();

// immediately returns 42
$lazy->getValue();

```

Full static analysis; psalm will always know the correct type.

More real cases soon.
