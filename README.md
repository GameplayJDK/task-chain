# task-chain

Small library for the task chain pattern.

That pattern allows building and defining sequential tasks in a clear and understandable, yet extensible way.

## Installation

```bash
composer require gameplayjdk/php-file-cache
```

## Usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use TaskChain\TaskChain;
use TaskChain\TaskInterface;

$chain = new TaskChain();

/**
 * Class TaskAdd
 */
class TaskAdd implements TaskInterface {

    /**
     * @var int
     */
    private $number;

    /**
     * TaskAdd constructor.
     * @param int $number
     */
    public function __construct(int $number)
    {
        $this->number = $number;
    }

    /**
     * @inheritDoc
     */
    public function accept($input): bool
    {
        return is_int($input);
    }

    /**
     * @inheritDoc
     */
    public function process($input, callable $nextCallback)
    {
        echo print_r($this, true);
        echo PHP_EOL;

        return $nextCallback($input + $this->number);
    }
}

/**
 * Class TaskMul
 */
class TaskMul implements TaskInterface {

    /**
     * @var int
     */
    private $number;

    /**
     * TaskMul constructor.
     * @param int $number
     */
    public function __construct(int $number)
    {
        $this->number = $number;
    }

    /**
     * @inheritDoc
     */
    public function accept($input): bool
    {
        return is_int($input);
    }

    /**
     * @inheritDoc
     */
    public function process($input, callable $nextCallback)
    {
        echo print_r($this, true);
        echo PHP_EOL;

        return $nextCallback($input * $this->number);
    }
}

// Add "1", priority 2.
$chain->add(new TaskAdd(1), 2);
// Multiply by "2", priority 3.
$chain->add(new TaskMul(2), 3);

// Once a chain is ran, the priority information gets lost (with the built-in implementation).
echo $chain->run(1);
echo PHP_EOL;

```

## License

It's MIT.
