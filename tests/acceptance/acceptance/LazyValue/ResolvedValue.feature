Feature: ResolvedValue
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
  Scenario: Assert correct types
    Given I have the following code
      """
<?php

declare(strict_types=1);

use Strictify\Lazy\ResolvedValue;

function slow(): int {
    return 42;
}

$lazy = new ResolvedValue(slow());

$value = $lazy->getValue();
/** @psalm-trace $value */

      """
    When I run Psalm
    Then I see these errors
      | Type  | Message                              |
      | Trace | $value: int                          |
    And I see no other errors
