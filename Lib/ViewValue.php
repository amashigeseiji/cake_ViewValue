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

class ViewValue Implements ArrayAccess, IteratorAggregate {
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

	public function offsetSet($key, $value = null) {
		return $this->instance->offsetSet($key, $value);
	}

	public function offsetExists($key) {
		return $this->instance->offsetExists($key);
	}

	public function offsetUnset($key) {
		return $this->instance->offsetExists($key);
	}
}
