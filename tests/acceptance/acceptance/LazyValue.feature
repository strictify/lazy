Feature: basics
  In order to test my plugin
  As a plugin developer
  I need to have tests

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
  Scenario: Assert LazyValue types
    Given I have the following code
      """
<?php

declare(strict_types=1);

namespace Strictify\Lazy\Tests\Fixture;

use Strictify\Lazy\LazyValue;

class Fake
{
    public function test(): void
    {
        $lazy = new LazyValue(fn() => $this->slow());
        /** @psalm-trace $lazy */

        $value = $lazy->getValue();
        /** @psalm-trace $value */
    }

    public function slow(): int
    {
        return 42;
    }
}
      """
    When I run Psalm
    Then I see these errors
      | Type  | Message                              |
      | Trace | $lazy: Strictify\Lazy\LazyValue<int> |
      | Trace | $value: int                          |
    And I see no other errors

