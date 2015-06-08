<?php
App::uses('BaseViewValue', 'ViewValue.Lib');

class StringValue extends BaseViewValue {

	public $type = 'string';

	public function __toString() {
		return $this->clean();
	}
}
