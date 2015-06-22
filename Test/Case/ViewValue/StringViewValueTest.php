<?php
App::uses('ViewValueTestCase', 'ViewValue.Test');

class StringViewValueTest extends ViewValueTestCase {

	public $className = 'StringViewValue';

/**
 * @test
 */
	public function testExpectString() {
		$this->outputShouldBeSame(
			'hoge',
			$this->create('hoge')->__toString()
		);
	}

/**
 * @test
 */
	public function testExpectStringEscaped() {
		$this->outputShouldBeSame(
			$this->_h('<script>alert(0)</script>'),
			$this->create('<script>alert(0)</script>')
		);
	}

/**
 * @test
 */
	public function testStringViewValueHasRawMethod() {
		$this->assertTrue(method_exists($this->create('hoge'), 'raw'));
	}

/**
 * @test
 */
	public function testStringShouldBeSameToStringViewValue() {
		$string1 = $this->create('<script>alert(0)</script>');
		$this->assertEquals($this->_h('<script>alert(0)</script>'), $string1);
	}

/**
 * @test
 */
	public function testStringShouldBeSameToRawValue() {
		$string1 = $this->create('<script>alert(0)</script>');
		$this->assertEquals('<script>alert(0)</script>', $string1->raw());
	}
}
