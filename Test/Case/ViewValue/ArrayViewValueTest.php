<?php
App::uses('ViewValueTestCase', 'ViewValue.Test');

class ArrayViewValueTest extends ViewValueTestCase {

	public $className = 'ArrayViewValue';

/**
 * @test
 */
	public function testArrayViewValueHasRawMethod() {
		$array = array('string');
		$this->assertTrue(method_exists($this->create($array), 'raw'));
	}

/**
 * @test
 */
	public function testRawValueIsArray() {
		$array = array('string');
		$this->assertTrue(gettype($this->create($array)->raw()) === 'array');
	}

/**
 * @test
 */
	public function testArrayViewValueActAsArrayByOffsetGet() {
		$array = array('string', 1);
		$arrayInstance = $this->create($array);
		$this->assertEquals($arrayInstance[0], 'string');
		$this->assertEquals($arrayInstance[1], 1);
	}

/**
 * @test
 */
	public function testIteration() {
		$array = array('hoge', '<script>alert(0)</script>', 0);
		$arrayInstance = $this->create($array);
		foreach ($arrayInstance as $key => $value) {
			if ($key === 0) {
				$this->assertEquals('hoge', $value);
			} elseif ($key === 1) {
				$this->assertEquals($this->_h('<script>alert(0)</script>'), $value);
			} elseif ($key === 0) {
				$this->assertEquals(0, $value);
			}
		}
	}

/**
 * @test
 */
	public function testCount() {
		$array = array('hoge', '<script>alert(0)</script>', 0);
		$arrayInstance = $this->create($array);
		$this->assertEquals(3, count($arrayInstance));
	}

/**
 * @test
 */
	public function testStringInArrayViewValueIsStringViewValue() {
		$array = array('hoge');
		$arrayInstance = $this->create($array);
		$this->assertInstanceOf('StringViewValue', $arrayInstance[0]);
	}

/**
 * @test
 */
	public function testNestedArrayIsArrayViewValue() {
		$array = array(array('hoge'));
		$arrayInstance = $this->create($array);
		$this->assertInstanceOf('ArrayViewValue', $arrayInstance[0]);
	}

/**
 * @test
 */
	public function testStringInArrayViewValueShouldBeEscaped() {
		$array = array('<script>alert(0)</script>');
		$arrayInstance = $this->create($array);
		$this->outputShouldBeSame(
			$this->_h('<script>alert(0)</script>'),
			$arrayInstance[0]
		);
	}

/**
 * @test
 */
	public function testExceptionByString() {
		$this->constructorthrowExceptionBy('hoge');
	}

/**
 * @test
 */
	public function testExceptionByNull() {
		$this->constructorThrowExceptionBy(null);
	}

/**
 * @test
 */
	public function testExceptionByBool() {
		$this->constructorThrowExceptionBy(true);
	}
}
