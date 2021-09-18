Feature: Use case for LazyIterable
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

use Strictify\Lazy\LazyIterable;
use Strictify\Lazy\ResolvedIterable;
use Strictify\Lazy\Contract\LazyIterableInterface;

class View
{
    /**
     * @param LazyIterableInterface<Exception> $first
     * @param LazyIterableInterface<Exception> $second
     */
    public function __construct(
        private $first,
        private $second,
    ){}
}

new View(
    first: new LazyIterable(fn() => [new Exception(), new RuntimeException()]),
    second: new ResolvedIterable([new Exception(), new RuntimeException()]),
);
      """
    When I run Psalm
    Then I see no errors

