<?php
App::uses('ArrayViewValue', 'ViewValue.ViewValue');
App::uses('StringViewValue', 'ViewValue.ViewValue');
App::uses('ObjectViewValue', 'ViewValue.ViewValue');
App::uses('ViewValueFactory', 'ViewValue.Lib');

class ViewValueTestCase extends CakeTestCase {

	public $className = '';

/**
 * create
 *
 * @param mixed $arg ViewValue argument
 * @return BaseViewValue
 */
	public function create($arg) {
		return new $this->className($arg);
	}

/**
 * _h
 *
 * @param string $val string
 * @return string
 */
	protected function _h($val) {
		return htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
	}

/**
 * outputShouldBeSame
 *
 * @param string $string1 compared
 * @param string $string2 compared
 * @return void
 */
	public function outputShouldBeSame($string1, $string2) {
		$this->expectOutputString($string1);
		echo $string2;
	}

/**
 * outputShouldBeSame
 *
 * @param mixed $arg BaseViewValue argument
 * @return void
 */
	protected function _constructorThrowExceptionBy($arg) {
		$this->setExpectedException('LogicException');
		$this->create($arg);
	}
}
