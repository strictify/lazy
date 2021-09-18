Feature: Use case for LazyValue
  Background:
    Given I have the following config
      """
      <?xml version="1.0"?>
      <psalm totallyTyped="true" >
        <projectFiles>
          <directory name="."/>
        </projectFiles>
      </psalm>
      """
  Scenario: Allow covariance
    Given I have the following code
      """
<?php

declare(strict_types=1);

use Strictify\Lazy\LazyValue;
use Strictify\Lazy\ResolvedValue;
use Strictify\Lazy\Contract\LazyValueInterface;

class View
{
    /**
     * @param LazyValueInterface<Exception> $first
     * @param LazyValueInterface<Exception> $second
     * @param LazyValueInterface<Exception> $third
     */
    public function __construct(
        private $first,
        private $second,
        private $third,
    ){}
}

new View(
    first: new LazyValue(fn() => new Exception()),
    second: new LazyValue(fn() => new RuntimeException()),
    third: new ResolvedValue(new RuntimeException()),
);

      """
    When I run Psalm
    Then I see no errors

