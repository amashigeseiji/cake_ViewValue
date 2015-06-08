<?php
/**
 * ViewValue Class
 *
 * sanitize view value by default
 *
 * @package		ViewValue
 * @author		Seiji Amashige <amasihge@startbahn.jp>
 * @version		1.0
 */

App::uses('StringValue', 'ViewValue.Lib');
App::uses('ArrayValue', 'ViewValue.Lib');

class ViewValue extends ArrayObject {
	private
		$name = '',
		$value = null,
		$instance = null
	;

	public function __construct($name, $value) {
		$this->name = $name;
		$this->value = $value;
		if (is_array($value)) {
			$this->instance = new ArrayValue($value);
			parent::__construct($this->instance->clean());
		} elseif (is_string($value)) {
			$this->instance = new StringValue($value);
		}
	}

	public function __call($name, $args) {
		return $this->instance->$name($args);
	}

	public function __toString() {
		return $this->instance->__toString();
	}

	public function getIterator() {
		return $this->instance->getIterator();
	}

	public function offsetGet($key) {
		return $this->instance->offsetGet($key);
	}
}
