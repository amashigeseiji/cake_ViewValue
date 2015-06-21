<?php
App::uses('ArrayViewValue', 'ViewValue.ViewValue');
App::uses('StringViewValue', 'ViewValue.ViewValue');
App::uses('ObjectViewValue', 'ViewValue.ViewValue');
App::uses('ViewValueFactory', 'ViewValue.Lib');

class ViewValueTestCase extends CakeTestCase {

	public $className = '';

	public function create($arg) {
		return new $this->className($arg);
	}

	protected function _h($val) {
		return htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
	}

	public function outputShouldBeSame($string1, $string2) {
		$this->expectOutputString($string1);
		echo $string2;
	}

	protected function constructorThrowExceptionBy($arg) {
		$this->setExpectedException('LogicException');
		$this->create($arg);
	}
}
