<?php
/**
 * The MIT License (MIT)
 * Copyright (c) 2020 GameplayJDK
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
 * Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 */

require dirname(__DIR__) . '/vendor/autoload.php';

use TaskChain\TaskChain;
use TaskChain\TaskInterface;

// Create a task chain (using the built-in implementation).
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

// Once a chain is ran, the priority information gets lost (using the built-in implementation).
echo $chain->run(1);
echo PHP_EOL;
