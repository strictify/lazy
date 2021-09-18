Feature: Use case for LazyList
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

use Strictify\Lazy\LazyList;
use Strictify\Lazy\ResolvedList;
use Strictify\Lazy\Contract\LazyListInterface;

class View
{
    /**
     * @param LazyListInterface<Exception> $first
     * @param LazyListInterface<Exception> $second
     */
    public function __construct(
        private $first,
        private $second,
    ){}
}

new View(
    first: new LazyList(fn() => [new Exception(), new RuntimeException()]),
    second: new ResolvedList([new Exception(), new RuntimeException()]),
);
      """
    When I run Psalm
    Then I see no errors

