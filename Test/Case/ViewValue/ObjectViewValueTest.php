<?php
App::uses('ViewValueTestCase', 'ViewValue.Test');

class ObjectViewValueTest extends ViewValueTestCase {

	public $className = 'ObjectViewValue';

/**
 * @test
 */
	public function testObjectViewValueHasRawMethod() {
		$obj = new stdClass();
		$this->assertTrue(method_exists($this->create($obj), 'raw'));
	}

/**
 * @test
 */
	public function testRawValueIsObject() {
		$obj = new stdClass;
		$this->assertTrue(gettype($this->create($obj)->raw()) === 'object');
	}

/**
 * @test
 */
	public function testStringInObjectViewValueIsStringViewValue() {
		$obj = new stdClass;
		$obj->name = 'hoge';
		$objInstance = $this->create($obj);
		$this->assertInstanceOf('StringViewValue', $objInstance->name);
	}

/**
 * @test
 */
	public function testStringInObjectViewValueShouldBeEscaped() {
		$obj = new stdClass;
		$obj->val = '<script>alert(0)</script>';
		$objInstance = $this->create($obj);
		$this->outputShouldBeSame(
			$this->_h('<script>alert(0)</script>'),
			$objInstance->val
		);
	}

/**
 * @test
 */
	public function testArrayInObjectViewValueIsArrayViewValue() {
		$obj = new stdClass;
		$obj->array = array();
		$objInstance = $this->create($obj);
		$this->assertInstanceOf('ArrayViewValue', $objInstance->array);
	}

/**
 * @test
 */
	public function testExceptionByString() {
		$this->_constructorthrowExceptionBy('hoge');
	}

/**
 * @test
 */
	public function testExceptionByNull() {
		$this->_constructorThrowExceptionBy(null);
	}

/**
 * @test
 */
	public function testExceptionByBool() {
		$this->_constructorThrowExceptionBy(true);
	}

/**
 * @test
 */
	public function testObjectCallShouldBeEscaped() {
		$obj = new SampleObject();
		$obj->value = '<script>alert(0)</script>';
		$objInstance = $this->create($obj);
		$this->outputShouldBeSame(
			$this->_h('<script>alert(0)</script>'),
			$objInstance->callableMethod()
		);
	}

/**
 * @test
 */
	public function testObjectUnCallableMethodThrowBadMethodCallException() {
		$obj = new SampleObject();
		$objInstance = $this->create($obj);
		$this->setExpectedException('BadMethodCallException');
		$objInstance->_unCallableMethod();
	}

}

class SampleObject {

	public $value = '';

	public function callableMethod() {
		return $this->value;
	}

	protected function _unCallableMethod() {
		return 'this is not callable method';
	}
}
