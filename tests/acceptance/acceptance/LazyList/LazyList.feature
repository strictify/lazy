Feature: LazyList
  Background:
    Given I have the following config
      """
      <?xml version="1.0"?>
      <psalm totallyTyped="true" findUnusedVariablesAndParams="false">
        <projectFiles>
          <directory name="."/>
        </projectFiles>
      </psalm>
      """
  Scenario: Test list values and types
    Given I have the following code
      """
<?php

declare(strict_types=1);

use Strictify\Lazy\LazyList;

/** @return list<string> */
function slow() {
  return ['a', 'b', 'c'];
}

$lazy = new LazyList(fn() => slow());
/** @psalm-trace $lazy */
echo 123;

$values = $lazy->getValues();
/** @psalm-trace $values */

foreach($lazy as $key => $value) {
    /** @psalm-trace $key */
    echo 123; // without at least one line of code, psalm cannot correctly print trace statements
    /** @psalm-trace $value */
}

      """
    When I run Psalm
    Then I see these errors
      | Type  | Message |
      | Trace | $lazy: Strictify\Lazy\LazyList<string> |
      | Trace | $values: iterable<array-key, string>   |
      | Trace | $key: array-key                        |
      | Trace | $value: string                         |
    And I see no other errors

