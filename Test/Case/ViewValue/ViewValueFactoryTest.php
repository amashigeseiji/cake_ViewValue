<?php
App::uses('ViewValueFactory', 'ViewValue.Lib');

class ViewValueFactoryTest extends CakeTestCase {

/**
 * @test
 */
	public function testReturnArrayViewValueWhenGivenArray() {
		$array = array(1, 2);
		$this->assertInstanceOf('ArrayViewValue', ViewValueFactory::create($array));
	}

/**
 * @test
 */
	public function testReturnStringViewValueWhenGivenString() {
		$string = 'string';
		$this->assertInstanceOf('StringViewValue', ViewValueFactory::create($string));
	}

/**
 * @test
 */
	public function testReturnObjectViewValueWhenGivenObject() {
		$obj = new stdClass;
		$this->assertInstanceOf('ObjectViewValue', ViewValueFactory::create($obj));
	}

/**
 * @test
 */
	public function testReturnArrayViewValueWhenGivenArrayViewValue() {
		$arrayInstance = ViewValueFactory::create(array());
		$this->assertInstanceOf('ArrayViewValue', ViewValueFactory::create($arrayInstance));
	}

/**
 * @test
 */
	public function testReturnStringViewValueWhenGivenStringViewValue() {
		$stringInstance = ViewValueFactory::create('string');
		$this->assertInstanceOf('StringViewValue', ViewValueFactory::create($stringInstance));
	}

/**
 * @test
 */
	public function testReturnObjectViewValueWhenGivenObjectViewValue() {
		$objInstance = ViewValueFactory::create(new stdClass);
		$this->assertInstanceOf('ObjectViewValue', ViewValueFactory::create($objInstance));
	}

/**
 * @test
 */
	public function testReturnNullWhenGivenNull() {
		$null = ViewValueFactory::create(null);
		$this->assertEquals(null, $null);
	}

/**
 * @test
 */
	public function testReturnBooleanWhenGivenBoolean() {
		$true = ViewValueFactory::create(true);
		$this->assertEquals(true, $true);
		$false = ViewValueFactory::create(false);
		$this->assertEquals(false, $false);
	}
}
