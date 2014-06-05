<?php

/**
 * @file
 * Contains \Drupal\rules\Tests\RulesOrTest.
 */

namespace Drupal\rules\Tests;

use Drupal\rules\Plugin\RulesExpression\RulesOr;

/**
 * Tests the rules OR condition plugin.
 */
class RulesOrTest extends RulesTestBase {

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => 'RulesOr class tests',
      'description' => 'Test the RuleOr class',
      'group' => 'Rules',
    ];
  }

  /**
   * Tests one condition.
   */
  public function testOneCondition() {
    // The method on the test condition must be called once.
    $this->trueCondition->expects($this->once())
      ->method('execute');

    $or = $this->getMockOr();
    $or->addCondition($this->trueCondition);
    $result = $or->execute();
    $this->assertTrue($result, 'Single condition returns TRUE.');
  }

  /**
   * Tests an empty OR.
   */
  public function testemptyOr() {
    $or = $this->getMockOr();
    $this->assertTrue($or->execute(), 'Empty OR returns TRUE.');
  }

  /**
   * Tests two true condition.
   */
  public function testTwoConditions() {
    // The method on the test condition must be called once.
    $this->trueCondition->expects($this->once())
      ->method('execute');

    $or = $this->getMockOr()
      ->addCondition($this->trueCondition)
      ->addCondition($this->trueCondition);

    $this->assertTrue($or->execute(), 'Two conditions returns TRUE.');
  }

  /**
   * Tests two false conditions.
   */
  public function testTwoFalseConditions() {
    // The method on the test condition must be called once.
    $this->falseCondition->expects($this->exactly(2))
      ->method('execute');

    $or = $this->getMockOr()
      ->addCondition($this->falseCondition)
      ->addCondition($this->falseCondition);

    $this->assertFalse($or->execute(), 'Two false conditions return FALSE.');
  }
}
